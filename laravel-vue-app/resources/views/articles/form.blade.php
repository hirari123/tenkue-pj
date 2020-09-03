{{-- note記入フォーム。新規作成、編集の両方で使用する --}}

@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{$article->note_title ?? old('note_title') }}">
</div>

<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control" rows="16" placeholder="本文"
  value="{{$article->content ?? old('content') }}"></textarea>
</div>
