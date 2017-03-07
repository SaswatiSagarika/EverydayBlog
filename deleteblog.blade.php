<?php
/**
    *File name: delete.blade.
    *File type: php.
    *Date of  creation:10th May 2016.
    *Author:mindfire solutions.
    *Purpose: this php file  get id and delete the student record.
    *Path:D:\Projects\hello-world\filemaker\blog\resources\veiws\filemaker.
    **/
?>
@extends('layouts.master')
@section('title')
    Delete
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Main Content -->
@section('content')
<div class="container">
    <div class="col-md-12">
        
        <div class="panel">
            <div class="panel-heading">
                <div class="jumbotron">
                    <h1>Delete this</h1>
                </div >
            </div>
                
            <div class="panel-body">
            <form class="myform" id="myform" action="{{ url('/delete/blog') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       @foreach($records as $record)
                      
                         @if ($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <input type="Hidden" name="id" id="id" value="{{$record->getField('AuthorId')}}"/>

                        <div class="error">{{ $errors->first('id') }}</div>
                        <h3 class="alert alert-error">Are you sure to delete you want to delete this Blog ?</h3>
                        <div id="buttons" style="padding-left:20%">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <a class="btn btn-warning" href="{{ url('/home') }}">No</a>
                                  @endforeach
                        </div>
                    </form>
            	<div>
                   
                </div>
            </div>
   	</div>
    </div> 
</div>
@endsection     