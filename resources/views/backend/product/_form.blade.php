@push('prestyles')
{{ HTML::style("vendor/summernote/summernote.css") }}
{{ HTML::style(mix('assets/css/backend/dropzone.css')) }}
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
                <div class="col-md-6">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
                </div>
                <div class="col-md-2">
                    {{ Form::label('code', 'Code', ['class' => 'control-label']) }}
                    {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'required: Code']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('price', 'Price', ['class' => 'control-label']) }}
                    {{ Form::text('price', null, ['class' => 'form-control currency-mask', 'placeholder' => 'Price']) }}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    {{ Form::label('size', 'Size', ['class' => 'control-label']) }}
                    {{ Form::text('size', null, ['class' => 'form-control', 'placeholder' => 'Size']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('material', 'Material', ['class' => 'control-label']) }}
                    {{ Form::text('material', null, ['class' => 'form-control', 'placeholder' => 'required: Material']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('origin', 'Origin', ['class' => 'control-label']) }}
                    {{ Form::text('origin', null, ['class' => 'form-control', 'placeholder' => 'required: Origin']) }}
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
            {{ Form::label('properties', 'Properties', ['class' => 'control-label']) }}
            {{ Form::textarea('properties', null, ['class' => 'form-control textarea-summernote']) }}
        </div>

        <div class="form-group">
            {{ Form::label('guide', 'Guide', ['class' => 'control-label']) }}
            {{ Form::textarea('guide', null, ['class' => 'form-control textarea-summernote']) }}
        </div>

        <div class="form-group" id="dropzone-form">
            {{ Form::label('images[]', 'Images') }}
            <upload-image @if(isset($item)) :images="item.images" @endif></upload-image>
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
<script>
    var item = {!! $item or '{}' !!};
</script>
{{ HTML::script('vendor/summernote/summernote.min.js') }}
{{ HTML::script(mix('assets/vue/backend/manifest.js')) }}
{{ HTML::script(mix('assets/vue/backend/vendor.js')) }}
{{ HTML::script(mix('assets/vue/backend/dropzone.js')) }}
<script>
    var crud = new CRUD("{{ $resource }}", {});
    function localeString(x, sep, grp) {
        var sx = (''+x).split('.'), s = '', i, j;
        sep || (sep = ','); // default seperator
        grp || grp === 0 || (grp = 3); // default grouping
        i = sx[0].length;
        while (i > grp) {
            j = i - grp;
            s = sep + sx[0].slice(j, i) + s;
            i = j;
        }
        s = sx[0].slice(0, i) + s;
        sx[0] = s;
        return sx.join('.')
    }
    function parseCurrency(s) {
        var i = parseInt(s.toString().replace(/,/g, ""), 10);
        return isNaN(i) ? 0 : i;
    }
    function toLocaleCurrency(s) {
        return localeString(parseCurrency(s));
    }
    $(function () {
        $('.textarea-summernote').summernote({
            height:200,
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

        $(".currency-mask").each(function () {
            $(this).val(toLocaleCurrency($(this).val()));
            var callback = function ($this) {
                if ( !$this.val() ) return;
                $this.data('val', parseCurrency($this.val()));
                $this.val(toLocaleCurrency($this.data('val')));
            }
            $(this).on('change', function (e) {
                callback($(this));
            });
            $(this).keyup(function(e) {
                if (e.which !== 0) {
                    callback($(this));
                }
            });
        });
    })
</script>
@endpush
