<div class="slim-scroll">
@foreach($listSelect as $id => $name)
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><input value="{{ $id }}" type="checkbox"></span>
            <input name ="name" type="text" value="{{ $name }}" class="form-control">
        </div>
    </div>
@endforeach
</div>
