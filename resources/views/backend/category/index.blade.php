@extends('layouts.nested.index')

@push('menu.left')
@component('backend._partials.components.alert')
@endcomponent
@if(isset($item))
{{ Form::model($item, [
    'method' => 'PATCH',
    'url' => route('backend.category.update', $item->id),
    'role'  => 'form',
    'files' => true,
    'autocomplete'=>'off',
]) }}
    @include('backend.category._form')
{{ Form::close() }}
@else
{{ Form::open([
    'url' => route('backend.category.store'),
    'files' => true,
    'autocomplete'=>'off',
]) }}
{{ Form::hidden('type', $type) }}
    @include('backend.category._form')
{{ Form::close() }}
@endif
@endpush

@push('menu.right')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#list" data-toggle="tab" >Lists</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active block-style" id="list"></div>
    </div>
</div>
@endpush

@push('prescripts')
<script>
    var flash_message = '{!! session("flash_message") !!}';
    var categories = {!! $items->toJson() !!};
    var category = {!! $item or 0 !!};
    var treeOptions = {
        onCreateLi: function(node, $li) {
            if (category != 0 && category.id == node.id) {
                return false;
            }
            $li.find('.jqtree-element')
            .append('<div class="btn-group pull-right tools">\
                <a href="'+laroute.route('backend.category.edit', {category: node.id})+'" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a> \
                <a href="'+laroute.route('backend.category.destroy', {category: node.id})+'" class="btn btn-xs btn-danger delete-action"><i class="fa fa fa-trash-o"></i></a>\
            </div>');
        }
    };

    var crud = new CRUD("{{ $resource }}", {});
    crud.flash(flash_message);
    $(function () {
        crud.treeInit(categories, treeOptions);
    })
</script>
@endpush
