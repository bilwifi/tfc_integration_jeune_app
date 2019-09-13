<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListOffresDataTable;
use App\Models\Offre;
use App\Models\Candidature;
use App\Models\Formation;
use App\Models\User;

use App\Http\Requests\CreateOffreRequest;
use Flashy;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(ListOffresDataTable $dataTables){
    	return $dataTables->render('admin.index');
    }

    public function showFormOffre(){
        $offre = null;
    	return view('admin.form_offre',compact('offre'));
    }

    public function createOffre(CreateOffreRequest $request){
        // dd($request->all());
        $offre = Offre::updateOrCreate(
                                        ['idoffres'=>$request->idoffres],
                                        $request->all()
                                    );
        Flashy::message("L'offre est publié avec succèss !!");
        return redirect()->route('admin.show_offre',$offre->idoffres);
    }
    public function editOffre(Offre $offre){
        return view('admin.form_offre',compact('offre'));
        
    }
    public function destroyOffre(Offre $offre){
        Offre::destroy($offre->idoffres);
        Flashy::error('L\'offre est supprimée avec succèss');
        return redirect()->back();
        
    }

    public function showOffre(Offre $offre){
        $candidats = Candidature::NonAdmi()->joinUser()
                                ->where('candidatures.idoffres',$offre->idoffres)
                                ->get([
                                    'candidatures.idcandidatures',
                                    'candidatures.idusers',
                                    'users.nom',
                                    'users.prenom',
                                    'candidatures.idoffres',
                                ]);
        $beneficiaires = Formation::joinOffre()
                                    ->join('users','candidatures.idusers','users.idusers')
                                    ->where('candidatures.idoffres',$offre->idoffres)->get();
        return view('admin.view_offre',compact('offre','candidats','beneficiaires'));
    }

    public function acceptCandidature(Candidature $candidature){
        // dd($candidature->only('idcandidatures','idusers','idoffres'));
        Formation::updateOrCreate($candidature->only('idcandidatures','idusers','idoffres'),$candidature->only('idcandidatures','idusers','idoffres'));
        Flashy::info('Candidature accepté avec succèss');
        return redirect()->back();
        
    }

    public function profilUser(User $user){
        // $user = auth()->user();
        return view('profil_user',compact('user'));
    }

    public function resilierCandidature(Candidature $candidature){
        Candidature::destroy($candidature->idcandidatures);
        Flashy::error('Vous avez annuler cette candidature');
        return redirect()->back();

    }
}
