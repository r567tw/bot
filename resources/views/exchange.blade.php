@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">換匯工具</div>

                <div class="card-body" id="exchangeApp">
                    <div class="form-inline">
                        <input type="number" name="NeedExchange" class="form-control col-md-3" id=""
                            v-model="NeedExchange">
                        <div class="col-md-9">
                            <select class="form-control" name="NeedExchangeUnit" id="" v-model="NeedExchangeUnit">
                                <option v-for="symbol in symbols">@{{ symbol  }}</option>
                            </select>
                            @{{ symbols }}
                        </div>
                    </div>
                    <br />
                    <div class="form-inline">
                        <input type="number" name="ForExchange" class="form-control col-md-3" id=""
                            v-model="ForExchange">
                        <div class="col-md-9">
                            <select class="form-control" name="ForExchangeUnit" id="" v-model="ForExchangeUnit">
                                @foreach (Config::get('exchange.options'); as $dollar=>$name)
                                <option value="{{ $dollar }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br />
                    <input class="form-control" type="text" name="result" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const vm = new Vue({
        el: '#exchangeApp',
        data:{
            NeedExchange: '0.0',
            ForExchange: '0.0',
            NeedExchangeUnit: 'USD',
            ForExchangeUnit: 'TWD',
            symbols:[],
        },
        methods:{
            fetchSymbols(){
                var v = this;
                fetch('http://data.fixer.io/api/symbols?access_key=f6dfba2a7214bf6896ebb7f527e11a19')
                .then(function(resp){
                    if (resp.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' +
                        resp.status);
                        return;
                    }

                    // Examine the text in the response
                    resp.json().then(function(data) {
                        var dollars = [];
                        for(var i in data.symbols){
                            dollars.push({'name': i,'dollar': data.symbols[i]});
                        }
                        //console.log(dollars);
                        v.symbols = dollars;
                        console.log(v);
                    });
                })
                .catch(function(err){
                    console.log(err);
                });
            }
        },
        computed:{
            result(){

            }
        },
        mounted(){
            this.fetchSymbols();
        }
})
</script>
@endsection
