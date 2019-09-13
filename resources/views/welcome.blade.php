@extends('layouts.master')
@section('stylesheet1')
<script>

  tbimage=new Array('img1','img2','img3','img4','img5','img6','img7','img8','img9','img10') //tableau des image mettre le nom de toutes les images
  preImages=new Array
  var opaa=0;
  var opab=100;
  var compteur=2
  var vitesse=2000

  function precharge() { 
    for (i = 0; i < tbimage.length; i++) { 
      preImages[i] = new Image()
      preImages[i].src = "{!! asset('img') .'/' !!}"+tbimage[i]+".jpg"
  }
    setTimeout(defilmage,vitesse);
  }

  function defilmage(reg){
    oxo=reg;
    if(compteur==tbimage.length-1){
    compteur=-1
  }
  if(oxo==1){
    compteur++
    opaa=10;
    document.getElementById('divimageb').src="{!! asset('img/').'/' !!}"+tbimage[compteur]+".jpg";
    oxo=0;
  }
  var imacibleb=document.getElementById('divimagea');
  var imaciblea=document.getElementById('divimageb');

  opaa+=3;
  opab-=4;
  if(document.all && !window.opera){ 
    imaciblea.style.filter = 'alpha(opacity=' + opaa + ');' ;
    imacibleb.style.filter = 'alpha(opacity=' + opab + ');';
  } 
  else{ 
    imaciblea.style.opacity = opaa/100;
    imacibleb.style.opacity = opab/100;
  }
  if(opaa>=100){
    opaa=10;
    opab=100;
    var xcc=imaciblea.src.length-4
    var cxx=imaciblea.src.lastIndexOf("/")+1
    var nomimg=imaciblea.src.substring(cxx,xcc)
    imacibleb.src='images/'+nomimg+'.jpg'
    setTimeout("defilmage(1)",vitesse);
    return false
  }
    setTimeout("defilmage()",25);
  }
  if(navigator.appName.substring(0,3)=="Mic"){
    attachEvent("onload",precharge);
  }
  else{
    addEventListener("load", precharge, false);
  }
</script>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card">
        {{-- <div class="card-header bg-danger">IMG</div> --}}
        <div class="card-body " style="background-color: #f8f9fa">
          <div id="divconteneur">
          <img id='divimagea' class="img-fluid border rounded-circle" src="{{ asset('img/img1.jpg') }}" style="opacity:100;FILTER:alpha(opacity=100);">
          <img id='divimageb'class="img-fluid rounded-circle" src="{{ asset('img/img2.jpg') }}" style="opacity:0;FILTER:alpha(opacity=0); min-height: 400px">
          </div>
        </div>  
      </div>
    </div>               
    <div class="col-md-1"></div>               
    <div class="col-md-5">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
              <li>{!! $error !!}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="card">
        <div class="card-header bg-danger text-monospace text-white">
          S'enregistrer
        </div>
        <div class="card-body">
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" placeholder="" name="nom" value="{{ old('nom') }}">
            </div>
            <div class="form-group">
              <label for="postnom">Postnom</label>
              <input type="text" class="form-control" id="postnom" placeholder="" name="postnom" value="{{ old('postnom') }}">
            </div>
            <div class="form-group">
              <label for="prenom">Prenom</label>
              <input type="text" class="form-control" id="prenom" placeholder="" name="prenom" value="{{ old('prenom') }}">
            </div>
            <div class="form-group">
              <label for="password1">Mot de passe </label>
              <input type="password" class="form-control" id="password1" placeholder="" name="password" >
            </div>
            <div class="form-group">
              <label for="password2">Confirmer votre mot de passe</label>
              <input type="password" class="form-control" id="password2" placeholder="" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Valider</button>
          </form>
      </div>
</div>
    </div>               
</div>
@endsection
@push('scripts')

@endpush