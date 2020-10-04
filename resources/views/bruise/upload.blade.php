@section('title', 'データupload')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>画像投稿</h2>
        <form method="POST" action="{{ route('upload') }}" onSubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="oid">
                    ユーザID
                </label>
                <label for="oid">
                {{ old('oid') }}
                </label>
            </div>
            <div class="form-group">
                <label for="image">
                    画像
                </label>
                <label for="image">
                {{ old('image') }}
                </label>
            </div>
            <div class="form-group">
                <label for="imgyy">
                    撮影年
                </label>
                <input
                    id="imgyy"
                    name="imgyy"
                    class="form-control"
                    value="{{ old('imgyy') }}"
                    type="text"
                >
                @if ($errors->has('imgyy'))
                    <div class="text-danger">
                        {{ $errors->first('imgyy') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="imgmm">
                撮影月
                </label>
                <input
                    id="imgmm"
                    name="imgmm"
                    class="form-control"
                    value="{{ old('imgmm') }}"
                    type="text"
                >
                @if ($errors->has('imgmm'))
                    <div class="text-danger">
                        {{ $errors->first('imgmm') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="imgdd">
                撮影日
                </label>
                <input
                    id="imgdd"
                    name="imgdd"
                    class="form-control"
                    value="{{ old('imgdd') }}"
                    type="text"
                >
                @if ($errors->has('imgdd'))
                    <div class="text-danger">
                        {{ $errors->first('imgdd') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="imghh">
                撮影時
                </label>
                <input
                    id="imghh"
                    name="imghh"
                    class="form-control"
                    value="{{ old('imghh') }}"
                    type="text"
                >
                @if ($errors->has('imghh'))
                    <div class="text-danger">
                        {{ $errors->first('imghh') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="imgmi">
                撮影分
                </label>
                <input
                    id="imgmi"
                    name="imgmi"
                    class="form-control"
                    value="{{ old('imgmi') }}"
                    type="text"
                >
                @if ($errors->has('imgmi'))
                    <div class="text-danger">
                        {{ $errors->first('imgmi') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="biko">
                    biko
                </label>
                <input
                    id="biko"
                    name="biko"
                    class="form-control"
                    value="{{ old('biko') }}"
                    type="text"
                >
                @if ($errors->has('biko'))
                    <div class="text-danger">
                        {{ $errors->first('biko') }}
                    </div>
                @endif
            </div>

                <input type="file" id="file" name="file" class="form-control" multiple>
            <!--
                <input type="hidden" name="hid" value="{{ $bruise->id }}">
                <input type="hidden" name="huserid" value="{{ $bruise->userid }}">
                <input type="hidden" name="htarget" value="{{ $bruise->target }}">
                <input type="hidden" name="helement" value="{{ $bruise->element }}">
                <button type="submit">アップロード</button>
-->
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showDetail') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection