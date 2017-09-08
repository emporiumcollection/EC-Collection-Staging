@extends('layouts.app')

@section('content')
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('crmhotel?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper m-t">   

<div class="sbox animated fadeInRight">
	<div class="sbox-title"> 
   		<a href="{{ URL::to('crmhotel?return='.$return) }}" class="tips btn btn-xs btn-default pull-right" title="{{ Lang::get('core.btn_back') }}"><i class="fa fa-arrow-circle-left"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
		@if($access['is_add'] ==1)
   		<a href="{{ URL::to('crmhotel/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-primary pull-right" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
		@endif 
	</div>
	<div class="sbox-content" style="background:#fff;"> 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Property</td>
						<td>{!! SiteHelpers::gridDisplayView($row->propr_id,'propr_id','1:tb_properties:id:property_name') !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Company Name</td>
						<td>{{ $row->company_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Company Email</td>
						<td>{{ $row->company_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Company Phone</td>
						<td>{{ $row->company_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Company Website</td>
						<td>{{ $row->company_website }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Name</td>
						<td>{{ $row->hotel_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Address</td>
						<td>{{ $row->hotel_address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel City</td>
						<td>{{ $row->hotel_city }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Postal Code</td>
						<td>{{ $row->hotel_postal_code }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Country</td>
						<td>{{ $row->hotel_country }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Email</td>
						<td>{{ $row->hotel_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Main Phone</td>
						<td>{{ $row->hotel_main_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Linkedin Profile</td>
						<td>{{ $row->hotel_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Name</td>
						<td>{{ $row->hotel_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Lastname</td>
						<td>{{ $row->hotel_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Extension</td>
						<td>{{ $row->hotel_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Email</td>
						<td>{{ $row->hotel_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Phone</td>
						<td>{{ $row->hotel_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Manager Linkedin Profile</td>
						<td>{{ $row->hotel_manager_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Name</td>
						<td>{{ $row->hotel_sales_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Lastname</td>
						<td>{{ $row->hotel_sales_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Email</td>
						<td>{{ $row->hotel_sales_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Phone</td>
						<td>{{ $row->hotel_sales_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Extension</td>
						<td>{{ $row->hotel_sales_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Sales Manager Profile</td>
						<td>{{ $row->hotel_sales_manager_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Product Range</td>
						<td>{{ $row->hotel_spa_product_range }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Name</td>
						<td>{{ $row->hotel_spa_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Lastname</td>
						<td>{{ $row->hotel_spa_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Email</td>
						<td>{{ $row->hotel_spa_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Phone</td>
						<td>{{ $row->hotel_spa_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Extension</td>
						<td>{{ $row->hotel_spa_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Spa Manager Linkedin Profile</td>
						<td>{{ $row->hotel_spa_manager_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Name</td>
						<td>{{ $row->hotel_restaurant_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Name</td>
						<td>{{ $row->hotel_restaurant_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Lastname</td>
						<td>{{ $row->hotel_restaurant_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Email</td>
						<td>{{ $row->hotel_restaurant_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Phone</td>
						<td>{{ $row->hotel_restaurant_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Extension</td>
						<td>{{ $row->hotel_restaurant_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Manager Linkedin Profile</td>
						<td>{{ $row->hotel_restaurant_manager_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Chefs Name</td>
						<td>{{ $row->hotel_restaurant_chefs_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant Chefs Awards</td>
						<td>{{ $row->hotel_restaurant_chefs_awards }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Name</td>
						<td>{{ $row->hotel_restaurant2_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Name</td>
						<td>{{ $row->hotel_restaurant2_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Lastname</td>
						<td>{{ $row->hotel_restaurant2_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Email</td>
						<td>{{ $row->hotel_restaurant2_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Phone</td>
						<td>{{ $row->hotel_restaurant2_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Extension</td>
						<td>{{ $row->hotel_restaurant2_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Manager Linkedin Profile</td>
						<td>{{ $row->hotel_restaurant2_manager_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Chefs Name</td>
						<td>{{ $row->hotel_restaurant2_chefs_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant2 Chefs Awards</td>
						<td>{{ $row->hotel_restaurant2_chefs_awards }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Name</td>
						<td>{{ $row->hotel_restaurant3_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Name</td>
						<td>{{ $row->hotel_restaurant3_manager_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Lastname</td>
						<td>{{ $row->hotel_restaurant3_manager_lastname }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Email</td>
						<td>{{ $row->hotel_restaurant3_manager_email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Phone</td>
						<td>{{ $row->hotel_restaurant3_manager_phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Extension</td>
						<td>{{ $row->hotel_restaurant3_manager_extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Manager Linkedin Profile</td>
						<td>{{ $row->hotel_restaurant3_manager_linkedin_profile }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Chefs Name</td>
						<td>{{ $row->hotel_restaurant3_chefs_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hotel Restaurant3 Chefs Awards</td>
						<td>{{ $row->hotel_restaurant3_chefs_awards }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->crm_prop_status }} </td>
						
					</tr>
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	

	</div>
</div>
	  
@stop