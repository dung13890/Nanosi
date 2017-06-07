<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('name', 'Name', ['class'=>'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: name']) }}
        </div>

        <div class="col-md-6">
            {{ Form::label('parent_id', 'Root', ['class'=>'control-label']) }}
            {{ Form::select('parent_id', $listItems, null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('name', 'Description', ['class' => 'control-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=>'5', 'placeholder' => 'Description...']) }}
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            {{ Form::checkbox('locked', true, old('locked'), ['data-toggle'=>'toggle', 'data-size' => 'small']) }} <b>Locked</b>
        </label>
    </div>
</div>

<div class="form-group">
{{ Form::label('slide', 'Banner', ['class' => 'control-label']) }}
@include('backend._partials.includes.banner', ['imageName' => 'image'])
</div>
@component('backend._partials.components.submit')
@endcomponent
