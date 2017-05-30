@extends('layouts.crud.index')

@push('prescripts')
<script>
    var columns = [
        { data: 'id', name: 'id', searchable: false, visible: false },
        { data: 'description', name: 'description'},
        { 
            data: 'featured',
            name: 'featured',
            render: function (data, type, row) {
                return row.featured == 0 ? '<span class="label label-default">OFF</span>' : '<span class="label label-primary">ON</span>';
            }
        },
    ];
    var searches = {
        data: function (d) {
            d.keyword = $('input[name=keyword]').val();
            d.category_id = $('select[name=category]').val();
        }
    };
</script>
@endpush

@push('index-table-filter')
    @component('backend._partials.components.filter')
        @slot('filter_fields')
        <div class="col-sm-2">
            <div class="form-group">
                {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
            </div>
        </div>
        @endslot
    @endcomponent
@endpush

@push('index-table-thead')
<thead>
    <tr>
        <th style="display:none">ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Featured</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
@endpush
