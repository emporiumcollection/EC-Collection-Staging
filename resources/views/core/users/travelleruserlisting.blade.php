@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('sximo/css/m-popup.css')}}">
<style>
.modal-dialog { width:500px !important; }
</style>

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

	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			<a href="{{ URL::to('crmhotel') }}" class="tips btn btn-sm btn-white"  title="Hotel Lead Listing">
			<i class="fa fa-list "></i>&nbsp;Hotel Lead Listing</a>
            
            <a href="{{ URL::to('crmhotel/lead') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_lead_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_lead_create') }}</a>
            
            <a href="{{ URL::to('crmhotel/leadlisting') }}" class="tips btn btn-sm btn-white"  title="User Lead Listing">
			<i class="fa fa-list "></i>&nbsp;{{ Lang::get('core.btn_lead_listing') }}</a>
             
            <a href="{{ URL::to('crmhotel/hotellisting') }}" class="tips btn btn-sm btn-white"  title="Hotel">
			<i class="fa fa-list "></i>&nbsp;Hotel</a>
            
            <a href="{{ URL::to('crmhotel/hoteluserlisting') }}" class="tips btn btn-sm btn-white"  title="Hotel User">
			<i class="fa fa-list "></i>&nbsp;Hotel User</a>
            
            <a href="{{ URL::to('crmhotel/travelleruserlisting') }}" class="tips btn btn-sm btn-white active"  title="Traveller">
			<i class="fa fa-list "></i>&nbsp;Traveller</a>
            
            <a href="{{ URL::to( 'core/users/crmtravellerusersearch') }}" class="btn btn-sm btn-white" onclick="SximoModal(this.href,'Advance Search'); return false;" ><i class="text-danger fa fa-search"></i> Search</a>
		</div> 		

	
	
	 {!! Form::open(array('url'=>'crmhotel/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
     <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th>Avatar</th>
				<th>Group</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
				<th width="180" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>        						
            @foreach ($rowData as $row)
			
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>									
					<td> 
                        <?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?> 
							<img alt="" src="http://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
					    <?php } ?> 
                    </td>
                    <td> {{$row->name}} </td>
					<td> {{$row->first_name}} </td>
					<td> {{$row->last_name}} </td>
					<td> {{$row->email}} </td>
				 <td>
					 						
						<a  href="javascript:void(0);" class="tips btn btn-xs btn-success" title="Email" onclick="sendemails_crmhotels('{{$row->id}}');"><i class="fa fa-envelope-o"></i></a>
						
				</td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	<div class="table-footer">
    	<div class="row">
            <div class="col-sm-5">
                <div class="table-actions" style=" padding: 10px 0">
                
                </div>					
            </div>
            <div class="col-sm-3">
                <p class="text-center" style=" padding: 25px 0">
        		Total : <b>{{ $pagination->total() }}</b>
        		</p>
            </div>
            <div class="col-sm-4">			 
    	       {!! $pagination->appends($pager)->render() !!}
            </div>
    	</div>
	</div>
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
						<li class="active"><a data-toggle="tab" href="#email-tab1" class="em-tab">{{ Lang::get('core.crmhotel_email_popup_emailtab') }}</a></li>
						<li><a data-toggle="tab" href="#email-tab2" class="em-tab">{{ Lang::get('core.crmhotel_email_popup_emaillist') }}</a></li>
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
    $(".em-tab").on("click", function(){
        $(".email-pop-up-tabs li").removeClass('active');
        $(".tab-content .tab-pane").hide();
        var tab_id = $(this).attr('href');
        $(tab_id).addClass('in active');
        $(tab_id).show();
        $(this).closest('li').addClass('active');
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
    var sList = "";
	$('input[type=checkbox].ids').each(function () {
		if(this.checked)
		{
			sList += (sList=="" ? $(this).val() : "," + $(this).val());
		}
		
	});
	if(crmid > 0 && crmid!='')
	{
		$.ajax({
		  url: "{{ URL::to('fetch_user_info')}}",
		  type: "post",
		  data: {crmuid:crmid, ids:sList},
		  dataType: "json",
		  success: function(data){
			if(data.status!='error')
			{
				$('#crm_email_popup').val(data.crm.email);
				$('#propertyid_email_popup').val(data.crm.id);
				$('#crmId_email_popup').val(crmid);
				$('#crmmap_popup').attr('src','https://www.google.com/maps?q='+data.crm.address+'&output=embed');
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
                    $('.collapse').collapse();
				}else{
				    var lhtml = 'There is no communication.';
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
	  url: "{{URL::to('emailInviteCRM')}}",
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