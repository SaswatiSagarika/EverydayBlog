@extends('layouts.master')
@section('title')
	Show List
@endsection
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
                </div>
                <div class="panel-body">
                @foreach($records as $record)

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title pull-left">{{$record->getField('SubjectTitle')}}</p>
                            <p hidden>{{$record->getField('AuthorId')}}</p>
                            <button class="btn btn-danger pull-right"><a href = "{{url('deleteconformationpage')}}?id={{$record->getField('AuthorId')}}"><span class="glyphicon glyphicon-trash"></a></button>
                            <button class="btn btn-info pull-right" > <a href="{{url('editpage/blog')}}?id={{$record->getField('AuthorId')}}"><span class="glyphicon glyphicon-pencil"></a></button>
                        </div>
                        <div class="panel-body">
                            <p hidden>{{$record->getField('AuthorId')}}</p>
                            <p>{{$record->getField('Subject')}}</p>
                            <p><i> by </i> {{$record->getField('AuthorName')}} <i> on </i> {{$record->getField('Date')}}</p>
                            <p><i> No of comments </i>{{$record->getField('CommentsNo')}}</p>
                            <Button class="btn btn-default" type="/"><a  href="{{url('/readpage/blog')}}?id={{$record->getField('AuthorId')}}">
                                    Read more...</a>
                            </Button>
                        </div>
                    </div>
                @endforeach
                
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
