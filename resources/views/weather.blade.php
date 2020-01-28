@extends('layouts.app')

@section('content')
<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">查詢天氣</div>

                <div class="card-body" id="weatherApp">
                    <div class="form-inline">
                        <div class="col-md-6">
                            <select class="form-control" name="NeedExchangeUnit" id="">
                                <option v-for="symbol in symbols" v-bind:key="symbol.dollar" :value="symbol.dollar">
                                    @{{ symbol.name  }}</option>
                            </select>

                        </div>
                        <label class="col-md-2" for="NeedExchange">被換的貨幣與數字</label>
                        <input type="number" name="NeedExchange" class="form-control col-md-3" id="NeedExchange"
                            v-model="NeedExchange" @change="exchangeTo(NeedExchange,NeedExchangeUnit,ForExchangeUnit)"
                            step=0.01>
                    </div>
                    <br />
                    <div class="form-inline">
                        <label class="col-md-2">＝</label>
                    </div>
                    <br />
                    <div class="form-inline">
                        <label class="col-md-2" for="ForExchange">欲換的貨幣與數字</label>
                        <input type="number" name="ForExchange" class="form-control col-md-3" id="ForExchange"
                            v-model="ForExchange" @change="exchangeBack(ForExchange,ForExchangeUnit,NeedExchangeUnit)">
                        <div class="col-md-6">
                            <select class="form-control" name="ForExchangeUnit" id="" v-model="ForExchangeUnit"
                                @change="exchangeBack(ForExchange,ForExchangeUnit,NeedExchangeUnit)">
                                <option v-for="symbol in symbols" v-bind:key="symbol.dollar" :value="symbol.dollar">
                                    @{{ symbol.name  }}</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-6">
                            <h3>快速選擇查詢地點</h3>
                            <button @click="SetLocation('臺東縣')">台東</button>
                            <button @click="SetLocation('臺北縣')">台北</button>
                        </div>
                    </div>
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
            locations: [],
            weatherData: ''
        },
        created() {
            this.fetchLocations();
        },
        methods: {
            fetchLocations() {
                var self = this;
                axios.get('http://data.fixer.io/api/symbols?access_key=f6dfba2a7214bf6896ebb7f527e11a19')
                    .then(resp => {
                        var symbolsData = resp.data.symbols;
                        var arrayData = []
                        for (symbol in symbolsData) {
                            arrayData.push({ name: symbolsData[symbol], dollar: symbol })
                        }
                        // console.log(arrayData);
                        this.symbols = arrayData
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            getWeather(location) {
                var self = this;
                // url = 'http://data.fixer.io/api/latest?access_key=f6dfba2a7214bf6896ebb7f527e11a19'
                // url += '&symbols=' + needUnit + ',' + forUnit

                axios.get(url)
                    .then(resp => {
                        rates = resp.data.rates
                        console.log((insert / rates[needUnit]) * rates[forUnit])
                        this.ForExchange = ((insert / rates[needUnit]) * rates[forUnit]).toFixed(2);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            SetLocation(val) {
                this.location = val;
                // this.exchangeTo(this.NeedExchange, this.NeedExchangeUnit, this.ForExchangeUnit)
            }
        }
    });
</script>
@endsection
