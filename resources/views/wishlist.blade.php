<div class="row">

  @lang('messages.wishlist'):
  @if(Cart::instance('saveForLater')->count() > 0)
  <h4>{{ Cart::instance('saveForLater')->count() }} @lang('messages.itemsinwishlist')</h4>

    @foreach (Cart::instance('saveForLater')->content() as $item)
    <h4><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->name }}</a></h4>
    <h3>{{ $item->model->presentPrice() }}</h3>
    <form action="{{ route('wishlist.destroy', $item->rowId) }}" method="post">
      {{ csrf_field() }}
      {{ method_field('delete') }}
      <button type="submit" class="btn btn-lg btn-default cart-options">@lang('messages.remove')</button>
    </form>
    <form action="{{ route('wishlist.addtocart', $item->rowId) }}" method="post">
      {{ csrf_field() }}
      <button type="submit" class="btn btn-lg btn-default cart-options">@lang('messages.movetocart')</button>
    </form>
    @endforeach

  @else
    <h3>@lang('messages.noitemsinyourwishlist')</h3>

  @endif
</div>
<h4>{{ Cart::instance('saveForLater')->count() }} @lang('messages.itemsinwishlist')</h4>
