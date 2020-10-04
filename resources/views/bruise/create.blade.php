@extends('layouts.app')

@section('title', 'データ投稿')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <h2>データ投稿フォーム</h2>
        <form method="POST" action="{{ route('insert') }}" onSubmit="return checkSubmit()">
        @csrf
            <div class="form-group">
                <label for="userid">
                        ユーザID
                    </label>
                    <input
                        id="userid"
                        name="userid"
                        class="form-control"
                        value="{{ $username }}"
                        type="text"
                    >
                @if ($errors->has('userid'))
                    <div class="text-danger">
                        {{ $errors->first('userid') }}
                    </div>
                @endif
                </div>
            <div class="form-group">
                <label for="target">
                    対象
                </label>
                <input
                    id="target"
                    name="target"
                    class="form-control"
                    value="{{ old('target') }}"
                    type="text"
                >
                @if ($errors->has('target'))
                    <div class="text-danger">
                        {{ $errors->first('target') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="age">
                    年齢
                </label>
                <input
                    id="age"
                    name="age"
                    class="form-control"
                    value="{{ old('age') }}"
                    type="text"
                >
                @if ($errors->has('age'))
                    <div class="text-danger">
                        {{ $errors->first('age') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="sex">
                    性別
                </label>
                {{Form::select('sex', 
                [
                '00：選択して下さい',
                '01：男性',
                '02：女性'
                ])}}
                @if ($errors->has('sex'))
                    <div class="text-danger">
                        {{ $errors->first('sex') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseiyy">
                    発生年
                </label>
                <input
                    id="hasseiyy"
                    name="hasseiyy"
                    class="form-control"
                    value="{{ old('hasseiyy') }}"
                    type="text"
                >
                @if ($errors->has('hasseiyy'))
                    <div class="text-danger">
                        {{ $errors->first('hasseiyy') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseimm">
                    発生月
                </label>
                <input
                    id="hasseimm"
                    name="hasseimm"
                    class="form-control"
                    value="{{ old('hasseimm') }}"
                    type="text"
                >
                @if ($errors->has('hasseimm'))
                    <div class="text-danger">
                        {{ $errors->first('hasseimm') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseidd">
                    発生日
                </label>
                <input
                    id="hasseidd"
                    name="hasseidd"
                    class="form-control"
                    value="{{ old('hasseidd') }}"
                    type="text"
                >
                @if ($errors->has('hasseidd'))
                    <div class="text-danger">
                        {{ $errors->first('hasseidd') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseihh">
                    発生時
                </label>
                <input
                    id="hasseihh"
                    name="hasseihh"
                    class="form-control"
                    value="{{ old('hasseihh') }}"
                    type="text"
                >
                @if ($errors->has('hasseihh'))
                    <div class="text-danger">
                        {{ $errors->first('hasseihh') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseimi">
                    発生分
                </label>
                <input
                    id="hasseimi"
                    name="hasseimi"
                    class="form-control"
                    value="{{ old('hasseimi') }}"
                    type="text"
                >
                @if ($errors->has('hasseimi'))
                    <div class="text-danger">
                        {{ $errors->first('hasseimi') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="factor">
                    原因
                </label>
                <input
                    id="factor"
                    name="factor"
                    class="form-control"
                    value="{{ old('factor') }}"
                    type="text"
                >
                @if ($errors->has('factor'))
                    <div class="text-danger">
                        {{ $errors->first('factor') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="element">
                    部位
                </label>
                {{Form::select('element', 
                [
                '00：選択して下さい',
                '01：頭',
                '02：顔',
                '03：首',
                '04：胸',
                '05：腹',
                '06：背中',
                '07：腹部',
                '08：上腕',
                '09：前腕',
                '10：手',
                '11：鼠径部',
                '12：大腿',
                '13：下腿',
                '14：足',
                '15：臀部'
                ])}}

                @if ($errors->has('element'))
                    <div class="text-danger">
                        {{ $errors->first('element') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="targetfile">
                    写真
                </label>
                <input
                    id="targetfile"
                    name="targetfile"
                    class="form-control"
                    value="{{ old('targetfile') }}"
                    type="text"
                >
                @if ($errors->has('targetfile'))
                    <div class="text-danger">
                        {{ $errors->first('targetfile') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="note">
                    メモ
                </label>
                <input
                    id="note"
                    name="note"
                    class="form-control"
                    value="{{ old('note') }}"
                    type="text"
                >
                @if ($errors->has('note'))
                    <div class="text-danger">
                        {{ $errors->first('note') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showUpload') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
            </div>
        </form>
    </div>
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