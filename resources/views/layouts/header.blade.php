<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Home')</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/default.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
<script src="https://js.stripe.com/v3/"></script>
  @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-md">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Pitcher app') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto"></ul>
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  {{ Config::get('languages')[App::getLocale()] }}
              </a>
              <ul class="dropdown-menu">
                  @foreach (Config::get('languages') as $lang => $language)
                      @if ($lang != App::getLocale())
                          <li>
                              <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                          </li>
                      @endif
                  @endforeach
                </ul>
            </li>
            <li class="list-inline-item">
              <a class="nav-link" href="{{ route('cart.index') }}">@lang('messages.cart')
                <span>
                  @if(Cart::instance('default')->count() > 0)
                    <span class="badge badge-info">{{ Cart::instance('default')->count() }}</span>
                 @endif
              </span>
              </a>
            </li>
            @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a></li>
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('messages.Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid" id="app">
    <div class="row justify-content-center">
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Shoes</a></li>
          <li class="list-inline-item"><a href="#">Clothing</a></li>
          <li class="list-inline-item"><a href="#">Accessories</a></li>
        </ul>
    </div>
    <div class="row">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/shop">Category</a></li>
        <li class="breadcrumb-item active"><a href="#">Product</a></li>
      </ol>
    </div>
    <div class="row text-center">@include('layouts.alerts')</div>
  </div>
