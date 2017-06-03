<div class="form-horizontal">
    <div class="form-group">
        {{ Form::label('name', 'Name', ['class'=>'col-sm-2 control-label']) }}
        <div class="col-sm-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: Name']) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('url', 'Link', ['class'=>'control-label col-sm-2']) }}
        <div class="col-sm-10">
            {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Http://...']) }}
        </div>
    </div>
</div>
