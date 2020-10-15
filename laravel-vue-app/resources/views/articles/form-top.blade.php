{{-- note記入フォーム トップページ用なので入力を受け付けない仕様 --}}

@csrf
<div class="top__text">

    <p>
        {{-- タイトル入力 --}}
        <input type="text" name="note_title"  placeholder="ノートタイトル"
        value="{{$article->note_title ?? old('note_title') }}" disabled>
    </p>

        {{-- 内容入力 --}}
        <textarea name="content" disabled class="form-control" rows="16"
        placeholder="ノート内容">{{$article->content ?? old('content') }}</textarea>


</div>
