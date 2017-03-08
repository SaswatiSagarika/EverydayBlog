<?php
/**
    *File name: viewlist.blade.
    *File type: php.
    *Date of  creation:23th Feb 2017.
    *Author:mindfire solutions(saswati).
    *Purpose: this php file extends to Crud pages and show all the blogs.
    *Path:D:\PHP Projects\blog and comments\blog1\resources\veiws\.
    **/
?>
@extends('layouts.master')
@section('title')
	Show List
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="jumbotron">
                        <h1>All blogs</h1>
                        <p>This is What I do </p>
                    </div>
                     <form class="myform" action="{{url('/list')}}" method="GET">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <div class="input-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search by Title, Author, Date">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                          </div>
                        </div>
                        </div>
                    </form>
                </div>
                  
                    
                <div class="panel-body">
                @if ($records == 0)
                    <p><b>No records are available for this search</b> </p>
                 @else  
                @foreach($records as $record)

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title pull-left">{{$record->getField('SubjectTitle')}}</p>
                            <p hidden>{{$record->getField('BlogId')}}</p>
                            <a class="btn btn-danger pull-right" href = "{{url('deleteconformationpage')}}?id={{$record->getField('BlogId')}}"><span class="glyphicon glyphicon-trash"></a>
                            <a class="btn btn-info pull-right" href="{{url('editpage/blog')}}?id={{$record->getField('BlogId')}}"><span class="glyphicon glyphicon-pencil"></a>
                        </div>
                        <div class="panel-body">
                            <p hidden>{{$record->getField('BlogId')}}</p>
                            <p>{{$record->getField('ListData')}}</p>
                            <p><i> by </i> <b>{{$record->getField('AuthorName')}} </b><i> on </i> <b>{{$record->getField('Date')}}</b></p>
                            <p><i> No of comments </i><b>{{$record->getField('CommentsNo')}}</b></p>
                            <a class="btn btn-default" type="/"  href="{{url('/readpage/blog')}}?id={{$record->getField('BlogId')}}">
                                    Read more...</a>
                            
                        </div>
                    </div>
                @endforeach
            @endif
                <ul class="pagination">
                    <!--<li><a href="{{url('/list')}}?skip=0"><<</a></li>-->
                    <li><a href="{{url('/list')}}?skip=0">1</a></li>
                    <li><a href="{{url('/list')}}?skip=1">2</a></li>
                    <li><a href="{{url('/list')}}?skip=2">3</a></li>
                    <li><a href="{{url('/list')}}?skip=3">4</a></li>
                  </ul>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
