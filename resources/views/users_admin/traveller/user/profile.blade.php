@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Account  <small>View Detail My Info</small>
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
            <span class="m-nav__link-text"> Account </span> 
        </a> 
    </li>
@stop

@section('content')
	<div class="row">
        @if(Session::has('message'))	  
    		   {!! Session::get('message') !!}
    	@endif
        
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
		<div class="col-xl-3 col-lg-4">
			<div class="m-portlet m-portlet--full-height  ">
				<div class="m-portlet__body">
					<div class="m-card-profile">
						<div class="m-card-profile__title m--hide">
							Your Profile
						</div>
						<div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
								{!! SiteHelpers::avatarProfile(80,80,'') !!}
							</div>
						</div>
						<div class="m-card-profile__details">
							<span class="m-card-profile__name">
								{{ Session::get('fid') }}
							</span>
							<a href="#" onclick="return false;" class="m-card-profile__email m-link">
								{{ Session::get('eid') }}
							</a>
						</div>
					</div>
                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary m-nav m-nav--hover-bg m-portlet-fit--sides _nav-profile" role="tablist">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
						<li class="m-nav__section m--hide">
							<span class="m-nav__section-text">
								Section
							</span>
						</li>
						<li class="m-nav__item nav-item m-tabs__item">
                            <a href="#myprofile" class="m-nav__link nav-link m-tabs__link active" data-toggle="tab" role="tab">
								<i class="m-nav__link-icon flaticon-profile-1"></i>
								<span class="m-nav__link-title">
									<span class="m-nav__link-wrap">
										<span class="m-nav__link-text">
											Personal Information
										</span>
									</span>
								</span>
							</a>
						</li>						
					</ul>
                    
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="tab-content">
        			<div class="tab-pane active" id="myprofile">
                    	<div class="m-portlet__head">
        					<div class="m-portlet__head-tools">
        						<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link active" data-toggle="tab" href="#info" role="tab">
        									<i class="flaticon-share m--hide"></i>
        									Personal Information
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#pass" role="tab">
        									Change Password
        								</a>
        							</li>
        							<li class="nav-item m-tabs__item">
        								<a class="nav-link m-tabs__link" data-toggle="tab" href="#preferences" role="tab">
        									Personalized Preferences
        								</a>
        							</li>
        						</ul>
        					</div>
        				</div>
        				<div class="tab-content">
        					<div class="tab-pane active" id="info">
                                {!! Form::open(array('url'=>'user/savetravellerprofile/', 'class'=>'m-form m-form--fit m-form--label-align-right ' ,'files' => true)) !!}
                                    <div class="m-portlet__body">  
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										First Name
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="first_name" type="text" id="first_name" class="form-control m-input" required  value="{{ $info->first_name }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Last Name
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="last_name" type="text" id="last_name" class="form-control m-input" required  value="{{ $info->last_name }}" />  
        									</div>
        								</div>                                      
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Email
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="email" type="text" id="email" class="form-control m-input" required readonly="readonly"  value="{{ $info->email }}" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Phone Number
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="txtmobileNumber" type="text" id="txtmobileNumber" class="form-control m-input" required  value="{{ $info->mobile_number }}" />  
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
                                        			{!! SiteHelpers::showUploadedFile($info->avatar,'/uploads/users/',80,80) !!}
                                                </div>
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										I Am 
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<select class="form-control" id="gender" name="gender">
                                                    <option value="Male" <?php echo $info->gender=="Male" ? "selected='selected'" : "" ?> >Male</option>
                                                    <option value="Female" <?php echo $info->gender=="Female" ? "selected='selected'" : "" ?>>Female</option>
                                                    <option value="Other" <?php echo $info->gender=="Other" ? "selected='selected'" : "" ?>>Other</option>
                                                </select>
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										Preferred Language
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<select class="form-control" id="prefer_communication_with" name="prefer_communication_with">
                                                    <option value="en"  <?php echo $info->prefer_communication_with=="en" ? "selected='selected'" : "" ?>>English</option>
                                                    <option value="id"  <?php echo $info->prefer_communication_with=="id" ? "selected='selected'" : "" ?> >Bahasa Indonesia</option>
                                                    <option value="ms"  <?php echo $info->prefer_communication_with=="ms" ? "selected='selected'" : "" ?>>Bahasa Melayu</option>
                                                    <option value="ca"  <?php echo $info->prefer_communication_with=="ca" ? "selected='selected'" : "" ?>>Catala</option>
                                                    <option value="da"  <?php echo $info->prefer_communication_with=="da" ? "selected='selected'" : "" ?>>Dansk</option>
                                                    <option value="de"  <?php echo $info->prefer_communication_with=="de" ? "selected='selected'" : "" ?>>Deutsch</option>
                                                    
                                                    <option value="es"  <?php echo $info->prefer_communication_with=="es" ? "selected='selected'" : "" ?>>Espanol</option>
                                                    <option value="el"  <?php echo $info->prefer_communication_with=="el" ? "selected='selected'" : "" ?>>E???????</option>
                                                    <option value="fr"  <?php echo $info->prefer_communication_with=="fr" ? "selected='selected'" : "" ?>>Francais</option>
                                                    <option value="hr"  <?php echo $info->prefer_communication_with=="hr" ? "selected='selected'" : "" ?>>Hrvatski</option>
                                                    <option value="it"  <?php echo $info->prefer_communication_with=="it" ? "selected='selected'" : "" ?>>Italiano</option>
                                                    <option value="hu"  <?php echo $info->prefer_communication_with=="hu" ? "selected='selected'" : "" ?>>Magyar</option>
                                                    <option value="nl"  <?php echo $info->prefer_communication_with=="nl" ? "selected='selected'" : "" ?>>Nederlands</option>
                                                    <option value="no"  <?php echo $info->prefer_communication_with=="no" ? "selected='selected'" : "" ?>>Norsk</option>
                                                    <option value="pl"  <?php echo $info->prefer_communication_with=="pl" ? "selected='selected'" : "" ?>>Polski</option>
                                                    <option value="pt"  <?php echo $info->prefer_communication_with=="pt" ? "selected='selected'" : "" ?>>Portugues</option>
                                                    <option value="fi"  <?php echo $info->prefer_communication_with=="fi" ? "selected='selected'" : "" ?>>Suomi</option>
                                                    <option value="sv"  <?php echo $info->prefer_communication_with=="sv" ? "selected='selected'" : "" ?>>Svenska</option>
                                                    <option value="tr"  <?php echo $info->prefer_communication_with=="tr" ? "selected='selected'" : "" ?>>Turkce</option>
                                                    <option value="is"  <?php echo $info->prefer_communication_with=="is" ? "selected='selected'" : "" ?>>Islenska</option>
                                                    <option value="cs"  <?php echo $info->prefer_communication_with=="cs" ? "selected='selected'" : "" ?>>Cestina</option>
                                                    <option value="ru"  <?php echo $info->prefer_communication_with=="ru" ? "selected='selected'" : "" ?>>???????</option>
                                                    <option value="th"  <?php echo $info->prefer_communication_with=="th" ? "selected='selected'" : "" ?>>???????</option>
                                                    <option value="zh"  <?php echo $info->prefer_communication_with=="zh" ? "selected='selected'" : "" ?>>?? (??)</option>
                                                    <option value="zh-TW"  <?php echo $info->prefer_communication_with=="zh-TW" ? "selected='selected'" : "" ?>>?? (??)</option>
                                                    <option value="ja"  <?php echo $info->prefer_communication_with=="ja" ? "selected='selected'" : "" ?>>???</option>
                                                    <option value="ko"  <?php echo $info->prefer_communication_with=="ko" ? "selected='selected'" : "" ?>>???</option>
                                                </select>
                                                  
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
                                                        
                                                        <option value="{{ $currencyCode }}" title="{{ $currencyName }}" {{  $info->preferred_currency == $currencyCode ? 'selected' : ''}} >{{ $currencyName }}
                                                    </option>                                        
                                                    @endforeach
                                                </select>
                                                 
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
        					<div class="tab-pane " id="pass">
                                {!! Form::open(array('url'=>'user/savepassword/', 'class'=>'m-form m-form--fit m-form--label-align-right ')) !!}
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.newpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password" type="password" id="password" class="form-control m-input" required  value="" />  
        									</div>
        								</div>
                                        <div class="form-group m-form__group row">
        									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
        										{{ Lang::get('core.conewpassword') }}
        									</label>
        									<div class="col-sm-12 col-md-7">
        										<input name="password_confirmation" type="password" id="password_confirmation" class="form-control m-input" required  value="" />  
        									</div>
        								</div> 
                            		</div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
        								<div class="m-form__actions">
        									<div class="row">
        										<div class="col-sm-12 col-md-2"></div>
        										<div class="col-sm-12 col-md-7">
        											<button type="submit" class="btn btn-danger m-btn m-btn--air m-btn--custom">
        												{{ Lang::get('core.sb_savechanges') }}
        											</button>
        										</div>
        									</div>
        								</div>
        							</div>   
                            		
                        		{!! Form::close() !!}
                            </div>
        					<div class="tab-pane " id="preferences">
                                <form action="{{URL::to('personalized-service/save')}}" method="POST">
                                                            
                                        <div class="personalized-pefrences pref-top-pad">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <h2 class="black-heading-big">Where do you want to travel?</h2>
                                                <p class="sub-des-heading">You can specify one or more destinations</p>
                                            </div>
                                            
								            <div class="col-xl-12 col-lg-12">
                                               <div class="choosen-input-align">
                                                    <select name="destinations[]" data-placeholder="Ex: Argentina, South Africa, Cape Town" class="form-control chosen-select-default chosen-select-input-style" multiple tabindex="4" id="destinationSelect">
                                                        <?php
                                                        if(!empty($destinations)) {
                                                            foreach ($destinations as $destination) {
                                                                echo '<option value="'.$destination['id'].'">'.$destination['name'].'</option>'.PHP_EOL;
                                                                /*if(!empty($destination->sub_destinations)) {
                                                                    foreach ($destination->sub_destinations as $sub_destination) {
                                                                        echo '<option value="'.$sub_destination->id.'">'.$sub_destination->category_name.'</option>'.PHP_EOL;
                                                                        if(!empty($sub_destination->sub_destinations)) {
                                                                            foreach ($sub_destination->sub_destinations as $sub_dest) {
                                                                                echo '<option value="'.$sub_dest->id.'">'.$sub_dest->category_name.'</option>'.PHP_EOL;
                                                                            }
                                                                        }
                                                                    }
                                                                }*/
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <div class="wrong-selection-pannel">
                                                    <p class="sub-des-heading wrong-selected-text">We can not make travel arrangements to "Delhi".</p>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-right pref-top-pad">
                                                <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="personalized-pefrences m--hide pref-top-pad">
                                        <div class="row">
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                            <h2 class="black-heading-big">What inspires you?</h2>
                                        </div>
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                            <div class="row inspiration" id="inspiration">
                                            <?php
                                            if(!empty($inspirations)) {
                                                foreach ($inspirations as $inspiration) {
                                                    ?>
                                                    <div class="col-md-3 col-sm-6">
                                                        
                                                                <label for="inspiration_{{$inspiration->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$inspiration->category_image)}}');" class="personalized-service-checkbox-label">
                                                                    <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$inspiration->category_name}}
                                                                </label>
                                                                <input id="inspiration_{{$inspiration->id}}" class="personalized-service-checkbox-input" name="inspirations[]" value="{{$inspiration->id}}" type="checkbox">
                                                            
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?> 
                                            </div>                                                                   
                                        </div>
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left">                   
                                                    <input type="button" name="previous" data-prev-id="holiday-destination" holiday-destination class="previous btn btn-default" value="Previous" />
                                                </div>
                                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right">
                                                    <input type="button" name="next"  data-next-id="travel-style" class="next btn btn-default" value="Continue" />
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="personalized-pefrences m--hide pref-top-pad">
                                        <div class="row" id="experience">
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <h2 class="black-heading-big">What would you like experience</h2>
                                            </div>
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <div class="row exprerience">
                                                    <?php
                                                    if(!empty($experiences)) {
                                                        foreach ($experiences as $experience) {
                                                            ?>
                                                            <div class="col-md-3 col-sm-6">
                                                                
                                                                    <div class="form-group ps-fields-align">
                                                                        <label for="experience_{{$experience->id}}" style="background-image: url('{{URL::to('uploads/category_imgs/'.$experience->category_image)}}');" class="personalized-service-checkbox-label">
                                                                            <span class="selected-chexkbox"><i class="fa fa-check" aria-hidden="true"></i></span>{{$experience->category_name}}
                                                                        </label>
                                                                        <input id="experience_{{$experience->id}}" class="personalized-service-checkbox-input" name="experiences[]" value="{{$experience->id}}" type="checkbox">
                                                                    </div>
                                                                
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                <div class="row">
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                        <input type="button" name="previous" data-prev-id="travel-style"  class="previous btn btn-default" value="Previous" />                           
                                                    </div>
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                        <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                    </div>                                                                        
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="personalized-pefrences m--hide pref-top-pad">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <h2 class="black-heading-big">What is particularly important to you?</h2>
                                                <p class="sub-des-heading">Tell us what you value - the more detailed the better.</p>
                                            </div>
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                <textarea class="form-control ps-text-area-style" name="note" placeholder="Further comments or wishes? A concrete trip tour, a special occasion such as A honeymoon." id="preferences_note"></textarea>
                                            </div> 
                                            
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 help-hover-icon">
                                                <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Your callback date can be selected in last step"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                            </div>
                                        
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                <div class="row">
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                        <input type="button" name="previous" data-prev-id="travel-style" class="previous btn btn-default" value="Previous" />
                                                    </div>
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                        <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="personalized-pefrences m--hide pref-top-pad">
                                        <div class="row">                                                                
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <h2 class="black-heading-big">How many people travel?</h2>
                                            </div>
                                        </div>   
                                        <div class="row m--align-center pref-botoom-pad">
                                            <div class="col-md-6 col-sm-6">
                                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Adults</p>
                                                <p class="smalldes-label">18* Years</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="ps-adults-handle-counter ps-handle-counter">
                                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                    <input class="spinner-input" name="adults" type="text" value="2" id="adults">
                                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m--align-center pref-botoom-pad">
                                            <div class="col-md-6 col-sm-6">
                                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Youth</p>
                                                <p class="smalldes-label">12-17 Years</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="ps-youth-handle-counter ps-handle-counter">
                                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                    <input class="spinner-input" name="youth" type="text" value="0" id="youth">
                                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                </div>
                                            </div>                                                                    
                                        </div>
                                        <div class="row m--align-center pref-botoom-pad">
                                            <div class="col-md-6 col-sm-6">
                                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">Children</p>
                                                <p class="smalldes-label">2-11 Years</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="ps-children-handle-counter ps-handle-counter">
                                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                    <input class="spinner-input" name="children" type="text" value="0" id="children">
                                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m--align-center pref-botoom-pad"> 
                                            <div class="col-md-6 col-sm-6">
                                                <p class="sub-des-heading suggestions-headin-tittle spinner-label">toddlers</p>
                                                <p class="smalldes-label">under 2 Years</p>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="ps-toddlers-handle-counter ps-handle-counter">
                                                    <button type="button" class="spinner-btns counter-minus btn btn-primary">-</button>
                                                    <input class="spinner-input" name="toddlers" type="text" value="0" id="toddlers">
                                                    <button type="button" class="spinner-btns counter-plus btn btn-primary">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                    <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                                </div>
                                                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                    <input type="button" name="next"  data-next-id="details" class="next btn btn-default" value="Continue" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="personalized-pefrences m--hide pref-top-pad">
                                        <div class="row">
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center">
                                                <h2 class="black-heading-big">When would you like to travel?</h2>
                                            </div>
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                                                <div id="t-preferences-picker" class="rsidebar datepic-max-width t-datepicker">
                                                    
                                                        <div class="t-check-in"></div>
                                                        <div class="t-check-out"></div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control ps-input-style ps-input-width" name="stay_time" id="stay_time">
                                                        <option value="1-2 Weeks">1-2 Weeks</option>
                                                        <option value="2-3 Weeks">2-3 Weeks</option>
                                                        <option value="3-4 Weeks">3-4 Weeks</option>
                                                        <option value="4-5 Weeks">4-5 Weeks</option>
                                                    </select>
                                                </div>
                                                <div class="form-group pref-left-pad-10"> 
                                                    <div class="m-checkbox-list"> 
														<label class="m-checkbox m-checkbox--state-primary">
															<input type="checkbox" name="agree" id="agree" />
															I Agree
															<span></span>
														</label>
													</div>
                                                    <div class="error" id="error" style="display: none;">
                                                        Please check agree checkbox.
                                                    </div>
                                                    <span class="m-form__help">
														Some help text goes here
													</span>                                                                            
                                                </div>
                                                <div class="form-group pref-left-pad-10">
                                                    <div class="m-checkbox-list">
														<label class="m-checkbox m-checkbox--state-primary">
															<input type="checkbox" name="privacy_policy" id="privacy_policy" />
															<a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Privacy Policy</a>
															<span></span>
														</label>
                                                    </div>
                                                    <span class="m-form__help">
														Some help text goes here
													</span>
                                                 </div>            
												 <div class="form-group pref-left-pad-10">
                                                    <div class="m-checkbox-list">
                                                    	<label class="m-checkbox m-checkbox--state-primary">
															<input type="checkbox" name="cookie_policy" id="cookie_policy" />
															<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
															<span></span>
														</label>
                                                    </div>
                                                    <span class="m-form__help">
														Some help text goes here
													</span>
                                                 </div>
                                            </div>
                                            <div class="help-hover-icon">
                                                <a class="custom-tooltip" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season." data-original-title="Of course, we will let you know if the chosen travel period coincides with local holidays, festivals, high season or an unfavorable season."><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                            </div>
                                            
                                            
                                            
                                            <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12 m--align-center pref-top-pad">
                                                <div class="row">
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-left"> 
                                                        <input type="button" name="previous" data-prev-id="details" class="previous btn btn-default" value="Previous" />
                                                    </div>
                                                    <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 m--align-right"> 
                                                        <button class="btn btn-default" id="preferences_submit_btn">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                            
                                </form> 
                            </div>
        				</div>
                    </div><!-- // myprofile -->
            
                </div><!-- /tab-content -->
			</div><!-- //tabs -->

		</div>
	</div>
@stop

{{-- For custom style  --}}
@section('style')
    @parent
    <link href="{{ asset('themes/emporium/daterangepicker/css/t-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/emporium/daterangepicker/css/themes/t-datepicker-bluegrey.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('sximo/assets/css/chosen.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/css/personalized.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('custom_js_script')
<script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
<script src="{{ asset('themes/emporium/daterangepicker/js/t-datepicker.js') }}"></script>
<script src=" {{ asset('sximo/assets/js/chosen.jquery.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/init.js') }} " type="text/javascript"></script>
<script src=" {{ asset('sximo/assets/js/handleCounter.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        // Multi Tab Form
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;

        $(".next").click(function () {                    
            current_fs = $(this).closest( ".personalized-pefrences" );
            next_fs = $(current_fs).next(".personalized-pefrences").removeClass('m--hide');                    
            current_fs.addClass('m--hide');                    
        });

        $(".previous").click(function () {                    
            current_fs = $(this).closest( ".personalized-pefrences" );
            next_fs = $(current_fs).prev(".personalized-pefrences").removeClass('m--hide');                    
            current_fs.addClass('m--hide');     
        });

        $(".submit").click(function () {
            return false;
        });
        
        $('#t-preferences-picker').tDatePicker({
            'numCalendar':'1',
            'autoClose':true,
            'durationArrowTop':'200',
            'formatDate':'dd-mm-yyyy',
            'titleCheckIn':'Earliest Arrival',
            'titleCheckOut':'Late Check Out',
            'inputNameCheckIn':'preferences_arrive',
            'inputNameCheckOut':'preferences_late_check_out',
            'titleDateRange':'days',
            'titleDateRanges':'days',
            'iconDate':'<i class="fa fa-calendar"></i>',
            'limitDateRanges':'365',
            'dateCheckIn':'@if(isset($_GET['arrive']) && $_GET['arrive']!=''){{$_GET['arrive']}}@else{{'null'}}@endif',
            'dateCheckOut':'@if(isset($_GET['departure']) && $_GET['departure']!=''){{$_GET['departure']}}@else{{'null'}}@endif'
        });
        
        
        $('.personalized-service-checkbox-label').click(function (e) {
            $(this).toggleClass('active').siblings().removeClass('active');
        });
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
        //Input Spinner
        var options = {
            minimum: 1,
            maximize: 10,
            onMinimum: function (e) {
                console.log('reached minimum: ' + e);
            },
            onMaximize: function (e) {
                console.log('reached maximize' + e);
            }
        };
        
        $('.ps-adults-handle-counter').handleCounter({minimum:1, maximize: 100});
        $('.ps-youth-handle-counter').handleCounter({minimum:0, maximize: 100});
        $('.ps-children-handle-counter').handleCounter({minimum:0, maximize: 100});
        $('.ps-toddlers-handle-counter').handleCounter({minimum:0, maximize: 100});
        
        
    });
</script>
        
    
<script>
$(document).ready(function(){
    $("#preferences_submit_btn").click(function(e){ 
        e.preventDefault();
        
        var destinations=[];
        var i = 0;
        $('#destinationSelect :selected').each(function(){
             destinations[i]=$(this).val();
             i++;
        });
        
        var insperations=[];
        var j = 0;
        $('#inspiration .personalized-service-checkbox-input:checked').each(function () {
           insperations[j] = $(this).val();
           j++;
        }); 
        
        var experiences=[];
        var k = 0;
        $('#experience .personalized-service-checkbox-input:checked').each(function () {
           experiences[k] = $(this).val();
           k++;
        }); 
        
        var note = $("#preferences_note").text();
        
        var error = true;
        if($("#agree").is(":checked")){
            error = false;
        }
        if(error){ console.log("error");
            $("#error").css("display", "");
        }else{                    
            $("#error").css("display", "none");
            var fdata = new FormData();                
            fdata.append("_token",$("input[name=_token]").val());
            fdata.append("form_wizard",$("input[name=form_wizard_2]").val()); 
            
            fdata.append("destinations", destinations); 
            fdata.append("inspirations", insperations);
            fdata.append("experiences", experiences);
            fdata.append("note", note);
            fdata.append("adults",$("input[name=adults]").val());
            fdata.append("youth",$("input[name=youth]").val());
            fdata.append("children",$("input[name=children]").val());
            fdata.append("toddlers",$("input[name=toddlers]").val());
            
            
            fdata.append("earliest_arrival",$("input[name=preferences_arrive]").val());
            fdata.append("late_check_out",$("input[name=preferences_late_check_out]").val());
            
            var stay_time=[];
            $('#stay_time :selected').each(function(){
                 stay_time[$(this).val()]=$(this).text();
            });
            
            fdata.append("stay_time",stay_time);
            $.ajax({
                url:"{{URL::to('personalized-service/ajax_save')}}",
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
                        //window.location.href="{{URL::to('dashboard')}}";
                    }
                    else{
                        toastr.error(response.message);
                    }
                }
            }); 
        }
   });
});

