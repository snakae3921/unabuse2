@extends('layouts.app')
@section('title', '　投稿に付加する')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()" enctype="multipart/form-data">
        @csrf
            <input type="hidden" name="id" value="{{ $bruise->id }}" >
            <div class="form-group">
            <label for="userid">
                    ユーザ
                </label>
                @if ($errors->any())
                    <input
                        id="userid"
                        name="userid"
                        class="form-control"
                        value="{{ old('userid') }}"
                        type="text" readonly
                    >
                @else
                    <input
                        id="userid"
                        name="userid"
                        class="form-control"
                        value="{{ $bruise->userid }}"
                        type="text" readonly
                    >
                @endif
                @if ($errors->has('userid'))
                    <div class="text-danger">
                        {{ $errors->first('userid') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="target">
                    だれの
                </label>
                @if ($errors->any())
                    <input
                        id="target"
                        name="target"
                        class="form-control"
                        value="{{ old('target') }}"
                        type="text"
                    >
                @else
                    <input
                        id="target"
                        name="target"
                        class="form-control"
                        value="{{ $bruise->target }}"
                        type="text"
                    >
                @endif
                @if ($errors->has('target'))
                    <div class="text-danger">
                        {{ $errors->first('target') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="file1">
                    投稿した写真
                </label><br><b>
                <label for="file1">
                {{ $bruise->file1 }}
                </label></b><br>
                    <a href="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}" data-lightbox="group">
                    <img src="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}"
                    alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
                    width="60" height="60" ></td>
                    </a>

            </div>
            <div class="form-group">
                <label for="takeymd1">
                コメント（撮影日時など）
                </label>
                @if ($errors->any())
                    <input
                        id="takeymd1"
                        name="takeymd1"
                        class="form-control"
                        value="{{ old('takeymd1') }}"
                        type="text"
                    >
                @else
                    <input
                        id="takeymd1"
                        name="takeymd1"
                        class="form-control"
                        value="{{ $bruise->takeymd1 }}"
                        type="text"
                    >
                @endif
                @if ($errors->has('takeymd1'))
                    <div class="text-danger">
                        {{ $errors->first('takeymd1') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="age">
                    年齢
                </label>
                @if ($errors->any())
                    <input
                        id="age"
                        name="age"
                        class="form-control"
                        value="{{ old('age') }}"
                        type="text"
                    >
                @else
                    <input
                        id="age"
                        name="age"
                        class="form-control"
                        value="{{ $bruise->age }}"
                        type="text"
                    >
                @endif
                @if ($errors->any())
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
                    発生年月日　
                </label>

                {{Form::select('hasseiyy', 
                [
                '',
                '2010',
                '2011',
                '2012',
                '2013',
                '2014',
                '2015',
                '2016',
                '2017',
                '2018',
                '2019',
                '2020'
                ], $bruise->hasseiyy)}}
                <label for="hasseimm">
                    /
                </label>
                {{Form::select('hasseimm', 
                [
                '',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12'
                ], $bruise->hasseimm)}}
                <label for="hasseidd">
                    /
                </label>
                {{Form::select('hasseidd', 
                [
                '',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '24',
                '25',
                '26',
                '27',
                '28',
                '29',
                '30',
                '31'
                ], $bruise->hasseidd)}}
                @if ($errors->has('hasseiyy'))
                    <div class="text-danger">
                        {{ $errors->first('hasseiyy') }}
                    </div>
                @endif
                @if ($errors->has('hasseimm'))
                    <div class="text-danger">
                        {{ $errors->first('hasseimm') }}
                    </div>
                @endif
                @if ($errors->has('hasseidd'))
                    <div class="text-danger">
                        {{ $errors->first('hasseidd') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="hasseihh">
                    発生時間　　
                </label>
                {{Form::select('hasseihh', 
                [
                '',
                '0',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23'
                ], $bruise->hasseihh)}}
                <label for="hasseimi">
                ：
                                </label>
                {{Form::select('hasseimi', 
                [
                '',
                '0',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
                '11',
                '12',
                '13',
                '14',
                '15',
                '16',
                '17',
                '18',
                '19',
                '20',
                '21',
                '22',
                '23',
                '24',
                '25',
                '26',
                '27',
                '28',
                '29',
                '30',
                '31',
                '32',
                '33',
                '34',
                '35',
                '36',
                '37',
                '38',
                '39',
                '40',
                '41',
                '42',
                '43',
                '44',
                '45',
                '46',
                '47',
                '48',
                '49',
                '50',
                '51',
                '52',
                '53',
                '54',
                '55',
                '56',
                '57',
                '58',
                '59'
                ], $bruise->hasseimi)}}
                @if ($errors->has('hasseihh'))
                    <div class="text-danger">
                        {{ $errors->first('hasseihh') }}
                    </div>
                @endif
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
                @if ($errors->any())
                    <input
                        id="factor"
                        name="factor"
                        class="form-control"
                        value="{{ old('factor') }}"
                        type="text"
                    >
                @else
                    <input
                        id="factor"
                        name="factor"
                        class="form-control"
                        value="{{ $bruise->factor }}"
                        type="text"
                    >
                @endif
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
            <div class="form-group">
                <label for="note">
                    メモ
                </label>
                @if ($errors->any())
                    <input
                        id="note"
                        name="note"
                        class="form-control"
                        value="{{ old('note') }}"
                        type="text"
                    >
                @else
                    <input
                        id="note"
                        name="note"
                        class="form-control"
                        value="{{ $bruise->note }}"
                        type="text"
                    >
                @endif
                @if ($errors->has('note'))
                    <div class="text-danger">
                        {{ $errors->first('note') }}
                    </div>
                @endif
            </div>

            @if ($kbn == 1)
                <div class="form-group">
                <label for="dmy">結果登録用</label>
                </div>
                <div class="form-group">
                <input type="file" id="file" name="file2" class="form-control" value="{{ old('file2') }}" >
                @if ($errors->has('file2'))
                    <div class="text-danger">
                    {{ $errors->first('file2') }}
                    </div>
                @endif
                </div>
                <div class="form-group">
                <label for="takeymd">写真へのコメント（撮影日時など）</label>
                <b>
                <input id="takeymd2" name="takeymd2" class="form-control" value="{{ old('takeymd2') }}"
                        type="text" >
                </b>
                @if ($errors->has('takeymd2'))
                    <div class="text-danger">
                    {{ $errors->first('takeymd2') }}
                    </div>
                @endif
                </div>
            @endif

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