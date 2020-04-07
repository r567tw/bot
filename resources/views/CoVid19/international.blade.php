<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js'></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <h1>國際武漢肺炎現況~</h1>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">資料</div>

                <div class="card-body" id="exchangeApp">
                    {{-- <div class="form-inline">
                        <p class="alert alert-info">
                            此工具資料來源來自於
                            <a href="https://www.exchangerate-api.com">ExchangeRate-API.com</a>
，在實際上轉換會有一些些的差異，但基本上應該不會相差太多。僅供參考，責任須自行負責。
                        </p>
                    </div> --}}
                    <div class="form-inline">
                        <label class="col-md-2" for="NeedExchange">想查詢的國家</label>
                        
                        <div class="col-md-6">
                            <select class="form-control" name="selectedCountry" id="" v-model="selectedCountry"
                                @change="getData(selectedCountry)">
                                <option v-for="country in countries" v-bind:key="country.Slug" :value="country.Slug">
                                    @{{ country.Country  }}</option>
                            </select>

                        </div>
                    </div>
                    <br />
                    <div class="form-inline">
                        <label class="col-md-2">＝</label>
                    </div>
                    <div>
                        @{{ result }}
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    const vm = new Vue({
        el: '#exchangeApp',
        data: {
            selectedCountry: 'taiwan',
            countries: [],
            result:''
        },
        created() {
            this.fetchCountries();
        },
        methods: {
            fetchCountries() {
                var self = this;

                axios.get('https://api.covid19api.com/countries')
                    .then(resp => {
                        var data = resp.data;
                        // console.log(contries);
                        // var arrayData = []
                        // for (contry in contries) {
                        //     arrayData.push({ name: contry['Country'], value: country['slug'] })
                        // }
                        self.countries = data
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            getData(country) {
                var self = this;
                url = `https://api.covid19api.com/total/country/${country}/status/confirmed`
                console.log(url)
                axios.get(url)
                    .then(resp => {
                        var result = Object.values(resp.data)
                        
                        console.log(result);
                        this.result = result.slice(-1).pop()
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
        
            SetSelectedCountry(val) {
                // this.NeedExchangeUnit = val;
                // this.exchangeTo(this.NeedExchange, this.NeedExchangeUnit, this.ForExchangeUnit)
            }
        }
    });
</script>
</html>
