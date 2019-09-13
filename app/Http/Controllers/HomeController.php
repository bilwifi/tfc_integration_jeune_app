<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Models\Candidature;
use App\Models\Formation;
use App\Models\User;
use Flashy;
use Validator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $offres = Offre::NonPostuler(auth('web')->user()->idusers)->where('statut','encours')
                ->get([
                    'offres.idoffres',
                    'offres.titre',
                    'offres.resume',
                    'offres.description',
                    'candidatures.idoffres as j',
                    'offres.statut',
                    'offres.picture',
                    'offres.created_at',
                ]);
        // dd($offres);
        $formations = Formation::JoinOffre()->where('candidatures.idusers',auth()->user()->idusers)
                    ->get([
                    'offres.idoffres',
                    'offres.titre',
                    'offres.resume',
                    'offres.description',
                    'offres.statut',
                    'offres.picture',
                    'offres.created_at',
                ]);
        // dd($formations);

        $candidatures = Candidature::JoinOffre()->NonAdmi()->where('candidatures.idusers',auth()->user()->idusers)->get([
                    'offres.idoffres',
                    'offres.titre',
                    'offres.resume',
                    'offres.description',
                    'offres.statut',
                    'offres.picture',
                    'offres.created_at',
                    'candidatures.idcandidatures',
                ]);
        return view('home',compact('offres','candidatures','formations'));
    }

    public function viewOffre(Offre $offre){
        return view('view_offre',compact('offre'));
    }

    public function postuler(Offre $offre){
        $candidature = Candidature::updateOrCreate([
            'idusers'=>auth()->user()->idusers,
            'idoffres'=>$offre->idoffres,
        ]);

        Flashy::message('Vous avez postuler à l\'offre => '.$offre->titre, 'test');
        return redirect()->back();

    } 

    public function resilierCandidature(Candidature $candidature){
        Candidature::destroy($candidature->idcandidatures);
        Flashy::error('Vous avez annuler votre candidature');
        return redirect()->back();

    }

    public function profilUser(){
        $user = auth()->user();
        return view('profil_user',compact('user'));
    }

    public function editPictureUser(){
        $user = auth()->user();
        return view('upload_img',compact('user'));
    }

    /**
     * To handle the comming post request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImg(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:1000',
            'idusers' => 'required|exists:users',
        ]);
        if ($validator->fails()) {
            
            return $validator->errors();            
        }


        $status = "";

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            // Rename image
            $filename = time().'.'.$image->guessExtension();
            
            $path = $request->file('profile_picture')->storeAs(
                 'profile_pictures', $filename
            );
            $user = User::find($request->idusers);
            $user->picture = $path;
            $user->save();
            $status = "uploaded";            
        }
        
        return response($status,200);
    }
}
