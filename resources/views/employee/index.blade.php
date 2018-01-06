@extends('layouts.app')

@section('content')
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
<div class="sbox animated fadeInRight">
	<div class="sbox-title"> <h5> <i class="fa fa-table"></i> </h5>
<div class="sbox-tools" >
		@if(Session::get('gid') ==1)
			<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="btn btn-xs btn-white tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa fa-cog"></i></a>
		@endif 
		</div>
	</div>
	<div class="sbox-content"> 	
	    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('employee/update') }}" class="tips btn btn-sm btn-white"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa fa-plus-circle "></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-minus-circle "></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('employee/download') }}" class="tips btn btn-sm btn-white" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-download"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif			
			<a class="tips btn btn-sm btn-white" onclick="selectfolderfiles();" data-toggle="modal" data-target="#sendEmail"><i class="fa fa-envelope"></i> Send Email </a>
		</div> 		

	
	
	 {!! Form::open(array('url'=>'employee/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
			<tr id="sximo-quick-search" >
				<td class="number"> # </td>
				<td> </td>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
					<td>						
						{!! SiteHelpers::transForm($t['field'] , $tableForm) !!}								
					</td>
					@endif
				@endforeach
				<td >
				<input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-xs btn-info"> GO</button></td>
			 </tr>	        
						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->EmployeeId }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>	
						{{--*/ $col = $field['field']; /*--}}
					 	@if($field['attribute']['image']['active'] =='1')
							{!! SiteHelpers::showUploadedFile($row->$col,$field['attribute']['image']['path']) !!}
						@else	
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{!! SiteHelpers::gridDisplay($row->$col,$field['field'],$conn) !!}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('employee/show/'.$row->EmployeeId.'?return='.$return)}}" class="tips btn btn-xs btn-white" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('employee/update/'.$row->EmployeeId.'?return='.$return) }}" class="tips btn btn-xs btn-white" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
						@endif
												
					
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

<!-- Send Email Modal -->
<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Send files as links</h4>
	  </div>
	  {!! Form::open(array('url'=>'sendemail', 'class'=>'columns' ,'id' =>'send_email', 'method'=>'post' )) !!}
	  <input type="hidden" name="curnurl" value="{{ Request::url() }}">
	  <input type="hidden" name="selectedusers" class="selectedusers" value="">
	  <div class="modal-body">
		<fieldset>
			<div class="form-group">
				<label>{{ Lang::get('core.fr_emailsubject') }} <em>*</em></label>
				<div class="field-input">
					{!! Form::text('subject',null,array('class'=>'form-control', 'placeholder'=>'','required'=>'true')) !!}
				</div>
			</div>
			<div class="form-group">
				<label>{{ Lang::get('core.fr_emailmessage') }}<em>*</em></label>
				<div class="field-input">
					<textarea class="form-control editor" rows="15" required name="message">
						Hi [first_name] [last_name]<br><br>These files have been temporarily shared with you on Demo Kontainer's Kontainer Filesharing:<br><br>[email]<br>[password]<br><br>Best,<br>Demo Kontainer
					</textarea>
				</div>
			</div>
			<p> {{ Lang::get('core.fr_emailtag') }} : </p>
           <small> [first_name] [last_name] [email] [password] </small>
		</fieldset>
	  </div>
	  <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Send mail</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("employee/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	

function selectfolderfiles()
{
	var sList = "";
	$('input[type=checkbox]').each(function () {
		if(this.checked)
		{
			sList += (sList=="" ? $(this).val() : "," + $(this).val());
		}
		
	});
	$('.selectedusers').val(sList);
}
</script>		
@stop