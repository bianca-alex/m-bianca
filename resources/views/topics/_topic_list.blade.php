@if (count($topics))
  <ul class="list-unstyled">
    @foreach ($topics as $topic)
      <li class="d-flex">

        <div class="flex-grow-1 ms-2">

          <div class="mt-0 mb-1">
            <a href="{{ route('topics.show', [$topic->id]) }}" title="{{ $topic->title }}">
              {{ $topic->title }}
            </a>
          </div>

          <small class="media-body meta text-secondary">

            <div style="float: right; margin-top: 20px;">
              <a class="text-secondary" style="margin-right: 20px;" href="#" title="{{ $topic->category->name }}">
                <i class="far fa-folder"></i>
                {{ $topic->category->name }}
              </a>
              <i class="far fa-clock"></i>
              <span class="timeago" style="margin-right: 20px;" title="最后活跃于：{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
            </div>
          </small>
        </div>
      </li>

      @if ( ! $loop->last)
        <hr>
      @endif

    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif
