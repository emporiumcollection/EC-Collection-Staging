<?php
namespace App\Helpers;
use Session, DB ;

class CommonHelper
{   
    static function submit_contracts($all_contracts_data,$type,$oid=0,$cType=""){
        $contracts = $all_contracts_data;
        
        if(count($contracts) > 0){
            
            switch($type){
                case 'sign-up' :
                    \CommonHelper::submit_sign_up_contract($contracts);
                break;
                
                case 'packages' :
                    \CommonHelper::submit_packages_contract($contracts,$oid);
                break;
                
                case 'commission' :
                    \CommonHelper::submit_commission_contract($contracts,$oid,$cType);
                break;
                
                case 'hotels' :
                    \CommonHelper::submit_hotel_contract($contracts,$oid);
                break;
            }
        }
    }
    
    static function submit_hotel_contract($contracts,$oid){
        if(\Auth::check()){
            $uid = \Auth::user()->id;
            $contractsAccepted = array();
            
            //insert contracts
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id')->where('tb_users_contracts.contract_type','hotels')->where('tb_users_contracts.hotel_id',$oid)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            $resetuserContract = array();
            foreach($usersContracts as $si_usersContract){
                $resetuserContract[$si_usersContract->contract_id] = $si_usersContract->id;                
            }
            
            foreach($contracts as $si_contract){
                if(!isset($resetuserContract[$si_contract->contract_id])){
                    $temparray = array();
                    $temparray['contract_id'] = $si_contract->contract_id;
                    $temparray['hotel_id'] = $oid;
                    $temparray['title'] = $si_contract->title;
                    $temparray['description'] = $si_contract->description;
                    $temparray['contract_type'] = $si_contract->contract_type;
                    $temparray['package_ids'] = $si_contract->package_ids;
                    $temparray['hotel_ids'] = $si_contract->hotel_ids;
                    $temparray['event_ids'] = $si_contract->event_ids;
                    $temparray['user_group_ids'] = $si_contract->user_group_ids;
                    $temparray['user_ids'] = $si_contract->user_ids;
                    if(isset($si_contract->is_required)){ $temparray['is_required'] = (bool) $si_contract->is_required; }
                    if(isset($si_contract->is_agree)){ $temparray['is_agree'] = (bool) $si_contract->is_agree; }
                    if(isset($si_contract->sort_num)){ $temparray['sort_num'] = (int) $si_contract->sort_num; }
                    $temparray['status'] = 1;
                    $temparray['accepted_by'] = $uid;
                    $temparray['created_by'] = $uid;
                    $temparray['created_on'] = date('Y-m-d H:i:s');
                    
                    $contractsAccepted[] = $temparray;
                }
            }
            
            if(count($contractsAccepted) > 0){ \DB::table('tb_users_contracts')->insert($contractsAccepted); }
            //End
        }
    }
    
