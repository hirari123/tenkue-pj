<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $primaryKey = 'image_id';

    /**
     * このimageが添付されているarticleを取得
     */
    public function articles_image()
    {
        return $this->belongsTo('App\Article');
    }
}
