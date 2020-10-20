@extends('layouts.app')
@section('title', '写真投稿')
@section('content')

<header>
@include('header')
</header>

<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8 col-md-offset-2">
    <h2>写真投稿</h2>
    <h2>ユーザ：{{ $username }}</h2>
        <span>
            <form method="POST" action="{{ route('insUpload') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if (session('err_msg'))
                <p>{{ session('err_msg')}} 
                </p>
              @endif
              <label for="target">どなたの</label>
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

              <input type="file" id="file" name="file[]" class="form-control" multiple>
        
              <label for="takeymd">写真へコメント（撮影日時など）</label>
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
              <label for="takeymd">写真へコメント（撮影日時など）</label>
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