@foreach ($schools as $school)

  <div class="card col-lg-4 col-md-6 col-xs-12">
    <a href="{{ url('/promos') }}">
      <img class="card-img-top" src="{{ asset('storage').'/'.$school->image }}" alt="{{ $school->name }}" />
      <div class="card-main">
        <h5 class="card-title">{{ $school->province }}</h5>
      </div>
    </a>
  </div>
  
@endforeach