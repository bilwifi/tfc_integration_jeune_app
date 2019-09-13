@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-6 ">
        <div class="card bg-light border-bottom " style="border-radius: 10px; max-height: 600px"  >
            <div class="card-header bg-danger">
                <h5 class="card-title text-white">Les offres</h5>
            </div>
          <div class="card-body border-danger scroll-panel"  >
            <div class="row">
                @if($offres->isNotEmpty())
                @foreach($offres as $offre)
                @if(!App\Models\Candidature::aPostuler($offre->idoffres,auth()->user()->idusers))
                    <div class="col-12">
                       <div class="card border " style="border-radius: 10px" >
                          {{-- <img class="card-img-top img-fluid" src="{{ asset('img/test.png') }}" alt="Card image cap"> --}}
                          <div class="card-body">
                            <h5 class="card-title">{{ $offre->titre }}</h5>
                            <p class="card-text">{{ $offre->resume }}</p>
                            <div class="justify-content-end ">
                                {{-- <a href="{{ route('view_offre',$offre->idoffres) }}" class="btn btn-primary">Voir en détail</a> --}}
                                <button type="button" class="view-offre btn btn-primary" data-toggle="modal" data-target="#modal-view-offre" data-links="{{ route('view_offre',$offre->idoffres) }}"> Voir en détail </button>
                                <a href="{{ route('postuler',$offre->idoffres) }}" class="btn btn-primary">Postuler</a>
                            </div>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                          </div>
                        </div> 
                    </div>
                    <br>
                    @endif
                    @endforeach
                 @else
                 <div class="alert alert-light" role="alert">
                  Aucune offre disponible pour l'instant !
                 </div>
                 @endif

            </div>
            
          </div>

        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="row">
            <div class="card bg-light col-12 " style="max-height: 300px">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Mes Formations</h5>
                </div>
                <div class="card-body scroll-panel">
                    @if($formations->isNotEmpty())
                    @foreach($formations as $formation)
                    <div class="col-12">
                       <div class="card border-danger mb-3">
                          {{-- <img class="card-img-top img-fluid" src="{{ asset('img/test.png') }}" alt="Card image cap"> --}}
                          <div class="card-body">
                            <h5 class="card-title">{{ $formation->titre }}</h5>
                            <p class="card-text">{{ $formation->resume }}</p>
                            <div class="justify-content-end ">
                                {{-- <a href="{{ route('view_offre',$offre->idoffres) }}" class="btn btn-primary">Voir en détail</a> --}}
                                <button type="button" class="view-offre btn btn-primary" data-toggle="modal" data-target="#modal-view-offre" data-links="{{ route('view_offre',$formation->idoffres) }}"> Voir en détail </button>
                            </div>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                          </div>
                        </div> 
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-light" role="alert">
                      Aucune formation disponible pour l'instant !
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="card bg-light col-12 " style="max-height: 300px">
                <div class="card-header bg-danger">
                    <h5 class="card-title  text-white">Mes Candidatures</h5>
                </div>
                <div class="card-body scroll-panel">
                    @if($candidatures->isNotEmpty())
                    @foreach($candidatures as $candidature)
                    <div class="col-12">
                       <div class="card border-danger mb-3">
                          {{-- <img class="card-img-top img-fluid" src="{{ asset('img/test.png') }}" alt="Card image cap"> --}}
                          <div class="card-body">
                            <h5 class="card-title">{{ $candidature->titre }}</h5>
                            <p class="card-text">{{ $candidature->resume }}</p>
                            <div class="justify-content-end ">
                                {{-- <a href="{{ route('view_offre',$offre->idoffres) }}" class="btn btn-primary">Voir en détail</a> --}}
                                <button type="button" class="view-offre btn btn-primary" data-toggle="modal" data-target="#modal-view-offre" data-links="{{ route('view_offre',$candidature->idoffres) }}"> Voir en détail </button>
                                <a href="{{ route('resilier_candaidature',$candidature->idcandidatures) }}" class="btn btn-danger">Annuler</a>
                            </div>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                          </div>
                        </div> 
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-light" role="alert">
                      Aucune candidature disponible pour l'instant !
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-view-offre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Détail de l'offre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="data-view-offre">
        
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
        $('.view-offre').on('click', function(e) {
        e.preventDefault();
        var links = $(this).data('links');
        $.ajax({
            type: 'get',
            url: links,
            success: function(data) {
                $('#data-view-offre').html(data);
                
            },
            error:function(data) {
                var errors = data.responseJSON.errors;
                  $.each(errors, function (key, value) {
                    document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
                    $('#msgErrors').removeAttr('hidden');
                });
            }
        });
    });
</script>
@endpush
