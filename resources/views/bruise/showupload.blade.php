@extends('layouts.app')
@section('title', '　写真を投稿します')
@section('content')

<header>
@include('header')
</header>
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
    <h2>ユーザ：{{ $username }}</h2>
        <span>

        <a href="mailto:s.nakae@stlabs.co.jp?subject=投稿だけに限る&amp;body=%E6%8A%95%E7%A8%BF%E3%81%99%E3%82%8B%E5%86%99%E7%9C%9F%E3%82%92%E6%B7%BB%E4%BB%98%E3%81%97%E3%81%A6%E9%80%81%E4%BF%A1%E3%81%97%E3%81%A6%E4%B8%8B%E3%81%95%E3%81%84%E3%80%82%0D%0A%0D%0A%E3%82%88%E3%82%8D%E3%81%97%E3%81%91%E3%82%8C%E3%81%B0%E8%A8%98%E5%85%A5%E3%81%8A%E9%A1%98%E3%81%84%E3%81%84%E3%81%9F%E3%81%97%E3%81%BE%E3%81%99%E3%80%82%0D%0A%EF%BC%9D%EF%BC%9D%EF%BC%9D%EF%BC%9D%EF%BC%9D%0D%0A%E3%81%8A%E5%90%8D%E5%89%8D%EF%BC%9A%0D%0A%E9%9B%BB%E8%A9%B1%E7%95%AA%E5%8F%B7%EF%BC%9A%0D%0A%E4%BD%8F%E6%89%80%EF%BC%9A%0D%0A%E3%81%8A%E5%95%8F%E5%90%88%E3%81%9B%E5%86%85%E5%AE%B9%EF%BC%9A%0D%0A%0D%0A%0D%0A%EF%BC%9D%EF%BC%9D%EF%BC%9D%EF%BC%9D%EF%BC%9D%0D%0A%E5%AE%9C%E3%81%97%E3%81%8F%E3%81%8A%E9%A1%98%E3%81%84%E3%81%84%E3%81%9F%E3%81%97%E3%81%BE%E3%81%99%E3%80%82%0D%0A&amp;bcc=nshinichiro3921@gmail.com,n_shinichiro3921@yahoo.co.jp&amp;">メール起動</a>

            <form method="POST" action="{{ route('insUpload') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if (session('err_msg'))
                <p>{{ session('err_msg')}}　　　 
                <a href="showEditId">写真の詳細を設定する</a>
                </p>
                続けて投稿するなら次の写真を選択して下さい
              @endif
              <input type="file" id="file" name="file1" class="form-control" value="{{ old('file1') }}" >
              @if ($errors->has('file1'))
                  <div class="text-danger">
                  {{ $errors->first('file1') }}
                  </div>
              @endif
              <br>
              <label for="target">だれの</label>
              <b>
              <input id="target" name="target" class="form-control" value="{{ old('target') }}"
                      type="text" >
              </b>
              @if ($errors->has('target'))
                  <div class="text-danger">
                  {{ $errors->first('target') }}
                  </div>
              @endif
              <br>
              <label for="takeymd">写真へのコメント（撮影日時など）</label>
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
              <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('showUpload') }}">
                    クリア
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
              </div>
            </form>
        </span>
        </p>
  </div>
</div>
</div>
@endsection