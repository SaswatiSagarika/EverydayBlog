<?php
/**
    *File name: read.blade.
    *File type: php.
    *Date of  creation:24th Feb 2017.
    *Author:mindfire solutions(saswati).
    *Purpose: this php file show the blog i separate page where reader can add new comments andview the blog completly along with the comments.
    *Path:D:\PHP Projects\blog and comments\blog1\resources\veiws\layouts.
    **/
?>
@extends('layouts.master')
@section('title')
    Read
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container">
    <div class="row">
        @foreach($records as $record)
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="jumbotron">
                        <h1>{{$record->getField('SubjectTitle')}}</h1>
                    </div>
                 </div>
                
                <div class="panel-body">
                   <p hidden><b><u>{{$record->getField('BlogId')}}</u></b></p>
                            <p>{{$record->getField('Subject')}}</p>
                            <p><i> by </i> <b>{{$record->getField('AuthorName')}} </b><i> on </i> <b>{{$record->getField('Date')}}</b></p>
                            <button  class="btn btn-Primary" href="{{ url('/list') }}">
                                    <i class="fa fa-btn fa-sign-out"></i>Back
                            </button>
                </div>
                    
            </div>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="row">
         <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Add New Comment </h3>
                </div>    
                <div class="panel-body">
                   <div class="row">
                        <div class="col-sm-12" id="errorDiv">
                            @if (isset($errors) && count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    
                        <div>
                            <form class="myform" id="myform" action="" method="">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" class="form-control" name="id" id="id" value="{{$record->getField('BlogId')}}">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>
         
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" id="name">
                                        @if ($errors->has(''))
                                             <span class="help-block">
                                                 <strong>{{ $errors->first('name') }}</strong>
                                             </span>
                                         @endif
                                     </div>
                                 </div>
                            <br>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">E-Mail Address</label>
         
                                    <div class="col-md-8">
                                        <input type="email" class="form-control" name="email" id="email">
         
                                        @if ($errors->has(''))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <br>                      
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Message</label>
                                    <div class="col-md-8">
                                        <Textarea type="text" rows="8" class="form-control" name="comment" id="comment"></textarea>
                                        @if ($errors->has(''))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 
                            <br>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="button" class="btn btn-primary"  id="postbutton">
                                            comment to this commit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
    <br>
    <div class="row">
         <div class="col-md-12 ">
            <hr>
            <div class="panel panel-info">
            <div class="panel-heading">
            </div>
                <div class="panel-body" >
                   <div class="comment-list" id="comment-list">
                  
               @if ($comments == 0)
                    <p>No comments are available for this blog</p>
                 @else       
                 @foreach($comments as $comment)
                    
                        <p>{{$comment->getField('Blog_Comments__BlogId::CommenterMessage')}}</p>
                    <p><i> by </i> {{$comment->getField('Blog_Comments__BlogId::CommenterName')}} <i> on </i> {{$comment->getField('Blog_Comments__BlogId::CommentDate')}}  <i> at </i> {{$comment->getField('Blog_Comments__BlogId::CommentTime')}}</p>
                    <p>{{$comment->getField('Blog_Comments__BlogId::CommenterEmail')}}</p> 
                    <hr> 
                      
                   @endforeach
                    @endif
                 
                
                </div>
                </div>
            </div>    
        </div>   
    </div>

</div>
@endsection
@section('script')
    
    <script type="text/javascript" src="{{URL::asset('js/CreateCommentAjax.js')}}"></script>
@endsection


