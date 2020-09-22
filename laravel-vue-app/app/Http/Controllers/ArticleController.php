<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;

use App\Http\Requests\ArticleRequest;

use Illuminate\Http\Request;

class ArticleController extends Controller
{

    // 作成したArticleポリシーの有効化
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    // note一覧の表示
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');
        return view('articles.index', ['articles' => $articles]);
    }

    // note作成
    public function create()
    {
        return view('articles.create');
    }

    // $requestに格納されているデータを$article,$imageに割り当てて保存していく
    // noteのデータベースへの登録 + 添付された画像の保存 保存完了後は一覧ページへ遷移

    public function store(ArticleRequest $request, Article $article, Image $image)
    {
        // タイトルとコンテンツを取得
        $article->note_title = $request->note_title;
        $article->content = $request->content;

        // 投稿画像の拡張子を取得する
        $extension = $request->image->extension();

        // 画像のアップロード 画像名は 'アップロード時間' 'ユーザーid''拡張子名' を合わせたものにする
        $time = date("Ymdhis");
        $image->file_name = $time . '_' . $request->user()->id . $extension;


        // S3に投稿した画像を保存 第4引数の'public'はファイルを公開状態で保存するため
        // putFileAs($path, $file, $name, $options = [])
        Storage::cloud()
            ->putFileAs('', $request->image, $image->file_name, 'public');

        // データベースエラー時にファイル削除を行うためトランザクションを利用する
        DB::beginTransaction();

        try {
            // ログインユーザーの記事の中からimageを保存
            Auth::user()->articles()->images()->save($image);
            // 画像の保存を確定
            DB::commit();
        } catch (\Exception $exception) {
            // エラーが発生した場合はトランザクションを取り消し
            DB::rollBack();
            // そしてアップロードしたファイルを削除する
            Storage::cloud()->delete($image->file_name);
            throw $exception;
        }

        // 画像保存はここまで

        // 登録ユーザーからidを取得
        $article->user_id = $request->user()->id;

        // 必要データを格納できたのでarticleを保存する
        $article->save();

        // 一覧ページへリダイレクト
        return redirect()->route('articles.index');
    }

    // noteの編集
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
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

    // トップページの表示
    public function top()
    {
        return view('articles.toppage');
    }
}
