@extends('layout')

@section('content')
	
	<div class="col-md-8 col-md-offset-2">

		<div class="row">
			<a href="{{ url('/product/create') }}" class="btn btn-info btn-block">Dodaj nowy produkt</a>
			
		</div>

		<hr>

		<div class="row">
			
			<table class="table table-hover text-center">
				<col width="100">
				<col width="250">
				<col width="100">
				<col width="150">
				<col width="150">
				<thead>
					<tr>
						<th class="text-center">Nazwa</th>
						<th class="text-center">Opis</th>
						<th class="text-center">Cena</th>
						<th class="text-center">Dodano produkt</th>
						<th class="text-center">Aktualizacja</th>
						<th class="text-center">Opcje</th>
					</tr>
				</thead>
				@foreach($products as $product)
			
				<tbody>
					<tr>
						<td>{{ $product->name }}</td>
						<td>{{ $product->description }}</td>
						<td>{{ $product->price['price'] }} zł</td>
						<td>{{ $product->created_at }}</td>
						<td>{{ $product->updated_at }}</td>
						<td>
							<form action="{{ url('/product/'.$product->id.'/edit') }}" method="POST">

								{{ csrf_field() }}
								{{ method_field('GET') }}

								<button type="submit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></button>
								
							</form>
							<form action="{{ url('/product/'.$product->id) }}" method="POST">

								{{ csrf_field() }}
								{{ method_field('DELETE') }}

								<button type="submit" onclick="return confirm('Czy napewno usunąć?')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
								
							</form>
						</td>
					</tr>
				</tbody>
				

				@endforeach
			</table>
		</div>		

		<div class="text-center">
			{{ $products->links() }}	
		</div>

	</div>	
@endsection