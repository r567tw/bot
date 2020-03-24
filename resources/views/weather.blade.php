@extends('layouts.app')

@section('content')
<?php header('Access-Control-Allow-Origin: *'); ?>

<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">查詢天氣</div>

                <div class="card-body" id="weatherApp">
                    <input type="text" v-model="location">
                    <input type="submit" @click="getWeather(location)">
                    <br/>
                    <textarea class="col-md-12" name="" id="" cols="30" rows="10">@{{ weatherData }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script crossorigin="anonymous">
    const vm = new Vue({
        el: '#weatherApp',
        data: {
            location: '',
            weatherData: ''
        },
        created() {

        },
        methods: {
            getWeather(location) {
                console.log(location);
                var self = this;

                url = `/api/weather/${location}`;
                var options = {
                    'locationName':location
                };
                axios.get(url,options)
                    .then(resp => {
                        console.log(resp.data)
                        this.weatherData = resp.data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            SetLocation(val) {
                this.location = val;
            }
        }
    });
</script>
@endsection
