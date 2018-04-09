<div id="accordion">

  <div class="card  mb-2">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#categories-menu">
        @lang('messages.categories')
      </a>
    </div>
    <div id="categories-menu" class="collapse show">
@foreach($categories as $category)
      <ul class="list-group" style="list-style-type: none;">
          <li class="{{ request()->category == $category->slug ? 'active' : '' }}"><a href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
      </ul>
@endforeach
    </div>
  </div>
</div>
