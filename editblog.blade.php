@extends('layouts.master')
@section('title')
    Update
@endsection
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Read Blog </div>
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
            </div>
            <div>
            @foreach($records as $record)
                   <form class="myform" id="myform" action="{{ url('/editblog/record') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="Hidden" name="id" id="id" value="{{$record->getField('AuthorId')}}"/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Subject</label>

                            <div class="col-md-8">
                            <input type="text" class="form-control" name="subject" id="subject" value="{{{$record->getField('SubjectTitle')}}}">

                               @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<br>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>

                            <div class="col-md-8">
                                <input type="Text" class="form-control" name="name" id="name" value="{{{$record->getField('AuthorName')}}}">

                                @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <br>                       <div class="form-group">
                            <label class="col-md-3 control-label">Content</label>

                            <div class="col-md-8">
                                <Textarea type="text" rows="15" class="form-control" name="content" id="content">{{$record->getField('Subject')}}</textarea>

                              @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
<br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Update Post
                                </button>
                                <button  class="btn btn-danger" href="{{ url('/list') }}">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
