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
            {{ Form::label('introduce', 'Introduce', ['class' => 'control-label']) }}
            {{ Form::textarea('introduce', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Introduce']) }}
        </div>

        <div class="form-group">
            {{ Form::label('url', 'Url', ['class' => 'control-label']) }}
            {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Url']) }}
        </div>

        <div class="form-group">
        {{ Form::label('image', 'Slide', ['class' => 'control-label']) }}
        @include('backend._partials.includes.banner', ['imageName' => 'image'])
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
