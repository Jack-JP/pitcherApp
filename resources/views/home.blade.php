@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br>
                    <button type="button" onclick="window.location='{{ route("landing-page") }}'">
                      Go to home page
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
