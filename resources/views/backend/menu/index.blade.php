@extends('layouts.nested.index')

@push('menu.left')
@component('backend._partials.components.alert')
@endcomponent
<div class="block-style" id="list"></div>
<div class="form-group">
    <a href="javascript:window.history.back()" class="btn btn-default btn-sm" ><i class="fa fa-arrow-circle-left"></i> {{ __('repositories.back') }}</a>
    <a href="#" class="btn btn-success btn-sm pull-right save-menu" ><i class="fa fa-check"></i> Save</a>
</div>
@endpush

@push('menu.right')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#link" data-toggle="tab">{{ __('repositories.link') }}</a></li>
        <li><a href="#post" data-toggle="tab">{{ __('repositories.post') }}</a></li>
        <li><a href="#page" data-toggle="tab">{{ __('repositories.page') }}</a></li>
        <li><a href="#product" data-toggle="tab">{{ __('repositories.product') }}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active block-style" id="link">
            @include('backend.menu._link')
        </div>
        <div class="tab-pane block-style" id="post">
            @include('backend.menu._select', ['listSelect' => $categoryPost])
        </div>
        <div class="tab-pane block-style" id="page">
            @include('backend.menu._select', ['listSelect' => $pages])
        </div>
        <div class="tab-pane block-style" id="product">
            @include('backend.menu._select', ['listSelect' => $categoryProduct])
        </div>
        <hr>
        <div class="form-group">
            <a href="#" class="btn btn-primary btn-sm create-menu" ><i class="fa fa-hand-o-left"></i> Create Menu</a>
        </div>
    </div>
</div>
@include('backend.menu._edit')
@endpush

@push('prescripts')
<script>
    var flash_message = '{!! session("flash_message") !!}';
    var menus = {!! $items->toJson() !!};
    var treeOptions = {
        onCanMoveTo: function(moved_node, target_node, position) {
            if (position == 'inside' && !moved_node.children.length && !target_node.parent.id) {
                return true;
            }
            if (position == 'after') {
                return true;
            }
        },
        onCreateLi: function(node, $li) {
            $li.find('.jqtree-element')
            .append('<div class="btn-group pull-right tools">\
                <a href="#edit-menu" data-toggle="modal" data-id="'+node.id+'" data-name="'+node.name+'" data-url="'+node.url+'" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>\
                <a href="'+laroute.route('backend.menu.destroy', {menu: node.id})+'" class="btn btn-xs btn-danger delete-action"><i class="fa fa fa-trash-o"></i></a>\
            </div>');
        }
    };
    var crud = new CRUD("{{ $resource }}", {});
    crud.flash(flash_message);
    $(function() {
        crud.treeInit(menus, treeOptions, true);
        $('.slim-scroll').slimscroll({
            height: 300
        });

        $('.create-menu').on('click', function (e) {
            e.preventDefault();
            var tab = $('.tab-pane.active').attr('id');
            var value = [];
            if (tab != 'link') {
                $('#' + tab).find('input[type="checkbox"]').each(function () {
                    if (this.checked) {
                        value.push({
                            'id':$(this).val(),
                            'name': $(this).parent().siblings('input').val()
                        });
                    }
                });
            } else {
                value.push({
                    'name': $('#' + tab).find('input[name="name"]').val(),
                    'url' : $('#' + tab).find('input[name="url"]').val()
                });
            }
            if (value.length) {
                $.post(laroute.route('backend.menu.store'), {type:tab, value:value}, function() {})
                .done(function (data) {
                    toastr.success(data.status.message);
                    $('#list').tree('loadData', data.result);
                })
                .fail(function(xhr) {
                    console.log(xhr.responseText);
                    return toastr.error(xhr.responseText);
                });
            }
        });

        $('.save-menu').on('click', function (e) {
            e.preventDefault();
            console.log(3);
            var serialize = $('#list').tree('toJson');
            $.post(laroute.route('backend.menu.serialize'), {serialize}, function () {})
            .done(function (data) {
                toastr.success(data.status.message);
                $('#list').tree('loadData', data.result);
            })
            .fail(function(xhr) {
                console.log(xhr.responseText);
                return toastr.error(xhr.responseText);
            });
        });

        $('#edit-menu').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('id');
            var name = $(event.relatedTarget).data('name');
            var url = $(event.relatedTarget).data('url');
            $(this).find('form').attr('action', laroute.route('backend.menu.update', {menu:id}));
            $(this).find('input[name="name"]').val(name);
            $(this).find('input[name="url"]').val(url);

        })
    })
</script>
@endpush
