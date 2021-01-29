{{-- note記入フォーム。新規作成、編集の両方で使用する --}}

@csrf
<div class="md-form">
    {{-- タイトル入力 --}}
  <label>タイトル</label>
  <input type="text" class="form-control" name="note_title" required
        value="{{$article->note_title ?? old('note_title') }}">
</div>

<div class="form-group">
  <label></label>
  {{-- 内容入力 --}}
        <textarea class="form-control" name="content" required class="form-control" rows="16"
        >{{$article->content ?? old('content') }}</textarea>
</div>
