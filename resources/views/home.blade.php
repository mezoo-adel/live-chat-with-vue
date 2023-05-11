@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->hasRole(['admin','super_admin']))
                    <a class="dropdown-item text-primary" href="/dashboard" >
                      Open the dashboard here
                    </a>
                    @else
                    <p class="dropdown-item text-warning">
                        You aren't the admin
                      </p>
                    @endif
                </div>
            </div>
        </div>
        <welcome-component class="mt-3">
            <a class="dropdown-item text-primary" href="/chat" >
           Chat room
          </a>
        </welcome-component>
    </div>
</div>
@endsection
