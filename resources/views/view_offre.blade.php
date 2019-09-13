<div class="card bg-light col-12 ">
    <div class="card-header bg-danger">
        <h5 class="card-title text-white">{{ $offre->titre }}</h5>
    </div>
    <div class="card-body ">
        <div class="">
		  <h1 class="display-6">{{ $offre->titre }}</h1>
		  <p class="lead">{{ $offre->resume }}</p>
		  <hr class="my-4">
		  <p>{!! $offre->description !!}</p>
        	{{-- <a href="{{ route('postuler',$offre->idoffres) }}" class="btn btn-primary btn-lg">Postuler</a> --}}
		  
		</div>
    </div>
</div>
