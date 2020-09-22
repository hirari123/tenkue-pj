<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * このimageが添付されているarticleを取得
     */
    public function articles()
    {
        return $this->belongsTo('App\Article');
    }
}
