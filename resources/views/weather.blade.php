@extends('layouts.app')

@section('content')
<?php header('Access-Control-Allow-Origin: *'); ?>

<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">查詢天氣</div>

                <div class="card-body" id="weatherApp">
                    <div class="form-inline">
                        <select name="location" id="" v-model="location" class="form-control col-md-3">
                            <option value="臺北市">臺北市</option>
                            <option value="臺北縣">臺東縣</option>
                            <option value="宜蘭縣">宜蘭縣</option>
                            <option value="花蓮縣">花蓮縣</option>
                            <option value="臺東縣">臺東縣</option>
                            <option value="澎湖縣">澎湖縣</option>
                            <option value="金門縣">金門縣</option>
                            <option value="連江縣">連江縣</option>
                            <option value="臺北市">臺北市</option>
                            <option value="新北市">新北市</option>
                            <option value="桃園市">桃園市</option>
                            <option value="臺中市">臺中市</option>
                            <option value="臺南市">臺南市</option>
                            <option value="高雄市">高雄市</option>
                            <option value="基隆市">基隆市</option>
                            <option value="新竹縣">新竹縣</option>
                            <option value="新竹市">新竹市</option>
                            <option value="苗栗縣">苗栗縣</option>
                            <option value="彰化縣">彰化縣</option>
                            <option value="南投縣">南投縣</option>
                            <option value="雲林縣">雲林縣</option>
                            <option value="嘉義縣">嘉義縣</option>
                            <option value="嘉義市">嘉義市</option>
                            <option value="屏東縣">屏東縣</option>
                        </select>
                        <input class="form-control col-md-4" type="submit" @click="getWeather(location)">
                    </div>
                    <br/>
                    <textarea class="col-md-12" name="" id="" rows="20" readonly>@{{ weatherData }}</textarea>
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
            location: '臺北市',
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
