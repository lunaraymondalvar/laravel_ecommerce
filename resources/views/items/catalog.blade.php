
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	{{-- bootstrap cdn --}}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
		<a href="/menu/add" class="btn btn-success"> Add New Item </a>

		@if(Session::has("success_message"))
			<div class="alert alert-success">{{ Session::get("success_message") }}</div>
		@endif



		<div class="row">
			@foreach($items as $indiv_item)
				<div class="col-sm-4">
					<div class="card">
						<h5 class="card-title text-center mt-3">{{ $indiv_item->name }}</h5>
						<div class="card-body">
							<img src="/{{$indiv_item->image_path}}" class="card-img-top">
							<p>{{ $indiv_item->description }}</p>
							<p>{{ $indiv_item->price }}</p>
							<form method="POST" action="/addToCart/{{ $indiv_item->id }}">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="quantity">Quantity</label>
									<input type="number" name="quantity" id="quantity" class="form-control">
									<button class="btn btn-block btn-outline-success" type="submit"> Add To Cart </button>
								</div>
							</form>

							<a href="/menu/{{ $indiv_item->id }}" class="btn btn-block btn-primary">View Details</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	
</body>
</html>



	


	





