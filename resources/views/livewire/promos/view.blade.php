@section('title', __('Promos'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card admin-card">
				<div class="card-header admin-card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
								<i class="fas fa-graduation-cap text-info"></i> Promos
							</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar promo">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal"> 
							<i class="fa fa-plus"></i>  Añadir promo 
						</div>
					</div>
				</div>
				
				<div class="card-body admin-card-body">
						@include('livewire.promos.create')
						@include('livewire.promos.update')
					<div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<td>#</td> 
									<th>Escuela</th>
									<th>Nombre</th>
									<th>Localidad</th>
									<th>Fecha de inicio</th>
									<th>Duración (h)</th>
									<th>Imagen</th>
									<th>Url</th>
									<th>Código</th>								
									<td>Acciones</td>
								</tr>
							</thead>
							<tbody>
								@foreach($promos as $row)
								<tr>
									<td>{{ $row->id }}</td> 
									<td>{{ $row->school->name }}</td> 
									<td>{{ $row->name }}</td> 
									<td>{{ $row->ubication }}</td> 
									<td>{{ $row->start_date }}</td> 
									<td>{{ $row->duration }}h</td>
									<td><img class="table-img" src="{{ asset('storage').'/'.$row->image }}" alt="{{ $row->name }}"></td>
									<td>{{ $row->url }}</td> 
									<td>{{ $row->code }}</td> 
									<td width="90">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											<div class="dropdown-menu dropdown-menu-right">
												<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
												<a class="dropdown-item" onclick="confirm('¿Confirmas que quieres borrar la promo con id {{$row->id}}? \n¡Esta acción no se puede deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>						
						{{ $promos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
