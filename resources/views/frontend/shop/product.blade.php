@extends('layouts.frontend')

@push('prestyles')
    {{ HTML::style('vendor/fancybox/jquery.fancybox.min.css') }}
@endpush

@push('prescripts')
    {{ HTML::script('vendor/elevatezoom/jquery.elevateZoom-2.2.3.min.js') }}
    {{ HTML::script('vendor/fancybox/jquery.fancybox.min.js') }}
@endpush

@section('page-content')

<div class="single-product">
    <div class="row">
        <div class="single-product--gallery col-md-7">
            <div class="single-product--image">
              <div id="owl-sync1" class="owl-carousel owl-theme">
                <div class="item">
                  <img src="{{ ( $item->image ) ? route('image', $item->image_medium) :  asset('assets/img/backend/no_image.jpg') }}" alt="{{ $item->name }}" class= "elevate-zoom" data-zoom-image="{{ ( $item->image ) ? route('image', $item->image_large) :  asset('assets/img/backend/no_image.jpg') }}" data-fancybox="gallery" href="{{ ( $item->image ) ? route('image', $item->image_large) :  asset('assets/img/backend/no_image.jpg') }}">
                </div>
                @foreach ($item->images as $image)
                    <div class="item">
                        <img src="{{ ( $image ) ? route('image', $image->image_medium) :  asset('assets/img/backend/no_image.jpg') }}" alt="{{ $image->name }}" data-zoom-image="{{ ( $image ) ? route('image', $image->image_large) :  asset('assets/img/backend/no_image.jpg') }}" data-fancybox="gallery" href="{{ ( $image ) ? route('image', $image->image_large) :  asset('assets/img/backend/no_image.jpg') }}">
                    </div>
                @endforeach
              </div>
              <span class="msg-zoom">Click to image view a popup</span>
            </div>
            <div id="owl-sync2" class="single-product--thumbnails owl-carousel owl-theme">
                <div class="item">
                    <img src="{{ ( $item->image ) ? route('image', $item->image_small) :  asset('assets/img/backend/no_image.jpg') }}" alt="{{ $item->name }}" class="thumbnail-image">
                </div>
                @foreach ($item->images as $image)
                    <div class="item">
                        <img src="{{ ( $image ) ? route('image', $image->image_small) :  asset('assets/img/backend/no_image.jpg') }}" alt="{{ $image->name }}" class="thumbnail-image">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="single-product--content col-md-5">
            <h1 class="product-title">{{ $item->name }}</h1>
            <div class="info-box">
                <h4 class="box-title"><i class="fa fa-angle-right" aria-hidden="true"></i> Info</h4>
                <div class="box-content">
                    {{ $item->description }}
                </div>
            </div>
            <div class="info-box">
                <h4 class="box-title"><i class="fa fa-angle-right" aria-hidden="true"></i> Properties</h4>
                <div class="box-content">
                    {{ $item->properties }}
                </div>
            </div>
            <div class="info-box">
                <h4 class="box-title"><i class="fa fa-angle-right" aria-hidden="true"></i> Guide</h4>
                <div class="box-content">
                    {{ $item->guide }}
                </div>
            </div>
        </div>
    </div>

    <div class="single-product--tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a>
            </li>
            <li role="presentation">
                <a href="#review" aria-controls="profile" role="tab" data-toggle="tab">Review</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description">
                {{ $item->content }}
            </div>
            <div role="tabpanel" class="tab-pane" id="review">

            </div>
        </div>
    </div>

</div>
@endsection
