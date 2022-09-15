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
            {{ $topic->view_count }}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
