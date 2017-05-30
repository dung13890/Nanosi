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
            <div class="row">
                <div class="col-md-8">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
                </div>
            </div>
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

                <label>
                    {{ Form::checkbox('featured', true, old('featured'), ['data-toggle'=>'toggle', 'data-size' => 'small']) }}   <b>Featured</b>
                </label>
            </div>
        </div>
        @component('backend._partials.components.submit')
        @endcomponent
        @endslot
    @endcomponent
</div>
<div class="col-sm-3">
    @component('backend._partials.components.seo', ['seo' => $seo ?? null ])
    @endcomponent
    @include('backend._partials.includes.image', ['imageName' => 'image'])
    @include('backend._partials.includes.category', ['rootCategories' => $rootCategories])
</div>

@push('prescripts')
{{ HTML::script('vendor/summernote/summernote.min.js') }}
<script>
    var crud = new CRUD("{{ $resource }}", {});
    $(function () {
        $('.textarea-summernote').summernote({
            height:300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['insert', ['link','picture','video']],
                ['misc', ['fullscreen','undo','redo']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    crud.sendImage(files[0], laroute.route('backend.summernote.image'), $(this));
                }
            }
        });
    })
</script>
@endpush
