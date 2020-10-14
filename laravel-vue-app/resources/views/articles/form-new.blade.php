{{-- note記入フォーム。新規作成、編集の両方で使用する --}}

@csrf
<div class="top__text">

    <p>
        {{-- タイトル入力 --}}
        <input type="text" name="note_title" required placeholder="ノートタイトル"
        value="{{$article->note_title ?? old('note_title') }}">
    </p>

        {{-- 内容入力 --}}
        <textarea name="content" required class="form-control" rows="16"
        placeholder="ノート内容">{{$article->content ?? old('content') }}</textarea>

</div>
