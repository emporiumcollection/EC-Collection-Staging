@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Invite Guests
@stop

@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="javascript:;" class="m-nav__link"> 
            <span class="m-nav__link-text"> Invite Guests </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                <h2>Invited Guests</h2>                
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-sm-8">
                        <h6>Invited Guests</h6>
                    </div>
                    <div class="col-sm-4">
                        <a href="#"><i class="fa fa-search fa-lg"></i></a>
                        <a href="#"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="#"><i class="fa fa-trash fa-lg"></i></a>
                    </div>
                </div>              
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad m--align-center">
                <div class="m-card-profile__pic">
                    <div class="m-card-profile__pic-wrapper">
						<img src="{{URL::to('images/800x450.png')}}" style="width: 100%;" />
					</div>
				</div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Invite your friends</h2>
                <p>Intro text for invite friends</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if(Session::has('message'))
            				{!! Session::get('message') !!}
            			@endif
                    </div>
                    {!! Form::open(array('url'=>'user/invite/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
								<div class="col-lg-6">
									<label>
										First name *
									</label>
									<div class="m-input-icon m-input-icon--right">
										<input type="text" name="first_name" class="form-control m-input" placeholder="Enter invitee first name">
                                        <span class="error">{{ $errors->first('first_name') }}</span>
									</div>
								</div>
								<div class="col-lg-6">
									<label class="">
										Last Name *
									</label>
									<div class="m-input-icon m-input-icon--right">
										<input type="text" name="last_name" class="form-control m-input" placeholder="Enter invitee last name">
                                        <span class="error">{{ $errors->first('last_name') }}</span>
									</div>
								</div>
							</div>
                            <div class="form-group m-form__group row">	
                                <div class="col-lg-12">							
								    <label>
										Email *
									</label>
									<div class="m-input-icon m-input-icon--right">
										<input type="text" name="email" class="form-control m-input" placeholder="Enter invitee email address">
                                        <span class="error">{{ $errors->first('email') }}</span>
									</div>
                                </div>
							</div> 
                            <div class="form-group m-form__group row">	
                                <div class="col-lg-12">							
								    <label>
										Message
									</label>
									<div class="m-input-icon m-input-icon--right">
										<textarea name="message" class="form-control"></textarea>
                                        <span class="m-form__help">Defalut message will be send if you do not enter message.</span>
									</div>
                                </div>
							</div> 
                            <div class="col-sm-12 col-md-12 col-lg-12 m--align-right">
                                <button type="submit" class="btn btn-primary" id="btn_send_invites">Send Invites</button>
                            </div>
                        </div> 
            		{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('custom_js_script')
    <script>
        /*$(document).ready(function(){
           $("#btn_send_invites").click(function(){ console.log("ff23");
                var fdata = $( "form" ).serialize();
                $.ajax({
                    url:"{{URL::to('user/invite')}}",
                    type:'POST',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:fdata,
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            current_fs = $("#preferences_submit_btn").closest( ".personalized-pefrences" );
                            next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
                            current_fs.addClass('m--hide');
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });
           }); 
        });*/
    </script>
@stop