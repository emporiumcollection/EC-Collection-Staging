@extends('users_admin.metronic.layouts.app')

@section('page_name')
    Account  <small>Enter Your Info</small>
@stop

@section('content')
	<div class="row">
        <div class="col-md-12 col-xs-12">
       	    <div class="m-portlet m-portlet--full-height">
            
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption">
						<div class="m-portlet__head-title">
							<h3 class="m-portlet__head-text">
								Your Packages
							</h3>
						</div>
					</div>
				</div>
                
				<div class="m-portlet__body">
                    
                    <div class="m-section">
                        <div class="m-section__content">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    <img src="{{URL::to('images/800x200.png')}}" style="width: 100%;" />
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                    <h2 class="black-heading-big">Thank You</h2>
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ornare diam at convallis lacinia. Duis a sapien et erat finibus molestie eu id nisi. Integer nibh elit, blandit ac volutpat eget, tempus eget enim. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas mollis dictum risus. Vivamus aliquam at elit non dictum. Integer nisi ante, interdum at purus vitae, rhoncus bibendum dui. Praesent pharetra augue at ultrices facilisis. Vestibulum erat urna, iaculis et purus in, fermentum varius nibh.
                                </div> 
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                       
                                </div>                                                                                                                                       
                                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 pref-top-pad">
                                    <div class="row">                                
                                        <div class="col-xs-2 col-sm-2 m--align-right">
                                            First Name:
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <?php echo $user->first_name; ?>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 m--align-right">
                                            Last Name:
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <?php echo $user->last_name; ?>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 m--align-right">
                                            E-mail:
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <?php echo $user->email; ?>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 m--align-right">
                                            Mobile No:
                                        </div>
                                        <div class="col-xs-4 col-sm-4">
                                            <?php echo $user->mobile_number; ?>
                                        </div>
                                    </div>
                                    <div class="row m--align-center">
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 pref-top-pad">Thank you for submitting your information.</div> 
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 pref-top-pad"><a href="{{ URL::to('userorder_downloadinvoicepdf/'.$order_id)}}" class="tips btn btn-xs btn-primary"><i class="fa  icon-file-pdf "></i>Download Your Invoice</a></div>
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