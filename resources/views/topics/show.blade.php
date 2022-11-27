@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

  <div class="row">

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $topic->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="fa fa-eye" aria-hidden="true"></i>
            {{ $view_count }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>
          @can('view', $topic)
          <div class="operate">
            <hr>
            <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
              <i class="far fa-edit"></i> 编辑
            </a>
            <form action="{{ route('topics.destroy', $topic->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>
          </div>
          @endcan
        </div>
        <p id="myBtn" style="display: none; z-index: 1" class="btn_pagetop top_button">
            <a href="#top">Top</a>
        </p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 sidebar">
      @include('topics._sidebar_show')
    </div>
  </div>
@stop

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/atelier-estuary-light.min.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('css/a11y-dark.min.css') }}" /> --}}
@stop

@section('scripts')
  <script src="{{ asset('js/highlight.min.js') }}"></script>
  <script>hljs.highlightAll();</script>
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
