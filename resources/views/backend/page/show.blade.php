@extends('layouts.crud.show')

@push('show-content')
<div class="col-sm-4">
    @component('backend._partials.components.box', ['box_title' => __('repositories.show')])
        @slot('box_fields')
            <h3 class="profile-username text-center">{{ $item->name }}</h3>

            <ul class="nav nav-stacked nav-pills">
                @include('backend.user._field', ['class' => 'fa-check-square-o', 'field' => $item->name])
                <li>
                    <a href="javascript:void(0)">
                        <i class="fa @if (!$item->locked) fa-unlock @else fa-lock @endif  text-light-blue"></i>
                        @if (!$item->locked) <span class="label label-primary">Active</span> @else <span class="label label-danger">Locked</span> @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('backend.post.edit', $item->id) }}">
                        <i class="fa fa-edit  text-light-blue"></i>
                        <span class="label label-primary">Edit</span>
                    </a>
                </li>
           </ul>
        @endslot
    @endcomponent
</div>
<div class="col-sm-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#actions" data-toggle="tab">{{ __('repositories.info') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="actions">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($item->image)
                        {{ HTML::image(route('image', [ $item->image_default ]), 
                        '', ['class' => 'img-responsive']) }}
                        @endif
                        <H4>{{ $item->description }}</H4>
                        <hr>
                        {!! $item->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
