
@extends('layouts.app')
@section('title', '　過去の投稿です')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
      @if (session('err_msg'))
        <p>{{ session('err_msg')}} 
        </p>
      @endif
      <table class="table table-striped">
          <tr>
              <th>DW</th>
              <th>更新</th>
              <th>ユーザ</th>
              <th>tpdf</th>
              <th>投稿</th>
              <th>だれの</th>
              <th>コメント</th>
          </tr>
          @foreach($bruises as $bruise)
          <tr>
<!--  投稿写真ダウンロード -->
            <td><a href="{{asset('/storage/images/'. $bruise->oimagename1) }}" download="{{$bruise->file1}}">{{$bruise->userid}}</a></td>
<!--             <td><a href="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}" download>{{$bruise->userid}}</a></td>
-->
<!-- 投稿データ更新 -->
            <td><button type="button" class="btnbtn-primary" onclick="location.href='showEdit/{{ $bruise->id }}'">付加</button></td>
            <td><a href="showDetail/{{$bruise->id}}">{{ $bruise->userid }}</a></td>
<!-- テスト用pdf化 start　-->
            <td><a href="mkPdf/{{$bruise->id}}">{{ $bruise->userid }}</a>forTest</td>
<!-- テスト用 end　-->
<!-- 投稿写真サムネイル -->
            <td><a href="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}" data-lightbox="group{{$bruise->id}}">
               <img src="{{asset('/storage/images/'. $bruise->userid. '/300-300-'. $bruise->id. $bruise->file1) }}"
               alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
               width="60" height="60" >
               </a>
            </td>
            <td>{{ $bruise->target }}</td>
            <td>{{ $bruise->takeymd1 }}</td>
          </tr>
          @endforeach
      </table>
      {{ $bruises->links() }}
  <div class="mt-5">
    <a class="btn btn-secondary" href="{{ route('showUpload') }}">
        もどる
    </a>
  </div>
  </div>
</div>
</div>
@endsection