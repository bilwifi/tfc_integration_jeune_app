<?php 

	function img_profil($idusers){
		$user = App\Models\User::find($idusers);
		if (!empty($user->picture)) {
			return url(\Storage::url($user->picture));
		}else{
			return asset('img/profil-user.png');
		}
	}

	function opt($var,$attr){
		if (isset($var)) {
			return optional($var)->$attr;
		}else{
			return null;
		}
	}

    function getPrefixeRoute($request){
    	if (!empty($request['PATH_INFO'])) {
			$path_info = $request['PATH_INFO'];
		    $path_info =trim($path_info,'/');
		    $prefixe = explode('/',$path_info)[0];
		   
		    return $prefixe;
    	}
    	return '';
    }




