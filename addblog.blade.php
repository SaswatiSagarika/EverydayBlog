@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Add new </div>
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
                   <form class="myform" id="myform" action="{{ url('/createrecord') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Subject</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject">

                               @if ($errors->has(''))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
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
                            <label class="col-md-3 control-label">Name</label>

                            <div class="col-md-8">
                                <input type="Text" class="form-control" name="name" id="name">

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
                                <Textarea type="text" rows="12" class="form-control" name="content" id="content"></textarea>

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
                                    <i class="fa fa-btn fa-user"></i>Add New Post
                                </button>
                                <button  class="btn btn-danger" href="#">
                                    <i class="fa fa-btn fa-sign-out"></i>Cancel
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
@endsection
@section('script')
<script type="text/javascript" src="{{URL::asset('js/Crud.js')}}"></script>
@stop
