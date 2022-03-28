@extends('layouts.app')
@section('title', __('Escuelas'))
@section('content')

<div class="container-fluid">
	<div>
		<h1 class="display-6 mb-5 section-title"><span class="section-title-line">Escuelas</span></h1>
		<div class="container cards-container">
			<div class="row justify-content-center">
				@livewire('components.card-school')
			</div>
		</div>
	</div>
</div>

@endsection