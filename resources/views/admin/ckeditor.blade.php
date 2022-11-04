<div {!! admin_attrs($group_attrs) !!}>
    <label for="{{$id}}" class="{{$viewClass['label']}} control-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        <textarea name="{{$name}}" class="form-control {{$class}}" rows="{{ $rows }}" placeholder="{{ $placeholder }}" {!! $attributes !!} >{!! $value !!}</textarea>
        @include('admin::form.error')
        @include('admin::form.help-block')
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script @script>
    CKEDITOR.replace('{{ $name }}');
</script>
