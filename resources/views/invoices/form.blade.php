@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<script src="{{ asset('sximo/js/custom_ps.js') }}"></script>
<script src="{{ asset('sximo/js/typeahead.min.js') }}"></script>
<style>
	.input-group-addon {
		background-color: #eee;
		border: 1px solid #ccc;
		border-radius: 4px;
	}
	
	#item-pnl .input-group-addon
	{
		padding:6px 9px;
	}
	
	.tt-query,
.tt-hint {
    width: 370px;
    height: 30px;
    padding: 8px 12px;
    font-size: 24px;
    line-height: 30px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    outline: none;
}
	.tt-dropdown-menu {
    width: 100%;
    margin-top: 12px;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
    padding: 3px 20px;
    font-size: 16px;
    line-height: 24px;
}

.tt-suggestion.tt-is-under-cursor {
    color: #fff;
    background-color: #0097cf;

}
	
</style>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('invoices?return='.$return) }}">{{ $pageTitle }}</a></li>
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
	<div class="sbox-title"> <h4> <i class="fa fa-table"></i> <?php echo $pageTitle ;?> <small>{{ $pageNote }}</small></h4></div>
	<div class="sbox-content"> 	

		 {!! Form::open(array('url'=>'invoices/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
				<div class="row">
					<div class="col-md-12">
						<legend> Invoices</legend>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<fieldset>
							<div class="form-group hidethis " style="display:none;">
								<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
								<div class="col-md-6">
								  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							</div> 					
							<div class="form-group  " >
								<label for="Upload your logo" class=" control-label col-md-2 text-left"> Upload your logo </label>
								<div class="col-md-6">
								  <input  type='file' name='invoice_logo' id='invoice_logo' @if($row['invoice_logo'] =='') class='required' @endif style='width:150px !important;'  />
								  <small>Note: Maximum resolution should be 180px * 100px (width * height)</small>
									<div >
										{!! SiteHelpers::showUploadedFile($row['invoice_logo'],'/uploads/invoices_logos/',50,50) !!}
									</div>	
									<input  type="hidden" name="company_logo" id="company_logo" value="{{(!empty($billFrom))?$billFrom->company_logo:''}}"/>

								 </div> 
								 <div class="col-md-2">
									
								 </div>
							</div> 
						</fieldset>
					</div>
					<div class="col-md-4">
						<fieldset>
					  <div class="form-group  " >
						<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  {!! Form::text('invoice_title', $row['invoice_title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
						 </div> 
						 
					  </div> 					
					  <div class="form-group  " >
						<label for="Invoice #" class=" control-label col-md-4 text-left"> Invoice # <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  {!! Form::text('invoice_number', ($row['invoice_number']!='')?$row['invoice_number']:$def_invoice_num,array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true', 'readonly'=>'readonly'  )) !!} 
						 </div> 
						 
					  </div> 					
					  <div class="form-group  " >
						<label for="Billing Date" class=" control-label col-md-4 text-left"> Billing Date <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  
							<div class="input-group">
								{!! Form::text('billing_date', ($row['billing_date']!='')? $row['billing_date'] : date('Y-m-d'),array('class'=>'form-control date')) !!}
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div> 
						 </div> 
						
					  </div> 					
					  <div class="form-group  " >
						<label for="Due Date" class=" control-label col-md-4 text-left"> Due Date <span class="asterix"> * </span></label>
						<div class="col-md-8">
						  
							<div class="input-group">
								{!! Form::text('due_date', ($row['due_date']!='')? $row['due_date'] : date('Y-m-d'),array('class'=>'form-control date')) !!}
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div> 
						
						 </div> 
						 
					  </div> 
					  </fieldset>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<fieldset>
							<legend style="font-weight:bold;"> BILL FROM</legend>
						  <div class="form-group  " >
							<label for="Business Name" class=" control-label col-md-3 text-left"> Business Name <span class="asterix"> * </span></label>
							<div class="col-md-9">
							  {!! Form::text('from_business_name', ($row['from_business_name']!='')?$row['from_business_name']:((!empty($billFrom))?$billFrom->company_name:$row['from_business_name']),array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
							 </div> 
							 
						  </div> 					
						  <div class="form-group  " >
							<label for="Address Line 1" class=" control-label col-md-3 text-left"> Address Line 1 </label>
							<div class="col-md-9">
							  {!! Form::text('from_address', ($row['from_address']!='')?$row['from_address']:((!empty($billFrom))?$billFrom->company_address:$row['from_address']),array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 
						  </div> 					
						  <div class="form-group  " >
							<label for="Address Line 2" class=" control-label col-md-3 text-left"> Address Line 2 </label>
							<div class="col-md-9">
							  {!! Form::text('from_address2', ($row['from_address2']!='')?$row['from_address2']:((!empty($billFrom))?$billFrom->company_address2:$row['from_address2']),array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 
						  </div> 					
						  <div class="form-group  " >
							<label for="Phone #" class=" control-label col-md-3 text-left"> Phone # </label>
							<div class="col-md-9">
							  {!! Form::text('from_phone', ($row['from_phone']!='')?$row['from_phone']:((!empty($billFrom))?$billFrom->company_phone:$row['from_phone']),array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							 
						  </div> 					
						  <div class="form-group  " >
							<label for="Email" class=" control-label col-md-3 text-left"> Email </label>
							<div class="col-md-9">
							  {!! Form::email('from_email', ($row['from_email']!='')?$row['from_email']:((!empty($billFrom))?$billFrom->company_email:$row['from_email']),array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
							 </div> 
							
						  </div> 					
						  <div class="form-group  " >
							<label for="Additional Info" class=" control-label col-md-3 text-left"> Additional Info </label>
							<div class="col-md-9">
							  <textarea name='from_additional_info' rows='5' id='from_additional_info' class='form-control '  
				   >{{ $row['from_additional_info'] }}</textarea> 
							 </div> 
							 
						  </div>
						</fieldset>						  
					</div>
					<div class="col-md-6">
						<fieldset>
							<legend style="font-weight:bold;"> BILL TO</legend>
							  <div class="form-group  " >
								<label for="Business Name" class=" control-label col-md-3 text-left"> Business Name <span class="asterix"> * </span></label>
								<div class="col-md-9">
								  {!! Form::text('to_business_name', $row['to_business_name'],array('class'=>'form-control', 'placeholder'=>'', 'id'=>'to_business_name', 'required'=>'true', 'onblur'=>'fillBillto(this);' )) !!} 
								 </div> 
								
							  </div> 					
							  <div class="form-group  " >
								<label for="Address Line 1" class=" control-label col-md-3 text-left"> Address Line 1 </label>
								<div class="col-md-9">
								  {!! Form::text('to_address', $row['to_address'],array('class'=>'form-control', 'placeholder'=>'', 'id'=>'to_address'  )) !!} 
								 </div> 
								 
							  </div> 					
							  <div class="form-group  " >
								<label for="Address Line 2" class=" control-label col-md-3 text-left"> Address Line 2 </label>
								<div class="col-md-9">
								  {!! Form::text('to_address2', $row['to_address2'],array('class'=>'form-control', 'placeholder'=>'', 'id'=>'to_address2'  )) !!} 
								 </div> 
								
							  </div> 					
							  <div class="form-group  " >
								<label for="Phone #" class=" control-label col-md-3 text-left"> Phone # </label>
								<div class="col-md-9">
								  {!! Form::text('to_phone', $row['to_phone'],array('class'=>'form-control', 'placeholder'=>'',  'id'=>'to_phone' )) !!} 
								 </div> 
								
							  </div> 					
							  <div class="form-group  " >
								<label for="Email" class=" control-label col-md-3 text-left"> Email </label>
								<div class="col-md-9">
								  {!! Form::email('to_email', $row['to_email'],array('class'=>'form-control', 'placeholder'=>'', 'id'=>'to_email'  )) !!} 
								 </div> 
								
							  </div> 					
							  <div class="form-group  " >
								<label for="Additional Info" class=" control-label col-md-3 text-left"> Additional Info </label>
								<div class="col-md-9">
								  <textarea name='to_additional_info' rows='5' id='to_additional_info' class='form-control '  
					   >{{ $row['to_additional_info'] }}</textarea> 
								 </div> 
								
							  </div>
							</fieldset>
						</div>
					</div>
					
					<div id="item-pnl">

						<div class="row items-pnl-head">
							<div class="col-sm-1 col">ACTION</div>
							<div class="col-sm-6 col extendable" style="text-align: left">PRODUCTS</div>
							<div class="col-sm-1 col">QUANTITY</div>
							<div class="col-sm-1 col">PRICE</div>
							<div class="col-sm-1 col taxCol">TAX</div>
							<div class="col-sm-1 col disCol">DISCOUNT</div>
							<div class="col-sm-1 col" style="border-right:0">TOTAL</div>
						</div>

						<div class="row items-pnl-body" id="item-row">
							<?php $pd=0; ?>
							@if(!empty($products))
								@foreach($products as $product)
								@if($pd>0)
								<div class="fieldwrapper">
								@endif
									<div class="col-sm-1 col">
										<p>
											@if($pd==0)
												<button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="" id="add" data-original-title="Add more">
													<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
												</button>
											@else
												<button type="button" onclick="removeItem('{{$pd}}')" class="btn btn-danger remItem" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"> 
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
												</button>
											@endif
										</p>
									</div>
									<div class="col-sm-6 col extendable">
										<input type="text" class="form-control firstCol req" name="proName[]" placeholder="Title" required="required" value="{{$product->product_title}}">
										<textarea class="form-control" style="margin: 5px -1px 0px 0px; width: 507px; height: 54px;" name="proDesc[]" placeholder="Description">{{$product->product_desc}}</textarea>
									</div>
									<div class="col-sm-1 col">
										<input type="text" class="form-control req amnt valid" value="{{$product->product_qty}}" name="amount[]" id="amount-{{$pd}}" onkeypress="return isNumber(event)" onkeyup="calTotal('{{$pd}}'),calSubtotal()" autocomplete="off" aria-required="true" aria-invalid="false">
									</div>
									<div class="col-sm-1 col">
										<div class="input-group">
											<div class="input-group-addon currenty">€</div>
											<input type="text" class="form-control req prc padoverwrite" name="price[]" id="price-{{$pd}}" onkeypress="return isNumber(event)" onkeyup="calTotal('{{$pd}}'),calSubtotal()" autocomplete="off" value="{{$product->product_price}}">
										</div>
									</div>
									<div class="col-sm-1 col taxCol">
										<div class="input-group">
											<input type="text" class="form-control vat padoverwrite" name="vat[]" id="vat-{{$pd}}" onkeypress="return isNumber(event)" onkeyup="calTotal('{{$pd}}'),calSubtotal()" autocomplete="off" value="{{$product->product_tax}}">
											<div class="input-group-addon default-addon-tax">%</div>
										</div>
									</div>
									<div class="col-sm-1 col disCol">
										<div class="input-group">
											<input type="text" class="form-control discount padoverwrite" name="discount[]" onkeypress="return isNumber(event)" id="discount-{{$pd}}" onkeyup="calTotal('{{$pd}}'),calSubtotal()" autocomplete="off" value="{{$product->product_discount}}">
											<div class="input-group-addon  default-addon">%</div>
										</div>
									</div>
									<div class="col-sm-1 col">
										<p><span class="currenty">€</span> <span class="ttlText" id="result-{{$pd}}">{{$product->product_total}}</span></p>
										<input type="hidden" class="ttInput" name="total[]" id="total-{{$pd}}" value="{{$product->product_total}}">
									</div>
									<div class="clearfix"></div>
								@if($pd>0)
								</div>
								@endif
									<?php $pd++; ?>
								@endforeach
							@else
								<div class="col-sm-1 col">
									<p>
										<button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="" id="add" data-original-title="Add more">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
									</p>
								</div>
								<div class="col-sm-6 col extendable">
									<input type="text" class="form-control firstCol req" name="proName[]" placeholder="Title" required="required" value="">
									<textarea class="form-control" style="margin: 5px -1px 0px 0px; width: 507px; height: 54px;" name="proDesc[]" placeholder="Description"></textarea>
								</div>
								<div class="col-sm-1 col">
									<input type="text" class="form-control req amnt valid" value="1" name="amount[]" id="amount-0" onkeypress="return isNumber(event)" onkeyup="calTotal('0'),calSubtotal()" autocomplete="off" aria-required="true" aria-invalid="false">
								</div>
								<div class="col-sm-1 col">
									<div class="input-group">
										<div class="input-group-addon currenty">{{$def_currency->content}}</div>
										<input type="text" class="form-control req prc padoverwrite" name="price[]" id="price-0" onkeypress="return isNumber(event)" onkeyup="calTotal('0'),calSubtotal()" autocomplete="off" value="">
									</div>
								</div>
								<div class="col-sm-1 col taxCol">
									<div class="input-group">
										<input type="text" class="form-control vat padoverwrite" name="vat[]" id="vat-0" onkeypress="return isNumber(event)" onkeyup="calTotal('0'),calSubtotal()" autocomplete="off" value="{{$def_tax->content}}">
										<div class="input-group-addon default-addon-tax">%</div>
									</div>
								</div>
								<div class="col-sm-1 col disCol">
									<div class="input-group">
										<input type="text" class="form-control discount padoverwrite" name="discount[]" onkeypress="return isNumber(event)" id="discount-0" onkeyup="calTotal('0'),calSubtotal()" autocomplete="off">
										<div class="input-group-addon  default-addon">%</div>
									</div>
								</div>
								<div class="col-sm-1 col">
									<p><span class="currenty">{{$def_currency->content}}</span> <span class="ttlText" id="result-0"></span></p>
									<input type="hidden" class="ttInput" name="total[]" id="total-0" value="0">
								</div>
								<div class="clearfix"></div>
							@endif
						</div>

					</div>
					
					<div class="row">
						<div class="col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8" id="tax-row">
							<div class="col-xs-2">
								<button type="button" class="btn btn-success" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="" id="addTax" data-original-title="Add Taxes, Shipping, Handling or Other Fees">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</button>
							</div>
							<div class="col-xs-5">
								<h1 class="subtotalCap">Sub Total</h1>
							</div>
							<div class="col-xs-5">
								<input type="hidden" value="{{($id>0)?$invoice->invoice_sub_total:''}}" id="subTotalInput" name="subtotal">
								<h1 class="subtotalCap">
									<span class="currenty lightMode">{{$def_currency->content}}</span>
									<span id="subTotal" class="lightMode">{{($id>0)?$invoice->invoice_sub_total:''}}</span>
								</h1>
							</div>
						</div>
						<div class="col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8">
							<div class="totalbill-row">
								<div class="col-xs-5 col-sm-offset-2">
									<h1>Total : </h1>
								</div>
								<div class="col-xs-5">
									<h1><span class="currenty">{{$def_currency->content}}</span> <span id="totalBill">{{($id>0)?$invoice->invoice_total_price:''}}</span></h1>
									<input type="hidden" value="{{($id>0)?$invoice->invoice_total_price:''}}" name="totalBill" id="totalBillInput">
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<fieldset>
					 		  <div class="form-group  " >
								<label for="Extra Notes" class=" control-label col-md-1 text-left"> Comments </label>
								<div class="col-md-11">
								  <textarea name='invoice_comment' rows='5' id='invoice_comment' class='form-control' placeholder='Use this space to add some more text e.g. Terms & Conditions or Bank Details etc etc'>{{ $row['invoice_comment'] }}</textarea> 
								 </div> 
								 
							  </div> 
							</fieldset>
						</div>
					</div>
					
					<div style="clear:both"></div>	
				
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" onclick="return generteSave();" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" onclick="return generteSave();" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('invoices?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					<button type="submit" onclick="return genertePdf();" class="btn btn-primary btn-sm "> Generate & Download Invoice </button>
					</div>	  
			
				  </div> 
					<input type="hidden" value="0" id="taxCounter" >
					<input type="hidden" value="{{$pd-1}}" name="counter" id="counter">
					<input type="hidden" value="€" name="currency" id="currencyInput" >
					<input type="hidden" value="%" name="taxformat" id="taxFormatInput">
					<input type="hidden" value="%" name="discountFormat" id="DisFormatInput">
					<input type="hidden" value="yes" name="applyTax" id="applyTaxInput">
					<input type="hidden" value="yes" name="applyDiscount" id="applyDiscount">
					<input type="hidden" value="true"  name="AccessFlag">
					<input type="hidden" value="save"  name="generate" id="generated">

		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});	
		
		$("#to_business_name").typeahead({
			name : 'business names',
			hint: true,
			highlight: true,
			remote: {
				url : "{{ URL::to('getBillTo/%QUERY')}}"
			}
			
		});

			calTotal('0');
			calSubtotal();
	});
	
	function genertePdf()
	{
		$('#generated').val('pdf');
		return true;
	}
	
	function generteSave()
	{
		$('#generated').val('save');
		return true;
	}
	
	function fillBillto(obj)
	{
		var custid = $(obj).val();
		$.ajax({
		  url: "{{ URL::to('getprofileBillto')}}",
		  type: "post",
		  data: "usercompnay="+custid,
		  dataType: "json",
		  success: function(data){
			  console.log(data);
			if(data!='error')
			{
				$('#to_address').val(data.company_address);
				$('#to_address2').val(data.company_address2);
				$('#to_email').val(data.company_email);
				$('#to_phone').val(data.company_phone);
			}
		  }
		});
	}
	</script>		 
@stop