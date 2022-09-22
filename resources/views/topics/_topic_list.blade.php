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
            <div style="float:left; display: inline; margin-top: 20px; margin-left: 50px;">
              @if (count($topic->tags)>0)
                @foreach($topic->tags as $tag)
                  <a href="{{ route('topics.tags') }}?search={{ $tag }}" style="margin-right: 10px; background-color: #dbf4db; color: #686565; padding: 5px; border-radius: 5px;">{{ $tag }}</a> 
                @endforeach
              @endif
            </div>
            <div style="float: right; margin-top: 20px; display inline">
              <a class="text-secondary" style="margin-right: 20px;" href="{{ route('categories.show',$topic->category->id) }}" title="{{ $topic->category->name }}">
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
