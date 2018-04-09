@extends('layouts.app')
@section('styles')
<link href="{{ asset('css/single-product/related-product-slider.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('css/single-product/product-info.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('css/single-product/description.css') }}" type="text/css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
  <p><h2 style="text-align:left;">{{ $product->name }}</h2></p>
  <div class="row">
    <div class="gallery col-md-6">
      Hier komt foto
    </div>

    <div class="col-md-6">

      <div class="product-title">{{ $product->name }}</div>
      <div class="product-desc">{{ $product->slug }}</div>

      <hr>

      <div class="product-price">{{ $product->presentPrice() }}</div>

      <?php
      if( $product['status']  == "Sold out" ){
        ?>
        <div class="product-outstock">{{ $product->status }}</div>
        <?php
      }
      else{
        ?>
        <div class="product-instock">{{ $product->status }}</div>
        <?php
      }
      ?>
      <hr>

      <div class="product-size">
        <select>
          <option selected disabled>Select size</option>

        </select>
      </div>

      <br>

      <div class="product-color">
        <select>
          <option selected disabled>Select color</option>

        </select>
      </div>

      <hr>

      <div class="btn-group cart">
        <form action="{{ route('cart.store') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $product->id }}">
          <input type="hidden" name="name" value="{{ $product->name }}">
          <input type="hidden" name="price" value="{{ $product->price }}">
          <button type="submit" class="btn btn-success">Add to cart</button>
        </form>
      </div>
    </div>
  </div>  <!-- end of div first "row" for product info and img -->
  <div>
    <p> <h3 style="text-align : center;">Product Description</h3> </p>

    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'Description')" id="defaultOpen">Description</button>
      <button class="tablinks" onclick="openTab(event, 'Specs')">Specs</button>
      <button class="tablinks" onclick="openTab(event, 'Reviews')">Reviews</button>
    </div>

    <div id="Description" class="tabcontent">
      <h3>Description</h3>
      <p>{{ $product->description }}</p>
    </div>

    <div id="Specs" class="tabcontent">
      <h3>Specs</h3>
      <p>Here is where you find a overview of the product like this.</p>
      <ul>
        <?php $product->details = preg_replace('/\.$/', '', $product->details); ?>
        <?php $details = explode(",", $product->details);?>
        @foreach($details as $detail)
        <li>{{ $detail }}</li>
        @endforeach
      </ul>
    </div>

    <div id="Reviews" class="tabcontent">
      <h3>Reviews</h3>
      <p>Here can reviews be posted</p>
    </div>
  </div> <!--end of div description -->

  <!-- Below is "related" products -->
  <p> <h3 style="text-align:center;">You also might like</h3> </p>
  <div class="row mx-auto my-auto">
    <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
      <div class="carousel-inner w-100" role="listbox">
        @foreach ($mightAlsoLike as $key=>$product)
        <div class="carousel-item {{ ($key == 0) ? "active" : "" }}">
          <a class="d-block col-3" href="{{ route('shop.show', $product->slug) }}">
            <img style="width:100%;"  src="http://placehold.it/350x180?text=1">
          </a>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>  <!-- end of div last row from carrousel -->

</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/single-product/related-product-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/single-product/description.js') }}"></script>
@endsection
