@extends('layouts.basic')

@section('content')
    <br>
    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
            <a class="btn btn-secondary" href="{{ route('fields') }}">Back to Fields List</a>
        </div>
    </div>
    <br>
    <div class="text-center"><h3>Edit Field Form</h3></div>

    @if($old_field)
    {!! Form::open(['url'=>route('field_update', $old_field->id),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    {{--NAME--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-2">
                {!! Form::hidden('id', $old_field['id']) !!}
                {!! Form::label('name', 'Field Name', ['class' => 'control-label']) !!}
            </div>
            <div class="col-sm-5">
                {!! Form::text('name', $old_field['name'], ['class' => 'form-control',
                                        'placeholder'=>'Input field name']) !!}
            </div>
        </div>
    </div>

    <div id="products">
        @foreach($old_field->products()->get() as $product)
            <div class="form-group product">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        {!! Form::label('product[]', 'Product', ['class' => 'control-label']) !!}
                    </div>
                    @if($all_products)
                        <div class="col-sm-2">
                            <select class="form-control" name="product[]">
                                <option value="{{ $product->pivot->product_id }}"> {{ $product->name }} </option>
                                @foreach( $all_products as $all_product)
                                    <option value="{{ $all_product->id }}"> {{ $all_product->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                            {!! Form::label('qnty[]', 'Quantity', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::number('qnty[]', $product->pivot->quantity, ['class' => 'form-control',
                                                        'placeholder'=>'Input product qnty', 'required']) !!}
                        </div>
                        <div class="col-sm-1">
                            <button type="button" onclick="rmProduct(this)" class="btn btn-secondary remove">Remove</button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- BUTTON FOR ADDING PRODUCTS TO FIELD --}}
    <div class="text-center">
        <button type="button" onclick="addProduct()" class="btn btn-secondary">Add Product</button>
    </div>

    {{--SAVE BUTTON--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-offset-1 col-sm-4">
                {!! Form::button('Update', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    @else
        <div class="text-center"><h5>NO data!</h5></div>
    @endif

@endsection

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script>
        $('.remove')[0].setAttribute('hidden', true);
        function addProduct(){
            $('.remove')[0].removeAttribute('hidden');
            $("#products").append($('.product').clone()[0]);
            $('.remove')[0].setAttribute('hidden', true);
        }
        function rmProduct(elem){ elem.closest('.product').remove(); }
    </script>
@endpush
