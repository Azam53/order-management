<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use \Conner\Tagging\Taggable;

    protected $fillable = [ 'title', 'content','user_id' ];
}
