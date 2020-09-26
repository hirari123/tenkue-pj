<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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

        // 登録ユーザーからidを取得
        $article->user_id = $request->user()->user_id;

        // S3に投稿した画像を保存 第4引数の'public'はファイルを公開状態で保存するためのオプション
        // putFileAs($path, $file, $name, $options = [])
        // Storage::cloud()
        //     ->putFileAs('', $request->image, $image->file_name, 'public');

        // データベースエラー時にファイル削除を行うためトランザクションを利用する
        // DB::beginTransaction();

        // try {
        // 画像の保存を確定するかどうかをユーザー認証で判定している
        // Auth::user()->articles()->images()->save($image);
        // Auth::user()->article()->images()->save($image);
        // 画像の保存を確定
        //     DB::commit();
        // } catch (\Exception $exception) {
        //     // エラーが発生した場合はトランザクションを取り消し
        //     DB::rollBack();
        //     // そしてアップロードしたファイルを削除する
        //     Storage::cloud()->delete($image->file_name);
        //     throw $exception;
        // }


        // $requestに画像データが添付されているのかを判定する

        if ($request->filled('file_name')) {

            // 投稿画像の拡張子を取得する
            $extension = $request->file_name->extension();

            // 画像のアップロード  画像名は 'アップロード時間' 'ユーザーid''拡張子名' を合わせたものにする
            $time = date("Ymdhis");
            $image->image_title = $time . '_' . $request->user()->id . $extension;

            // image、articleのarticle_idを結びつける ariticle()の記述は必要？ $imageに画像データの格納
            $image->article_id = $article->article()->article_id;
            $image->file_name = $request->file_name;

            // 画像が添付されていた場合、ローカルストレージへ画像を保存する
            Storage::putFileAs('', '$image', '$image->image_title');

            // データベースエラー時にファイル削除を行うためトランザクションを利用する
            DB::beginTransaction();

            try {
                // 画像をupしたらDBに画像を保存する。エラーが発生した場合はアップした画像も削除する
                Auth::user()->articles()->images()->save($image);
                // 画像の保存を確定
                DB::commit();
            } catch (\Exception $exception) {
                // エラーが発生した場合はトランザクションを取り消し
                DB::rollBack();
                // そしてアップロードしたファイルを削除する
                Storage::delete($image->file_name);
                throw $exception;
            }
        }
        // 画像保存はここまで

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
    public function update(ArticleRequest $request, Article $article, Image $image)
    {
        $article->fill($request->all());

        // $requestに画像データが添付されているのかを判定する

        if ($request->filled('file_name')) {

            // 投稿画像の拡張子を取得する
            $extension = $request->file_name->extension();

            // 画像のアップロード  画像名は 'アップロード時間' 'ユーザーid''拡張子名' を合わせたものにする
            $time = date("Ymdhis");
            $image->image_title = $time . '_' . $request->user()->id . $extension;

            // image、articleのarticle_idを結びつける ariticle()の記述は必要？ $imageに画像データの格納
            $image->article_id = $article->article()->article_id;
            $image->file_name = $request->file_name;

            // 画像が添付されていた場合、ローカルストレージへ画像を保存する
            Storage::putFileAs('', '$image', '$image->image_title');

            // データベースエラー時にファイル削除を行うためトランザクションを利用する
            DB::beginTransaction();

            try {
                // 画像をupしたらDBに画像を保存する。エラーが発生した場合はアップした画像も削除する
                Auth::user()->articles()->images()->save($image);
                // 画像の保存を確定
                DB::commit();
            } catch (\Exception $exception) {
                // エラーが発生した場合はトランザクションを取り消し
                DB::rollBack();
                // そしてアップロードしたファイルを削除する
                Storage::delete($image->file_name);
                throw $exception;
            }
        }
        // 画像保存はここまで

        $article->save();
        return redirect()->route('articles.index');
    }

    // noteの削除
    // noteを削除したら同時に添付していた画像も削除されるようにカスケードの関係にする必要あり
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
