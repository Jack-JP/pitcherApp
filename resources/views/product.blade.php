@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/single-product/related-product-slider.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/single-product/product-info.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/single-product/description.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="{{ asset('css/bootstrap3-3-6.css') }}" rel="stylesheet">
@endsection
@section('content')

<!-- Errormessage if user already voted -->
<div class="container">
  @if (session()->has('data'))
<div class="alert alert-success">{{session('data')}}</div>
@endif
</div>

<div class="container">
    <p><h2 style="text-align:left;">{{ $product->name }}</h2></p>
    <div class="row">
    <div class="gallery col-md-6">
      <div class="mx-auto">
        <img src="{{ asset('storage/'.$product->image) }}" alt="img" class="img-thumbnail">
      </div>
        <div class="mx-auto">

          <div class="stars">

          	  <form action="/vote" method="post">
                {{ csrf_field() }}

          	    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
          	    <label class="star star-5" for="star-5"></label>
          	    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
          	    <label class="star star-4" for="star-4"></label>
          	    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
          	    <label class="star star-3" for="star-3"></label>
          	    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
          	    <label class="star star-2" for="star-2"></label>
          	    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
          	    <label class="star star-1" for="star-1"></label>

                <input type="hidden" name="productid" required="" value="{{ $product->id }}">

                <p>@lang('messages.averagerating:') {{ $product->averagerating }}/5</p>
                <button class="btn btn-success">@lang('messages.submit_rating')</button>
          	  </form>

          </div>

             </div>
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
          <option selected disabled>@lang('messages.selectsize')</option>

        </select>
      </div>

      <br>

      <div class="product-color">
      <select>
        <option selected disabled>@lang('messages.selectcolor')</option>

      </select>
      </div>

      <hr>

      <div class="btn-group cart">
        <form action="{{ route('cart.store') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $product->id }}">
          <input type="hidden" name="name" value="{{ $product->name }}">
          <input type="hidden" name="price" value="{{ $product->price }}">
          <button type="submit" class="btn btn-success">@lang('messages.addtocart')</button>
        </form>
      </div>
    </div>
  </div>  <!-- end of div first "row" for product info and img -->
  <div>
     <p> <h3 style="text-align : center;">@lang('messages.productdescription')</h3> </p>

  <div class="tab">
   <button class="tablinks" onclick="openTab(event, 'Description')" id="defaultOpen">@lang('messages.description')</button>
   <button class="tablinks" onclick="openTab(event, 'Specs')">@lang('messages.specs')</button>
   <button class="tablinks" onclick="openTab(event, 'Reviews')">@lang('messages.reviews')</button>
  </div>

  <div id="Description" class="tabcontent">
   <h3>@lang('messages.')description</h3>
   <p>{{ $product->description }}</p>
  </div>

  <div id="Specs" class="tabcontent">
   <h3>@lang('messages.specs')</h3>
   <p>@lang('messages.overviewproductlikethis')</p>
  <ul>
    <?php $product->details = preg_replace('/\.$/', '', $product->details); ?>
    <?php $details = explode(",", $product->details);?>
    @foreach($details as $detail)
      <li>{{ $detail }}</li>
    @endforeach
  </ul>
  </div>

  <div id="Reviews" class="tabcontent">
   <h3>@lang('messages.reviews')</h3>
   <p>@lang('messages.herereviews')</p>
  </div>
  </div> <!--end of div description -->

<!-- Below is "related" products -->
<p> <h3 style="text-align:center;">@lang('messages.youalsomightlike')</h3> </p>
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
              <span class="sr-only">@lang('messages.previous')</span>
          </a>
          <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">@lang('messages.next')</span>
          </a>
    </div>

  </div>  <!-- end of div last row from carrousel -->

</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/single-product/related-product-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/single-product/description.js') }}"></script>
@endsection
