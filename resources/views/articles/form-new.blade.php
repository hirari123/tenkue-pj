{{-- note記入フォーム。新規作成、編集の両方で使用する --}}

@csrf
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

        {{-- 画像表示エリア ノートの新規作成画面では画像を表示しない？ --}}
        {{-- @foreach ($images as $image)

            <div>
            <img src="{{ asset('storage/'. $image->image_title)}}" alt="添付したimage" style="width: 10%; height: auto;">
            </div>

        @endforeach --}}
