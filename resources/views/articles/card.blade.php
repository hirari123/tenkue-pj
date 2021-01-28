{{-- noteの詳細画面 更新、画像、削除、一覧ボタンの表示 --}}

<form method="POST" action="">

        {{-- form.bladeの読み込み  --}}
        @include('articles.form')

        {{-- ログイン時のみデータベースに登録する処理を行う --}}
        @auth
        <div class="top__btn">

          <div class="top__btn-new">

            {{-- noteの内容更新 --}}
            <p>
              <input type="submit" class="btn" name="post-note" value="内容更新"/>
            </p>

            {{-- 画像登録 --}}
            <p>
              <input type="submit" class="btn image" name="post-img" value="画像登録"/>
            </p>

          </div>

          {{-- 削除ボタン --}}

            <p>

              {{-- 削除ボタン --}}
              <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn edit">削除</button>
              </form>

            </p>

          {{-- 一覧ボタンの表示 --}}
          <div class="top__btn-login">

              {{-- 一覧ページへの遷移ボタン --}}
              <p>
                  <a href="{{route('list')}}">
                    <button type="button" class="btn">一覧</button>
                </a>
            </p>

            </div>

        </div>
