<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use App\Image;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    // 作成したArticleポリシーの有効化
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    // note一覧の表示 該当するuser_idのatricleのみ表示するように編集する

    public function index()
    {
        // ログインしているユーザーの記事のみ表示する

        $user_id = Auth::id();
        $articles = Article::where('user_id', $user_id)->latest()->get();
        return view('articles.index', ['articles' => $articles]);
    }

    // note作成画面の表示
    public function create()
    {
        return view('articles.create');
    }

    // noteのデータベースへの登録 + 添付された画像の保存 保存完了後は一覧ページへ遷移

    public function store(ArticleRequest $request, Article $article, Image $image)
    {
        // タイトルとコンテンツを取得
        $article->note_title = $request->note_title;
        $article->content = $request->content;

        // 登録ユーザーからidを取得
        $article->user_id = $request->user()->user_id;

        // 必要データを格納できたのでarticleを保存する
        $article->save();

        // $requestに画像データが添付されているのかを判定する

        if ($request->hasfile('image')) {

            // 画像をアップロードするための準備。
            // 投稿画像の拡張子を取得する
            $extension = $request->image->extension();

            // 画像名は 'アップロード時間' 'ユーザーid''拡張子名' を合わせたものにする
            $time = date("Ymdhis");
            $image->image_title = $time . '_' . $request->user()->user_id . '.' . $extension;

            // image、articleのarticle_idを結びつける $imageに画像データの格納
            $image->article_id = $article->article_id;
            $image->file_name = $request->image;

            // パブリックストレージへ画像を保存する
            $path = Storage::putFileAs('public', $request->file('image'), $image->image_title);

            // データベースエラー時にファイル削除を行うためトランザクションを利用する
            DB::beginTransaction();

            try {
                // 画像がストレージにupされたらDBにも画像を登録する。エラーが発生した場合はupした画像も削除する
                $image->save();
                // 画像の保存を確定
                DB::commit();
            } catch (\Exception $exception) {
                // エラーが発生した場合はトランザクションを取り消し
                DB::rollBack();
                // そしてアップロードしたファイルを削除する
                Storage::delete($image->image_title);
                throw $exception;
            }
        }
        // 画像保存はここまで

        // 一覧ページへリダイレクト
        return redirect()->route('articles.index');
    }

    // noteの編集画面の表示
    public function edit(Article $article)
    {
        $images = Image::where('article_id', $article->article_id)->latest()->get();
        return view('articles.edit', ['article' => $article], ['images' => $images]);
    }

    // noteの編集の反映
    public function update(ArticleRequest $request, Article $article, Image $image)
    {
        $article->fill($request->all());

        // 必要データを格納できたのでarticleを更新する
        $article->save();

        // $requestに画像データが添付されているのかを判定する

        if ($request->hasfile('image')) {

            // 画像をアップロードするための準備。
            // 投稿画像の拡張子を取得する
            $extension = $request->image->extension();

            // 画像名は 'アップロード時間' 'ユーザーid''拡張子名' を合わせたものにする
            $time = date("Ymdhis");
            $image->image_title = $time . '_' . $request->user()->user_id . '.' . $extension;

            // image、articleのarticle_idを結びつける $imageに画像データの格納
            $image->article_id = $article->article_id;
            $image->file_name = $request->image;

            // パブリックストレージへ画像を保存する
            $path = Storage::putFileAs('public', $request->file('image'), $image->image_title);

            // データベースエラー時にファイル削除を行うためトランザクションを利用する
            DB::beginTransaction();

            try {
                // 画像がストレージにupされたらDBにも画像を登録する。エラーが発生した場合はupした画像も削除する
                $image->save();
                // 画像の保存を確定
                DB::commit();
            } catch (\Exception $exception) {
                // エラーが発生した場合はトランザクションを取り消し
                DB::rollBack();
                // そしてアップロードしたファイルを削除する
                Storage::delete($image->image_title);
                throw $exception;
            }
        }
        // 画像保存はここまで

        return redirect()->route('articles.index');
    }

    // noteの削除
    // noteを削除したら同時に添付していた画像も削除されるように
    public function destroy(Article $article)
    {
        // note削除と同時に添付されている画像もpublicストレージから削除する
        // 複数削除に対応するために配列で画像名を取得する
        $delete_images = Image::where('article_id', $article->article_id)->pluck('image_title');

        foreach ($delete_images as $delete_image) {
            // 削除するパスとファイルの指定
            $delete_path = 'public/' . $delete_image;
            Storage::delete($delete_path);
        }

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
