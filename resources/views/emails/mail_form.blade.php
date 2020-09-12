@extends('layouts.basic')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="flex-center position-ref full-height">
        <div class="text-center">
            <a class="btn btn-secondary" href="{{ route('home') }}">Back to Home Page</a>
        </div>
    </div>
    <br>

    <div class="text-center"><h6>EMAIL FORM</h6></div>

    {!! Form::open(['url'=>route('email_send'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    {{--NAME--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            {!! Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('name', old('name'), ['class' => 'form-control',
                                        'placeholder'=>'Input name']) !!}
            </div>
        </div>
    </div>

    {{--EMAIL--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            {!! Form::label('email', 'Email', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::email('email', old('email'), ['class' => 'form-control',
                                        'placeholder'=>'Input email']) !!}
            </div>
        </div>
    </div>

    {{--massage--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-1"></div>
            {!! Form::label('message', 'Message', ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::textarea('message', old('mesage'), ['class' => 'form-control',
                                        'placeholder'=>'Input message']) !!}
            </div>
        </div>
    </div>

    {{--SAVE BUTTON--}}
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-offset-1 col-sm-8">
                {!! Form::button('Send', ['class' => 'btn btn-primary', 'type'=>'submit']) !!}
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
