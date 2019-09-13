@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6"></div>               
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