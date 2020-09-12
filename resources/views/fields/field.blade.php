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
    <div class="text-center"><h4>Field</h4></div>
    <div class="container-fluid">
        @if ($field)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Field Name</th>
                    <th>Data Created</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tr>
                    <td>{{ $field->id}}</td>
                    <td>{{ $field->name}}</td>
                    <td>{{ $field->created_at }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('field_edit', $field->id) }}">Edit</a>
                    </td>
                    <td>
                        {{--Delete--}}
                        {!!  Form::open(['url' => route('field_destroy', $field->id), 'class'=>'form-horizontal', 'method'=>'DELETE']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit'])!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </table>
        @else
            <div class="text-center"><h4>NO Field</h4></div>
        @endif
    </div>

    <div class="container-fluid">
        @if ($products)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product quantity</th>
                </tr>
                </thead>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name}}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="text-center"><h4>NO Product on this field</h4></div>
        @endif
    </div>

@endsection
