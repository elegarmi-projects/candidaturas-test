@section('title', __('Tokens'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card admin-card">
				<div class="card-header admin-card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
								<i class="fas fa-shield-keyhole fa-fw text-info">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" fill="currentColor" viewBox="0 0 131.87 166.56" style="enable-background:new 0 0 131.87 166.56;" xml:space="preserve">
							   			<path d="M55.03,92.51c0-0.05,0-0.11,0-0.16c0.37-4.19-0.35-7.43-3.99-10.66c-6.64-5.88-7.55-16.13-3.33-23.85 c4.28-7.83,13.25-12.22,21.67-10.6c9.21,1.77,16.12,8.84,17.08,17.92c0.84,7.91-2.04,14.37-8.37,19.28c-0.63,0.49-1.18,1.5-1.2,2.29 c-0.12,3.86-0.01,7.73-0.07,11.59c-0.11,6.54-4.74,11.33-10.89,11.33c-6.15,0-10.76-4.79-10.89-11.33 C55,96.37,55.03,94.44,55.03,92.51z M63.04,90.64c0,2.47-0.01,4.93,0,7.4c0.01,2.27,1.02,3.54,2.81,3.59 c1.87,0.05,2.96-1.25,2.97-3.58c0.01-4.45,0.14-8.91-0.04-13.35c-0.12-2.94,0.91-4.76,3.57-6.15c4.59-2.4,6.99-7.52,6.07-12.95 c-0.89-5.27-4.11-8.7-9.29-10.19c-4.61-1.33-9.84,0.4-12.97,4.27c-5.08,6.3-3.36,15.24,3.78,19.12c2.26,1.23,3.3,2.85,3.14,5.42 C62.93,86.35,63.03,88.5,63.04,90.64z"/>
							   			<path d="M130.13,20.01c-0.31-3.53-2.28-4.61-5.78-4.08c-5.97,0.91-11.98,1.96-18,2.15C91.69,18.56,77.23,8.36,69.08,2.64 c-0.38-0.27-1.85-1.41-3.19-1.41c-1.5,0-2.79,1.16-3.05,1.43c-6.48,6.6-15.22,12.13-24.24,14.17c-10.41,2.36-20.78,1.5-31.09-0.84 C4.05,15.2,2.01,16.47,1.73,20C0.1,40.83,0.46,61.59,4.26,82.2c2.43,13.18,6.52,25.76,13.62,37.21 c11.54,18.62,27.13,33.24,45.14,45.44c1.98,1.34,3.81,1.34,5.8,0.01c13.05-8.75,24.74-19,34.84-31.06 c10.59-12.65,18.16-26.85,22.07-42.94c2.58-10.61,4.09-21.37,4.77-32.25C131.32,45.74,131.26,32.86,130.13,20.01z M121.83,65.71 c-1.04,10.54-2.85,20.92-6.11,31.02c-4.22,13.09-11.5,24.39-20.53,34.61c-8.35,9.45-17.76,17.74-28.1,24.95 c-0.5,0.35-1.6,0.51-2.02,0.21C49,145.08,34.86,131.78,24.45,114.84c-6.73-10.95-10.41-22.99-12.59-35.54 C9.71,66.95,8.88,54.49,9.27,41.97c0-5.31,0.02-10.62-0.01-15.93c-0.01-1.08,0.18-1.46,1.44-1.24c8.67,1.51,17.37,1.94,26.1,0.52 c10.66-1.74,19.98-6.28,28.02-13.45c0.85-0.76,1.3-0.84,2.2-0.03c12.62,11.3,27.6,15.33,44.21,14.15c3.42-0.24,6.81-0.83,10.22-1.16 c0.35-0.03,1.07,0.54,1.08,0.85C123.25,39.04,123.15,52.38,121.83,65.71z"/>
							   		</svg>
							   </i> Tokens
							</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar tokens">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
							<i class="fa fa-plus"></i> Añadir token
						</div>
					</div>
				</div>
				
				<div class="card-body admin-card-body">
						@include('livewire.tokens.create')
						@include('livewire.tokens.update')
					<div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<td>#</td> 
									<th>Token de Typeform</th>
									<td>Acciones</td>
								</tr>
							</thead>
							<tbody>
								@foreach($tokens as $row)
								<tr>
									<td>{{ $row->id }}</td> 
									<td>{{ $row->typeform_token }}</td>
									<td width="90">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											<div class="dropdown-menu dropdown-menu-right">
												<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
												<a class="dropdown-item" onclick="confirm('¿Confirmas que quieres borrar el token con id {{$row->id}}? \n¡Esta acción no se puede deshacer!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
											</div>
										</div>
									</td>
								@endforeach
							</tbody>
						</table>						
						{{ $tokens->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
