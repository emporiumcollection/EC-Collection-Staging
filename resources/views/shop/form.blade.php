@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/css/custom_ps.css')}}" rel="stylesheet">
<!-- Step Form Wizard plugin -->
<link rel="stylesheet" href="{{ asset('sximo/css/frontend_templete/step-form-wizard/css/step-form-wizard-all.css')}}" type="text/css" media="screen, projection">
<script src="{{ asset('sximo/js/frontend_templete/step-form-wizard/js/step-form-wizard.js')}}"></script>
<style>
.leng { display:none; }
</style>
<script>
	$(document).ready(function () {
		$("#wizard_example").stepFormWizard({
			theme: 'circle' // sea, sky, simple, circle, sun
		});
	})
	/*$(window).load(function () {
		/* only if you want use mcustom scrollbar */
		/*$(".sf-step").mCustomScrollbar({
			theme: "dark-3",
			scrollButtons: {
				enable: true
			}
		});
	});*/
</script>
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('shop?return='.$return) }}">{{ $pageTitle }}</a></li>
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
			<div class="sbox-title"> 
				<h4> <i class="fa fa-table"></i> <span style="float:right;"> <a href="#" onclick="change_lang('dutch');">Deutsch</a> || <a href="#" onclick="change_lang('eng');">English</a></span></h4>
			</div>
			<div class="sbox-content"> 	

				 {!! Form::open(array('url'=>'shop/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ', 'id' => 'wizard_example')) !!}
					<div class="col-md-12">
						<fieldset>
							<legend> Basic Information</legend>
											
							  <div class="form-group hidethis " style="display:none;">
								<label for="Id" class=" control-label col-md-2 text-left"> Id </label>
								<div class="col-md-8">
								  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Page" class=" control-label col-md-2 text-left"> Page <span class="asterix"> * </span></label>
								<div class="col-md-8">
								  
								<?php $page = explode(',',$row['page']);
								$page_opt = array( 'Musterbestellung' => 'Musterbestellung' ,  'Pflegehinweise' => 'Pflegehinweise' , ); ?>
									<select name='page' id='page' rows='5' required  class='select2 ' onchange="shop_page_categories(this.value);"  > 
										<?php 
										foreach($page_opt as $key=>$val)
										{
											echo "<option  value ='$key' ".($row['page'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
										}						
										?>
									</select> 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Product Category" class=" control-label col-md-2 text-left"> Product Category <span class="asterix"> * </span></label>
								<div class="col-md-8">
									<?php $product_cat_id = explode(',',$row['product_cat_id']);
									?>
									<select name='product_cat_id' id='product_cat_id' rows='5' required  class='select2 '  > 
										<option value ="" >- Select category -</option>
									</select> 

								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group  " >
								<label for="Product Title" class=" control-label col-md-2 text-left"> Product Title <span class="asterix"> * </span></label>
								<div class="col-md-8">
								  {!! Form::text('product_title', $row['product_title'],array('class'=>'form-control ldutch', 'placeholder'=>'', 'required'=>'true'  )) !!}

								 {!! Form::text('product_title_eng', $row['product_title_eng'],array('class'=>'form-control leng', 'placeholder'=>'' )) !!} 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  <div class="form-group" >
								<label for="Product Description" class=" control-label col-md-2 text-left"> Product Description <span class="asterix"> * </span></label>
								<div class="col-md-8 ldutch">
								  <textarea name='product_description' rows='5' id='editor' class='form-control editor '  
					required >{{ $row['product_description'] }}</textarea> 
								 </div> 
								 
								 <div class="col-md-8 leng">
								  <textarea name='product_description_eng' rows='5' id='editor_eng' class='form-control editor ' >{{ $row['product_description_eng'] }}</textarea> 
								 </div>
								 <div class="col-md-2">
									
								 </div>
							  </div> 					
							  
						</fieldset>
						<fieldset>
							<legend>Products Information</legend>
							@if(!empty($fetch_products))
							{{--*/ $pr = 1; /*--}}
								@foreach($fetch_products as $product)
									<div class="clone{{$pr}}">
										<input type="hidden" name="edit_prd[]" value="{{$product->id}}">
										<div class="form-group" >
											<label for="Product {{$pr}}" class="control-label col-md-1 text-left"> Product {{$pr}} </label>
											<div class="col-md-10">
												<div class="row">
													<div class="col-md-6 MrgTop10">
														<input type="text" name="title[]" value="{{$product->title}}" placeholder="Product title" class="form-control ldutch" required="required">
														
														<input type="text" name="title_eng[]" value="{{$product->title_eng}}" placeholder="Product title" class="form-control leng">
													</div>
													<div class="col-md-6 MrgTop10">
														<textarea name="description[]" class="form-control ldutch" placeholder="Product Description" required="required">{{$product->description}}</textarea>
														
														<textarea name="description_eng[]" class="form-control leng" placeholder="Product Description">{{$product->description_eng}}</textarea>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 MrgTop10">
														<div class="col-md-6">
															<input  type='file' name='product_image[]' style='width:150px !important;'  />
															<div >
															{!! SiteHelpers::showUploadedFile($product->image,'/uploads/shop_imgs/',50,50) !!}
															
															</div>
														</div>
														<div class="col-md-6">
															<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId({{$pr}});">Choose from container</a>
															<input type="hidden" name="container_product_image_{{$pr}}" id="box{{$pr}}" value="">
															<span id="boxspan{{$pr}}"></span>
														</div>
													</div>
													<div class="col-md-6 MrgTop10">
														<input type="text" name="price[]" value="{{$product->price}}" placeholder="Product Price" class="form-control" required="required">
													</div>
												</div>
												<div class="row">
													<div class="col-md-6 MrgTop10">
														<input type="text" name="customdescription[]" value="{{$product->custom_description}}" class="form-control ldutch" placeholder="Description" />
														
														<input type="text" name="customdescription_eng[]" value="{{$product->custom_description_eng}}" class="form-control leng" placeholder="Description" />
													</div>
													<div class="col-md-6 MrgTop10">
													</div>
												</div>
											</div>
											<div class="col-md-1 butt">
												@if($product==end($fetch_products))
													<button type="button" onclick="addItem('{{$pr}}', '{{$product->id}}');" class="btn btn-success MrgTop10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
													<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
												</button>
												@else
													<button type="button" onclick="removeItem('{{$pr}}', '{{$product->id}}')" class="btn btn-danger MrgBot10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove">
														<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
													</button>
												@endif
											</div>
										</div>
									</div>
									{{--*/ $pr++; /*--}}
								@endforeach
							@else
								<div class="clone1">
									<input type="hidden" name="edit_prd[]" value="">
									<div class="form-group" >
										<label for="Product 1" class="control-label col-md-1 text-left"> Product 1 </label>
										<div class="col-md-10">
											<div class="row">
												<div class="col-md-6 MrgTop10">
													<input type="text" name="title[]" value="" placeholder="Product title" class="form-control ldutch" required="required">
													
													<input type="text" name="title_eng[]" value="" placeholder="Product title" class="form-control leng">
												</div>
												<div class="col-md-6 MrgTop10">
													<textarea name="description[]" class="form-control ldutch" placeholder="Product Description" required="required"></textarea>
													
													<textarea name="description_eng[]" class="form-control leng" placeholder="Product Description"></textarea>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 MrgTop10">
													<div class="col-md-6">
														<input  type='file' name='product_image[]' style='width:150px !important;'  />
														
													</div>
													<div class="col-md-6">
														<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(1);">Choose from container</a>
														<input type="hidden" name="container_product_image_1" id="box1" value="">
														<span id="boxspan1"></span>
													</div>
												</div>
												<div class="col-md-6 MrgTop10">
													<input type="text" name="price[]" value="" placeholder="Product Price" class="form-control" required="required">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 MrgTop10">
													<input type="text" name="customdescription[]" value="" class="form-control ldutch" placeholder="Description" />
													
													<input type="text" name="customdescription_eng[]" value="" class="form-control leng" placeholder="Description" />
												</div>
												<div class="col-md-6 MrgTop10">
												</div>
											</div>
										</div>
										<div class="col-md-1 butt">
											<button type="button" onclick="addItem('1', '0');" class="btn btn-success MrgTop10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more">
												<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
											</button>
										</div>
									</div>
								</div>
							@endif
						</fieldset>
						<fieldset>
							<legend>Final step</legend>
							<div class="form-group  " >
								<label for="Product Pdf" class=" control-label col-md-2 text-left"> Product Pdf </label>
								<div class="col-md-4">
								  <input  type='file' name='product_pdf' id='product_pdf' style='width:150px !important;'  />
									<div >
									{!! SiteHelpers::showUploadedFile($row['product_pdf'],'/uploads/shop_imgs/',50,50) !!}
									
									</div>					
				 
								 </div> 
								  <div class="col-md-4">
									<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId(0);">Choose from container</a>
									<input type="hidden" name="container_product_pdf" id="box0" value="">
									<span id="boxspan0"></span>
								 </div>
								 <div class="col-md-2">
									
								 </div>
							</div> 					
							<div class="form-group  " >
								<label for="Product Status" class=" control-label col-md-2 text-left"> Product Status <span class="asterix"> * </span></label>
								<div class="col-md-8">
								  
									<label class='radio radio-inline'>
									<input type='radio' name='product_status' value ='0' required @if($row['product_status'] == '0') checked="checked" @endif > Inactive </label>
									<label class='radio radio-inline'>
									<input type='radio' name='product_status' value ='1' required @if($row['product_status'] == '1') checked="checked" @endif > Active </label> 
								 </div> 
								 <div class="col-md-2">
									
								 </div>
							</div> 
						</fieldset>
					</div>
					
				 {!! Form::close() !!}
			</div>
		</div>		 
	</div>	
</div>	

<!-- open container Modal -->
<div class="modal fade" id="openContainer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">Select Image</h4>
		  </div>
		  <div class="modal-body">
			 <iframe id="iframe_id_123" src="{{URL::to('containeriframe').'/0/iframe'}}" style="height: 430px;width: 553px;border: none;"></iframe>
		  </div>
		  <div class="modal-footer">
			  <input type="hidden" name="boxid" id="boxid" value="">
			  <button type="button" class="btn btn-primary" onclick="selectimg();">ok</button>
			  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
		
		var page = $('#page').val();
		shop_page_categories(page);
		
	});
	
	function sendmotId(boxid)
	{
		$('#boxid').val(boxid);
	}
	
	function selectimg(obj)
	{
		var bid = $('#boxid').val();
		var sList='';
		var sListid='';
		var highrespath='';
		sList = $(obj).attr('rel2');
		imgname = $(obj).attr('rel');
		imagepath = $(obj).attr('rel3');
		$('#box'+bid).val(imagepath);
		$('#boxspan'+bid).html(imgname);
		$('#openContainer').modal('hide');
	}
	
	function addItem(id, prodID=0)
	{
		if(id!="")
		{
			$('.clone'+id+' .butt button').remove();
			var remBut = '<button type="button" onclick="removeItem('+id+', '+prodID+')" class="btn btn-danger MrgTop10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Remove" data-original-title="Remove"> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button>';
			$('.clone'+id+' .butt').append(remBut);
			var newid = parseInt(id) + 1;
			var html = '';
			
			html += '<div class="clone'+newid+'">';
			html += '<input type="hidden" name="edit_prd[]" value="">';
			html += '<div class="form-group" >';
			html += '<label for="Product '+newid+'" class=" control-label col-md-1 text-left"> Product '+newid+' </label>';
			html += '<div class="col-md-10">';
			html += '<div class="row">';
			html += '<div class="col-md-6 MrgTop10">';
			html += '<input type="text" name="title[]" value="" placeholder="Product title" class="form-control ldutch" required="required">';
			html += '<input type="text" name="title_eng[]" value="" placeholder="Product title" class="form-control leng">';
			html += '</div>';
			html += '<div class="col-md-6 MrgTop10">';
			html += '<textarea name="description[]" class="form-control ldutch" placeholder="Product Description" required="required"></textarea>';
			html += '<textarea name="description_eng[]" class="form-control leng" placeholder="Product Description"></textarea>';
			html += '</div>';
			html += '</div>';
			html += '<div class="row">';
			html += '<div class="col-md-6 MrgTop10">';
			html += '<div class="col-md-6">';
			html += '<input  type="file" name="product_image[]" style="width:150px !important;"  />';
			html += '</div>';
			html += '<div class="col-md-6">';
			html += '<a href="#" data-toggle="modal" data-target="#openContainer" onclick="sendmotId('+newid+');">Choose from container</a>';
			html += '<input type="hidden" name="container_product_image_'+newid+'" id="box'+newid+'" value="">';
			html += '<span id="boxspan'+newid+'"></span>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-md-6 MrgTop10">';
			html += '<input type="text" name="price[]" value="" placeholder="Product Price" class="form-control" required="required">';
			html += '</div>';
			html += '</div>';
			html += '<div class="row">';
			html += '<div class="col-md-6 MrgTop10">';
			html += '<input type="text" name="customdescription[]" value="" class="form-control ldutch" placeholder="Description" />';
			html += '<input type="text" name="customdescription_eng[]" value="" class="form-control leng" placeholder="Description" />';
			html += '</div>';
			html += '<div class="col-md-6 MrgTop10"></div>';
			html += '</div>';
			html += '</div>';
			html += '<div class="col-md-1 butt">';
			html += '<button type="button" onclick="addItem('+newid+', 0)" class="btn btn-success MrgTop10" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title="Add More" id="add" data-original-title="Add more"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
			html += '</div>';
			html += '</div>';
			html += '</div>';
			
			var hgt = $('.sf-viewport').css('height');
			var hgtinc = 160 + parseInt(hgt);
			$('.sf-viewport').css('height', hgtinc);
			$('.clone'+id).after(html);
		}
	}
	
	function removeItem(id, prodID)
	{
		if(id!="")
		{
			if(prodID!="" && prodID>0)
			{
				var conf = confirm('Are you sure you want to delete this product?');
				if(conf==true)
				{
					$.ajax({
					  url: "{{ URL::to('delete_shop_product')}}",
					  type: "post",
					  data: "prodID="+prodID,
					  success: function(data){
						if(data=='error')
						{
							alert('Product not found');
						}
						else if(data=='success')
						{
							$('.clone'+id).remove();
							var hgt = $('.sf-viewport').css('height');
							var hgtinc = parseInt(hgt) - 160;
							$('.sf-viewport').css('height', hgtinc);
						}
					  }
					});
				}
			}
			else{
				var hgt = $('.sf-viewport').css('height');
				var hgtinc = parseInt(hgt) - 160;
				$('.sf-viewport').css('height', hgtinc);
				$('.clone'+id).remove();
			}
			
		}
		
	}
	
	function shop_page_categories(page)
	{
		if(page!='')
		{
			$.ajax({
			  url: "{{ URL::to('getshopcategories')}}",
			  type: "post",
			  data: "page="+page,
			  dataType: "json",
			  success: function(data){
				var str_sel = '<option value ="" >- Select category -</option>';
				if(data.status!='error')
				{
					var cat_id = '<?php echo $row['product_cat_id']; ?>';
					$.each(data.cats, function(idx, obj) {
						var sel='';
						if(cat_id==obj.id) { sel = 'selected="selected"'; }
						str_sel += '<option value="'+obj.id+'" '+sel+' >'+obj.cat_name+'</option>';
					});
					$('#product_cat_id').html(str_sel);
					$('#product_cat_id').select2('val',cat_id);
				}
				else{
					$('#product_cat_id').html(str_sel);
				}
			  }
			});
		}
		
	}
	
	function change_lang(lang)
	{
		if(lang=='dutch')
		{
			$('.ldutch').css('display', 'block');
			$('.leng').css('display', 'none');
		}
		else if(lang=='eng')
		{
			$('.ldutch').css('display', 'none');
			$('.leng').css('display', 'block');
		}
	}
</script>		 
@stop