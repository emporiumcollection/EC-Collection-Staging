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
                    {!! Form::open(array('url'=>'user/savetravellerprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">								
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Enter email address">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">
											Send Invite
										</button>
									</div>
								</div>
							</div> 
                        </div> 
            		{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop