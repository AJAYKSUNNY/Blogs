<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'blogs';

    protected $primaryKey = 'blog_id';

    public $timestamps = true;

    protected $fillable = [
        'users_id',
        'heading',
        'content',
        'is_blog_verified'
    ];
}
