@extends('layouts.app')
@section('title', '　投稿に付加する')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
        @csrf
            <input type="hidden" name="id" value="{{ $bruise->id }}">
            <div class="form-group">
            <label for="userid">
                    ユーザ
                </label>
                <input
                    id="userid"
                    name="userid"
                    class="form-control"
                    value="{{ $bruise->userid }}"
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
                    どなたの
                </label>
                <input
                    id="target"
                    name="target"
                    class="form-control"
                    value="{{ $bruise->target }}"
                    type="text"
                >
                @if ($errors->has('target'))
                    <div class="text-danger">
                        {{ $errors->first('target') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="image1">
                    写真その１
                </label><br><b>
                <label for="image1">
                {{ $bruise->image1 }}
                </label></b>
            </div>
            <div class="form-group">
                <label for="takeymd1">
                コメント（撮影日時など）
                </label>
                <input
                    id="takeymd1"
                   name="takeymd1"
                    class="form-control"
                    value="{{ $bruise->takeymd1 }}"
                    type="text"
                >
                @if ($errors->has('takeymd1'))
                    <div class="text-danger">
                        {{ $errors->first('takeymd1') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="image2">
                    写真その２
                </label><br><b>
                <label for="image2">
                {{ $bruise->image2 }}
                </label></b>
            </div>
            <div class="form-group">
                <label for="takeymd2">
                コメント（撮影日時など）
                </label>
                <input
                    id="takeymd2"
                   name="takeymd2"
                    class="form-control"
                    value="{{ $bruise->takeymd2 }}"
                    type="text"
                >
                @if ($errors->has('takeymd2'))
                    <div class="text-danger">
                        {{ $errors->first('takeymd2') }}
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
                    value="{{ $bruise->age }}"
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
                ], $bruise->sex)}}

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
                    value="{{ $bruise->hasseiyy }}"
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
                    value="{{ $bruise->hasseimm }}"
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
                    value="{{ $bruise->hasseidd }}"
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
                    value="{{ $bruise->hasseihh }}"
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
                    value="{{ $bruise->hasseimi }}"
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
                    value="{{ $bruise->factor }}"
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
                ], $bruise->element)}}

                @if ($errors->has('element'))
                    <div class="text-danger">
                        {{ $errors->first('element') }}
                    </div>
                @endif
            </div>
<!--            
            <div class="form-group">
                <label for="targetfile">
                    写真
                </label>
                <input
                    id="targetfile"
                    name="targetfile"
                    class="form-control"
                    value="{{ $bruise->targetfile }}"
                    type="text"
                >
                @if ($errors->has('targetfile'))
                    <div class="text-danger">
                        {{ $errors->first('targetfile') }}
                    </div>
                @endif
            </div>
-->
            <div class="form-group">
                <label for="note">
                    メモ
                </label>
                <input
                    id="note"
                   name="note"
                    class="form-control"
                    value="{{ $bruise->note }}"
                    type="text"
                >
                @if ($errors->has('note'))
                    <div class="text-danger">
                        {{ $errors->first('note') }}
                    </div>
                @endif
            </div>
            
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showList') }}">
                    もどる
                </a>
                <a class="btn btn-secondary" href="{{$bruise->id}}">
                    クリア
                </a>
                <button type="submit" class="btn btn-primary">
                    付加する
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection