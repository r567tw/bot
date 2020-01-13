@extends('layouts.app')

@section('content')
<div class="container" id="exchangeApp">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">換匯工具</div>

                <div class="card-body" id="exchangeApp">
                    <div class="form-inline">
                        <input type="text" name="NeedExchange" class="form-control col-md-3" id="y"
                            v-model="NeedExchange">
                        <div class="col-md-9">
                            <select class="form-control" name="NeedExchangeUnit" id="" v-model="NeedExchangeUnit">
                                <option v-for="symbol in symbols" v-bind:key="symbol.dollar" :value="symbol.dollar" >@{{ symbol.name  }}</option>
                            </select>

                        </div>
                    </div>
                    <br />
                    <div class="form-inline">
                        <input type="text" name="ForExchange" class="form-control col-md-3" id="x"
                            v-model="ForExchange">
                        <div class="col-md-9">
                            <select class="form-control" name="NeedExchangeUnit" id="" v-model="ForExchangeUnit">
<option v-for="symbol in symbols" v-bind:key="symbol.dollar" :value="symbol.dollar">@{{ symbol.name  }}</option>                            </select>
                        </div>
                    </div>
                    <br />
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
            data:{
                NeedExchangeUnit: 'USD',
                ForExchangeUnit: 'TWD',
                symbols: []
            },
            created(){
               this.fetchSymbols();
            },
            methods:{
                fetchSymbols(){
                    var self = this;
                    axios.get('http://data.fixer.io/api/symbols?access_key=f6dfba2a7214bf6896ebb7f527e11a19')
                    .then(resp=>{
                        var symbolsData = resp.data.symbols;
                        var arrayData = []
                        for(symbol in symbolsData){
                            arrayData.push({name: symbolsData[symbol], dollar: symbol})
                        }
                        // console.log(arrayData);
                        this.symbols = arrayData
                    })
                    .catch(err=>{
                        console.log(err)
                    })
                }
            },
            computed:{
                NeedExchange(){
                    return 0.0
                },
                ForExchange(){
                    return 0.0
                }
            }
    });
</script>
@endsection
