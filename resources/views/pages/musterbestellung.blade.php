<style>
	.panel{ border:none; background-color: transparent;  }
	.panel-default > .panel-heading { text-align:left; background-color: transparent; }
	.panel-body { padding: 0px; border-top:none !important; }
	.page-1-head { width:100% !important; }
	.material { margin-top:20px; padding: 0; }
	.material img { margin-bottom:10px; }
	.editContent p { text-align:left; }
	.downtxt {
		text-align: left;
		color: #000;
		margin-top: 30px;
		font-weight:bold;
	}
	.presehead { font-size:18px; margin-bottom:10px !important; }
	.panel-heading { padding-left: 0 !important; }
</style>
<div class="row new-box" >
	@if(!empty($musterbestellung_slider))
		<div class="container slider-con">
			<header id="intro-slider" class="intro-block full-slider no-sep feature-page-slider">
				<div id="carousel-full-header" class="carousel slide carousel-full" data-ride="carousel">
				
					<!-- Indicators -->
					<ol class="carousel-indicators">
					  <li data-target="#carousel-full-header" data-slide-to="0" class="active"></li>
					  @for($sl=1; $sl < count($musterbestellung_slider); $sl++)
						<li data-target="#carousel-full-header" data-slide-to="{{$sl}}"></li>
					  @endfor
					</ol>
				
					<div class="carousel-inner">
						@if(!empty($musterbestellung_slider))
						{{--*/ $s = 0 /*--}}
							@foreach($musterbestellung_slider as $slides)
								<div class="item {{($s==0)?'active':''}}">
									<div style="background-image: url('{{URL::to('uploads/slider_images/'.$slides->slider_img)}}');" class="cover-bg editBg">
											<div class="container double-padding">
												<div class="row">
													<div class="col-md-5 editContent slider-heading">
														<h2 class="big-title">{{$slides->slider_title}}</h2>
														<p><a href="{{$slides->slider_link}}">{{$slides->slider_description}}</a></p>
													</div>
												</div>
											</div>
										</div>
								</div>
								{{--*/ $s++ /*--}}
							@endforeach
						@endif
					</div>
					<!-- Controls -->
					  <a class="left carousel-control" href="#carousel-full-header" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#carousel-full-header" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
			</header>
			</div>
		</div>
	@endif

		
<div class="container2">
	<section data-selector="section" id="text-2col">
		<div class="row header-line about-sec">
			<h1 data-selector="h3" class="title product-title" style="margin-top:50px !important;">Musterbestellung</h1>
		</div>
	</section>
		
	<section id="text-1col">
		<div class="header-line about-sec MrgTop50">
			@if(!empty($shop['Musterbestellung']))
				 {!! Form::open(array('url'=>'shop_order', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
					<input type="hidden" name="return_url" value="{{ Request::url() }}" />
					<input type="hidden" name="order_page" value="Musterbestellung" />
					<div class="panel-group accordion" id="accordion">
						@foreach($shop['Musterbestellung'] as $muster)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$muster['data']->id}}">
											<i class="fa fa-arrow-right"></i> {{ (\Session::get('newlang')=='English') ?  $muster['data']->cat_name_eng : $muster['data']->cat_name }}
										</a>
									</h3>
								</div>
								<div id="collapse{{$muster['data']->id}}" class="panel-collapse collapse" style="height: auto;">
									<div class="panel-body PadLft20">
										@if(!empty($muster['detail']))
											<div class="MrgTop10">
												{!! (\Session::get('newlang')=='English') ? $muster['detail']->product_description_eng : $muster['detail']->product_description !!}
												
											@if($muster['detail']->product_pdf!='')
												<p class="MrgTop30"><a href="{{URL::to('uploads/shop_imgs/'.$muster['detail']->product_pdf)}}" title="{{$muster['detail']->product_pdf}}" download="{{$muster['detail']->product_pdf}}"> <i class="fa fa-download"></i> <span class="undrln">Download Musterbestellung</span></a></p>
											@endif
											</div>
										@endif
										
										@if(\Auth::check() == false)
											<p><a href="#" data-toggle="modal" data-target="#myModal" onclick="showLogin();"><b><i class="icon-users2"></i>{{ (\Session::get('newlang')=='English') ? 'You have to log in to place an Order' : 'bitte hier anmelden, um eine Bestellung zu tätigen' }}</b></a></p>
										@endif
										
										<p class="undrln MrgTop30"> <b>{{ (\Session::get('newlang')=='English') ? $muster['detail']->product_title_eng : $muster['detail']->product_title }}</b> </p>
										
										@if(!empty($muster['products']))
											<ul>
												@foreach($muster['products'] as $product)
													<li class="material col-xs-12 col-md-12 col-lg-12">
														@if(\Auth::check() == true)
															<input type="checkbox" name="order_products[]" class="order_products" value="{{$product->cat_id.'-'.$product->id}}" /> 
															<input type="hidden" name="order_qty[]" class="order_qty" value="1" />
														@endif
														<b>{{ (\Session::get('newlang')=='English') ? $product->title_eng : $product->title }}</b>
														<p>{!! (\Session::get('newlang')=='English') ? $product->description_eng : $product->description !!}</p>
													</li>
												@endforeach
											</ul>
										@endif
										
										<button class="btn btn-sm btn-primary MrgTop30" type="button" style="background: transparent; color: #000; border-bottom: 3px solid #000; font-weight: bold; font-size: 18px;" @if(\Auth::check() == false) data-toggle="modal" data-target="#myModal" onclick="showLogin();" @else onclick="shop_orders();" @endif>{{\Lang::get('core.menu_frontend_order_button')}}</button>
									</div>
								</div>
							</div>
							@if(end($shop['Musterbestellung'])!=$muster)
								<hr class="Hrmrg" />
							@endif
						@endforeach	
					</div>
				</form>
			@endif
		</div>
	</section>
</div>
<br>

<!-- Show reserve items-->
<div class="modal fade" id="showshopitems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:40px;">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Shop</h4>
	  </div>
	  <div class="modal-body">
		<p>Ihre Produkten :</p>
		<div class="row ord_items">
		
		</div>
	  </div>
	  <div class="modal-footer">
		<a href="{{URL::to('shoporders')}}" class="btn btn-primary">Ihre Bestellungen ansehen</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  </form>
	</div>
  </div>
</div>

<script>
	function shop_orders()
	{
		var lang = '<?php echo \Session::get('newlang'); ?>';
		var sList = "";
		var sQty = "";
		$('input[type=checkbox].order_products').each(function () {
			if(this.checked)
			{
				sList += (sList=="" ? $(this).val() : "," + $(this).val());
				sQty += (sQty=="" ? $(this).next('.order_qty').val() : "," + $(this).next('.order_qty').val());
			}
			
		});
		if(sList != '')
		{
			$.ajax({
			  url: "{{ URL::to('shop_order')}}",
			  type: "post",
			  data: "order_page=Musterbestellung&order_products="+sList+"&order_qtys="+sQty,
			  dataType: "json",
			  success: function(data){
				if(data.status=='error')
				{
					alert(data.errors);
				}
				else if(data.status=='success')
				{
					var newcont = '';
					var obj = data.shopitems;
					var dataMin = eval(obj.replace(/[\r\n]/, ""));
					
					$.each(dataMin, function(i, val)
					{
						newcont += '<div class="col-sm-12" style="text-align:left">';
						if(lang=='English')
						{
							newcont += '<b>'+val.title_eng+'</b><p>'+val.description_eng+'</p>';
						}
						else {
							newcont += '<b>'+val.title+'</b><p>'+val.description+'</p>';
						}
						newcont += '</div>';
					});
					
					$('.ord_items').append(newcont);
					$('#showshopitems').modal('show');
				}
			  }
			});
		}
		else{
			alert('Please select products first');
		}
	}
</script>
