@extends('layouts.app')

@section('styles')
  <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link href="{{ asset('css/bootstrap3-3-6.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2"><!-- product filter -->
      @include('layouts/product-filter')
    </div><!--End product filter -->

    <div class="col-md-8 text-right">
      <div class="row">
        <div class="col-md">
          <div class="row">
            <div class="col-6"><h1 class="my-4 text-left">{{ $categoryName }}</h1></div>
            <div class="col-6">
              <strong>@lang('messages.price')</strong>
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort'=>'high_low']) }}">@lang('messages.hightolow')</a>|
                <a href="{{ route('shop.index', ['category'=> request()->category, 'sort'=>'low_high']) }}">@lang('messages.lowtohigh')</a>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="btn-group" role="group" aria-label="{{__('messages.basicexample')}}">
            <button id="list" type="button" class="btn btn-secondary"><i class="fas fa-align-justify"></i></button>
            <button id="block" type="button" class="btn btn-secondary"><i class="fas fa-th"></i></button>
          </div>
        </div>
      </div>

      <div class="row" id="product_block"><!--Product block -->
        @forelse($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <a href="{{ route('shop.show', $product->slug) }}">
              @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="img" class="img-thumbnail">
              @else
                <img src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
              @endif
            </a>
          <div class="card-body">
            <div class="row"><a href="{{ route('shop.show', $product->slug) }}"><p>{{ $product->name }}</p></a></div>
              <div class="row"><p>@lang('messages.averagerating:') {{ $product->averagerating }}/5 </p>
              </div>
            <div class="row"> <p>{{ $product->presentPrice() }}</p> </div>
            <div class="row">
              <div class="btn-group" role="group" aria-label="Basic example">
                <form action="{{ route('cart.store') }}" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="{{ $product->id }}">
                  <input type="hidden" name="name" value="{{ $product->name }}">
                  <input type="hidden" name="price" value="{{ $product->price }}">
                  <button type="submit" class="btn btn-success">@lang('messages.addtocart')</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div>@lang('messages.noitemsfound')</div>
        @endforelse
      </div><!--End Product block -->

      <div class="row" id="product_list"><!--Prodcut list -->
        @forelse($products as $product)
        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('shop.show', $product->slug) }}">
                      @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" alt="img" class="img-thumbnail">
                      @else
                        <img src="{{ asset('img/defaults/placeholder_default_350x180.png')}}" alt="img" class="img-thumbnail">
                      @endif

                      <div>
                      <p></p>
                      </div>

                    </a>
                </div>
                <div class="col-md-5">
                  <div class="row"><a href="{{ route('shop.show', $product->slug) }}"><p>{{ $product->name }} - @lang('messages.averagerating:') {{ $product->averagerating }}/5 - {{ $product->presentPrice() }}</p></a></div>
                  <div class="row"> {!! $product->description !!}</div>
                </div>
                <div class="col-md-3">
                  <div class="row">
                    <form action="{{ route('cart.store') }}" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $product->id }}">
                      <input type="hidden" name="name" value="{{ $product->name }}">
                      <input type="hidden" name="price" value="{{ $product->price }}">
                      <button type="submit" class="btn btn-success">@lang('messages.addtocart')</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div>@lang('messages.noitemsfound')</div>
        @endforelse
      </div><!--End prodcut list -->

    </div>
    <div class="col-md-2">

    </div>
  </div>
</div>
<div class="container">
  <!-- Pagination -->
  <div class="row justify-content-center">
  {!!$products->appends(request()->input())->links()!!}
</div>
<!-- /.container -->
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/shop.js') }}"></script>
@endsection
