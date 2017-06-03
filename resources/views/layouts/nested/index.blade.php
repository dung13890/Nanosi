@extends('layouts.backend')

@section('title', isset($heading) ? $heading : __('repositories.index'))

@push('prestyles')
{{ HTML::style('vendor/jqtree/css/jqtree.css') }}
@endpush

@push('prescripts')
    {{ HTML::script('vendor/jqtree/js/tree.jquery.js') }}
<script>
    var flash_message = '{!! session("flash_message") !!}';
</script>
@endpush

@section('page-content')
<section class="content-header">
    <h1>{{ $heading or __('repositories.index') }}</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('backend.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">{{ $heading or __('repositories.index') }}</li>
    </ol>
</section>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            @component('backend._partials.components.box', [
                'box_title' => $action ?? __('repositories.create'),
                'box_class' => 'animated fadeInUp'
            ])
            @slot('box_fields')
            @stack('menu.left')
            @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            @stack('menu.right')
        </div>
    </div>
</div>
@endsection
