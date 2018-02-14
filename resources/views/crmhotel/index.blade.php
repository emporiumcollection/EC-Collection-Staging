@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('sximo/css/m-popup.css')}}">
<style>
.modal-dialog { width:500px !important; }
</style>
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}"> Dashboard </a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>
	
	
	<div class="page-content-wrapper m-t">	 	
	<div id="formerrors"></div>
	
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h5> <i class="fa fa-table"></i> </h5>
<div class="sbox-tools" >
		<a href="{{ url($pageModule) }}" class="btn btn-xs btn-white tips" title="Clear Search" ><i class="fa fa-trash-o"></i> Clear Search </a>
		@if(Session::get('gid') ==1)
			<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="btn btn-xs btn-white tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa fa-cog"></i></a>
		@endif 
		</div>
	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('crmhotel/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 
			<a href="{{ URL::to( 'crmhotel/search') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> Search</a>				
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('crmhotel/download?return='.$return) }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
		 
		</div> 		

	
	
	 {!! Form::open(array('url'=>'crmhotel/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')				
						<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(SiteHelpers::filterColumn($limited ))
						
							<th>{{ $t['label'] }}</th>			
						@endif 
					@endif
				@endforeach
				<th width="180" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>        						
            @foreach ($rowData as $row)
			{{--*/ $hotel_slug = \SiteHelpers::seoUrl($row->hotel_name); /*--}}
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>									
					<td> <a target="_blank" href="{{URL::to($hotel_slug)}}">{{$row->hotel_name}}</a> </td>
					<td> {{$row->hotel_email}} </td>
					<td> {{$row->hotel_main_phone}} </td>
					<td> {{$row->hotel_manager_name}} </td>
				 <td>
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('crmhotel/show/'.$row->id.'?return='.$return)}}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('crmhotel/update/'.$row->id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
						@endif
						<a  href="{{ URL::to('properties/update/'.$row->propr_id.'?return='.$return) }}" class="tips btn btn-xs btn-success" title="property module"><i class="fa fa-cogs"></i></a>	
						<a  href="{{ URL::to('properties_settings/'.$row->propr_id.'/types') }}" class="tips btn btn-xs btn-success" title="reservations"><i class="fa fa-cogs"></i></a>					
						<a  href="javascript:void(0);" class="tips btn btn-xs btn-success" title="Email" onclick="sendemails_crmhotels('{{$row->id}}');"><i class="fa fa-envelope-o"></i></a>
						<a  href="{{(strpos($row->hotel_website, 'http') !== false) ? $row->hotel_website : 'http://'.$row->hotel_website }}" class="tips btn btn-xs btn-success" title="website"><i class="fa fa-globe"></i></a>
				</td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>	
	</div>	  
</div>
<!--Email popup start-->
<div id="email-page" class="popup">
	<div class="popup-inner">
		<a href="#" class="popup-close-btn rigth-close-btn-align">&times;</a>
		<div class="popup-content">
			<div class="popup-header">
				<div class="write-email-popup-outer">
					<div class="email-popup-tittle">
						<h2 class="email-popup-big-heading">{{ Lang::get('core.crmhotel_email_popup_heading') }}<span class="email-popup-small-heading"> {{ Lang::get('core.crmhotel_email_popup_subheading') }}</span></h2>
					</div>
				</div>
			</div>
			<div class="email-tabs-outer">
				<div class="white-bar-menu-outer">
					<ul class="nav nav-tabs email-pop-up-tabs">
						<li class="active"><a data-toggle="tab" href="#email-tab1">{{ Lang::get('core.crmhotel_email_popup_emailtab') }}</a></li>
						<li><a data-toggle="tab" href="#email-tab2">{{ Lang::get('core.crmhotel_email_popup_emaillist') }}</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
				<div class="tab-content email-tabs-content-outer">
					<div id="email-tab1" class="tab-pane fade in active email-form-outer-spacing-align">
						<div class="client-location-form-outer">
							<div class="container">
								<div class="col-md-6">
									<div class="client-location-map">
										<iframe id="crmmap_popup" src="https://www.google.com/maps?q=Randall Miller %26 Associates 300 E Broadway, Logansport, IN 46947&output=embed"></iframe>
									</div>


										<!-- open container Modal -->
										<div  id="openContainer" tabindex="-1" style="display: none;" role="dialog" aria-labelledby="myModalLabel">
										  <div class="modal-dialog" role="document">
											  <div class="modal-content">
												  <div class="modal-header">
													  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:closeContainerDIV();"><span aria-hidden="true">&times;</span></button>
													  <h4 class="modal-title" id="myModalLabel">Select Image</h4>
												  </div>
												  <div class="modal-body">
													 <iframe id="iframe_id_123" src="{{URL::to('containeriframe').'/0/iframe'}}" style="height: 400px;width: 400px;border: none;"></iframe>
												  </div>
												  <div class="modal-footer">
													  <input type="hidden" name="boxid" id="boxid" value="">
													  <button type="button" class="btn btn-primary" onclick="selectimg();">ok</button>
													  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:closeContainerDIV();">Cancel</button>
												  </div>

											  </div>
										  </div>
										</div>
								</div>
								<div class="col-md-6">
									<div class="email-form-outer">
										{!! Form::open(['url' => '#','method'=>'post','id'=>'emailcrm', 'enctype'=>'multipart/form-data']) !!}
											<input type="hidden" name="crmId_email_popup" id="crmId_email_popup" value="" />
											<input type="hidden" name="propertyid_email_popup" id="propertyid_email_popup" value="" />
											<div class="form-group">
												<input class="form-control ai-blue-bordered-input" type="text" name="crm_email_popup" id="crm_email_popup" placeholder="Enter Email Address" value="" required>
											</div>
											<div class="form-group">
												<input class="form-control ai-blue-bordered-input" type="text" placeholder="CC" name="cc_email_popup">
											</div>
											<div class="form-group">
												<input class="form-control ai-blue-bordered-input" type="text" placeholder="Subject" name="subject_email_popup">
											</div>
											<div class="form-group">
												<select class="form-control ai-blue-bordered-input" name="template_email_popup">
													<option selected disabled>Template</option>
													<option value="crm_email">Template CRM</option>
												</select>
											</div>
											<div class="form-group " >
												<div class="">
													<input class="form-control"  type='file' name='upload_email_popup' id='upload_email_popup'  />
													
												</div> 
												<div class="">
													<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(1); openContainerDIV();">Choose from container</a>
													<input type="hidden" name="container_image_pos_1" id="box1" value="">
													<span id="boxspan1"></span>
												 </div> 
												
											</div>
											<div class="form-group">
												<textarea class="form-control editor" name="message_email_popup" id="message_email_popup"></textarea>
											</div>
											 
											<button type="button" class="add-task-btn email-send-btn" onclick="submitcrmemail();">{{ Lang::get('core.crmhotel_email_popup_send_btn') }}</button>
										</form>



									
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="email-tab2" class="tab-pane fade">
						<div class="popup-list-page-outer-align">
							<form>
								<input type="text" class="fullwidth-search-bar" placeholder="Search">
							</form>
							<div class="ai-accordian-tbl-outer">
								<table class="table table-condensed ai-accordian-table">
									<tbody id="crmemaillist">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<!--Email popup end-->

	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("crmhotel/multisearch")}}');
		$('#SximoTable').submit();
	});
	
	$(".popup-close-btn").click(function (event) {
        event.preventDefault();
        $(this).parent().parent().fadeOut("slow");
        $("body").removeClass("fixed");
    });
});	

function sendmotId(boxid)
{
	$('#boxid').val(boxid);
}

function openContainerDIV()
{
	$('#openContainer').show();
	
}
function closeContainerDIV()
{
	$('#openContainer').hide();
	
}

function selectimg(obj)
{
	


	var bid = $('#boxid').val();
	var cat = $('#cat_id').val();
	var sList='';
	var sListid='';
	var highrespath='';
	sList = $(obj).attr('rel2');
	imgname = $(obj).attr('rel');
	imagepath = $(obj).attr('rel3');
	$('#box'+bid).val(imagepath);
	$('#boxspan'+bid).html(imgname);
	$('#openContainer').hide();
	
}

function sendemails_crmhotels(crmid)
{
	if(crmid > 0 && crmid!='')
	{
		$.ajax({
		  url: "{{ URL::to('fetch_company_info')}}",
		  type: "post",
		  data: 'crmid='+crmid,
		  dataType: "json",
		  success: function(data){
			if(data.status!='error')
			{
				$('#crm_email_popup').val(data.crm.hotel_email);
				$('#propertyid_email_popup').val(data.crm.propr_id);
				$('#crmId_email_popup').val(crmid);
				$('#crmmap_popup').attr('src','https://www.google.com/maps?q='+data.crm.hotel_address+'&output=embed');
				$('#crmemaillist').html('');
				if(data.crmemails.length)
				{
					var lhtml = '';
					$(data.crmemails).each(function(index,obj) {
					    lhtml +='<tr>';
						lhtml +='<td style="width:50%">'+obj.email_subject+'</td>';
						lhtml +='<td>Project</td>';
						lhtml +='<td>'+obj.created_at+'</td>';
						lhtml +='<td data-toggle="collapse" data-target="#collapse-row'+obj.id+'" class="accordion-toggle collapsed"><div class="collapse-pannel-btn"></div></td>';
						lhtml +='</tr>';
						lhtml +='<tr>';
						lhtml +='<td colspan="4" class="hiddenRow collapse-row" style="background: #fff;">';
						lhtml +='<div class="accordian-body collapse" id="collapse-row'+obj.id+'"> ';
						lhtml +='<div class="accordian-pannel-inner"> '+obj.email_message+' </div>';
						lhtml +='</div>'; 
						lhtml +='</td>';
						lhtml +='</tr>';
					});
					$('#crmemaillist').html(lhtml);
				}
				
				$("#email-page").fadeIn("slow");
				$("body").addClass("fixed");
			}
		  }
		});
	}
}

function submitcrmemail()
{
	$('#message_email_popup').val($('.note-editable').html());
	var form_data = new FormData(document.getElementById('emailcrm'));
	$.ajax({
	  method: "post",
	  url: "{{URL::to('emailCRM')}}",
	  cache : false,
	  contentType: false, // Important.
	  processData: false,
	  data: form_data,
	  mimeType: "multipart/form-data",
	  dataType: "json",
	  success: function (data)
	  {
		  if(data.status=='success'){
			$("#email-page").fadeOut("slow");
			$("body").removeClass("fixed");
			html ='<div class="alert alert-danger fade in block-inner">';
			html +='<button data-dismiss="alert" class="close" type="button">×</button>';
			html +='<i class="icon-checkmark-circle"></i> Email Sent! </div>';
			$('.page-content-wrapper #formerrors').html(html);
		  }
	  }
	});
}
</script>		
@stop