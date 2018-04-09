@extends('layouts.app')

@section('title', 'Search Results')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
  @endsection

@section('content')

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

    <div class="search-results-container container">
        <h1>@lang('messages.searchresults')</h1>
        <p class="search-results-count">{{ $products->total() }} @lang('messages.resultsfor') '{{ request()->input('query') }}'</p>

        @if ($products->total() > 0)
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>@lang('messages.name')</th>
                    <th>@lang('messages.averagerating')</th>
                    <th>@lang('messages.details')</th>
                    <th>@lang('messages.description')</th>
                    <th>@lang('messages.price')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th><a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></th>
                        <td>{{ $product->averagerating }}</td>
                        <td>{{ $product->details }}</td>
                        <td>{{ str_limit($product->description, 80) }}</td>
                        <td>{{ $product->presentPrice() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-center">
        {{ $products->appends(request()->input())->links() }}
        </div>
        @endif
    </div>
    <!-- end search-results-container -->

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/homepage/mightalsolike-product-slider.js') }}"></script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
