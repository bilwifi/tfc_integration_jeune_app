@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-8">
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
    </div>
    {{-- <div class="col-md-1"></div> --}}
    <div class="col-md-4">
        <div class="row">
            <div class="card bg-light col-12 " style="max-height: 300px">
                <div class="card-header bg-danger">
                    <h5 class="card-title text-white">Candidatures</h5>
                </div>
                <div class="card-body scroll-panel">
                  @if($candidats->isNotEmpty())
                  @foreach($candidats as $c)
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-5">
                          <img src="{{ img_profil($c->idusers) }}" class="img-fluid rounded-circle" alt="Bil" width="90 " height="90">
                        </div>
                        <div class="col-7">
                          <h5>{{ $c->prenom .' '.$c->nom }} </h5>
                          
                          <a href="{{ route('admin.profil_user',$c->idusers) }}" class="btn bg-info text-white"><span class="fa fa-eye"></span></a>
                          <a href="{{ route('admin.accept_candidature',$c->idcandidatures) }}" class="btn bg-success text-white"><span class="fa fa-check"></span></a>
                          <a href="{{ route('admin.resilier_candidature',$c->idcandidatures) }}" class="btn bg-danger text-white"><span class="fa fa-trash"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="card bg-light col-12 " style="max-height: 300px">
                <div class="card-header bg-danger">
                    <h5 class="card-title  text-white">Bénéficiaires</h5>
                </div>
                <div class="card-body scroll-panel">
                  @if($beneficiaires->isNotEmpty())
                  @foreach($beneficiaires as $c)
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-5">
                          <img src="{{ img_profil($c->idusers) }}" class="img-fluid rounded-circle" alt="Bil" width="90 " height="90">
                        </div>
                        <div class="col-7">
                          <h5>{{ $c->prenom .' '.$c->nom }} </h5>
                          
                          <a href="{{ route('admin.profil_user',$c->idusers) }}" class="btn bg-info text-white"><span class="fa fa-eye"></span></a>
                          {{-- <a href="" class="btn bg-success text-white"><span class="fa fa-check"></span></a> --}}
                          {{-- <a href="" class="btn bg-danger text-white"><span class="fa fa-trash"></span></a> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection