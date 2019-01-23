
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Laravel Day 3</title>

	{{-- Bootstrap cdn --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>

	<h1 class="text-center">Catalog Page</h1>

	<h2>Categories</h2>
	<a href="#" class="btn btn-primary">All</a>
	@foreach($categories as $category)
		<a href="#" class="btn btn-primary">{{ $category->name }}</a>
	@endforeach

	<hr>

	<div class="container">
		<div class="row">
			@foreach($items as $indiv_item)
				<div class="col-sm-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">{{ $indiv_item->name }}</h5>
							<img src="{{ $indiv_item->image_path }}">
							<p>{{ $indiv_item->description }}</p>
							<p>{{ $indiv_item->category_id }}</p>
							<a href="/menu/{{ $indiv_item->id }}" class="btn btn-block btn-primary">{{ $indiv_item->name }}</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<a href="/menu/add" class="btn btn-success">Add New Item</a>

		@if(Session::has("success_message"))
			<div class="alert alert-success">{{ Session::get("success_message") }}</div>
		@endif
	</div>
</body>
</html>