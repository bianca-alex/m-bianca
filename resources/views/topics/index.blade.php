@extends('layouts.app')

@section('title', '话题列表')

@section('content')
<div class="col-lg-9 col-md-9 topic-list" style="margin-bottom: 20px;">
  <ul class="nav justify-content-center" style="font-size: 30px;">
    <label style="margin-right: 50px;">探索</label>
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#">博客</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">分享</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Code</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled">Life</a>
    </li>
  </ul>
</div>
<div class="row mb-5">
  <div class="col-lg-9 col-md-9 topic-list">
    <div class="card ">

      <div class="card-body">
        {{-- 话题列表 --}}
        @include('topics._topic_list', ['topics' => $topics])
        {{-- 分页 --}}
        <div class="mt-5">
          {!! $topics->appends(Request::except('page'))->onEachSide(0) !!}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 sidebar">
    @include('topics._sidebar')
  </div>
</div>

@endsection
