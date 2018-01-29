<?php 
namespace App\Models;
use App\Models\User;
use App\Models\Permissiongroup;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Base extends Model {
	
	/**
     * checking the user permission for access any module
	 * $id is user id
     */
	 
	function validAccess( $id){
		$accessArr = array();
		//Get Permission By User Wise
		$userPermissions =   User::find($id);
		if($userPermissions->groups->first()->slug_peg=='super-administrator'){
			$accessArr['all']= true;
		}else{
			foreach ($userPermissions->permissions as $key => $value) {
				$accessArr[$value['slug_per']]= true; 
			}
			//Get Permission by Group Wise
			foreach($userPermissions->groups as $pgrps)
			{
				$groupPermissions = Permissiongroup::find($pgrps->id_permissiongroup)->permissions;
				foreach ($groupPermissions as $key => $value) {
					$accessArr[$value['slug_per']]= true; 
				}
			}
		}	
		return $accessArr;
	}	
}