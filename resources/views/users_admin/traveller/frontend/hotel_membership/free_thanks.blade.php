@extends('users_admin.traveller.layouts.blank_app')

@section('page_name')
    
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
            
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								
							</h3>
						</div>
					</div>
				</div>
                
				<div class="m-portlet__body">
                    
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="b2c-banner-text">Thank You</div>
                                    <img src="{{URL::to('images/Emporium-Collection_21.jpg')}}" style="width: 100%;" />
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center padding-30">
                                    <h2 class="black-heading-big">Thank You</h2>
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <p>{!! nl2br($pkg_desc) !!}</p>
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                       
                                </div>  
                                                                                                     
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    
                                    <div class="row padding-30 m--align-center" style="margin-right: 25px;">                                        
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12"><a href="{{ URL::to('userorderdownloadinvoicepdf/'.$order_id)}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i> Download Your Invoice</a></div>                                        
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--margin-top-30"><a href="{{ URL::to('dashboard')}}" class="tips btn btn-xs btn-primary"><i class="flaticon-imac"></i> Go to Dashboard</a></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection
{{-- For custom style  --}}
@section('style')    
    <style>
    .black-heading-big {
        color: #ABA07C;
        font-family: ACaslonPro-Regular;
        font-size: 36px;
        text-align: center;
        font-weight: 700;
    }
    </style>
@endsection