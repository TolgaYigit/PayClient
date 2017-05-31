@extends('layouts.home')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open(['url' => '/']) !!}
    <div class="col-md-10">
        <h1>Payment Page</h1>
        <div class="form-group col-md-12">
            <label class="col-md-2 control-label" for="gateway">name: </label>
            <div class="col-md-2">
                {{Form::text('name', null, ['placeholder' => 'Enter your name...', 'class' => 'form-control', 'required'])}}
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-2 control-label" for="gateway">email: </label>
            <div class="col-md-2">
                {{Form::text('email', null, ['placeholder' => 'Enter your email...', 'class' => 'form-control', 'required'])}}
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-2 control-label" for="gateway">payment gateway: </label>
            <div class="col-md-2">
                {{Form::select('gateway_id', $gateways, null, ['placeholder' => 'Pick a gateway...', 'class' => 'form-control', 'required'])}}
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-md-2 control-label" for="gateway">value: </label>
            <div class="col-md-1">
                {{Form::text('base_value', null, ['class' => 'form-control', 'required'])}}
            </div>
            <div class="col-md-2">
                {{Form::select('currency', $currencies, 'EUR', ['placeholder' => 'Pick a gateway...', 'class' => 'form-control', 'required'])}}
            </div>
            <button type="submit" name="save" class="btn btn-default" value="save">Pay</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection