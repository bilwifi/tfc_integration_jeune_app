@extends("layouts.master")
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-6 ">
        <div class="card bg-light border-bottom ">
        	<div class="card-header bg-danger text-white">Profil de {{ $user->prenom .' '.$user->nom }}</div>
        	<div class="card-body">
        		<div class="row d-flex ">
        			<div class="col-12 d-flex justify-content-center ">
						<img src="{{ img_profil($user->idusers) }}" class="img-fluid rounded-circle" alt="Bil" width="200" height="200"><a href="{{ route('edit_picture_user') }}"><i class="fas fa-edit"></i></a>			
        			</div>
        		</div>
                <br>
                <br>
            <div class="row">
            <div class="card bg-light col-12 d-flex justify-content-center" >
              {{-- <div class="card-header">Identité</div> --}}
              <div class="card-body">
                <table class="table table-striped">
                 {{--  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead> --}}
                  <tbody>
                    <tr>
                      <th scope="row">Nom</th>
                      <td>{{ $user->nom }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Postom</th>
                      <td>{{ $user->postnom }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Prenom</th>
                      <td>{{ $user->prenom }}</td>
                    </tr>
                   
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        	</div>
        </div>
    </div>
 <div>
@endsection