<link href="{{ asset('sximo/css/membershipPlans.css')}}" rel="stylesheet">
<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3>Membership Plans </h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">Membership Plans </li>
		  </ul>		
		</div>
		  
    </div>
</div>	

<div class="container">
	<div class="row text-center">
		<h3 class="text-center">MEMBERSHIP PLANS</h3>
		<div class="col-lg-12">
			Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum
		</div>
	</div>	
	<br><br>
	
	<div class="row">
		<!-- PRICING-TABLE CONTAINER -->
		<div class="pricing-table group">
			<?php $p=1; $clcor = array('personal','professional','business','other'); ?>
			@foreach($plans as $plan)
			<div class="col-lg-3">
				<div class="block {{$clcor[$p-1]}} fl">
					<h2 class="title">{{$plan->package_name}}</h2>
					<!-- CONTENT -->
					<div class="content">
						<p class="price">
							<span>${{$plan->package_price}}</span>
							<sub>/ {{$plan->package_duration}} months</sub>
						</p>
					</div>
					<!-- /CONTENT -->
					<h4>Package Size: {{$plan->package_size}}GB</h4>
					<h4 class="title">Package Modules:</h4>
					<!-- FEATURES -->
					<ul class="features">
						<?php $m=1; ?>
						@foreach($plan->modules as $moduls)
						<?php $cls = ($m%2==0)?'back':''; ?>
						<li class="{{$cls}}"><span class="fontawesome-cog"></span>{{$moduls->module_title}}</li>
						<?php $m++; ?>
						@endforeach
					</ul>
					<!-- /FEATURES -->
					<!-- PT-FOOTER -->
					<div class="pt-footer">
						<a href="{{url::to('user/register').'/'.$plan->id}}"><p>Sign Up</p></a>
					</div>
					<!-- /PT-FOOTER -->
				</div>
			</div>
			<?php ($p%4==0)?$p=1:$p++; ?>
			@endforeach
		</div>
		<!-- /PRICING-TABLE -->
	</div>
	
</div>