    static function submit_packages_contract($contracts,$packgids){
        if(\Auth::check()){
            $uid = \Auth::user()->id;
            $contractsAccepted = array();
            
            //insert contracts
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id')->where('tb_users_contracts.contract_type','packages')->whereIn('tb_users_contracts.package_id',$packgids)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            $resetuserContract = array();
            foreach($usersContracts as $si_usersContract){
                $resetuserContract[$si_usersContract->contract_id] = $si_usersContract->id;                
            }
            
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id')->where('tb_users_contracts.contract_type','packages')->whereNull('tb_users_contracts.package_id')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            foreach($usersContracts as $si_usersContract){
                $resetuserContract[$si_usersContract->contract_id] = $si_usersContract->id;                
            }
            
            foreach($contracts as $si_contract){
                if(!isset($resetuserContract[$si_contract->contract_id])){
                    $temparray = array();
                    $temparray['contract_id'] = $si_contract->contract_id;
                    $temparray['order_id'] = $si_contract->order_id;
                    if(isset($si_contract->package_id)){ $temparray['package_id'] = $si_contract->package_id; }
                    $temparray['title'] = $si_contract->title;
                    $temparray['description'] = $si_contract->description;
                    $temparray['contract_type'] = $si_contract->contract_type;
                    $temparray['package_ids'] = $si_contract->package_ids;
                    $temparray['hotel_ids'] = $si_contract->hotel_ids;
                    $temparray['event_ids'] = $si_contract->event_ids;
                    $temparray['user_group_ids'] = $si_contract->user_group_ids;
                    $temparray['user_ids'] = $si_contract->user_ids;
                    if(isset($si_contract->is_required)){ $temparray['is_required'] = (bool) $si_contract->is_required; }
                    if(isset($si_contract->is_agree)){ $temparray['is_agree'] = (bool) $si_contract->is_agree; }
                    if(isset($si_contract->sort_num)){ $temparray['sort_num'] = (int) $si_contract->sort_num; }
                    $temparray['status'] = 1;
                    $temparray['accepted_by'] = $uid;
                    $temparray['created_by'] = $uid;
                    $temparray['created_on'] = date('Y-m-d H:i:s');
                    
                    \DB::table('tb_users_contracts')->insert($temparray);
                    //$contractsAccepted[] = $temparray;
                }
            }
            
            //if(count($contractsAccepted) > 0){ \DB::table('tb_users_contracts')->insert($contractsAccepted); }die;
        }
    }
    
    static function submit_commission_contract($contracts,$oid,$cType){
        if(\Auth::check()){
            $uid = \Auth::user()->id;
            $contractsAccepted = array();
            $update_array = array();
            //insert contracts
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id')->where('tb_users_contracts.contract_type','commission')->where('tb_users_contracts.hotel_id',$oid)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            $resetuserContract = array();
            $resetuserContractIds = array();
            foreach($usersContracts as $si_usersContract){
                $resetuserContract[$si_usersContract->contract_id] = $si_usersContract->id;  
                $resetuserContractIds[$si_usersContract->id] = $si_usersContract->contract_id;               
            }
            
            foreach($contracts as $si_contract){
                //if(!isset($resetuserContract[$si_contract->contract_id])){
                    $temparray = array();
                    $temparray['contract_id'] = $si_contract->contract_id;
                    $temparray['hotel_id'] = $oid;
                    $temparray['title'] = $si_contract->title;
                    $temparray['description'] = $si_contract->description;
                    $temparray['contract_type'] = $si_contract->contract_type;
                    $temparray['package_ids'] = $si_contract->package_ids;
                    $temparray['hotel_ids'] = $si_contract->hotel_ids;
                    $temparray['event_ids'] = $si_contract->event_ids;
                    $temparray['user_group_ids'] = $si_contract->user_group_ids;
                    $temparray['user_ids'] = $si_contract->user_ids;
                    $temparray['full_availability_commission'] = $si_contract->full_availability_commission;
                    $temparray['partial_availability_commission'] = $si_contract->partial_availability_commission;
                    $temparray['is_required'] = true;
                     $temparray['is_agree'] = true;
                    if(isset($si_contract->sort_num)){ $temparray['sort_num'] = (int) $si_contract->sort_num; }
                    $temparray['is_commission_set'] = 1;
                    $temparray['commission_type'] = $si_contract->commission_type;
                    $temparray['status'] = 1;
                    $temparray['accepted_by'] = $uid;
                    $temparray['created_by'] = $uid;
                    $temparray['created_on'] = date('Y-m-d H:i:s');
                    
                    //$contractsAccepted[] = $temparray;
                //}
                if(in_array($si_contract->contract_id, $resetuserContractIds)){
                    $updateContractsAccepted['updatedarray'] = $temparray;
                    $updateContractsAccepted['id'] = (array_keys($resetuserContractIds, $si_contract->contract_id));
                    $update_array[] = $updateContractsAccepted;
                }else{
                    $contractsAccepted[] = $temparray;
                }
            }
            
            if(count($contractsAccepted) > 0){ \DB::table('tb_users_contracts')->insert($contractsAccepted); }
            if(count($update_array) > 0){
                foreach($update_array as $item){
                    \DB::table('tb_users_contracts')->where('id', $item['id'])->update($item['updatedarray']);
                }
            }
            //End
        }
    }
    
    static function submit_sign_up_contract($contracts){
        if(\Auth::check()){
            $uid = \Auth::user()->id;
            $contractsAccepted = array();
            
            $update_array = array();
            //insert contracts
            $usersContracts = \DB::table('tb_users_contracts')->select('tb_users_contracts.id','tb_users_contracts.contract_id')->where('tb_users_contracts.accepted_by', \Auth::user()->id)->where('tb_users_contracts.contract_type','sign-up')->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)->orderBy('tb_users_contracts.contract_id','DESC')->get();
            $resetuserContract = array();
            $resetuserContractIds = array();
            foreach($usersContracts as $si_usersContract){
                $resetuserContract[$si_usersContract->contract_id] = $si_usersContract->id;
                $resetuserContractIds[$si_usersContract->id] = $si_usersContract->contract_id;                
            }
            //print_r($resetuserContractIds); die;
            foreach($contracts as $si_contract){
                //if(!isset($resetuserContract[$si_contract->contract_id])){
                    $temparray = array();
                    $temparray['contract_id'] = $si_contract->contract_id;
                    $temparray['title'] = $si_contract->title;
                    $temparray['description'] = $si_contract->description;
                    $temparray['contract_type'] = $si_contract->contract_type;
                    $temparray['package_ids'] = $si_contract->package_ids;
                    $temparray['hotel_ids'] = $si_contract->hotel_ids;
                    $temparray['event_ids'] = $si_contract->event_ids;
                    $temparray['user_group_ids'] = $si_contract->user_group_ids;
                    $temparray['user_ids'] = $si_contract->user_ids;
                    if(isset($si_contract->is_required)){ $temparray['is_required'] = (bool) $si_contract->is_required; }
                    if(isset($si_contract->is_agree)){ $temparray['is_agree'] = (bool) $si_contract->is_agree; }
                    if(isset($si_contract->sort_num)){ $temparray['sort_num'] = (int) $si_contract->sort_num; }
                    $temparray['status'] = 1;
                    $temparray['accepted_by'] = $uid;
                    $temparray['created_by'] = $uid;
                    $temparray['created_on'] = date('Y-m-d H:i:s');
                    
                    //$contractsAccepted[] = $temparray;
                //}
                if(in_array($si_contract->contract_id, $resetuserContractIds)){
                    $updateContractsAccepted['updatedarray'] = $temparray;
                    $updateContractsAccepted['id'] = (array_keys($resetuserContractIds, $si_contract->contract_id));
                    $update_array[] = $updateContractsAccepted;
                }else{
                    $contractsAccepted[] = $temparray;
                }
            }
            
            if(count($contractsAccepted) > 0){ \DB::table('tb_users_contracts')->insert($contractsAccepted); }
            if(count($update_array) > 0){
                foreach($update_array as $item){
                    \DB::table('tb_users_contracts')->where('id', $item['id'])->update($item['updatedarray']);
                }
            }
            //End
        }
    }
    
    static function get_default_contracts($type="all",$fields="default",$gid=0,$ids=array()){
        $gid = (int) $gid;
        /*$package_id = (int) $package_id;
        $package_id = (($package_id > 0)?$package_id:0); 
        $hotel_id = (int) $hotel_id;
        $hotel_id = (($hotel_id > 0)?$hotel_id:0); 
        $event_id = (int) $event_id;
        $event_id = (($event_id > 0)?$event_id:0); */
        $type = strtolower(trim($type));
        $type = str_replace(' ','-',$type);
        
        $uid = 0;
        $groupId = (($gid > 0)?$gid:0);        
        if(\Auth::check()){
            $uid = \Auth::user()->id;
            $groupId = \Auth::user()->group_id;            
        }
        
        $fdata = array();
        $is_default = false;
        if($fields == 'default'){ $is_default = true; $fields = array('tb_contracts.contract_id','tb_contracts.title','tb_contracts.description','tb_contracts.contract_type','tb_contracts.is_required','tb_contracts.sort_num');}
        
        switch($type){
            case 'general':
                
            break;
            
            case 'sign-up':                
                //get specific group wise contracts
                $rdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type);
                if($groupId > 0){ $rdata = $rdata->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId); }else{ $rdata->where('tb_contracts.user_group_ids','all'); }
                $rdata = $rdata->orderBy('tb_contracts.contract_id','DESC')->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->get();                
                foreach($rdata as $rval){
                    $fdata[$rval->contract_id] = $rval;
                }
                //End
                
                //get common contracts
                $adata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)->where('tb_contracts.user_group_ids','all')->orderBy('tb_contracts.contract_id','DESC')->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->get();
                foreach($adata as $aval){
                    $fdata[$aval->contract_id] = $aval;
                }
                //End
            break;
            
            case 'packages':
                $tdata = array();
                if($is_default === true){ $fields[] = 'tb_contracts.package_ids';}
                //get specific group wise contracts
                if(count($ids) > 0){
                    $rdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_packages_ref','tb_contracts.contract_id','=','tb_contracts_packages_ref.contract_id')->whereIn('tb_contracts_packages_ref.package_id',$ids)
                                ->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();                
                    foreach($rdata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                    
                    if($groupId > 0){
                        $gdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                    ->join('tb_contracts_packages_ref','tb_contracts.contract_id','=','tb_contracts_packages_ref.contract_id')->whereIn('tb_contracts_packages_ref.package_id',$ids)
                                    ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                                    ->where('tb_contracts.user_ids','all')
                                    ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();                
                        foreach($gdata as $rval){
                            $tdata[$rval->contract_id] = $rval;
                        }
                    }
                        
                    
                    if($uid > 0){
                        $udata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                    ->join('tb_contracts_packages_ref','tb_contracts.contract_id','=','tb_contracts_packages_ref.contract_id')->whereIn('tb_contracts_packages_ref.package_id',$ids)
                                    ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                                    ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();                
                        foreach($udata as $rval){
                            $tdata[$rval->contract_id] = $rval;
                        }
                    }                        
                }                    
                //End
                
                //get common contracts
                $adata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)->where('tb_contracts.package_ids','all')->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->orderBy('tb_contracts.contract_id','DESC')->get();
                foreach($adata as $aval){
                    $tdata[$aval->contract_id] = $aval;
                }
                
                if($groupId > 0){
                    $gdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                                ->where('tb_contracts.package_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();                
                    foreach($gdata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                }
                    
                
                if($uid > 0){
                    $udata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                                ->where('tb_contracts.package_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();                
                    foreach($udata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                } 
                //End
                
                $common_contracts = array();
                $package_contracts = array();
                foreach($tdata as $si_ccontract){
                    $package_ids = $si_ccontract->package_ids;
                    
                    if($package_ids == 'all'){
                        $common_contracts[] = $si_ccontract;
                    }else if(strlen(trim($package_ids)) > 0){
                        $explode_arr = explode(',',trim($package_ids));
                        foreach($explode_arr as $si_packageid){
                            if(!isset($package_contracts[$si_packageid])){ $package_contracts[$si_packageid] = array(); }
                            $package_contracts[$si_packageid][] = $si_ccontract;
                        }
                    }
                }
                
                $fdata = array("common"=>$common_contracts,"packages_wise"=>$package_contracts);
            break;
            
            case 'hotels':
                $tdata = array();
                if($is_default === true){ $fields[] = 'tb_contracts.hotel_ids'; }
                
                if(count($ids) > 0){                    
                    //get contracts for common user groups and users
                    $specifchoteldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                                ->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($specifchoteldata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                    //End
                    
                    //get contracts for specific user group and all users
                    $specGroupdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                                ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                                ->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($specGroupdata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                    //End
                    
                    //get contracts for specific user
                    $spuserdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                            ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($spuserdata as $rval){
                        $tdata[$rval->contract_id] = $rval;
                    }
                    //End
                }
                
                $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                            ->where('tb_contracts.hotel_ids','all')
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                foreach($alldata as $rval){
                    $tdata[$rval->contract_id] = $rval;
                }
                
                $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                            ->where('tb_contracts.hotel_ids','all')->where('tb_contracts.user_ids','all')
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                foreach($alldata as $rval){
                    $tdata[$rval->contract_id] = $rval;
                }
                
                $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->where('tb_contracts.hotel_ids','all')->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                foreach($alldata as $rval){
                    $tdata[$rval->contract_id] = $rval;
                }
                
                $common_contracts = array();
                $hotel_contracts = array();
                foreach($tdata as $si_ccontract){
                    $hotel_ids = $si_ccontract->hotel_ids;
                    
                    if($hotel_ids == 'all'){
                        $common_contracts[] = $si_ccontract;
                    }else if(strlen(trim($hotel_ids)) > 0){
                        $explode_arr = explode(',',trim($hotel_ids));
                        foreach($explode_arr as $si_hotelid){
                            if(!isset($hotel_contracts[$si_hotelid])){ $hotel_contracts[$si_hotelid] = array(); }
                            $hotel_contracts[$si_hotelid][] = $si_ccontract;
                        }
                    }
                }
                
                $fdata = array("common"=>$common_contracts,"hotels_wise"=>$hotel_contracts);
            break;
            
            case 'commission':
                $tdata = array();
                if($is_default === true){ $fields[] = 'tb_contracts.hotel_ids'; $fields[] = 'tb_contracts.full_availability_commission'; $fields[] = 'tb_contracts.partial_availability_commission'; }
                //check if commission contrat available for specific user
                if(count($ids) > 0){                    
                    //get contracts for common user groups and users
                    $specifchoteldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                                ->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($specifchoteldata as $si_hcontract){
                        $hotel_ids = $si_hcontract->hotel_ids;
                        if(strlen(trim($hotel_ids)) > 0){
                            $explode_arr = explode(',',trim($hotel_ids));
                            foreach($explode_arr as $is_a){
                                $tdata[$is_a] = $si_hcontract;
                            }
                        }
                    }
                    //End
                    
                    //get contracts for specific user group and all users
                    $specGroupdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                                ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                                ->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($specGroupdata as $si_hcontract){
                        $hotel_ids = $si_hcontract->hotel_ids;
                        if(strlen(trim($hotel_ids)) > 0){
                            $explode_arr = explode(',',trim($hotel_ids));
                            foreach($explode_arr as $is_a){
                                $tdata[$is_a] = $si_hcontract;
                            }
                        }
                    }
                    //End
                    
                    //get contracts for specific user
                    $spuserdata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_hotels_ref','tb_contracts.contract_id','=','tb_contracts_hotels_ref.contract_id')->whereIn('tb_contracts_hotels_ref.hotel_id',$ids)
                            ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->get();
                    foreach($spuserdata as $si_hcontract){
                        $hotel_ids = $si_hcontract->hotel_ids;
                        if(strlen(trim($hotel_ids)) > 0){
                            $explode_arr = explode(',',trim($hotel_ids));
                            foreach($explode_arr as $is_a){
                                $tdata[$is_a] = $si_hcontract;
                            }
                        }
                    }
                    //End
                }
                
                $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_users_ref','tb_contracts.contract_id','=','tb_contracts_users_ref.contract_id')->where('tb_contracts_users_ref.user_id',$uid)
                            ->where('tb_contracts.hotel_ids','all')
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->first();
                
                if(!isset($alldata->contract_id)){
                    $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                            ->join('tb_contracts_user_groups_ref','tb_contracts.contract_id','=','tb_contracts_user_groups_ref.contract_id')->where('tb_contracts_user_groups_ref.group_id',$groupId)
                            ->where('tb_contracts.hotel_ids','all')->where('tb_contracts.user_ids','all')
                            ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->first();
                }
                
                if(!isset($alldata->contract_id)){
                    $alldata  = \DB::table('tb_contracts')->select($fields)->where('tb_contracts.contract_type',$type)
                                ->where('tb_contracts.hotel_ids','all')->where('tb_contracts.user_group_ids','all')->where('tb_contracts.user_ids','all')
                                ->where('tb_contracts.status',1)->where('tb_contracts.deleted',0)->groupBy('tb_contracts.contract_id')->orderBy('tb_contracts.contract_id','DESC')->first();
                }   
                //End
                
                $fdata = array("common"=>((isset($alldata->contract_id))?$alldata:array()),"hotels_wise"=>$tdata);
            break;
            
            case 'events':
            
            break;
            
            default:
                                
            break;
        }
        
        //echo "<pre>";print_r($fdata); die;
        
        return $fdata;
    }
    
    static function url_title($str, $separator = '-', $lowercase = FALSE)
    {
        if ($separator == 'dash') 
        {
            $separator = '-';
        }
        else if ($separator == 'underscore')
        {
            $separator = '_';
        }
    
        $q_separator = preg_quote($separator);
    
        $trans = array(
            '&.+?;'                 => '',
            '[^a-z0-9 _-]'          => '',
            '\s+'                   => $separator,
            '('.$q_separator.')+'   => $separator
        );
    
        $str = strip_tags($str);
    
        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }
    
        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }
    
        return trim($str, $separator);
    }

    // check user type
    static function getusertype($postData){
        
        $type = ((is_int($postData))?'int':((is_string($postData))?'string':''));
        
        $rtype = false;
        
        if(!defined('RUSER_GROUPS')){
            $rgroups  = \DB::table('tb_groups')->select('group_id','name','level')->get();
            $tarra = array(); 
            foreach($rgroups as $si_group){
                $group_id = (int) $si_group->group_id;
                $group_name = self::url_title(trim($si_group->name),'-',true);
                
                $tarra[$group_name] = $group_id;
            }   
            
            define('RUSER_GROUPS',$tarra);
        }        
                
        $users = RUSER_GROUPS;
        
        if($type == 'string'){            
            if(isset($users[$postData])){ $rtype = $users[$postData]; }
        }elseif($type == 'int')
        {
            $postData = (int) $postData;
            $rtype = array_search($postData, $users);
        }
        
        return $rtype;
    }
    //End
    
    //is user metronic dashboard
    static function isHotelDashBoard($g_id=0){
        $g_id = (int) $g_id;
        $group_id = (int) (($g_id > 0)?$g_id:\Auth::user()->group_id);
        $user = self::getusertype($group_id);
        $return = "";
        if($user=="hotel-b2b"){
            $match_array = array('hotel-b2b');
            if(in_array($user,$match_array)){ $return = 'users_admin.metronic'; }
        }else if($user=="users-b2c"){
            $return = 'users_admin.traveller';
        }
        return $return;
    }
    //end
    
    //is user metronic dashboard
    static function check_membership_package($u_id=0){
        $u_id = (int) $u_id;
        $g_id = \Auth::user()->group_id;
        
        $g_id = (int) $g_id;
        $group_id = (int) (($g_id > 0)?$g_id:\Auth::user()->group_id);
        $user = self::getusertype($group_id);
        $match_array = array('hotel-b2b');
        $return = "";
        $red_url = '';
        if(in_array($user,$match_array)){ 
            $obj_hotel  = \DB::table('tb_properties')->where('user_id', $u_id)->first();
            
            if(!empty($obj_hotel)){ 
                if(isset($obj_hotel->approved)){ 
                    if($obj_hotel->approved==0){ 
                        $red_url = 'whoiam';
                    }else{ 
                        $obj_order  = \DB::table('tb_orders')->where('user_id', $u_id)->get();
                        //print_r($obj_order); die;
                        if(count($obj_order) > 0){
                            foreach($obj_order as $order){
                                if($order->status=="Success"){
                                    $red_url = '';
                                    break;
                                }else{
                                    $red_url = 'hotel/package';
                                }
                            }
                        }else{                        
                            $red_url = 'hotel/package';
                        }
                    }
                }else{
                    $red_url = 'whoiam';
                }
            }else{
                $red_url = 'whoiam';
            }            
        } 
        return $red_url;
        
    }
    //end
    
    //Return All images path of Property
    static function getInfo(){

    	$data = array();
		\Session::put('lang', 'en');
        $getlang = \Session::get('newlang');
        $arrive_date = \Session::get('arrive_date');
        $destination_date = \Session::get('destination_date');
        $adults = \Session::get('adults');
        $childs = \Session::get('childs');
        $data['arrive_date'] = $data['destination_date'] = $data['childs'] = $data['adults'] = '';
        if (!isset($getlang)) {
            \Session::put('newlang', 'English');
        } else {
            \Session::put('lang', $getlang);
        }
        if (isset($arrive_date)) {
            $data['arrive_date'] = $arrive_date;
        }
        if (isset($destination_date)) {
            $data['destination_date'] = $destination_date;
        }
        if (isset($adults)) {
            $data['adults'] = $adults;
        }
        if (isset($childs)) {
            $data['childs'] = $childs;
        }
        $invoice_num = \DB::table('tb_settings')->where('key_value', 'default_tax_amount')->first();
        $data['vatsettings']=$invoice_num;
        $data['footer_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'footer_text')->first();
        $data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
    	$data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
    	return $data;
    }

    static function getAboutInfo(){

        $data = array();
        $data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
        return $data;
    }
	
	static function getUspMod(){

        $data = array();
        $data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
        return $data;
    }
	
	static function getSidebarAds($pos='landing', $cat_id = 'Hotel'){

        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_title', 'adv_desc', 'adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->get();
        return $data;
    }
	
	static function getSliderAds($pos='landing', $cat_id = 'Hotel'){

        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_title', 'adv_desc', 'adv_img', 'adv_link')->where('adv_type', 'slider')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->get();
        return $data;
    }
	
	static function getGridResultAds($pos, $cat_id = 'Hotel'){

        $data = array();
        $data['resultads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link', 'adv_title')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->orderByRaw('RAND()')->first();
        return $data;
    }
	
	static function getDetailpageSidebarAds($pos, $cat_ids){
		$cats = explode(',', $cat_ids);
        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->whereIn('ads_cat_id', $cats)->get();
        return $data;
    }

    static function calc_price($actprice,$actdays,$customdays){
		if($actprice>0 && $actdays > 0 && $customdays > 0)
		{
			$calcperunit = $actprice / $actdays;
			$calcallunit = $calcperunit * $customdays;
			return number_format($calcallunit,2,'.','');
		}
	}



      static function getCurrencyList(){

                        $currency_symbols = array(
                            'AED' => '&#1583;.&#1573;', // ?
                            'AFN' => '&#65;&#102;',
                            'ALL' => '&#76;&#101;&#107;',
                            'AMD' => '',
                            'ANG' => '&#402;',
                            'AOA' => '&#75;&#122;', // ?
                            'ARS' => '&#36;',
                            'AUD' => '&#36;',
                            'AWG' => '&#402;',
                            'AZN' => '&#1084;&#1072;&#1085;',
                            'BAM' => '&#75;&#77;',
                            'BBD' => '&#36;',
                            'BDT' => '&#2547;', // ?
                            'BGN' => '&#1083;&#1074;',
                            'BHD' => '.&#1583;.&#1576;', // ?
                            'BIF' => '&#70;&#66;&#117;', // ?
                            'BMD' => '&#36;',
                            'BND' => '&#36;',
                            'BOB' => '&#36;&#98;',
                            'BRL' => '&#82;&#36;',
                            'BSD' => '&#36;',
                            'BTN' => '&#78;&#117;&#46;', // ?
                            'BWP' => '&#80;',
                            'BYR' => '&#112;&#46;',
                            'BZD' => '&#66;&#90;&#36;',
                            'CAD' => '&#36;',
                            'CDF' => '&#70;&#67;',
                            'CHF' => '&#67;&#72;&#70;',
                            'CLF' => '', // ?
                            'CLP' => '&#36;',
                            'CNY' => '&#165;',
                            'COP' => '&#36;',
                            'CRC' => '&#8353;',
                            'CUP' => '&#8396;',
                            'CVE' => '&#36;', // ?
                            'CZK' => '&#75;&#269;',
                            'DJF' => '&#70;&#100;&#106;', // ?
                            'DKK' => '&#107;&#114;',
                            'DOP' => '&#82;&#68;&#36;',
                            'DZD' => '&#1583;&#1580;', // ?
                            'EGP' => '&#163;',
                            'ETB' => '&#66;&#114;',
                            'EUR' => '&#8364;',
                            'FJD' => '&#36;',
                            'FKP' => '&#163;',
                            'GBP' => '&#163;',
                            'GEL' => '&#4314;', // ?
                            'GHS' => '&#162;',
                            'GIP' => '&#163;',
                            'GMD' => '&#68;', // ?
                            'GNF' => '&#70;&#71;', // ?
                            'GTQ' => '&#81;',
                            'GYD' => '&#36;',
                            'HKD' => '&#36;',
                            'HNL' => '&#76;',
                            'HRK' => '&#107;&#110;',
                            'HTG' => '&#71;', // ?
                            'HUF' => '&#70;&#116;',
                            'IDR' => '&#82;&#112;',
                            'ILS' => '&#8362;',
                            'INR' => '&#8377;',
                            'IQD' => '&#1593;.&#1583;', // ?
                            'IRR' => '&#65020;',
                            'ISK' => '&#107;&#114;',
                            'JEP' => '&#163;',
                            'JMD' => '&#74;&#36;',
                            'JOD' => '&#74;&#68;', // ?
                            'JPY' => '&#165;',
                            'KES' => '&#75;&#83;&#104;', // ?
                            'KGS' => '&#1083;&#1074;',
                            'KHR' => '&#6107;',
                            'KMF' => '&#67;&#70;', // ?
                            'KPW' => '&#8361;',
                            'KRW' => '&#8361;',
                            'KWD' => '&#1583;.&#1603;', // ?
                            'KYD' => '&#36;',
                            'KZT' => '&#1083;&#1074;',
                            'LAK' => '&#8365;',
                            'LBP' => '&#163;',
                            'LKR' => '&#8360;',
                            'LRD' => '&#36;',
                            'LSL' => '&#76;', // ?
                            'LTL' => '&#76;&#116;',
                            'LVL' => '&#76;&#115;',
                            'LYD' => '&#1604;.&#1583;', // ?
                            'MAD' => '&#1583;.&#1605;.', //?
                            'MDL' => '&#76;',
                            'MGA' => '&#65;&#114;', // ?
                            'MKD' => '&#1076;&#1077;&#1085;',
                            'MMK' => '&#75;',
                            'MNT' => '&#8366;',
                            'MOP' => '&#77;&#79;&#80;&#36;', // ?
                            'MRO' => '&#85;&#77;', // ?
                            'MUR' => '&#8360;', // ?
                            'MVR' => '.&#1923;', // ?
                            'MWK' => '&#77;&#75;',
                            'MXN' => '&#36;',
                            'MYR' => '&#82;&#77;',
                            'MZN' => '&#77;&#84;',
                            'NAD' => '&#36;',
                            'NGN' => '&#8358;',
                            'NIO' => '&#67;&#36;',
                            'NOK' => '&#107;&#114;',
                            'NPR' => '&#8360;',
                            'NZD' => '&#36;',
                            'OMR' => '&#65020;',
                            'PAB' => '&#66;&#47;&#46;',
                            'PEN' => '&#83;&#47;&#46;',
                            'PGK' => '&#75;', // ?
                            'PHP' => '&#8369;',
                            'PKR' => '&#8360;',
                            'PLN' => '&#122;&#322;',
                            'PYG' => '&#71;&#115;',
                            'QAR' => '&#65020;',
                            'RON' => '&#108;&#101;&#105;',
                            'RSD' => '&#1044;&#1080;&#1085;&#46;',
                            'RUB' => '&#1088;&#1091;&#1073;',
                            'RWF' => '&#1585;.&#1587;',
                            'SAR' => '&#65020;',
                            'SBD' => '&#36;',
                            'SCR' => '&#8360;',
                            'SDG' => '&#163;', // ?
                            'SEK' => '&#107;&#114;',
                            'SGD' => '&#36;',
                            'SHP' => '&#163;',
                            'SLL' => '&#76;&#101;', // ?
                            'SOS' => '&#83;',
                            'SRD' => '&#36;',
                            'STD' => '&#68;&#98;', // ?
                            'SVC' => '&#36;',
                            'SYP' => '&#163;',
                            'SZL' => '&#76;', // ?
                            'THB' => '&#3647;',
                            'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
                            'TMT' => '&#109;',
                            'TND' => '&#1583;.&#1578;',
                            'TOP' => '&#84;&#36;',
                            'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
                            'TTD' => '&#36;',
                            'TWD' => '&#78;&#84;&#36;',
                            'TZS' => '',
                            'UAH' => '&#8372;',
                            'UGX' => '&#85;&#83;&#104;',
                            'USD' => '&#36;',
                            'UYU' => '&#36;&#85;',
                            'UZS' => '&#1083;&#1074;',
                            'VEF' => '&#66;&#115;',
                            'VND' => '&#8363;',
                            'VUV' => '&#86;&#84;',
                            'WST' => '&#87;&#83;&#36;',
                            'XAF' => '&#70;&#67;&#70;&#65;',
                            'XCD' => '&#36;',
                            'XDR' => '',
                            'XOF' => '',
                            'XPF' => '&#70;',
                            'YER' => '&#65020;',
                            'ZAR' => '&#82;',
                            'ZMK' => '&#90;&#75;', // ?
                            'ZWL' => '&#90;&#36;',
                            'BTC'=>'',
                            'BYN'=>'',
                            'CNH'=>'',
                            'CUC'=>'',
                            'ERN'=>'',
                            'GGP'=>'',
                            'IMP'=>'', 
                            'MRU'=>'',
                            'SSP'=>'',
                            'STN'=>'', 
                            'XAG'=>'', 
                            'XAU'=>'',
                            'XPD'=>'', 
                            'XPT'=>'',  
                            'ZMW'=>'', 

                        );
$allowedCurrenciesinProject=array("OMR","BHD","KWD","USD","CHF","EUR","KYD","GIP","GBP","JOD","FJD","AWG","AM","BGN","NZD","LYD","SGD","BND","AUD","CAD","INR");

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://openexchangerates.org/api/currencies.json?app_id=635960bf627e404fa235281f10de6aa9",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $returnCurrenyList=array();
                    $currencyList=json_decode($response);
                foreach($allowedCurrenciesinProject as $currencyCodeAllowed){
                    foreach($currencyList as $currencyCode => $currencyName){
                            if($currencyCodeAllowed==$currencyCode){

                                $returnCurrenyList[$currencyCode]=$currencyCode."-".$currency_symbols[$currencyCode];
                            }

                        }
                     }
                     
                     return (json_decode(json_encode($returnCurrenyList)));
                }
       
    }



 static function convertPriceFromCurrency($fromCurrencyCode="EUR", $toCurrencyCode="USD", $amount=1){

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.fixer.io/latest?base=".$fromCurrencyCode,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $currencyPriceList=array();
                    $currencyPrice=json_decode($response);

            }




            if($fromCurrencyCode!=""  && $toCurrencyCode !="" && $amount > 0)
            {
                


            if($toCurrencyCode!="EUR"){

                $calcperunit = $currencyPrice->rates->$toCurrencyCode;
                $calFinalPrice = $calcperunit * $amount;
                return number_format($calFinalPrice,2,'.','');
            }else{

                 return number_format($amount,2,'.','');
            }


               
            }
    }

    static function getcontractPDFHeader($center_content){
        
        $contract_logo = \DB::table('tb_settings')->where('key_value', 'contract_logo')->first();
        $contract_company = \DB::table('tb_settings')->where('key_value', 'contract_company')->first();
		$contract_title1 = \DB::table('tb_settings')->where('key_value', 'contract_title1')->first();
		$contract_title2 = \DB::table('tb_settings')->where('key_value', 'contract_title2')->first();
		$contract_title3 = \DB::table('tb_settings')->where('key_value', 'contract_title3')->first();
        $contract_paragraph = \DB::table('tb_settings')->where('key_value', 'contract_paragraph')->first(); 
        
        $obj_hotel = \DB::table('tb_properties')->where('assigned_user_id', \Session::get('uid'))->first();
        
        $p_content = '';
        if(!empty($contract_paragraph->content)){
            $p_content = $contract_paragraph->content;
            $string_array_replace = array(                    
                '{hotel_name}'=>(isset($obj_hotel->property_name) ? $obj_hotel->property_name : ''),
                '{company_name}'=>$contract_company->content,
            );
            foreach($string_array_replace as $key => $value){                    
                $str_replaced = str_replace($key, $value, $p_content);
                $p_content = $str_replaced;
            }       
        }    
        
        $cont_logo = '';        
        if($contract_logo->content!=''){
            if(file_exists(public_path().'/sximo/images/'.$contract_logo->content)){
                $cont_logo = \URL::to('/sximo/images/'.$contract_logo->content);
            }else{
                $cont_logo =  \URL::to('sximo/assets/images/logo-design_1.png');
            }     
        }else{
                $cont_logo =  \URL::to('sximo/assets/images/logo-design_1.png');
        }  
        
        $contract_block1 = \DB::table('tb_settings')->where('key_value', 'contract_block1')->first();
        $contract_block2 = \DB::table('tb_settings')->where('key_value', 'contract_block2')->first();
		$contract_block3 = \DB::table('tb_settings')->where('key_value', 'contract_block3')->first();       
                                
        $html = '<style> 
						.main { margin:2px; width:100%; font-family: Poppins, sans-serif; } 
						.page-break { page-break-after: always; } 
						.tb_page_break{ page-break-before: always; }
						.header{ position: fixed; width: 100%; top: 0px; height:250px; background: #fff;} 
                        .footer{ position: fixed; bottom: 100px; left: 0px; right: 0px; height: 100px; background: #fff; }
						.footer .page-number:after { content: counter(page); }
						.pagenum:after {content: counter(page);} 
						.imgBox { text-align:center; width:400px; } 
						.nro { text-align:center; font-size:12px; } 
						.header img { height: 100px; margin-bottom: 20px; } 
                        .Mrgtop200 {margin-top:280px;} 
						.Mrgtop80 {margin-top:80px;} 
						.Mrgtop40 {margin-top:40px;}
						.Mrgtop20 {margin-top:10px;} 
						.monimg img { width:125px; height:80px; }  
						.font13 { font-size:13px; } 
						.font12 { font-size:12px; } 
						.algRgt { text-align:right; } 
						.algCnt { text-align:center; } 
						
						.pagenum:after {content: counter(page);}
						.title {text-align:right; width:100%; font-size:30px; font-weight:bold;}
                        .title1 {width:100%; font-size:16px; font-weight:bold;} 
						.clrgrey{ color:#3f3f3f;} 
						.alnRight{text-align:right;} 
						.alnCenter{text-align:center;} 
						td{font-size:12px; padding:1px;} 
						th{background-color:#999; color:#000000; text-align:left; padding:1px; font-size:14px;}
						.totl{background-color:#999; color:#000000; font-weight:bold;} 
						h2{padding-bottom:0px; margin-bottom:0px;} 
						.valin{ vertical-align:top;} 
						.valinbt{ vertical-align:bottom; text-align:right;}
                        .footer-font-size{ font-size:9px; }
						.page {
						  background: white;
						  display: block;
						  margin: 0 auto;
						  margin-bottom: 0.5cm;
						  
						}
						.tablewc{
						  width: 50%; 
                          margin: 0px auto;
                        }
                        .tr_vertical_align{
                            vertical-align: top;    
                        }
						@media print {
						  body, page {
						    margin: 0;
						    box-shadow: 0;
						  }
						}
                        .underline{
                            border-bottom:1px solid #ccc;
                            font-size:14px;                            
                        }
                        .fnt15{
                            font-size:15px;
                         }   
                        .strong{
                            font-weight:bold;
                            width:150px;
                            font-size:14px;
                            text-align:right;
                            margin-right:5px;                                                                                    
                         }
                         table{
                            border-collapse:separate; 
                            border-spacing: 0 0.5em;                            
                          }  
                          label {
                            display: block;
                            padding-left: 20px;
                            text-indent: -15px;
                            font-size:14px;                            
                        }
                        input {
                            width: 13px;
                            height: 13px;
                            padding: 0;
                            margin:0;
                            top:-1px;                            
                            position: relative;
                            *overflow: hidden;
                        }                                                      
                        .center_content br {
                            content: "";
                            margin: 2em;
                            display: block;
                            font-size: 36%;
                        }
				</style>';
        
        $html .= '
            <div class="main">
                <div class="header"> 
                    <table width="100%">
                        <tr>  
    						<td>    						    
    							<center><img src="'.$cont_logo.'" height="100px;"></center>  				 	 
    						</td>
    					 </tr>
                         <tr>
    						<td class="title1" align="center">
    							<center>'.$contract_title1->content.'</center>
    						</td>
    					 </tr>
                         <tr>
    						<td class="title1" align="center">
    							<center>'.$contract_title2->content.'</center>
    						</td>
    					 </tr>
                         <tr>
    						<td align="left">
    							'.$p_content.'
    						</td>
    					 </tr>
                         <tr>
    						<td class="title1" align="center">
    							<center>'.$contract_title3->content.'</center>
    						</td>
    					 </tr>                                                                                                       
                    </table>
                </div>  
                
                <div style="clear:both;"> &nbsp;</div>
                <div class="center_content">
                '.nl2br($center_content).'
                </div>
                <div style="clear:both;"> &nbsp;</div>
                <div class="footer"> 
                    <table width="100%" class="Mrgtop40">  
                                          
                        <tr class="tr_vertical_align">  
    						<td width="40%" class="footer-font-size">    						    
    						  '.nl2br($contract_block1->content).'	   				 	 
    						</td>
                            <td width="30%" class="footer-font-size">    						    
    						  '.nl2br($contract_block2->content).'	   				 	 
    						</td>
                            <td width="30%" class="footer-font-size">    						    
    						  '.nl2br($contract_block3->content).'	   				 	 
    						</td>
    					 </tr>                                                                                        
                    </table> 
                </div>
            </div>
        ';
        //echo $html; die;    
        return $html;
    }

}
