{{-- @section('title', __('Candidaturas')) --}}

@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<div class="card admin-card">
				<div class="card-header admin-card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>
								<i class="fas fa-user-graduate text-info"></i> Candidaturas
							</h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar candidaturas">
						</div>									
					</div>
				</div>
				<div class="card-body admin-card-body">							
					<div class="table-responsive" wire:ignore>
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<th>#</th> 
									<th>Nombre</th>
									<th>Apellidos</th>
									<th>Fecha de nacimiento</th>
									<th>Nacionalidad</th>
									<th>Email</th>
									<th>Teléfono</th>
									<th>Cuenta de usuario</th>
									<th>Puntos</th>
									<th>Descripción</th>
									<th>Fecha de registro</th>
									<th>Promo id</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody id="tbody"></tbody>
							
						</table>						
						
					</div>
				</div>
			</div>		
        </div>     
    </div>   
</div>
@endsection




<script>

// FREECODECAMP ************************************************************************************************

const urlFreeCodeCamp = 'https://api.freecodecamp.org/api/users/get-public-profile?username='

var userArrayPoints = [];

async function getPoints(id){

    var myHeaders = new Headers();
    myHeaders.append("Cookie", "_csrf=XgWIagMZB3DIJKmiNWw2_yBX; csrf_token=CJzGy40i-Yn-nkwiiJx3JjVtrhFBioB91v_8; connect.sid=s%3AOYbepHrYbtwH5AdlKH_z1IiVBjGdhbMo.YuGP9bE7xSFH9UMpfUx5eREwD2PWGitHqJH315CrPqo");

    var requestOptions = {
		method: 'GET',
		headers: myHeaders,
		redirect: 'follow',
    };

	try{
		let response = await fetch(urlFreeCodeCamp+id, requestOptions);
		let result = await response.json();

		let userPoints = await result.entities.user[id].points;

		return userPoints;
	}catch(err){
		console.error(err);
	}	
}

async function getArrayPoints(id){

	userArrayPoints.push({id:id, points:await getPoints(id)});
}



// TYPEFORM ****************************************************************************************************

const urlTypeFormPromos = 'https://api.typeform.com/forms';

// Los siguientes datos provienen de la BD
const idPromo = '<?=$data->código?>';
const tokenTypeForm = '<?=$token->token_typeform?>';

const NAME = 0; 
const SURNAME = 1;
const MAIL = 2;
const FREECODE = 3;
const DESCRIPTION = 4;

var arrayFreeCodeIds = [];

async function getCandidatures(idPromo){

    const urlTypeFormCandidatures = 'https://api.typeform.com/forms/' + idPromo + '/responses';

    var myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer " + tokenTypeForm);

    var requestOptions = {
		method: 'GET',
		headers: myHeaders,
		redirect: 'follow'
    };

	try{
		let response = await fetch(urlTypeFormCandidatures, requestOptions);
		let result = await response.json();
		let typeFormCandidatures = await result.items;
		return typeFormCandidatures;

	}catch(err){
		console.error(err);
	} 
}

async function getFreeCodeIds(){

	let typeFormPromos = await getCandidatures(idPromo);

	typeFormPromos.forEach(user => {   

		user.answers.forEach(element => {  
			
			if(user.answers.indexOf(element) == FREECODE) {
				arrayFreeCodeIds.push(element.text);
			} 				
		}); 	
	});
}

async function showCandidatures(){

    let typeFormPromos = await getCandidatures(idPromo);

	var row;
	var rowsCandidates = [];
	var idFreeCode;
	
	typeFormPromos.forEach(user => {   
	
		row = '<tr><td></td>';
		
		user.answers.forEach(element => {  
					
			if(user.answers.indexOf(element) == NAME) {
				row+= '<td>'+ element.text + '</td>';
			}    
			if(user.answers.indexOf(element) == SURNAME) {
				row+= '<td>'+ element.text + '</td>';
			}    
			if(user.answers.indexOf(element) == MAIL) {  
				row+= '<td>Fecha</td>';  
				row+= '<td>Nacionalidad</td>';    
				row+= '<td>'+ element.email + '</td>';  
			}
			if(user.answers.indexOf(element) == FREECODE) {
				row+= '<td>Teléfono</td>'; 
				row+= '<td>'+ element.text + '</td>';
				idFreeCode = element.text;
			} 
			if(user.answers.indexOf(element) == DESCRIPTION) { 				
				row+= '<td id="'+ idFreeCode +'">Points</td>';
				row+= '<td>'+ element.text + '</td>';
				row+= '<td>Fecha registro</td>'; 
				row+= '<td>Promo id</td>'; 
				row+= '<td>Acciones</td></tr>'; 
			} 					
		}); 
		rowsCandidates.push(row);		
    });
	
	$('#tbody').append(rowsCandidates);
	return rowsCandidates;
}

showCandidatures();

async function printPoints(){
	await getFreeCodeIds();
	var i = 0;

	/* console.log('Array de IDs recien solicitados: ' + arrayFreeCodeIds);
	console.log('Array 0 de IDs recien solicitados: ' + arrayFreeCodeIds[0]);
	console.log('Array 1 de IDs recien solicitados: ' + arrayFreeCodeIds[1]); */
	
	arrayFreeCodeIds.forEach(element => {
		async function printHtml(){
			
			try{
				await getArrayPoints(element);			
				//console.log('Puntos de ' + userArrayPoints[i].id + ':' + userArrayPoints[i].points);
				document.getElementById(userArrayPoints[i].id).innerHTML=userArrayPoints[i].points;							
				i++;
			}catch(err){
				console.error(err);
				location.reload();
			}			
		};
		printHtml();
	});	
}

printPoints();

</script>

