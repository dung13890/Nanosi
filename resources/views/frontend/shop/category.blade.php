@extends('layouts.frontend')

@section('page-content')
<div class="row">
    <div class="products">
        @foreach ($products as $product)
            {{ $product }}
            <div class="product">
                <h2 class="product-name"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h2>
                <a class="product-image" href="{{ route('product.show', $product->slug) }}"><img src="{{ ( $product->image ) ? route('image', $product->image_medium) :  asset('assets/img/backend/no_image.jpg') }}" alt="{{ $product->name }}" /></a>
            </div>
        @endforeach
    </div>
</div>
@endsection
