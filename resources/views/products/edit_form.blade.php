@extends('layouts.basic')

@section('content')
    <br>
    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
            <a class="btn btn-secondary" href="{{ route('products') }}">Back to Products List</a>
        </div>
    </div>
    <br>
    <div class="text-center"><h3>Edit Product Form</h3></div>
    <br>

    {!! Form::open(['url'=>route('product_update', $product->id),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    {{--NAME--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                {!! Form::label('name', 'Product Name', ['class' => 'control-label']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::text('name', $product->name, ['class' => 'form-control',
                                        'placeholder'=>'Input product name']) !!}
            </div>
        </div>
    </div>

    {{--SAVE BUTTON--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-offset-1 col-sm-8">
                {!! Form::button('Update', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection

