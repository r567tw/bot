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
            weatherData: `臺北市未來二十四小時天氣現象
18:00-06:00: 多雲
06:00-18:00: 多雲午後短暫陣雨

臺北市未來二十四小時降雨機率
18:00-06:00: 20%
06:00-18:00: 40%

臺北市未來二十四小時溫度範圍
18:00-06:00: 21°C ~ 24°C
06:00-18:00: 21°C ~ 29°C

臺北市未來二十四小時舒適度
18:00-06:00: 舒適`
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
