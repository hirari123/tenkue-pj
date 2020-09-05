<?php

namespace App\Http\Controllers;

// 記事一覧の取得のコード。記入待ち
//use App\Article;

use App\Http\Requests\ArticleRequest;

use Illuminate\Http\Request;

class ArticleController extends Controller
{

    // note作成
    public function create()
    {
        return view('articles.create');
    }

    // noteの登録
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    // noteの編集
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article])
    }

    // noteの編集の反映
    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        return redirect()->route('articles.index');
    }

    // noteの削除
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    // noteの詳細画面の表示
    public function show(Article $article)
    {
        return view('aritcle.show', ['article' => $article]);
    }
}