$('input[type="checkbox"][id="copyadd"]').on('ifChecked', function(){
	$('#billing_address').val($('#shipping_address').val());
	$('#billing_address2').val($('#shipping_address2').val());
	$('#billing_city').val($('#shipping_city').val());
	$('#billing_postal_code').val($('#shipping_postal_code').val());
	$('#billing_country').val($('#shipping_country').val());
});

function fillProfile(obj)
{
	var custid = $(obj).val();
	$.ajax({
	  url: "{{ URL::to('getUserprofile')}}",
	  type: "post",
	  data: "customer="+custid,
	  dataType: "json",
	  success: function(data){
		if(data!='error')
		{
			$('#company_phone').val(data.phone);
			$('#company_email').val(data.email);
			$('#company_postal_code').val(data.zip);
			$('#comapny_address').val(data.street);
			$('#company_name').val(data.shoptitle);
			$('#company_city').val(data.city);
		}
	  }
	});
}

function deleteAds(ads_id, formid)
{
	if(ads_id!='')
	{
		var confirmd = confirm("{{ Lang::get('core.ads_delete_confirm_msg') }}");
		if(confirmd==true)
		{
			$.ajax({
			  url: "{{ URL::to('deleteUserAds')}}",
			  type: "post",
			  data: "adsId="+ads_id,
			  dataType: "json",
			  success: function(data){
				if(data!='error')
				{
					$('#'+formid)[0].reset();
				}
				else{
					alert('No Advertisement Found');
				}
			  }
			});
		}
	}
}
</script>
@stop