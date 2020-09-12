@extends('layouts.basic')

@section('content')
    <br>
    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
        </div>
    </div>
    <br>
    <div class="text-center"><h4>Products List</h4></div>
    <br>
    <div class="text-center"><a class="btn btn-success" href="{{ route('product_create')}}">Create Product</a></div>
    <br>
    <div class="container-fluid">
        @if ($products)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Product Name</th>
                    <th>Data Created</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            {{--Edit--}}
                            {!!  Form::open(['url' => route('product_edit', $product->id), 'class'=>'form-horizontal', 'method'=>'GET']) !!}
                            {{ method_field('GET') }}
                            {!! Form::button('Edit', ['class'=>'btn btn-warning', 'type'=>'submit'])!!}
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {{--Delete--}}
                            {!!  Form::open(['url' => route('product_destroy', $product->id), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit', 'onclick' => "return confirm('Are you sure?')"])!!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="text-center"><h4>NO Products List</h4></div>
        @endif
    </div>

@endsection
