@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card" style="margin-bottom:20px">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6 alert alert-success">
                            現在是 {{ $today->format('Y-m-d') }}，<br />
                            今年的第{{ $today->weekOfYear }}週<br />
                            今年的第{{ $today->dayOfYear }}天<br />
                        </div>

                        <div class="col-6 alert alert-info">
                            今年還剩下{{ $today->weeksInYear-$today->weekOfYear }}週<br />
                            今年還剩下{{ $today->daysInYear-$today->dayOfYear }}天<br />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 alert alert-warning">
                            <ul style="list-style:none">
                                @if (Auth::check())
                                    <li>
                                        @unless(Auth::user()->access_token)
                                            <form action="{{ route('line_notify.user.data') }}" method="post">
                                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success">連結Line notify 帳號</button>
                                            </form>
                                        @endunless
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
