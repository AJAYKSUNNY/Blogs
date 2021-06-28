<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validators\RegistrationValidator;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\UserLoginToken;
use App\Models\PasswordResets;
use App\Models\Blogs;

use Dingo;
use JWTAuth;
use JWTFactory;
use Session;
use Uuid;
use Auth;
use DB;


class RegistrationController extends Controller
{
    public function __construct()
    {
        
    }

    public function register(){

        return view('user_management/registration');
    }

    public function login(){

        return view('user_management/login');
    }

    public function dashBoard(Request $request){

        if($request->session()->has('user'))
        {
            $user_blogs =  app(Blogs::class)->where('users_id',$request->session()->get('user')->users_id)->orderBy('created_at','DESC')->paginate(10);
            return view('user_management/user_dashboard')->with('user',$request->session()->get('user'))->with('blogs',$user_blogs);
        }
        else{

            return redirect('login');
        }
        
    }

    public function userLogin(Request $request){

        try
        {
            $data = $request->all();
            $validation_rule = 'login-rule';
            app(RegistrationValidator::class)->with( $data )->passesOrFail($validation_rule);  // Pass validation rule depending up on the API
            $user = Sentinel::stateless($data);

            if($user)
            {
                $token = $this->generate_token($user);
                if(isset($token))
                {
                    $this->token_exist_check($token,$user->users_id);
                    $request->session()->put('user', $user);
                    return redirect('dashboard');
                }
            }
            else
            {   
                return view('user_management/login')->with('message','Invalid Credentials');
            }

        }
        catch (ValidatorException $e) {
            throw new Dingo\Api\Exception\StoreResourceFailedException('Unable to login user ', $e->getMessageBag());
        }
        catch (\Cartalyst\Sentinel\Checkpoints\checkThrottlingException $e){

            throw $e;
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function registerUser(Request $request){

        try
        {
            $data = $request->input();
            $validation_rule = 'register-rule';
            $result = app(RegistrationValidator::class)->with( $data )->passesOrFail($validation_rule);  // Pass validation rule depending up on the API
            $user = Sentinel::findByCredentials($data);
            if(!$user)
            {
                $user = Sentinel::registerAndActivate($data);
                $token = $this->generate_token($user);
                if(isset($token))
                {

                    $reset_data = [

                        'email'      => $user['email'],
                        'created_at' => now(),
                        'token'      => $this->getUuid()
                    ];

                    app(PasswordResets::class)->create($reset_data);

                    \Mail::send('email.email_verification',['firstname'=>$user['first_name'],'uuid' => $reset_data['token']], function ($message) use($reset_data,$user)
                    {
                       $message->subject("Woohoo! Set your password !!!");
                       $message->from("no-reply@simreka.com","Simreka");
                       $message->to(explode(',',$reset_data['email']));
                    });
                    return response()->json(['status'=>200,'user' => $user,'token' => $token['token']]);
                }
            }
            else
            {
                abort(412,'Account already exists with email '.$data['email']);
            }
        }
        catch (ValidatorException $e) {
            throw new Dingo\Api\Exception\StoreResourceFailedException('Unable to register user ', $e->getMessageBag());
        }
        catch(\Exception $e)
        { 
            throw $e;
        }

    }

    public function getUuid(){

        return (string) Uuid::generate();
    }

    public function generate_token($auth)
    {
        try {
            // // Create a token for the user
            $token = JWTAuth::fromUser($auth);

            $claims = JWTAuth::getJWTProvider()->decode($token);

        } catch (\Exception $e) {
            // something went wrong whilst attempting to encode the token
           throw $e;
        }
        
        return  [
            'token' => $token
        ];
    }
    public function token_exist_check($token,$users_id)
    {
        try
        {
            $token_exist = app(UserLoginToken::class)->where('users_id',$users_id)->first();
            if(isset($token_exist))
            {
                try
                {
                    JWTAuth::invalidate(JWTAuth::setToken(($token_exist->token)));
                }
                catch(\Exception $e)
                {
                    
                }
            }
            $data_for_create = [
                'users_id'   => $users_id,
                'token'      => $token['token']
            ];
            app(UserLoginToken::class)->UpdateorCreate(['users_id' => $users_id],$data_for_create);
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function setPassword($uniqid){

        return view('user_management/set_password')->with('uniqid',$uniqid);
    }

    public function setUserPassword(Request $request){

        try
        {
            $user_token =  app(PasswordResets::class)->where('token',$request['uniqid'])->first();
            $user       = Sentinel::findByCredentials(['email' => $user_token->email]);
            $result     = Sentinel::update($user, ['password' => $request['password'], 'email_verified_at' => date('Y-m-d H:i:s')]);

            if(!empty($result)){

                return json_encode(['status' => 200 , 'message' => "Password set successfully"]);

            }else{

                return json_encode(['status' => 400 , 'message' => "Password reset failed"]);
            }
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function createBlog(Request $request){

        try
        {
            $validation_rule = 'blog-rule';
            $result = app(RegistrationValidator::class)->with( $request->input() )->passesOrFail($validation_rule);

            $blog_id = $request->input('blog_id');
            if(isset($blog_id)){

                $update_data = [
                    'heading'          => $request->input('heading'),
                    'content'          => $request->input('content'),
                    'is_blog_verified' => 0
                ];

                $blog_deatails = app(Blogs::class)->UpdateorCreate(['blog_id' => $request->input('blog_id')],$update_data);
                $msg = "Blog updated successfully";
            }
            else{

                $blog_deatails =  app(Blogs::class)->create(['users_id' => $request->input('users_id'),'heading' => $request->input('heading'),'content' => $request->input('content')]);
                $msg = "Blog created successfully";
            }

            if(!empty($blog_deatails)){

                return json_encode(['status' => 200 , 'message' => $msg]);

            }else{

                return json_encode(['status' => 400 , 'message' => "Something went wrong"]);
            }
        }
        catch (ValidatorException $e) {
            throw new Dingo\Api\Exception\StoreResourceFailedException('Unable to create blog ', $e->getMessageBag());
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function deleteBlog(Request $request){

        try
        {
            $blog = Blogs::findOrFail($request->input('blog_id'));
            $result = $blog->delete();

            if($result){

                return json_encode(['status' => 200 , 'message' => "Blog deleted successfully"]);

            }else{

                return json_encode(['status' => 400 , 'message' => "Something went wrong"]);
            }
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->flush();
        return redirect('/login');
    }

    public function getBlogDetails(Request $request){

        try
        {
            $response = app(Blogs::class)->where('blog_id',$request->input('blog_id'))->get();
            if(!empty($response)){

                return json_encode(['status' => 200 , 'data' => $response->toArray()]);
            }
            else{

                return json_encode(['status' => 400 , 'data' => "Something went wrong"]);
            }
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getBlogAnalytics(Request $request){

        try
        {
            $data['total_blogs'] = app(Blogs::class)->where('users_id',$request->input('users_id'))->count();
            $data['total_verified'] = app(Blogs::class)->where('users_id',$request->input('users_id'))->where('is_blog_verified',1)->count();
            $data['total_verification_pending'] = app(Blogs::class)->where('users_id',$request->input('users_id'))->where('is_blog_verified',0)->count();
            return json_encode(['status' => 200 , 'data' => $data ]);
        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

    public function getBlogStatistics(Request $request){

        try
        {
            $to_date   = date('Y-m-d H:i:s');
            $from_date = date('Y-m-d 00:00:00',strtotime(' -30 days'));

            $result = DB::table('blogs')
             ->select(DB::raw('date_format(created_at,"%Y-%m-%d") as blog_date'), DB::raw('count(*) as blog_count'))
             ->where('users_id',$request->input('users_id'))
             ->whereBetween('created_at', [$from_date, $to_date])->groupBy('blog_date')
             ->get();
             
            if(!empty($result)){

                return json_encode(['status' => 200 , 'data' => $result->toArray() ]);

            }else{

                return json_encode(['status' => 400 , 'data' => "You dont have any blogs" ]);
            }

        }
        catch(\Exception $e)
        {
            throw $e;
        }
    }

}
