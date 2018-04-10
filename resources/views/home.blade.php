@extends('layouts.app')
@section('styles')
<meta http-equiv="refresh" content="3;{{ route("landing-page") }}" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!You will go to the home page. If this does not work click button.<br>
                    <button type="button" onclick="window.location='{{ route("landing-page") }}'">
                      Go to home page
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
