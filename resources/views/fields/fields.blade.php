@extends('layouts.basic')

@section('content')
    <br>
    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
        </div>
    </div>
    <br>
    <div class="text-center"><h4>Fields List</h4></div>
    <br>
    <div class="text-center"><a class="btn btn-success" href="{{ route('field_create')}}">Create Field</a></div>
    <br>
    <div class="container-fluid">
        @if ($fields)
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Field Name</th>
                    <th>Data Created</th>
                    <th>Show field</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                @foreach ($fields as $field)
                    <tr>
                        <td>{{ $field->id}}</td>
                        <td>{{ $field->name}}</td>
                        <td>{{ $field->created_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('field_show', $field->id) }}">Show</a>
                        </td>
                        <td>
                            {{--Edit--}}
                            {!!  Form::open(['url' => route('field_edit', $field->id), 'class'=>'form-horizontal', 'method'=>'GET']) !!}
                            {{ method_field('GET') }}
                            {!! Form::button('Edit', ['class'=>'btn btn-warning', 'type'=>'submit'])!!}
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {{--Delete--}}
                            {!!  Form::open(['url' => route('field_destroy', $field->id), 'class'=>'form-horizontal', 'method'=>'DELETE', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit'])!!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="text-center"><h4>NO Fields List</h4></div>
        @endif
    </div>
@endsection
