@extends('layouts.app')

@section('title', '话题列表')

@section('content')
<div class="col-lg-9 col-md-9 topic-list" style="margin-bottom: 20px;">
  <ul class="nav justify-content-center" style="font-size: 30px;">
    @foreach ($categories as $category)
    <li class="nav-item">
      <a class="nav-link" href="#">{{ $category->name }}</a>
    </li>
    @endforeach
  </ul>
</div>
<div class="row mb-5">
  <div class="col-lg-9 col-md-9 topic-list">
    <div class="card ">

      <div class="card-body">
        {{-- 话题列表 --}}
        @include('topics._topic_list', ['topics' => $topics])
        {{-- 分页 --}}
        <div class="mt-5" style="display:flex; justify-content:center;">
          {!! $topics->appends(Request::except('page'))->onEachSide(0) !!}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 sidebar">
    @include('topics._sidebar')
    <p  id="myBtn" style="display: none;" class="btn_pagetop top_button">
      <a href="#top">Top</a>
    </p>
  </div>
</div>

@endsection

@section('scripts')
  <script>
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
      if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("myBtn").style.display = "block";
      } else {
        document.getElementById("myBtn").style.display = "none";
      }
    }
  </script>
@stop
