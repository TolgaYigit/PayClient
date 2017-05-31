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
    <h2 class="">{{$payment->gateway->name}}</h2>
    <h4>Transection value: {{$payment->transection_value}} {{$payment->currency}}</h4>
    @if($payment->status != 'completed')
        {!! Form::open(['url' => '/']) !!}
            <button type="submit" name="save" class="btn btn-default" value="confirm">Confirm Payment</button>
        {!! Form::close() !!}
    @else
        <h4>Payment Already Completed!</h4>
    @endif
@endsection