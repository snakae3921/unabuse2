
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
              <th></th>
              <th>ユーザ</th>
              <th>投稿</th>
              <th>どなたの</th>
              <th>コメント</th>
              <th>年齢</th>
              <th>性別</th>
              <th>発生年</th>
              <td>/</td>
              <th>月</th>
              <td>/</td>
              <th>日</th>
              <td> </td>
              <th>時</th>
              <td>:</td>
              <th>分</th>
              <th>部位</th>
          </tr>
          @foreach($bruises as $bruise)
          <tr>
          <td><button type="button" class="btnbtn-primary" onclick="location.href='showEdit/{{ $bruise->id }}'">付加</button></td>
<!--              <td>{{ $bruise->id }}</td> -->
              <td><a href="showDetail/{{$bruise->id}}">{{ $bruise->userid }}</a></td>

              <td>
              <a href="{{asset('/storage/images/300-300-'. $bruise->id. $bruise->file1) }}" data-lightbox="group">
               <img src="{{asset('/storage/images/300-300-'. $bruise->id. $bruise->file1) }}"
               alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
               width="60" height="60" ></td>
               </a>
<!--
               <td><img src="{{asset('/storage/images/300-300-'. $bruise->id. $bruise->file1) }}"
               alt="{{$bruise->file1}}" title="{{$bruise->file1}}"
               width="60" height="60" ></td>
-->
               <a href="gazou1.jpg" data-lightbox="group"><img src="gazou1.jpg" width="300"></a>

               <td>{{ $bruise->target }}</td>
               <td>{{ $bruise->takeymd1 }}</td>
              <td>{{ $bruise->age }}</td>
              <td>
              @if ($bruise->sex == 1)
                  01:男性
              @elseif ($bruise->sex == 2)
                  02：女性
              @endif
              </td>
              <td>{{ $bruise->hasseiyy }}</td>
              <td>/</td>
              <td>{{ $bruise->hasseimm }}</td>
              <td>/</td>
              <td>{{ $bruise->hasseidd }}</td>
              <td> </td>
              <td>{{ $bruise->hasseihh }}</td>
              <td>:</td>
              <td>{{ $bruise->hasseimi }}</td>
              <td>
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
              </td>
          </tr>
          @endforeach
      </table>
  <div class="mt-5">
    <a class="btn btn-secondary" href="{{ route('showUpload') }}">
        もどる
    </a>
  </div>
  </div>
</div>
</div>
@endsection