@extends('layouts.basic')

@section('content')

    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
            <a class="btn btn-secondary" href="{{ route('fields') }}">Back to Fields List</a>
        </div>
    </div>

    <div class="text-center"><h3>Create Field Form</h3></div>

    {!! Form::open(['url'=>route('field_store'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    {{--NAME--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                {!! Form::label('name', 'Field Name', ['class' => 'control-label']) !!}
            </div>
            <div class="col-sm-8">
                {!! Form::text('name', old('name'), ['class' => 'form-control',
                                        'placeholder'=>'Input field name', 'required']) !!}
            </div>
        </div>
    </div>

    <div id="products">
        {{--PRODUCT--}}
        <div class="form-group product">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    {!! Form::label('product[]', 'Product', ['class' => 'control-label']) !!}
                </div>
                @if($products)
                    <div class="col-sm-2">
                        <select class="form-control" name="product[]">
                            @foreach( $products as $product)
                                <option value="{{ $product->id }}"> {{ $product->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        {!! Form::label('qnty[]', 'Quantity', ['class' => 'control-label']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::number('qnty[]', old('qnty[]'), ['class' => 'form-control',
                                                    'placeholder'=>'Input product qnty', 'required']) !!}
                    </div>
                    <div class="col-sm-1">
                        <button type="button" onclick="rmProduct(this)" class="btn btn-secondary remove">Remove</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- BUTTON FOR ADDING PRODUCTS TO FIELD --}}
    <div class="text-center">
        <button type="button" onclick="addProduct()" class="btn btn-secondary">Add Product</button>
    </div>

    {{--SAVE BUTTON--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-offset-1 col-sm-8">
                {!! Form::button('Save', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script>
        $('.remove')[0].setAttribute('hidden', true);

        console.log('roo');


        function addProduct(){
            $('.remove')[0].removeAttribute('hidden');
            $("#products").append($('.product').clone()[0]);
            $('.remove')[0].setAttribute('hidden', true);
        }
        function rmProduct(elem){ elem.closest('.product').remove(); }
    </script>
@endpush
