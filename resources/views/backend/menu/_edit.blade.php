<div class="modal fade" id="edit-menu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Edit Menu</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['method' => 'PATCH', 'url' => '', 'role'  => 'form', 'autocomplete'=>'off']) }}
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class'=>'control-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'required: Name']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('url', 'Link', ['class'=>'control-label']) }}
                        {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Http://...']) }}
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
