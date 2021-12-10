<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = "website";

    public function category() {
        return $this->belongsTo('App\Category','category_id');
    }

    public function website() {
        return $this->belongsTo('App\Website','website_id');
    }
}
