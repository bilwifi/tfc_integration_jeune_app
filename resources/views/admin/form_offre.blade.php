@extends('layouts.master')
@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('summernote/dist/summernote-bs4.css') }}">
@endpush
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-10">
    	<div class="card">
    		<div class="card-header bg-danger text-white">Offre</div>
    		<div class="card-body">
    			@if ($errors->any())
		        <div class="alert alert-danger">
		          <ul class="list-unstyled">
		            @foreach ($errors->all() as $error)
		              <li>{!! $error !!}</li>
		            @endforeach
		          </ul>
		        </div>
		      @endif
    			<form action="{{ route('admin.create_offre') }}" method="POST">
    				@csrf
    				<input type="text" name="idoffres" value="{{ old('idoffres',optional($offre)->idoffres) }}" hidden="">
				  <div class="form-group">
				    <label for="titre">Titre</label>
				    <input type="text" name="titre" class="form-control" id="titre" required="" value="{{ old('titre',optional($offre)->titre) }}">
				  </div>
				  <div class="form-group">
				    <label for="resume">Resumé</label>
				    <input type="text" name="resume" class="form-control" id="resume" maxlength="255" required="" value="{{ old('resume',optional($offre)->resume) }}">
				  </div>
				  <div class="form-group">
				    <label for="idtypes_offres">Type de l'offre</label>
				    <select  class="form-control" id="idtypes_offres" name="idtypes_offres" >
				    @foreach(App\Models\Types_offre::get() as $tp)
				      <option value="{{ $tp->idtypes_offres }}">{{ $tp->lib }}</option>
				    @endforeach
				      
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="description">Détail</label>
				    <textarea class="form-control" name="description" id="description" rows="10" >{!! old('description',optional($offre)->description) !!}</textarea>
				  </div>
				  <button type="submit" class="btn btn-primary mb-2 btn-block">Valider</button>
				</form>
    		</div>
    	</div>
    </div>
        
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('summernote/dist/summernote-bs4.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
  	$('#description').summernote({
  		height: 300,
  	});
});
</script>
@endpush
