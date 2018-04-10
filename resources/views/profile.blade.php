@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/account/bootstrap_account.css') }}" type="text/css" rel="stylesheet">
@endsection

@section('content')
 <h2 class="text-center">{{ Auth::user()->name }}</h2>
<div class="d-flex flex-row">
  <div class="wrapper">

    <nav id="sidebar" class="h-100 d-inline-block">
      <!-- Sidebar user image -->
      <div class="row sidebar-header" style="background:rgba(255,255,255,.1)">
        <!-- <div class="col">
          <img src="{{ URL::to('/') }}/img/profilepage/original.png.jpeg" class="img-fluid rounded-circle" style="border:solid">
        </div> -->
        <!-- <div class="col mx-auto my-auto">
          <p class="text-white"><h5>{{ Auth::user()->name }}</h5><p>
        </div> -->
      </div>

      <!-- Sidebar Header -->
      <div class="sidebar-header">
        <h3>Shortcuts</h3>
      </div>

          <!-- Sidebar Links -->
          <ul class="list-unstyled components">
            <li class="active px-2"><a href="#"><i class="fa fa-user"></i> Profile</a></li>
            <li class="px-2"><a href="/orders"><i class="far fa-list-alt"></i> Orders</a></li>
            <li class="px-2"><a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i> Shopcart</a></li>
          </ul>
      </nav>

  </div>

  <div class="container" style="background:#dee2e6">

    <div class="d-flex flex-column">
      <div class="d-flex flex-row">
      <div class="col p-3">
        <div class="card h-100" style="border-color: #394263;">
          <div class="white-panel">
            <div class="white-header">
              <h5>USER DATA</h5>
            </div>
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Name:</td>
                  <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                  <td>Birthdate:</td>
                  <td>{{ Auth::user()->birthdate }}</td>
                </tr>
                <tr>
                  <td>Delivery address:</td>
                  <td>Unknown</td>
                </tr>
              </tbody>
            </table>
            <div class="p-3 float-right">            
              <button type="submit" name="submitChangeData" class="btn btn-outline-primary">@lang('messages.change')
              </button>
            </div>
          </div>
        </div>
      </div>


      <div class="col p-3">
        <div class="card h-100" style="border-color: #394263;">
          <div class="white-panel">
            <div class="white-header">
              <h5>BANKACCOUNT DATA</h5>
            </div>
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Name:</td>
                  <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                  <td>Address:</td>
                  <td>{{ Auth::user()->adress }}</td>
                </tr>
                <tr>
                  <td>Postcode:</td>
                  <td>{{ Auth::user()->zipcode }}</td>
                </tr>
                <tr>
                  <td>Residence:</td>
                  <td>{{ Auth::user()->residence }}</td>
                </tr>
                <tr>
                  <td>Country:</td>
                  <td>{{ Auth::user()->country }}</td>
                </tr>
                <tr>
                  <td>Telephone nr:</td>
                  <td>{{ Auth::user()->phone }}</td>
                </tr>
              </tbody>
            </table>
            <div class="p-3 float-right">
              <button type="submit" class="btn btn-outline-primary">@lang('messages.change')
              </button>
            </div>
          </div>
        </div>
      </div>

<!--
      <div class="col p-3">
        <div class="card h-100" style="border-color: #394263;">
          <div class="white-panel">
            <div class="white-header">
              <h5>USER PHOTO</h5>
            </div>
            <p><img src="{{ URL::to('/') }}/img/profilepage/original.png.jpeg" class="rounded-circle" width="250"></p>
            <div class="p-3 float-right">
              <button type="submit" class="btn btn-outline-primary">@lang('messages.change')
              </button>
            </div>
          </div>
        </div>
      </div> -->
    </div>
    <div class="d-flex flex-row-reverse">
  <div class="p-2">
    <button type="submit" class="btn btn-info">@lang('messages.deleteacc')
    </button>
  </div>
  </div>
    </div>
  </div>
</div>

@endsection
