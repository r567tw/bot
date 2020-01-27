@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @auth
                    Hi, {{ auth()->user()->name }}. You are logged in!
                    @endauth
                    <br />
                    <br />
                    <p class="alert alert-success">
                        現在是 {{ $today->format('Y-m-d') }}，<br />
                        今年的第{{ $today->weekOfYear }}週<br />
                        今年的第{{ $today->dayOfYear }}天<br />
                    </p>

                    <p class="alert alert-info">
                        今年還剩下{{ $today->weeksInYear-$today->weekOfYear }}週<br />
                        今年還剩下{{ $today->daysInYear-$today->dayOfYear }}天<br />
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
