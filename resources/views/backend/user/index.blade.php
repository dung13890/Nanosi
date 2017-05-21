@extends('layouts.crud.index')

@push('prescripts')
<script>
    var columns = [
        { data: 'id', name: 'id', searchable: false, visible: false },
        { data: 'username', name: 'username'},
        { data: 'email', name: 'email'},
    ];
    var searches = {
        data: function (d) {
            d.keyword = $('input[name=keyword]').val();
        }
    };
</script>
@endpush

@push('index-table-filter')
    @component('backend._partials.components.filter')
        @slot('filter_fields')
        @endslot
    @endcomponent
@endpush

@push('index-table-thead')
<thead>
    <tr>
        <th style="display:none">ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
@endpush
