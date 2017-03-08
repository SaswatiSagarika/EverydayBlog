<!-- <html>
	<head>
		<title>Laravel</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Laravel 5</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
			</div>
		</div>
	</body>
</html>
 -->
@extends('layouts.master')
@section('title')
	Laravel
	
@stop
<!-- Main Content -->
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 ">
			

			<div class="jumbotron">
	  			<h1>Welcome To My Blog</h1>
	 			<p>Thank you for visiting my tets blog </p>
	 			<p><a class="btn btn-primary btn-lg" href="/list" role="button">Popular Post</a></p>
			</div>

			
		</div>
	</div>
	
</div>
@stop
@endsection