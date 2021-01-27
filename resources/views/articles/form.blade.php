{{-- note記入フォーム。新規作成、編集の両方で使用する --}}

@csrf
<div class="md-form">
    {{-- タイトル入力 --}}
  <label>タイトル</label>
  <input type="text" class="form-control" name="note_title" required placeholder="ノートタイトル"
        value="{{$article->note_title ?? old('note_title') }}">
</div>

<div class="form-group">
  <label></label>
  {{-- 内容入力 --}}
        <textarea name="content" required class="form-control" rows="16"
        class="form-control" placeholder="ノート内容">{{$article->content ?? old('content') }}</textarea>
</div>

        {{-- 画像表示エリア --}}
        @foreach ($images as $image)

            <div>
            <img src="{{ asset('storage/'. $image->image_title)}}" alt="添付したimage" style="width: 10%; height: auto;">
            </div>

        @endforeach
</div>
