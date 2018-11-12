<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'arts';
    protected $primaryKey = 'art_id';
    protected $guarded =[];
    public $timestamps = false;
}
