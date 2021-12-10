<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = "links";


    public function category() {
        return $this->belongsTo('App\Category','category_id');
    }

    public function website() {
        return $this->belongsTo('App\Website','website_id');
    }
    public function item() {
        return $this->belongsTo('App\Item','item_id');
    }
}
