<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use App\Models\Contract;
use App\Models\Acceptedcontract;
use App\Models\Contractsevents;
use App\Models\Contractshotels;
use App\Models\Contractspackages;
use App\Models\Contractsusergroups;
use App\Models\Contractsusers;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator,
    Input,
    Redirect;

class ContractController extends Controller {

    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'contract';
    static $per_page = '10';

    public function __construct() {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->model = new Contract();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'contract',
            'return' => self::returnUrl()
        );
    }

    public function getIndex(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'sort_num');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'desc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');


        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('contract');

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        $this->data['radtotalRecords'] = $results['total'];
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        $this->data['curr_page'] = $page;
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template
        return view('contract.index', $this->data);
    }
    
    private function setAcceptedContractGrid(){
        $returnCOnt = array();
        
        $returnCOnt[] = array("field"=>"id","alias"=>"tb_users_contracts","language"=>array(),"label"=>"ID","view"=>0,"detail"=>1,"sortable"=>1,"search"=>1,"download"=>1,"frozen"=>1,"limited"=>"","width"=>100,"align"=>"left","sortlist"=>1);
        $returnCOnt[] = array("field"=>"title","alias"=>"tb_users_contracts","language"=>array(),"label"=>"Title","view"=>1,"detail"=>1,"sortable"=>1,"search"=>1,"download"=>1,"frozen"=>1,"limited"=>"","width"=>100,"align"=>"left","sortlist"=>2);
        $returnCOnt[] = array("field"=>"contract_type","alias"=>"tb_users_contracts","language"=>array(),"label"=>"Type","view"=>1,"detail"=>1,"sortable"=>1,"search"=>1,"download"=>1,"frozen"=>1,"limited"=>"","width"=>100,"align"=>"left","sortlist"=>3);
        $returnCOnt[] = array("field"=>"commission_type","alias"=>"tb_users_contracts","language"=>array(),"label"=>"Commission Type","view"=>1,"detail"=>1,"sortable"=>1,"search"=>1,"download"=>1,"frozen"=>1,"limited"=>"","width"=>100,"align"=>"left","sortlist"=>4);
        
        return $returnCOnt;
    }
    
    public function getAcceptedcontracts(Request $request){
        if(!(\Auth::check())){
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }
        
        $uid = \Auth::user()->id;
        $acceptedcontractsmodel = new Acceptedcontract();
        
        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
        
        if(\Session::get('gid')!=1 && \Session::get('gid')!=2){
                $filter .= " AND ((accepted_by = '".$uid."'))" ;

        }

        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $acceptedcontractsmodel->getRows($params,true);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('contract/acceptedcontracts');

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        $this->data['tableGrid'] = $this->setAcceptedContractGrid();
        
        $is_demo6 = trim(\CommonHelper::isHotelDashBoard());
        if(strlen($is_demo6) > 0){
            $file_name = $is_demo6.'.contracts.accepted';
            return view($file_name,$this->data);
        }else{
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }
    }
    
    public function replace_tags($string){
        $string_array_replace = array(
                    '{current_date}'=>$date_signed,
        );
        foreach($string_array_replace as $key => $key){
            str_replace($key, $key, $string);
        }
        return $string;
    }
    
    public function download_signup_contract($isview='download'){ 
        $viewPDF = (($isview == 'view')?true:false);
        $downFileName = 'contract-signup-'.date('d-m-Y').'.pdf';
        $selectFields = array('tb_users_contracts.*','tb_users.first_name','tb_users.last_name','tb_users_contracts.contract_type','tb_users_contracts.commission_type','tb_users_contracts.partial_availability_commission','tb_users_contracts.full_availability_commission');
        $usersContracts = \DB::table('tb_users_contracts')
                            ->select($selectFields)
                            ->join('tb_users', 'tb_users_contracts.accepted_by', '=', 'tb_users.id')
                            ->where('tb_users_contracts.contract_type','sign-up')->where('tb_users_contracts.accepted_by', \Auth::user()->id)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)
                            ->orderBy('tb_users_contracts.sort_num','DESC')->get();
                            
        $CommissionContracts = \DB::table('tb_users_contracts')
                            ->select($selectFields)
                            ->join('tb_users', 'tb_users_contracts.accepted_by', '=', 'tb_users.id')
                            ->where('tb_users_contracts.contract_type','commission')->where('tb_users_contracts.accepted_by', \Auth::user()->id)->where('tb_users_contracts.status',1)->where('tb_users_contracts.is_expried',0)->where('tb_users_contracts.deleted',0)
                            ->orderBy('tb_users_contracts.sort_num','ASC')->first();
        if(isset($CommissionContracts->contract_type)){ $usersContracts[] = $CommissionContracts; }
        
        usort($usersContracts, function($a, $b) {
						return $a->sort_num - $b->sort_num; 
					});
        //$usersContracts = array_reverse($usersContracts);
        
        $center_content = '';
        $i = 1;
        $date_signed = '';
        $username = '';
        foreach($usersContracts as $si_contract){
            $username = trim(ucfirst($si_contract->first_name).' '.ucfirst($si_contract->last_name));
            $created_on = date_create($si_contract->created_on);
            $date_signed = date_format($created_on,"Y/m/d");
            if($i==1){
                $center_content .= '<div class="Mrgtop200 font13">';
            }else{
                $center_content .= '<div class="Mrgtop80 font13">';
            }
            
                $center_content .= '<h3>'.$i++.'. '.$si_contract->title.'</h3>';
                if((!empty($si_contract->commission_type)) && ($si_contract->contract_type == 'commission')){
                    $center_content .= '<p> <span class="strong">Availability: </span><span class="font14">'.ucfirst($si_contract->commission_type).'</p>';
                    $center_content .= '<p> <span class="strong">Commission (%): </span><span class="font14">';
                
                    if($si_contract->commission_type == 'partial'){
                        $center_content .= $si_contract->partial_availability_commission;
                    }
                    if($si_contract->commission_type == 'full'){
                        $center_content .= $si_contract->full_availability_commission;
                    }
                    $center_content .= '</span></p>';
                } 
                $str_desc = $si_contract->description;
                $valid_until = date('Y-m-d', strtotime('+2 years', strtotime($date_signed)));
                $valid_until_year = date('Y', strtotime($valid_until));
                $string_array_replace = array(                    
                    '{signed_date}'=>$date_signed,
                    '{valid_until}'=>$valid_until,
                    '{valid_until_year}'=>$valid_until_year,
                );
                foreach($string_array_replace as $key => $value){                    
                    $str_replaced = str_replace($key, $value, $str_desc);
                    $str_desc = $str_replaced;
                }                
                $center_content .= '<p></span><span class="font14">'.$str_desc.'</span></p>';         
            $center_content .= '</div>';
        }
        
        $contract_first_name = \DB::table('tb_settings')->where('key_value', 'contract_first_name')->first();
		$contract_last_name = \DB::table('tb_settings')->where('key_value', 'contract_last_name')->first();
        $contract_company = \DB::table('tb_settings')->where('key_value', 'contract_company')->first();
        
        $contract_full_name = '';
        if(!empty($contract_first_name->content)){
            $contract_full_name = $contract_first_name->content." ".$contract_last_name->content;
        }
        
        if((strlen($username) > 0) && (strlen($date_signed) > 0)){
            $center_content .= '<div class="Mrgtop40 font13">';
				$center_content .= '<p class="font13">I hereby agree to supply the above for entry into Emporium-Voyage</p>';
                $center_content .= '<p class="font13">General terms & conditions apply.</p>';
                $center_content .= '<table>';
                    $center_content .= '<tr><td class="strong">Signed by: </td> <td class="underline">'.$contract_full_name.'</td></tr>';    
                    $center_content .= '<tr><td class="strong">Print name: </td> <td class="underline">'.$contract_full_name.'</td></tr>';
                    $center_content .= '<tr><td class="strong">For and on behalf of: </td> <td class="underline">'.$contract_company->content.'</td></tr>';
                    $center_content .= '<tr><td class="strong">Date signed: </td> <td class="underline">'.$date_signed.'</td></tr>';
                    $center_content .= '<tr><td></td><td><img src="'. \URL::to('sximo/assets/images/checked-box.png').'" width="20px;" height="20px;"><label style="display:inline-block;text-align:left;">I agreed to the Terms stipulated in this contract</label></td></tr>';
                    $center_content .= '<tr><td class="strong">Signed by: </td> <td class="underline">'.$username.'</td></tr>';    
                    $center_content .= '<tr><td class="strong">Print name: </td> <td class="underline">'.$username.'</td></tr>';
                    $center_content .= '<tr><td class="strong">For and on behalf of: </td> <td class="underline">NA</td></tr>';
                    $center_content .= '<tr><td class="strong">Date signed: </td> <td class="underline">'.$date_signed.'</td></tr>';
                $center_content .= '</table>';
			$center_content .= '</div>';
        }
        
        $pdfHeader = \CommonHelper::getcontractPDFHeader($center_content);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4');
        $pdf->loadHTML($pdfHeader);
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        
        $canvas = $dom_pdf ->get_canvas();
        $y = $canvas->get_height() - 50;
        $canvas->page_text(30, $y, 'Page {PAGE_NUM} of {PAGE_COUNT} - Accepted', null, 10, array(0, 0, 0));
        //return $pdf->stream();
        if($viewPDF === true){ return $pdf->stream(); }else{ return $pdf->download($downFileName); }        
        //echo "<pre>".$pdfHeader;
    }
    
    public function download_contract($contractid){
        $downFileName = 'contract-order-'.date('d-m-Y').'_'.$contractid.'.pdf';
        if(!empty($contractid) && $contractid>0)
		{
    	    // Get Query
            $result = \DB::table('tb_users_contracts')
            ->join('tb_users', 'tb_users_contracts.accepted_by', '=', 'tb_users.id')
            ->where('tb_users_contracts.id', $contractid)
            ->select('tb_users_contracts.*', 'tb_users.first_name','tb_users.last_name')
            ->get();
            
            $bankdetails = \DB::table('tb_settings')->where('key_value', 'bank_details')->first();
			$regdetail = \DB::table('tb_settings')->where('key_value', 'reg_detail')->first();
			$contactdetail = \DB::table('tb_settings')->where('key_value', 'contact_detail')->first();
            
            
            if(!empty($result)){
                $hotel_name = '';
                if($result[0]->hotel_id != NULL && ($result[0]->contract_type == 'hotels' || $result[0]->contract_type == 'commission')){
                    
                    $result_hotel = \DB::table('tb_properties')->where('id', $result[0]->hotel_id)->get();
                    if(!empty($result_hotel)){
                        $hotel_name = ucfirst($result_hotel[0]->property_name);
                    }

                }
                
                $created_on = date_create($result[0]->created_on);
                $date_signed = date_format($created_on,"Y/m/d");
                
                
                $html = '<style> 
						.main { margin:2px; width:100%; font-family: arial, sans-serif; } 
						.page-break { page-break-after: always; } 
						
						.header{ width: 100%; position:fixed; top: -35px; text-align:center; height:200px;} 
						.footer {width: 100%; position:fixed;} 
						.pagenum:after {content: counter(page);} 
						.imgBox { text-align:center; width:400px; } 
						.nro { text-align:center; font-size:12px; } 
						.header img { width:250px; height: 50px; } 
						.Mrgtop80 {margin-top:80px;} 
						.Mrgtop40 {margin-top:40px;}
						.Mrgtop20 {margin-top:10px;} 
						.monimg img { width:125px; height:80px; }  
						.font13 { font-size:13px; } 
						.font12 { font-size:12px; } 
						.algRgt { text-align:right; } 
						.algCnt { text-align:center; } 
						.footer {bottom: 150px;}
						.pagenum:after {content: counter(page);}
						.title {text-align:right; width:100%; font-size:30px; font-weight:bold;} 
						.clrgrey{ color:#3f3f3f;} 
						.alnRight{text-align:right;} 
						.alnCenter{text-align:center;} 
						td{font-size:12px; padding:1px;} 
						th{background-color:#999; color:#000000; text-align:left; padding:1px; font-size:14px;}
						.totl{background-color:#999; color:#000000; font-weight:bold;} 
						h2{padding-bottom:0px; margin-bottom:0px;} 
						.valin{ vertical-align:top;} 
						.valinbt{ vertical-align:bottom; text-align:right;}
						.page {
						  background: white;
						  display: block;
						  margin: 0 auto;
						  margin-bottom: 0.5cm;
						  
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

				</style>';
                
                $html .= '
			
					
				<div class="main">
				  <div class="header">

					  <table width="100%">
					 
						 <tr>
							<td class="title" align="center">
							    
								<center><img src="'. \URL::to('sximo/assets/images/logo-design_1.png').'" width="250px;" height="50px;"></center>
								 
							</td>
						 </tr>
 							<tr>
							<td class="title" align="center">
								<center> &nbsp;</center>
							</td>
						 </tr>
					
						
					 </table>
						
				  </div>
				  <div style="clear:both;"> &nbsp;</div>
					<div class="footer">

							<table width="100%">
							<tr>
								<td colspan="3">
										<hr  style="border-top:1px solid #000;"/>
								 </td>
							 </tr>
								<tr style="border-bottom:1px solid #000;">
									<td width="33%"><h2>Bank Details</h2></td>
										<td width="33%"><h2>Company Details</h2></td>
										<td width="33%"><h2>Contact Information</h2></td>
								</tr>
							   <tr><td class="valin">';
				if(!empty($bankdetails))
				{
					$html .= nl2br($bankdetails->content);
				}
				$html .= '</td><td class="valin">';
				if(!empty($regdetail))
				{
					$html .= nl2br($regdetail->content);
				}
				$html .= '</td><td class="valin">';
				if(!empty($contactdetail))
				{
					$html .= nl2br($contactdetail->content);
				}
				$html .= '</td></tr></table></div>';
                $html .= '<div class="Mrgtop80 font13">';
                    $html .= '<h3 class="alnCenter">'.$result[0]->title.'</h3>';
                    $html .= '<p> <span class="strong">Type: </span><span class="font14">'.ucfirst($result[0]->contract_type).'</span></p>';
                    if(!empty($result[0]->commission_type)){
                        $html .= '<p> <span class="strong">Availability: </span><span class="font14">'.ucfirst($result[0]->commission_type).'</p>';
                        $html .= '<p> <span class="strong">Commission (%): </span><span class="font14">';
                    
                        if($result[0]->commission_type == 'partial'){
                            $html .= $result[0]->partial_availability_commission;
                        }
                        if($result[0]->commission_type == 'full'){
                            $html .= $result[0]->full_availability_commission;
                        }
                        $html .= '</span></p>';
                    }
                    
                    $html .= '<p></span><span class="font14">'.$result[0]->description.'</span></p>';
                    
                $html .= '</div>';                
				
				$html .= '<div class="Mrgtop40 font13">';
    				$html .= '<p class="font13">I hereby agree to supply the above for entry into Emporium-Voyage</p>';
                    $html .= '<p class="font13">General terms & conditions apply.</p>';
                    $html .= '<table>';
                        $html .= '<tr><td class="strong">Signed by: </td> <td class="underline">'.ucfirst(@$result[0]->first_name).' '.ucfirst(@$result[0]->last_name).'</td></tr>';    
                        $html .= '<tr><td class="strong">Print name: </td> <td class="underline">'.ucfirst(@$result[0]->first_name).' '.ucfirst(@$result[0]->last_name).'</td></tr>';
                        $html .= '<tr><td class="strong">For and on behalf of: </td> <td class="underline">'.$hotel_name.'</td></tr>';
                        $html .= '<tr><td class="strong">Date signed: </td> <td class="underline">'.$date_signed.'</td></tr>';
                        $html .= '<tr><td></td><td><input type="checkbox" name="checkbox" checked disabled/><label style="display:inline-block;text-align:left;">I agreed to the Terms stipulated in this contract</label></td></tr>';
                        $html .= '<tr><td class="strong">Signed by: </td> <td class="underline">'.ucfirst(@$result[0]->first_name).' '.ucfirst(@$result[0]->last_name).'</td></tr>';    
                        $html .= '<tr><td class="strong">Print name: </td> <td class="underline">'.ucfirst(@$result[0]->first_name).' '.ucfirst(@$result[0]->last_name).'</td></tr>';
                        $html .= '<tr><td class="strong">For and on behalf of: </td> <td class="underline">'.$hotel_name.'</td></tr>';
                        $html .= '<tr><td class="strong">Date signed: </td> <td class="underline">'.$date_signed.'</td></tr>';
                    $html .= '</table>';
    			$html .= '</div>';
                
                /*$html = '<style> .main { margin:0 25px; width:700px; font-family: arial, sans-serif; } .page-break { page-break-after: always; } .header,.footer {width: 100%; position:fixed;} .header { top: 0px; text-align:center;} .footer {bottom: 30px; font-size:10px;} .pagenum:after {content: counter(page);} .imgBox { text-align:center; width:400px; margin:50px auto 30px auto;} .nro { text-align:center; font-size:12px; } .header img { width:125px; height: auto; } .Mrgtop80 {margin-top:80px;} .Mrgtop40 {margin-top:40px;} .Mrgtop20 {margin-top:10px;} .monimg img { width:125px; height:80px; } .font14 { font-size:14px; }  .font13 { font-size:13px; } .font12 { font-size:12px; } .algRgt { text-align:right; } .algCnt { text-align:center; }</style>';
                $html .= '<div class="main"><div class="header"><img src="'. \URL::to('metronic/assets/demo/demo6/media/img/logo/logo.png').'"></div><br><br><br><div class="footer">© Copyright: Emporium Voyage Membership Portal</div></div>';*/
                /*$html .= '<div class="Mrgtop80 font13"><table><tr style="background:#eeeeee;"><th class="alnCenter">Title </th><th class="alnCenter">Type </th><th  class="alnCenter">Description </th><th class="alnCenter">Availability </th><th class="alnCenter">Commission (%) </th></tr>';
    			
    				$html .= '<tr><td class="alnCenter">'.$result[0]->title.'</td><td><b>'.ucfirst($result[0]->contract_type).'</b></td><td class="algCnt">'.$result[0]->description.'</td><td class="algCnt">'.ucfirst($result[0]->commission_type).'</td><td>';
                    if(!empty($result[0]->commission_type)){
                        if($result[0]->commission_type == 'partial'){
                            $html .= $result[0]->partial_availability_commission;
                        }
                        if($result[0]->commission_type == 'full'){
                            $html .= $result[0]->full_availability_commission;
                        }
                    }
                    else{
                        $html .= '';
                    }	
                    $html .= '</td></tr>';
    			
    			$html .= '</table></div>';*/
                //echo $html;
                //die;                                
                $pdf = \App::make('dompdf.wrapper');
    			$pdf->loadHTML($html);
    			return $pdf->download($downFileName);
            }
            else{
    			return 'error';
    		}
		}
        else{
			return 'error';
		}
    }
    
    public function my_contract(Request $request) {

        if ($this->access['is_view'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'contract_id');
        $order = (!is_null($request->input('order')) ? $request->input('order') : 'asc');
        // End Filter sort and order for query 
        // Filter Search for query		
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');


        $page = $request->input('page', 1);
        $params = array(
            'page' => $page,
            'limit' => (!is_null($request->input('rows')) ? filter_var($request->input('rows'), FILTER_VALIDATE_INT) : static::$per_page ),
            'sort' => $sort,
            'order' => $order,
            'params' => $filter,
            'global' => (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query 
        $results = $this->model->getRows($params);

        // Build pagination setting
        $page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;
        $pagination = new Paginator($results['rows'], $results['total'], $params['limit']);
        $pagination->setPath('contract');

        $this->data['rowData'] = $results['rows'];
        // Build Pagination 
        $this->data['pagination'] = $pagination;
        // Build pager number and append current param GET
        $this->data['pager'] = $this->injectPaginate();
        // Row grid Number 
        $this->data['i'] = ($page * $params['limit']) - $params['limit'];
        // Grid Configuration 
        $this->data['tableGrid'] = $this->info['config']['grid'];
        $this->data['tableForm'] = $this->info['config']['forms'];
        $this->data['colspan'] = \SiteHelpers::viewColSpan($this->info['config']['grid']);
        // Group users permission
        $this->data['access'] = $this->access;
        // Detail from master if any
        // Master detail link if any 
        $this->data['subgrid'] = (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array());
        // Render into template
        return view('contract.index', $this->data);
    }

    function getUpdate(Request $request, $id = null) {

        if ($id == '') {
            if ($this->access['is_add'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        if ($id != '') {
            if ($this->access['is_edit'] == 0)
                return Redirect::to('dashboard')->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        }

        $row = $this->model->find($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_contracts');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['forms']);

        $this->data['id'] = $id;
        return view('contract.form', $this->data);
    }

    public function getShow($id = null) {

        if ($this->access['is_detail'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');

        $row = $this->model->getRow($id);
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_contracts');
        }
        $this->data['fields'] = \SiteHelpers::fieldLang($this->info['config']['grid']);

        $this->data['id'] = $id;
        $this->data['access'] = $this->access;
        return view('contract.view', $this->data);
    }

    function postSave(Request $request) {

        $rules = $this->validateForm();
        
        $category_type = trim($request->input('contract_type'));
        $check_hotel = true;
        $check_revised_commission = false;
        $check_packages = true;
        $check_user_groups = true;
        $check_groups_users = true;
        
        switch($category_type){
            case "sign-up":
                $check_hotel = false;
                $check_packages = false;
                $check_groups_users = false;
            break;
            
            case "packages":
                $check_hotel = false;
            break;
            
            case "hotels":
                $check_packages = false;
            break;
            
            case "commission":
                $check_packages = false;
                $check_revised_commission = true;
            break;
        }

        $is_all_hotels = (bool) trim($request->input('all_hotels'));
        //$is_revised_commission = (bool) trim($request->input('revised_commission'));
        $is_all_packages = (bool) trim($request->input('all_packages'));
        $is_all_user_groups = (bool) trim($request->input('all_user_groups'));
        $is_all_groups_users = (bool) trim($request->input('all_groups_users'));
        
        if(($is_all_hotels == false) && ($check_hotel === true)){ $rules["hotel_ids"] = "required"; }
        //if(($is_revised_commission == true) && ($check_hotel === true) && ($check_revised_commission === true)){ $rules["full_availability_commission"] = "required|numeric"; $rules["partial_availability_commission"] = "required|numeric"; }
        if(($check_revised_commission === true)){ $rules["full_availability_commission"] = "required|numeric"; $rules["partial_availability_commission"] = "required|numeric"; }
        if(($is_all_packages == false) && ($check_packages === true)){ $rules["package_ids"] = "required"; }
        if(($is_all_user_groups == false) && ($check_user_groups === true)){ $rules["user_group_ids"] = "required"; }
        if(($is_all_groups_users == false) && ($is_all_user_groups == false) && ($check_user_groups === true) && ($check_groups_users === true)){ $rules["user_ids"] = "required"; }
        
        $validator = Validator::make($request->all(), $rules);        
        if ($validator->passes()) {
            //$data = $this->validatePost('tb_contract');
            $package_ids_array = array();
            $hotel_ids_array = array();
            $user_group_ids_array = array();
            $user_ids_array = array();
            
            $uid = \Auth::user()->id;
            $data = array();
            $data['contract_type'] = trim($request->input('contract_type'));
            $data['title'] = trim($request->input('title'));
            $data['description'] = trim($request->input('description'));
            $data['status'] = (bool) trim($request->input('contract_status'));
            $data['is_required'] = (bool) trim($request->input('is_required'));
            $data['package_ids'] = '';
            $data['hotel_ids'] = '';
            $data['user_group_ids'] = '';
            $data['user_ids'] = '';
            $data['deleted'] = 0;
            $data['is_commission_set'] = 0;
            $data['full_availability_commission'] = '0.00';
            $data['partial_availability_commission'] = '0.00';
            
            if(($check_packages == true))
            {
                $data['package_ids'] = 'all';
                if((!is_null($request->input('package_ids'))) && (is_array($request->input('package_ids'))) && ($is_all_packages == false)){
                    $package_ids_array = $request->input('package_ids');
                    $data['package_ids'] = trim(implode(',',$request->input('package_ids')));
                }                    
            }
            
            if(($check_hotel == true))
            {
                $data['hotel_ids'] = 'all';
                if((!is_null($request->input('hotel_ids'))) && (is_array($request->input('hotel_ids'))) && ($is_all_hotels == false)){
                    $hotel_ids_array = $request->input('hotel_ids');
                    $data['hotel_ids'] = trim(implode(',',$request->input('hotel_ids')));
                }                    
            }
            
            if(($check_user_groups == true))
            {
                $data['user_group_ids'] = 'all';
                if((!is_null($request->input('user_group_ids'))) && (is_array($request->input('user_group_ids'))) && ($is_all_user_groups == false)){
                    $user_group_ids_array = $request->input('user_group_ids');
                    $data['user_group_ids'] = trim(implode(',',$request->input('user_group_ids')));
                }
            }
            
            if(($check_user_groups === true) && ($check_groups_users === true))
            {
                $data['user_ids'] = 'all';
                if(($is_all_groups_users == false) && ($is_all_user_groups == false) && (!is_null($request->input('user_ids'))) && (is_array($request->input('user_ids')))){
                    $user_ids_array = $request->input('user_ids');
                    $data['user_ids'] = trim(implode(',',$request->input('user_ids')));
                }                    
            }
            
            if(($check_revised_commission === true)){
                $fulval = (float) trim($request->input('full_availability_commission'));
                $parval = (float) trim($request->input('partial_availability_commission'));
                $data['full_availability_commission'] = number_format($fulval,2,'.','');
                $data['partial_availability_commission'] = number_format($parval,2,'.','');
                $data['is_commission_set'] = 1;
            }
            
            if ($request->input('contract_id') == '') {
                $data['created_by'] = $uid;
                $data['created_on'] = date('Y-m-d h:i:s');
                $check_ordering = \DB::table('tb_contracts')->orderBy('sort_num', 'desc')->first();
				if(!empty($check_ordering)){
					$data['sort_num'] = $check_ordering->sort_num + 1;
				}
				else{
					$data['sort_num'] = 1;
				}
            }else
            {
                $data['updated_by'] = $uid;
                $data['update_on'] = date('Y-m-d h:i:s');
            }            

            $id = $this->model->insertRow($data, $request->input('contract_id'));
            
            if($id > 0){
                
                /** insert packages start **/
                $contractspackages = new Contractspackages();
                if(count($package_ids_array) > 0){                    
                    $rows = $contractspackages->select('id','package_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->package_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($package_ids_array as $package_id){
                        $rowid = ((isset($teData[$package_id]))?$teData[$package_id]:null);
                        $tiData[] = array('id'=>$rowid,'package_id'=>$package_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractspackages->where(array('contract_id'=>$id))->delete();
                        $contractspackages->insert($tiData); 
                    }    
                }else
                {
                    $contractspackages->where(array('contract_id'=>$id))->delete();
                }
                /** insert packages end **/
                
                /** insert hotels start **/
                $contractshotels = new Contractshotels();
                if(count($hotel_ids_array) > 0){                    
                    $rows = $contractshotels->select('id','hotel_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->hotel_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($hotel_ids_array as $hotel_id){
                        $rowid = ((isset($teData[$hotel_id]))?$teData[$hotel_id]:null);
                        $tiData[] = array('id'=>$rowid,'hotel_id'=>$hotel_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractshotels->where(array('contract_id'=>$id))->delete();
                        $contractshotels->insert($tiData); 
                    }    
                }else
                {
                    $contractshotels->where(array('contract_id'=>$id))->delete();
                }
                /** insert hotels end **/
                
                /** insert users groups start **/
                $contractsusergroups = new Contractsusergroups();
                if(count($user_group_ids_array) > 0){                    
                    $rows = $contractsusergroups->select('id','group_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->group_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($user_group_ids_array as $user_group_id){
                        $rowid = ((isset($teData[$user_group_id]))?$teData[$user_group_id]:null);
                        $tiData[] = array('id'=>$rowid,'group_id'=>$user_group_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractsusergroups->where(array('contract_id'=>$id))->delete();
                        $contractsusergroups->insert($tiData); 
                    }    
                }else
                {
                    $contractsusergroups->where(array('contract_id'=>$id))->delete();
                }
                /** insert users groups end **/
                
                /** insert users start **/
                $contractsusers = new Contractsusers();
                if(count($user_ids_array) > 0){                    
                    $rows = $contractsusers->select('id','user_id')->where(array('contract_id'=>$id))->get();
                    $teData = array();
                    foreach($rows as $row){
                        $teData[$row->user_id] = $row->id;
                    }
                    
                    $tiData = array();
                    foreach($user_ids_array as $user_id){
                        $rowid = ((isset($teData[$user_id]))?$teData[$user_id]:null);
                        $tiData[] = array('id'=>$rowid,'user_id'=>$user_id,'contract_id'=>$id);
                    }
                    
                    if(count($tiData) > 0){
                        $contractsusers->where(array('contract_id'=>$id))->delete();
                        $contractsusers->insert($tiData); 
                    }    
                }else
                {
                    $contractsusers->where(array('contract_id'=>$id))->delete();
                }
                /** insert users end **/
                
            }

            if (!is_null($request->input('apply'))) {
                $return = 'contract/update/' . $id . '?return=' . self::returnUrl();
            } else {
                $return = 'contract?return=' . self::returnUrl();
            }

            // Insert logs into database
            if ($request->input('contract_id') == '') {
                \SiteHelpers::auditTrail($request, 'New Data with ID ' . $id . ' Has been Inserted !');
            } else {
                \SiteHelpers::auditTrail($request, 'Data with ID ' . $id . ' Has been Updated !');
            }

            return Redirect::to($return)->with('messagetext', \Lang::get('core.note_success'))->with('msgstatus', 'success');
        } else {

            return Redirect::to('contract/update/' . $id)->with('messagetext', \Lang::get('core.note_error'))->with('msgstatus', 'error')
                            ->withErrors($validator)->withInput();
        }
    }

    public function postDelete(Request $request) {

        if ($this->access['is_remove'] == 0)
            return Redirect::to('dashboard')
                            ->with('messagetext', \Lang::get('core.note_restric'))->with('msgstatus', 'error');
        // delete multipe rows 
        if (count($request->input('ids')) >= 1) {
            $this->model->destroy($request->input('ids'));

            \SiteHelpers::auditTrail($request, "ID : " . implode(",", $request->input('ids')) . "  , Has Been Removed Successfull");
            // redirect
            return Redirect::to('contract')
                            ->with('messagetext', \Lang::get('core.note_success_delete'))->with('msgstatus', 'success');
        } else {
            return Redirect::to('contract')
                            ->with('messagetext', 'No Item Deleted')->with('msgstatus', 'error');
        }
    }
	
	function postChangeordering( Request $request )
	{
		$uid = \Auth::user()->id;
		$id = Input::get('pid');
		$action = Input::get('order_type');
		$ret_url = Input::get('curnurl');
		if($id!='' && $id>0)
		{
			$exist = \DB::table('tb_contracts')->where('contract_id', $id)->first();
			if(!empty($exist))
			{
				if($action=='up')
				{
					$previous = \DB::table('tb_contracts')->where('sort_num', '>', $exist->sort_num)->orderBy('sort_num','asc')->first();
					if(!empty($previous))
					{
						$previous_order = $previous->sort_num - 1;
						$update_ordering = \DB::table('tb_contracts')->where('contract_id',$previous->contract_id)->update(['sort_num'=>$previous_order]);
					}
					$new_ord_num = $exist->sort_num + 1;
				}
				elseif($action=='down')
				{
					$next = \DB::table('tb_contracts')->where('sort_num', '<', $exist->sort_num)->orderBy('sort_num','desc')->first();
					if(!empty($next))
					{
						$next_order = $next->sort_num + 1;
						$update_ordering = \DB::table('tb_contracts')->where('contract_id',$next->contract_id)->update(['sort_num'=>$next_order]);
					}
					
					$new_ord_num = $exist->sort_num - 1;
				}
				if($new_ord_num<1) { $new_ord_num = 1; }
				$update_ordering = \DB::table('tb_contracts')->where('contract_id',$id)->update(['sort_num'=>$new_ord_num]);
				if($update_ordering)
				{
					return Redirect::to($ret_url)->with('messagetext',\Lang::get('core.note_success'))->with('msgstatus','success');
				}
			}
			else
			{
				return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
			}
		}
		else
		{
			return Redirect::to($ret_url)->with('messagetext','No record found')->with('msgstatus','error');
		}
	}

}