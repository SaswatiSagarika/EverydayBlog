
@extends('layouts.master')
@section('title')
	About Us
	<style>
	#Message{

    height:200px;
    font-size:14pt;

	}
	</style>
@stop
<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">	
					<div class="jumbotron">
	  			<h1>Contact Me</h1>
	 			<p>Have questions? I have answers (maybe) </p>
	 			
			</div></div>
			    <div class="panel-body">
			    	
			    	<p>Want to get in touch with me? Fill out the form below to send me a message and I will try to get back to you within 24 hours!</p>
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="text">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Message</label>
							<div class="col-md-6">
								<textarea rows="5" class="form-control"  id="message" required data-validation-required-message="Please enter a message."></textarea>
							</div>
						</div>

						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Enter</button>

							</div>
						</div>
					</form>
					
				</div>
				</div>	
			</div>
		</div>
	</div>
</div>
@stop