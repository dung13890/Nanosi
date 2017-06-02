@push('prestyles')
{{ HTML::style('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}
<style>
    .fileinput, .fileinput .fileinput-preview {
        width: 100%;
    }
    .fileinput .fileinput-preview {
        width: 100%;
        border-radius: 0;
    }
    .fileinput .fileinput-preview img {
        height: 150px;
    }
</style>
@endpush
<div class="fileinput fileinput-new"  data-provides="fileinput">
    <div class="thumbnail fileinput-preview" data-trigger="fileinput">
        {{ HTML::image( (isset($item) && $item->image ) ? route('image', $item->image_medium) :  asset('assets/img/backend/no_image.jpg')) }}
    </div>
    <div>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        <div class="btn btn-default btn-file">
            <span class="fileinput-new">Select image</span>
            <span class="fileinput-exists">Change</span>
            {{ Form::file($imageName) }}
        </div>
    </div>
</div>
@push('prescripts')
{{ HTML::script('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js') }}
@endpush
