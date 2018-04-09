@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/productpage/related-product-slider.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

@component('components.breadcrumbs')
    <a href="/">@lang('messages.home')</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
@endcomponent

<div class="container">
    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="container">

  <!-- New product slider -->
  <br>
    <p> <h3 style="text-align:center;">@lang('messages.newproducts')</h3> </p>
  <div class="row mx-auto my-auto">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
          <div class="carousel-inner w-100" role="listbox">
            @foreach ($products as $key=>$product)
              <div class="carousel-item {{ ($key == 0) ? "active" : ""}} mx-2" >
                <a class="d-block col-3 img-fluid" href="{{ route('shop.show', $product->slug) }}">
                  <img style="width:100%;" src="{{ asset('storage/'.$product->image) }}"></a>
              </div>
              @endforeach
          </div>
          <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">@lang('messages.previous')</span>
          </a>
          <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">@lang('messages.next')</span>
          </a>
      </div>
    </div>


  <div class="row">

    <!-- Page Heading -->
    <h1 class="mt-5">
      @lang('messages.categories')
    </h1>

    <div class="row">
      @foreach($categories as $category)
      <div class="col-lg-4 col-sm-6 portfolio-item mt-5">
        <a href="{{ route('shop.index', ['category' => $category->slug]) }}">
        <div class="card h-100">
          <h4 class="card-title">
            {{ $category->name }}
          </h4>
          <img class="card-img-top" src="http://placehold.it/700x400" alt="">
        </div>
        </a>
      </div>
      @endforeach
  </div>
  </div>


</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/homepage/mightalsolike-product-slider.js') }}"></script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
