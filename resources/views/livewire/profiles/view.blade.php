@section('title', __('Profiles'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card admin-card">
				<div class="card-header admin-card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
								<i class="fas fa-user-edit text-info"></i> Perfiles
							</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar perfiles">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
							<i class="fa fa-plus"></i>  Añadir perfil
						</div>
					</div>
				</div>
				
				<div class="card-body admin-card-body">
						@include('livewire.profiles.create')
						@include('livewire.profiles.update')
					<div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<td>#</td> 
									<th>Nombre</th>
									<th>Apellidos</th>
									<th>Email</th>
									<th>Password</th>
									<th>Puesto</th>
									<th>GitHub</th>
									<th>Fecha de cumpleaños</th>
									<th>Imagen</th>
									<td>Acciones</td>
								</tr>
							</thead>
							<tbody>
								@foreach($profiles as $row)
								<tr>
									<td>{{ $row->id }}</td> 
									<td>{{ $row->name }}</td>
									<td>{{ $row->surnames }}</td>
									<td>{{ $row->email }}</td>
									<td>{{ $row->password }}</td>
									<td>{{ $row->job }}</td>
									<td>{{ $row->github }}</td>
									<td>{{ $row->birth_date }}</td>
									<td><img class="table-img" src="{{ asset('storage').'/'.$row->image }}" alt="{{ $row->name }}"></td> 
									<td width="90">
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Acciones
										</button>
										<div class="dropdown-menu dropdown-menu-right">
											<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
											<a class="dropdown-item" onclick="confirm('¿Confirmas que quieres borrar el perfil con id {{$row->id}}? \n¡Esta acción no se puede deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
										</div>
									</div>
									</td>
								@endforeach
							</tbody>
						</table>						
						{{ $profiles->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
