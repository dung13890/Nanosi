@push('prestyles')
{{ HTML::style("vendor/summernote/summernote.css") }}
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border-radius: 0;
    }
    .select2-container--default .select2-selection--multiple {
        border-radius: 0;
        border: 1px solid #ccc;
    }
    .animated {
        animation-fill-mode: none;
    }
</style>
@endpush
<div class="col-sm-9">
    @component('backend._partials.components.box', ['box_title' => __('repositories.form')])
        @slot('box_fields')
        @component('backend._partials.components.alert')
        @endcomponent
        <div class="form-group">
            {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Description']) }}
        </div>

        <div class="form-group">
            {{ Form::label('content', 'Content', ['class' => 'control-label']) }}
            {{ Form::textarea('content', null, ['class' => 'form-control textarea-summernote']) }}
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('locked', true, old('locked'), ['data-toggle'=>'toggle', 'data-size' => 'small']) }} <b>Locked</b>
                </label>
            </div>
        </div>
        @component('backend._partials.components.submit')
        @endcomponent
        @endslot
    @endcomponent
</div>
<div class="col-sm-3">
</div>

@push('prescripts')
{{ HTML::script('vendor/summernote/summernote.min.js') }}
<script>
    $(function () {
        $('.textarea-summernote').summernote({
            height:200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
            ]
        });
    })
</script>
@endpush
