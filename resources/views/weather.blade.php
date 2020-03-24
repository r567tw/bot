@extends('layouts.app')

@section('content')
<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">查詢天氣</div>

                <div class="card-body" id="weatherApp">
                    <input type="text" v-model="location">
                    <input type="submit" @click="getWeather(location)">
                    @{{ weatherData }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
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
                url = 'https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001';
                // url += '&symbols=' + needUnit + ',' + forUnit
                var options = {
                    'headers':{
                        'Access-Control-Allow-Origin':'*'
                    },
                    'data':{
                        'Authorization':'CWB-8617C293-566E-4A6E-BDBB-59443A4134C1',
                        'format':'JSON',
                        'locationName':location
                    }
                };
                axios.get(url,options)
                    .then(resp => {
                        console.log(resp)
                        this.weatherData = resp
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
