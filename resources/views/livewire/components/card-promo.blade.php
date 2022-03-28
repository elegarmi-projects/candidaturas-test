@foreach ($promos as $promo)
 
  <div class="card col-lg-4 col-md-6 col-xs-12">
    <a href="{{ route('candidaturas-view', $promo->id) }}">
      <img class="card-img-top" src="{{ asset('storage').'/'.$promo->image }}" alt="{{ $promo->name }}">
      <div class="card-main">
        <h5 class="card-title">{{ $promo->name }}</h2>
      </div>
      <div class="card-body"> 
        <h5 class="card-subtitle">{{ $promo->ubication }}</h5>
        <div class="card-description"> 
          <p class="card-text">{{ $promo->start_date }}</p>
          <p class="card-text">{{ $promo->duration }}h</p>
          <p class="card-text">{{ $promo->code }}</p>
        </div> 
      </div>
    </a>
  </div>

@endforeach  