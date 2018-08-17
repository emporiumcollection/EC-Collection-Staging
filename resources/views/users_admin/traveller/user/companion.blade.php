@extends('users_admin.traveller.layouts.app')

@section('page_name')
    My Companions  <small>Add Companion</small>
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
            <span class="m-nav__link-text"> My Companions </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4 bg-gray">
            <div class="row margin-top">
                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                    <h2>My Companions</h2>                
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-sm-8">
                            <h6>First Companion</h6>
                        </div>
                        <div class="col-sm-4">
                            <a href="#"><i class="fa fa-search fa-lg"></i></a>
                            <a href="#"><i class="fa fa-edit fa-lg"></i></a>
                            <a href="#"><i class="fa fa-trash fa-lg"></i></a>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                <div class="b2c-banner-text">My Companions</div>
                <img src="{{URL::to('images/companion.jpg')}}" style="width: 100%;" />
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Add Companion</h2>
                <p>Intro text</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="m-portlet m-portlet--full-height  ">
                    {!! Form::open(array('url'=>'user/savetravellerprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                        <div class="m-portlet__body">  
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						First Name
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="first_name" type="text" id="first_name" class="form-control m-input" value="" required />  
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Last Name
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="last_name" type="text" id="last_name" class="form-control m-input" required  value="" />  
            					</div>
            				</div>                                      
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Email
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="email" type="text" id="email" class="form-control m-input" required readonly="readonly"  value="" />  
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Phone Number
            					</label>
            					<div class="col-sm-12 col-md-7">
                                    <div class="input-group m-input-group m-input-group--square">
            							<div class="input-group-prepend">
            								<span class="input-group-text" id="basic-addon1">
            									
            								</span>
            							</div>
            							<input name="txtmobileNumber" type="text" id="txtmobileNumber" class="form-control m-input" required  value="" />
            						</div>    	
            						  
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Avatar
            					</label>
            					<div class="col-sm-12 col-md-7">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-primary btn-file">
                        			  	  <span class="fileinput-new">Upload Avatar Image</span>
                                          @if(!empty($info->avatar))
                                            <span class="fileinput-exists"> Change</span>
                                          @endif
                                            
                        					<input type="file" name="avatar">
                        				</span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                        <br /> 
                                        Image Dimension 80 x 80 px <br />                                       			
                            			
                                    </div>
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						I Am 
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<select class="form-control" id="gender" name="gender">
                                        <option value="Male" >Male</option>
                                        <option value="Female" >Female</option>
                                        <option value="Other" >Other</option>
                                    </select>
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Preferred Language
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<select class="form-control" id="prefer_communication_with" name="prefer_communication_with">
                                        <option value="en" >English</option>
                                        <option value="de" >Deutsch</option>                                                    
                                        <option value="es" >Espanol</option>                                                    
                                        <option value="fr" >Francais</option>                                                    
                                        <option value="it" >Italiano</option>                                                    
                                        <option value="nl" >Nederlands</option>                                                    
                                    </select>
                                    <span class="m-form__help">We'll send you messages in this language.</span>  
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Preferred Currency
            					</label>
            					<div class="col-sm-12 col-md-7">
                                <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
            						<select class="form-control" id="preferred_currency" name="preferred_currency">
                                        <option value="EUR">Currency</option>
                                        @foreach($currencyList as $currencyCode => $currencyName)
                                            
                                            <option value="{{ $currencyCode }}" title="{{ $currencyName }}" >{{ $currencyName }}
                                        </option>                                        
                                        @endforeach
                                    </select>
                                    <span class="m-form__help">Select the currency in which we display prices.</span> 
            					</div>
            				</div>
                            
                        <div class="m-portlet__foot m-portlet__foot--fit">
            				<div class="m-form__actions">
            					<div class="row">
            						<div class="col-sm-12 col-md-2"></div>
            						<div class="col-sm-12 col-md-7">
            							<button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
            								{{ Lang::get('core.sb_savechanges') }}
            							</button>
            						</div>
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