
<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<h1 class="text-center my-4">My Cart</h1>
	@if(Session::has('cart'))
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Item</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Subtotal</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($item_cart as $item)
					<tr>
						<td>{{ $item->name }}</td>
						<td>
							<form method="POST" action="/menu/mycart/{{$item->id}}/changeQty">
								{{ csrf_field() }}
								{{ method_field("PATCH") }}
								<div class="input-group">
									<input type="number" name="new_qty" value="{{$item->quantity}}" min=1>
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary">Update Quantity</button>
									</div>
								</div>
							</form>
						</td>
						<td>{{ $item->price }}</td>
						<td class="text-right">{{ $item->subtotal }}</td>
						<td class="justify-content-center">
							<form method="POST" action="/menu/mycart/{{$item->id}}/delete">
								{{ csrf_field() }}
								{{ method_field("DELETE") }}
								<button class="btn btn-danger center-block" type="submit">Remove from Cart</button>
							</form>
						</td>
					</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Total: </td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td class="text-right">{{ $total }}</td>
				</tr>
			</tbody>
		</table>
		<a href="/menu/clearcart" class="btn btn-block btn-outline-danger">Clear Cart</a>
	@else
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="mt-20">Your cart is now empty</h2>
				</div>
			</div>
		</div>
	@endif
		<div class="container">
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-3">
					<a href="/catalog" class="btn btn-primary my-3">Go back to shopping</a>	
				</div>	
				<div class="col-md-4"></div>
			</div>
		</div>

	{{-- bootstrap scripts --}}
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
