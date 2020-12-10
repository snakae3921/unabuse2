@extends('layouts.app')
@section('title', '　投稿の詳細です')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
      <span>ユーザ    <b>{{ $bruise->userid }}</b></span><br>
      <span>だれの    <b>{{ $bruise->target }}</b></span><br>

      <span>投稿した写真  <b>{{ $bruise->file1 }}</b><br>
<!--
        <img src="{{ asset('/storage/images/300-300-'. $bruise->id. $bruise->file1) }}"
          alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
          width="60" height="60" >
-->
        <a href="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}" data-lightbox="group">
        <img src="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}"
        alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
        width="60" height="60" ></td>
        </a>
      </span><br>
        <span>写真へのコメント（撮影日時など）  <b>{{ $bruise->takeymd1 }}</b></span><br>

<!--
        <span>投稿写真その２  <b>{{ $bruise->file2 }}</b></span><br>
        <span>コメント（撮影日時など）<b>{{ $bruise->takeymd2 }}</b></span><br> -->

      <span>年齢    <b>{{ $bruise->age }}</b></span>
        <span>性別    <b>
            @if ($bruise->sex == 1)
                  01：男性
            @elseif ($bruise->sex == 2)
                  02：女性
            @endif
            </b>
        </span><br>
        <span>発生日    <b>{{ $bruise->hasseiyy }}/{{ $bruise->hasseimm }}/
        {{ $bruise->hasseidd }}  {{ $bruise->hasseihh }}:{{ $bruise->hasseimi }}</b></span><br>
        <span>原因    <b>{{ $bruise->factor }}</b></span><br>
        <span>部位    <b>
              @if ($bruise->element == 1)
                01：頭
              @elseif ($bruise->element == 2)
                02：顔
              @elseif ($bruise->element == 3)
                03：首
              @elseif ($bruise->element == 4)
                04：胸
              @elseif ($bruise->element == 5)
                05：腹
              @elseif ($bruise->element == 6)
                06：背中
              @elseif ($bruise->element == 7)
                07：腹部
              @elseif ($bruise->element == 8)
                08：上腕
              @elseif ($bruise->element == 9)
                09：前腕
              @elseif ($bruise->element == 10)
                10：手
              @elseif ($bruise->element == 11)
                11：鼠径部
              @elseif ($bruise->element == 12)
                12：大腿
              @elseif ($bruise->element == 13)
                13：下腿
              @elseif ($bruise->element == 14)
                14：足
              @elseif ($bruise->element == 15)
                15：臀部
              @endif
              </b></span><br>
<!--        <span>写真  <b>{{ $bruise->targetfile }}</b></span><br> -->
        <span>メモ    <b>{{ $bruise->note }}</b></span><br>
        <span>作成日    <b>{{ $bruise->created_at }}</b></span></br>
        <span>更新日    <b>{{ $bruise->updated_at }}</b></span></br>
        <span>
        @if ($bruise->file2)
          <br>
          <br>
          <h4><b>以下、ご参考までにお目通しください</b></h4>
          <span>ご参考資料  <b>{{ $bruise->file2 }}</b><br>

          <a href="{{asset('/storage/images/'. $bruise-> userid. '/'. $bruise->oimagename2 ) }}" data-lightbox="group">
          <img src="{{asset('/storage/images/'. $bruise-> userid. '/'. $bruise->oimagename2) }}"
          alt="{{$bruise->file2}}" title="{{$bruise->file2}}"
          ></td>
          </a>

          </span><br>
          <span>ご参考資料へのコメント  <b>{{ $bruise->takeymd2 }}</b></span><br>
          <input type="button" value="プリント" onclick="window.print(); return false;" />
          <a href="#" onclick="window.print(); return false;">印刷</a>
        @endif
<!--
            <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="file" id="file" name="file[]" class="form-control" multiple>
        
              <label for="takeymd">撮影日時１</label>
              <b>
              <input id="takeymd1" name="takeymd1" class="form-control" value="{{ old('takeymd1') }}"
                      type="text" >
              </b>
              @if ($errors->has('takeymd1'))
                  <div class="text-danger">
                  {{ $errors->first('takeymd1') }}
                  </div>
              @endif
              <br>
              <input type="file" id="file" name="file[]" class="form-control" multiple>
              <label for="takeymd">撮影日時２</label>
              <b>
              <input id="takeymd2" name="takeymd2" class="form-control" value="{{ old('takeymd2') }}"
                      type="text" >
              </b>
              @if ($errors->has('takeymd2'))
                  <div class="text-danger">
                  {{ $errors->first('takeymd2') }}
                  </div>
              @endif
              <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showUpload') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
              </div>
            </form>
-->
              <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showList') }}">
                    もどる
                </a>
              </div>
        </span>
        </p>
  </div>
</div>
</div>
@endsection