@extends('layouts.app')

@section('content')
<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">換匯工具</div>

                <div class="card-body" id="exchangeApp">
                    <div class="form-inline">
                        <p class="alert alert-info">
                            此工具資料來源來自於
                            https://fixer.io/，在實際上轉換會有一些些的差異，但基本上應該不會相差太多。僅供參考，責任須自行負責。
                        </p>

                        <p class="alert alert-danger">
                            因為Fixer API 支援https需要額外收費與收錢，因此僅供本機以及Line bot 使用。Heroku 上面目前暫時停用
                        </p>
                    </div>
                    <div class="form-inline">
                        <label class="col-md-2" for="NeedExchange">被換的貨幣與數字</label>
                        <input type="number" name="NeedExchange" class="form-control col-md-3" id="NeedExchange"
                            v-model="NeedExchange" @change="exchangeTo(NeedExchange,NeedExchangeUnit,ForExchangeUnit)"
                            step=0.01>
                        <div class="col-md-6">
                            <select class="form-control" name="NeedExchangeUnit" id="" v-model="NeedExchangeUnit"
                                @change="exchangeTo(NeedExchange,NeedExchangeUnit,ForExchangeUnit)">
                                <option v-for="symbol in symbols" v-bind:key="symbol.dollar" :value="symbol.dollar">
                                    @{{ symbol.name  }}</option>
                            </select>

                        </div>
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
                            <h3>快速選擇被換的貨幣單位</h3>
                            <button @click="SetNeedExchangeUnit('TWD')">新台幣</button>
                            <button @click="SetNeedExchangeUnit('USD')">美元</button>
                            <button @click="SetNeedExchangeUnit('CNY')">人民幣</button>
                            <button @click="SetNeedExchangeUnit('KRW')">韓元</button>
                            <button @click="SetNeedExchangeUnit('JPY')">日圓</button>
                        </div>
                        <div class="col-md-6">
                            <h3>快速選擇欲換的貨幣單位</h3>
                            <button @click="SetForExchangeUnit('TWD')">新台幣</button>
                            <button @click="SetForExchangeUnit('USD')">美元</button>
                            <button @click="SetForExchangeUnit('CNY')">人民幣</button>
                            <button @click="SetForExchangeUnit('KRW')">韓元</button>
                            <button @click="SetForExchangeUnit('JPY')">日圓</button>
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
        el: '#exchangeApp',
        data: {
            NeedExchange: 0.0,
            ForExchange: 0.0,
            NeedExchangeUnit: 'USD',
            ForExchangeUnit: 'TWD',
            symbols: [],
            rates: {}
        },
        created() {
            this.fetchSymbols();
        },
        methods: {
            fetchSymbols() {
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
            exchangeTo(insert, needUnit, forUnit) {
                var self = this;
                url = 'http://data.fixer.io/api/latest?access_key=f6dfba2a7214bf6896ebb7f527e11a19'
                url += '&symbols=' + needUnit + ',' + forUnit

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
            exchangeBack(insert, needUnit, forUnit) {
                var self = this;
                url = 'http://data.fixer.io/api/latest?access_key=f6dfba2a7214bf6896ebb7f527e11a19'
                url += '&symbols=' + needUnit + ',' + forUnit

                axios.get(url)
                    .then(resp => {
                        rates = resp.data.rates
                        //console.log((insert / rates[needUnit]) * rates[forUnit])
                        this.NeedExchange = ((insert / rates[needUnit]) * rates[forUnit]).toFixed(2);
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },
            SetNeedExchangeUnit(val) {
                this.NeedExchangeUnit = val;
                this.exchangeTo(this.NeedExchange, this.NeedExchangeUnit, this.ForExchangeUnit)
            },
            SetForExchangeUnit(val) {
                this.ForExchangeUnit = val;
                this.exchangeBack(this.ForExchange, this.ForExchangeUnit, this.NeedExchangeUnit)
            }
        }
    });
</script>
@endsection
