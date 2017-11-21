@extends('layout')

@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading text-center">Dodawanie nowego produktu</div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">               
                        
                    <form action="{{ url('/product') }}" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            
                            @if($errors->has('name'))
                                <div class="help-block">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif

                            <input type="text" name="name" placeholder="Nazwa produktu" class="form-control" value="{{ old('name') }}">
                            
                        </div>

                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">

                            @if($errors->has('price'))
                                <div class="help-block">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif

                            <label class="sr-only" for="PLN">Cena(in PLN)</label>
                            <div class="input-group">
                                <input type="number" name="price" min="0.00" max="10000000.00" step="0.01" class="form-control" placeholder="Cena" value="{{ old('price') }}">
                                <div class="input-group-addon">PLN</div>
                            </div>

                        </div>


                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            
                            @if($errors->has('description'))
                                <div class="help-block">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            
                            <textarea name="description" class="form-control" rows="4" placeholder="Produkt">{{ old('description') }}</textarea>
                            
                        </div>
                        
                        <button type="submit" class="btn btn-success pull-right">Dodaj produkt</button>

                        <a href="{{ url('product') }}" class="btn btn-info pull-left">Powrót do listy</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()