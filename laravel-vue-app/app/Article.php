<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{

    protected $primaryKey = 'article_id';

    // 作成されたarticleのUserを取得
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    // articleに添付されたimageを取得 imagesテーブルとのリレーションを張っている
    public function images()
    {
        return $this->hasMany('App/Image');
    }
}
