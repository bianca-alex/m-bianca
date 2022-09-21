@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="far fa-edit"></i>
            @if ($topic->id)
              编辑话题
            @else
              新建话题
            @endif
          </h2>

          <hr>

          @if ($topic->id)
            <form id="form_draft" action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
          @else
              <form id="form_draft" action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
          @endif

          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')

          <div class="mb-3">
            <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title) }}"
              placeholder="请填写标题" required />
          </div>

          <div class="mb-3">
            <select class="form-control" name="category_id" required>
              <option value="" hidden disabled selected>请选择分类</option>
              @foreach ($categories as $value)
                <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected': ''}}>{{ $value->name }}</option>
              @endforeach
            </select>
          </div>
          <input name='tags' class='some_class_name' placeholder='选择文章标签，最多三个' value='{{ $topic->tags }}'><br />

          <div class="mb-3" id="editor">
            <textarea class="editormd-markdown-textarea" name="body_orign" style="display: none;">{{ old('body_orign', $topic->body_orign) }}</textarea>
            <textarea class="editormd-html-textarea" style="display:none;" name="body"></textarea>
          </div>

          <div class="well well-sm" style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 发布</button>
            <button type="button" id="store-draft" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 草稿</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/editormd.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
  <style>
  .tags-look .tagify__dropdown__item{
    display: inline-block;
    vertical-align: middle;
    border-radius: 3px;
    padding: .3em .5em;
    border: 1px solid #CCC;
    background: #F3F3F3;
    margin: .2em;
    font-size: .85em;
    color: black;
    transition: 0s;
  }

  .tags-look .tagify__dropdown__item--active{
    color: black;
  }

  .tags-look .tagify__dropdown__item:hover{
    background: lightyellow;
    border-color: gold;
  }

  .tags-look .tagify__dropdown__item--hidden {
    max-width: 0;
    max-height: initial;
    padding: .3em 0;
    margin: .2em 0;
    white-space: nowrap;
    text-indent: -20px;
    border: 0;
  }
  .some_class_name {
    margin-bottom: 15px;
  }
  </style>
@stop

@section('scripts')
  <script src="{{ asset('js/highlight.min.js') }}"></script>
  <script src="{{ asset('js/editormd.js') }}"></script>
  <script src="{{ asset('js/paste-upload-img.js') }}"></script>
  <script>
    // 编辑器
    var editor = editormd("editor", {
        width  : "100%",
        height : 600,
        fontSize:"14px",
        placeholder:'请使用 Markdown 语法',
        lineNumbers:false, //行号
        styleActiveLine:false, //当前行高亮
        // tocContainer : "#test",//你可以将TOC结构输出到自定义容器中
        path   : "/editor/lib/",
        toolbarIcons : function() {
            return ["h3","h4","bold", "quote", "hr","|", "list-ul","list-ol", "|","link", "image", "table", "|", "watch", "fullscreen","preview"]
        },
        syncScrolling: true, //左右侧预览同步
        toolbarAutoFixed:true,//工具栏自动固定定位的开启与禁用
        saveHTMLToTextarea : true, // 保存 HTML 到 Textarea
        imageUpload : true, //图片上传
        imageFormats : ["jpg", "jpeg", "gif", "png"],//上传图片格式
        imageUploadURL : "{{route('topics.upload_image')}}",//图片上传URL
        onload : function() {
           initPasteDragImg(this);
        },
        onfullscreen : function() {
            $('#header').css('display', 'none');
            $('#footer').css('display', 'none');
            console.log('xxxxx');
        },
        onfullscreenExit : function() {
            $('#header').css('display', 'block');
            $('#footer').css('display', 'block');
        }
    });
    //editor.setPreviewTheme('dark');
    editor.setPreviewTheme('default');
    //editor.setEditorTheme('neo');
  </script>
  <script>
    $('#store-draft').click(function(){
      @if ($topic->id)
        $('form[id=form_draft]').attr('action', '{{ route("topics.storeDraft", $topic->id) }}');
      @else
        $('form[id=form_draft]').attr('action', '{{ route("topics.storeDraft") }}');
      @endif
      $('#form_draft').submit();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
  <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
  <script>
    var tag_input = document.querySelector('input[name="tags"]'),
    // init Tagify script on the above inputs
    tagify = new Tagify(tag_input, {
      enforceWhitelist : true,
      whitelist: eval({!! $tags !!}),
      maxTags: 3,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: true    // <- do not hide the suggestions dropdown once an item has been selected
      },
      originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
    });
    tagify.on('add', function(e){
        console.log(e.detail.tagify.value)  // data, index, and DOM node
    });
  </script>
@stop
