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
                </div>
            </div>
            @foreach ($posts as $post)
            <div class="card" style="margin-bottom:20px">
            <div class="card-header">{{ $post->title }}</div>
                <div class="card-body">
                    @markdown($post->content)
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
