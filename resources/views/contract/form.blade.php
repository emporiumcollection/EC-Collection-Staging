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
		<li><a href="{{ URL::to('contract?return='.$return) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'contract/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> Contract</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Contract Id" class=" control-label col-md-4 text-left"> Contract Id </label>
									<div class="col-md-6">
									  {!! Form::text('contract_id', $row['contract_id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div class="form-group  " >
                                    <label for="Contract Category" class=" control-label col-md-4 text-left"> Contract Category <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  
					                   {{--*/ $contracts_category_opt = array( 'general' => 'General' ,  'sign-up' => 'Sign up' , 'packages' => 'Packages' , 'hotels' => 'Hotels', 'commission' => 'Commission', 'supplier' => 'Supplier', 'supplier_commission' => 'Supplier Commission' ); /*--}}
					                         <select name='contract_type' rows='5' required  class='select2  select2-offscreen'  >
                                                <option value="">Select Type</option>
                        						{{--*/
                        						foreach($contracts_category_opt as $key=>$val)
                        						{
                        							echo "<option  value ='$key' ".($row['contract_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
                        						} 						
                        						/*--}}
                                             </select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
                                  </div>
                                  					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <input name='title' id='title' class='form-control ' required="required" value="{{ $row['title'] }}" /> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <textarea name='description' rows='5' id='description' class='form-control ' required="required">{{ $row['description'] }}</textarea> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div class="form-group  " >
									<label for="contract_status" class=" control-label col-md-4 text-left"> Contract Status <span class="asterix"> * </span></label>
									<div class="col-md-6">									  
                    					<label class='radio radio-inline'>
                    					<input type='radio' name='contract_status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > Inactive </label>
                    					<label class='radio radio-inline'>
                    					<input type='radio' name='contract_status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > Active </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div class="form-group  " >
									<label for="is_required" class=" control-label col-md-4 text-left"> Required <span class="asterix"> * </span></label>
									<div class="col-md-6">									  
                    					<label class='radio radio-inline'>
                    					<input type='radio' name='is_required' value ='0' required @if($row['is_required'] == '0') checked="checked" @endif > No </label>
                    					<label class='radio radio-inline'>
                    					<input type='radio' name='is_required' value ='1' required @if($row['is_required'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div class="form-group  groups_checkboxes" >
									<label class=" control-label col-md-4 text-left"></label>
									<div class="col-md-6">									  
                    					<label class='checkbox checkbox-inline all_hotels'>
                    					<input type='checkbox' name='all_hotels' value ='1' required @if(($row['hotel_ids'] == 'all') || (strlen(trim($row['hotel_ids'])) <= 0)) checked="checked" @endif > All Hotels </label>
                                        
                                        <label class='checkbox checkbox-inline all_packages'>
                    					<input type='checkbox' name='all_packages' value ='1' required @if(($row['package_ids'] == 'all') || (strlen(trim($row['package_ids'])) <= 0)) checked="checked" @endif > All Packages </label>
                                        
                    					<label class='checkbox checkbox-inline all_user_groups'>
                    					<input type='checkbox' name='all_user_groups' value ='1' required @if(($row['user_group_ids'] == 'all') || (strlen(trim($row['user_group_ids'])) <= 0)) checked="checked" @endif > All User Groups </label> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div id="hotels_div" class="form-group  " style="display: none;" >
									<label for="Hotels" class=" control-label col-md-4 text-left"> Hotels <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='hotel_ids[]' multiple id='hotel_ids' class='select2 '></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div id="packages_div" class="form-group  " style="display: none;" >
									<label for="Packages" class=" control-label col-md-4 text-left"> Packages <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='package_ids[]' multiple id='package_ids' class='select2 '></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div id="user_groups_div" class="form-group  " style="display: none;" >
									<label for="User Groups" class=" control-label col-md-4 text-left"> User Groups <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='user_group_ids[]' multiple id='user_group_ids' class='select2 '></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div id="group_users_checkbox_div" class="form-group  " style="display: none;" >
									<label class=" control-label col-md-4 text-left"></label>
									<div class="col-md-6">									  
                    					<label class='checkbox checkbox-inline'>
                    					<input type='checkbox' name='all_groups_users' value ='1' required @if(($row['user_ids'] == 'all') || (strlen(trim($row['user_ids'])) <= 0)) checked="checked" @endif > All Groups Users </label>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  <div id="users_div" class="form-group  " style="display: none;" >
									<label for="Users" class=" control-label col-md-4 text-left"> Users <span class="asterix"> * </span></label>
									<div class="col-md-6">
									  <select name='user_ids[]' multiple id='user_ids' class='select2'></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                                  
                                  {{--<div id="revised_commission_div" class="form-group  " style="display: none;" >
									<label class=" control-label col-md-4 text-left"></label>
									<div class="col-md-6">									  
                    					<label class='checkbox checkbox-inline'>
                    					<input type='checkbox' name='revised_commission' value ='1' /> Commission </label>
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>--}}
                                  
                                  <div id="full_availability_commission_div" class="form-group  " style="display: none;" >
									<label for="full_availability_commission" class=" control-label col-md-4 text-left"> Full Availability Commission (%) <span class="asterix"> * </span> </label>
									<div class="col-md-6">
									  {!! Form::text('full_availability_commission', $row['full_availability_commission'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 
                                  
                                  <div id="partial_availability_commission_div" class="form-group  " style="display: none;" >
									<label for="partial_availability_commission" class=" control-label col-md-4 text-left"> Partial Availability Commission (%) <span class="asterix"> * </span> </label>
									<div class="col-md-6">
									  {!! Form::text('partial_availability_commission', $row['partial_availability_commission'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div>
                        </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('contract?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>

<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
			 
   <script type="text/javascript">
   function check_checkboxes(){
        var contract_typeVal = $('[name="contract_type"]').val();
        
        if(($('[name="all_packages"]').is(":checked") === false) && ($(".all_packages").hasClass('hide') === false)){ $("#packages_div").fadeIn(); }else{ $("#packages_div").fadeOut(); }
        if(($('[name="all_hotels"]').is(":checked") === false) && ($(".all_hotels").hasClass('hide') === false)){ $("#hotels_div").fadeIn(); }else{ $("#hotels_div").fadeOut(); }
        
        if(($('[name="all_user_groups"]').is(":checked") === false) && ($(".all_user_groups").hasClass('hide') === false)){ 
            $("#user_groups_div").fadeIn();
            
            var tval = $("#user_groups_div #user_group_ids").val();            
            if((typeof tval != 'undefined') && (tval != null) && (tval != '') && (contract_typeVal != 'sign-up'))
            {
                $("#group_users_checkbox_div").fadeIn(); 
                if($('[name="all_groups_users"]').is(":checked") === false){ $("#users_div").fadeIn(); }else{ $("#users_div").fadeOut();  } 
            }
            else{ 
                $("#group_users_checkbox_div").fadeOut(); 
                $("#users_div").fadeOut();  
            }
        }else{ 
            $("#user_groups_div").fadeOut(); 
            $("#group_users_checkbox_div").fadeOut(); 
            $("#users_div").fadeOut(); 
        }
        
        /*if(($('[name="revised_commission"]').is(":checked") === true) && (contract_typeVal == 'hotels')){ $("#full_availability_commission_div").fadeIn(); $("#partial_availability_commission_div").fadeIn();  }else{ $("#full_availability_commission_div").fadeOut(); $("#partial_availability_commission_div").fadeOut(); }*/
   }
	$(document).ready(function() { 
		 CKEDITOR.replace( 'description' );
         
        $("#package_ids").jCombo("{{ URL::to('contract/comboselect?filter=tb_packages:id:package_title') }}",
		{  selected_value : '{{ $row["package_ids"] }}' });
        
        $("#hotel_ids").jCombo("{{ URL::to('contract/comboselect?filter=tb_crm_prop:id:hotel_name') }}",
		{  selected_value : '{{ $row["hotel_ids"] }}' });
        
		$("#user_group_ids").jCombo("{{ URL::to('contract/comboselect?filter=tb_groups:group_id:name') }}",
		{  selected_value : '{{ $row["user_group_ids"] }}' });
        
        $("#user_ids").jCombo("{{ URL::to('contract/comboselect?filter=tb_users:id:email') }}",
		{  input_param: 'group_id', parent: '#user_group_ids', selected_value : '{{ $row["user_ids"] }}', condition_param: 'in' });
        
        /** input display and hide conditions start **/
        $('.checkbox-inline, .iCheck-helper').on('click',function(){
            check_checkboxes();
        });
        
        $("#user_group_ids").on('change',function(){
            check_checkboxes();
        });
        
        $('[name="contract_type"]').change(function(){
            var thisval = $(this).val();
            
            if(thisval == 'hotels'){
                //$("#revised_commission_div").fadeIn();
                
                $(".all_hotels").fadeIn(); 
                $(".all_packages").fadeOut(); 
                $(".all_user_groups").fadeIn();
                $(".all_hotels").removeClass('hide');  
                $(".all_packages").addClass('hide'); 
                $(".all_user_groups").removeClass('hide'); 
                
                $("#full_availability_commission_div").fadeOut(); 
                $("#partial_availability_commission_div").fadeOut();
            }else if(thisval == 'commission'){
                //$("#revised_commission_div").fadeIn();
                
                $(".all_hotels").fadeOut(); 
                $(".all_packages").fadeOut(); 
                $(".all_user_groups").fadeOut();
                $(".all_hotels").addClass('hide');  
                $(".all_packages").addClass('hide'); 
                $(".all_user_groups").addClass('hide');
                
                $("#full_availability_commission_div").fadeIn(); 
                $("#partial_availability_commission_div").fadeIn(); 
            }else if(thisval == 'sign-up'){
                //$("#revised_commission_div").fadeOut();
                
                $(".all_hotels").fadeOut(); 
                $(".all_packages").fadeOut();
                $(".all_user_groups").fadeIn(); 
                $(".all_hotels").addClass('hide');  
                $(".all_packages").addClass('hide'); 
                $(".all_user_groups").removeClass('hide'); 
                
                $("#full_availability_commission_div").fadeOut(); 
                $("#partial_availability_commission_div").fadeOut();
            }else if(thisval == 'packages'){
                //$("#revised_commission_div").fadeOut();
                
                $(".all_hotels").fadeOut(); 
                $(".all_packages").fadeIn();
                $(".all_user_groups").fadeIn(); 
                $(".all_hotels").addClass('hide');  
                $(".all_packages").removeClass('hide'); 
                $(".all_user_groups").removeClass('hide'); 
                
                $("#full_availability_commission_div").fadeOut(); 
                $("#partial_availability_commission_div").fadeOut();
            }else{
                $("#revised_commission_div").fadeOut();
                
                $(".all_hotels").fadeIn(); 
                $(".all_packages").fadeIn(); 
                $(".all_user_groups").fadeIn();
                $(".all_hotels").removeClass('hide');  
                $(".all_packages").removeClass('hide'); 
                $(".all_user_groups").removeClass('hide'); 
                
                $("#full_availability_commission_div").fadeOut(); 
                $("#partial_availability_commission_div").fadeOut();
            }
            
            check_checkboxes();
        });
        
        $('[name="contract_type"]').trigger('change');
        
        /** input display and hide conditions end **/

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop