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
                        <div class="col-sm-12">
                            <?php 
                            if(count($companion)>0){
                            ?>
                                <table class="table">
                                    <tr>
                                        <th>Name</th>                                        
                                        <th>Actions</th>
                                    </tr>
                                
                                    <?php
                                    foreach($companion as $comp){ 
                                    ?>
                                        <tr>
                                            <td><?php echo $comp->first_name." ".$comp->last_name; ?></td>                                            
                                            <td>
                                                <a href="#" title="View" onclick="view_companion({{$comp->id}});"><i class="fa fa-search fa-lg"></i></a>
                                                <a href="#" title="Edit" onclick="edit_companion({{$comp->id}});"><i class="fa fa-edit fa-lg"></i></a>
                                                <a href="#" title="Delete" onclick="delete_companion({{$comp->id}});"><i class="fa fa-trash fa-lg"></i></a></td>
                                        </tr>    
                                    <?php 
                                    } 
                                    ?>
                                </table>
                            <?php
                            }else{
                                echo "You haven't add any companion.";
                            }
                            ?>
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
                <div class="m-portlet m-portlet--full-height">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="color: red;">
                        @if(Session::has('message'))
            				{!! Session::get('message') !!}
            			@endif
                    </div>
                    {!! Form::open(array('url'=>'user/companion/', 'class'=>'m-form m-form--fit m-form--label-align-right', 'id'=>'frm_add' ,'files' => true)) !!}
                        <div class="m-portlet__body">  
                            <div class="form-group m-form__group row">
            					<label for="first_name" class="col-sm-12 col-md-2 col-form-label">
            						First Name
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="first_name" type="text" id="first_name" class="form-control m-input" placeholder="Enter companion first name" /> 
                                    <span class="error">{{ $errors->first('first_name') }}</span> 
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="last_name" class="col-sm-12 col-md-2 col-form-label">
            						Last Name
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="last_name" type="text" id="last_name" class="form-control m-input"  placeholder="Enter companion last name" />  
                                    <span class="error">{{ $errors->first('last_name') }}</span>
            					</div>
            				</div>                                      
                            <div class="form-group m-form__group row">
            					<label for="email" class="col-sm-12 col-md-2 col-form-label">
            						Email
            					</label>
            					<div class="col-sm-12 col-md-7">
            						<input name="email" type="text" id="email" class="form-control m-input"  placeholder="Enter companion email" />  
            					</div>
            				</div>
                            <div class="form-group m-form__group row">
            					<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
            						Phone Number
            					</label>
            					<div class="col-sm-12 col-md-7">
                                    <div class="row">
                                        <div class="col-sm-2 col-md-2" style="padding-right: 0px;">
                                            <input name="phone_code" type="text" id="phone_code" class="form-control m-input" placeholder="Code" />
                						</div>
                                        <div class="col-sm-10 col-md-10" style="padding-left: 0px;">	
                							<input name="phone_number" type="text" id="phone_number" class="form-control m-input" placeholder="Enter companion phone number" />
                						</div>    	
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
            						<select class="form-control" id="preferred_language" name="preferred_language">
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
            							<button class="btn btn-success m-btn m-btn--air m-btn--custom" id="btn_add">
            								Save Changes
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
    
    <!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="viewModalLabel">
    					View
    				</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__body" id="vw_table"></div>
                    </div>                				
    			</div>
    			<div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" id="viewclosebtn" data-dismiss="modal">Close</button>                    
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->
 
<!--Start: First Time on Dashboard modal pop up-->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="display: none;">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="editModalLabel">
    					Edit
    				</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">
    						×
    					</span>
    				</button>    				
    			</div>
    			<div class="modal-body">
                    <div class="m-portlet m-portlet--full-height">
                        
                        <form class="m-form" name="edit_form" id="edit_form" enctype="multipart/form-data">
                            <div class="m-portlet__body">
                                
								<div class="form-group m-form__group row">
									<label for="edit_first_name" class="col-sm-12 col-md-2 col-form-label">
										First Name
									</label>
									<div class="col-sm-12 col-md-10">
                                        <input type="hidden" id="edit_id" name="edit_id" />
										<input name="edit_first_name" type="text" id="edit_first_name" class="form-control" />  
									</div>
								</div>
								
                                <div class="form-group m-form__group row">
									<label for="edit_last_name" class="col-sm-12 col-md-2 col-form-label">
										Last Name
									</label>
									<div class="col-sm-12 col-md-10">
										<input name="edit_last_name" type="text" id="edit_last_name" class="form-control" />  
									</div>  
								</div>
								
                                <div class="form-group m-form__group row">
                                    <label for="edit_email" class="col-sm-12 col-md-2 col-form-label">
										Email
									</label>
									<div class="col-sm-12 col-md-10">
										<input name="edit_email" type="text" id="edit_email" class="form-control" />  
									</div>
								</div>
								
                                <div class="form-group m-form__group row">
                					<label for="edit_phone_number" class="col-sm-12 col-md-2 col-form-label">
                						Phone Number
                					</label>
                					<div class="col-sm-12 col-md-7">
                                        <div class="row">
                                            <div class="col-sm-2 col-md-2" style="padding-right: 0px;">
                                                <input name="edit_phone_code" type="text" id="edit_phone_code" class="form-control m-input" placeholder="Code" />
                    						</div>
                                            <div class="col-sm-10 col-md-10" style="padding-left: 0px;">	
                    							<input name="edit_phone_number" type="text" id="edit_phone_number" class="form-control m-input" placeholder="Enter companion phone number" />
                    						</div>    	
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
                                                
                            					<input type="file" name="edit_avatar">
                            				</span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                            <br /> 
                                            Image Dimension 80 x 80 px <br />                                       			
                                			<div id="edit_img"></div>
                                        </div>
                					</div>
                				</div>
                                <div class="form-group m-form__group row">
                					<label for="edit_gender" class="col-sm-12 col-md-2 col-form-label">
                						I Am 
                					</label>
                					<div class="col-sm-12 col-md-7">
                						<select class="form-control" id="edit_gender" name="edit_gender">
                                            <option value="Male" >Male</option>
                                            <option value="Female" >Female</option>
                                            <option value="Other" >Other</option>
                                        </select>
                					</div>
                				</div>
                                <div class="form-group m-form__group row">
                					<label for="edit_preferred_language" class="col-sm-12 col-md-2 col-form-label">
                						Preferred Language
                					</label>
                					<div class="col-sm-12 col-md-7">
                						<select class="form-control" id="edit_preferred_language" name="edit_preferred_language">
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
                					<label for="edit_preferred_currency" class="col-sm-12 col-md-2 col-form-label">
                						Preferred Currency
                					</label>
                					<div class="col-sm-12 col-md-7">
                                    <?php  $currencyList=(CommonHelper::getCurrencyList()); if(empty($currencyList)){ $currencyList = array(); } ?>
                						<select class="form-control" id="edit_preferred_currency" name="edit_preferred_currency">
                                            <option value="EUR">Currency</option>
                                            @foreach($currencyList as $currencyCode => $currencyName)
                                                
                                                <option value="{{ $currencyCode }}" title="{{ $currencyName }}" >{{ $currencyName }}
                                            </option>                                        
                                            @endforeach
                                        </select>
                                        <span class="m-form__help">Select the currency in which we display prices.</span> 
                					</div>
                				</div>
								
                            </div>
                        </form>
                        
                    </div>                				
    			</div>
    			<div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" id="editclosebtn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updatebtn">Update</button>                   
    			</div>
    		</div>
    	</div>
    </div>    
 <!--end: modal pop up-->
    
@stop
@section('custom_js_script')
    <script>
        var b_url = "{{url('/')}}";
        $(document).ready(function(){  
            
           $("#frm_add").validate({
                //== Validate only visible fields
                ignore: ":hidden",
                
                //== Validation rules
                rules: {                 
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        required: true
                    }, 
                },
    
                //== Validation messages
                messages: {
                    first_name: {
                        required: "First name field is required"
                    }, 
                    last_name: {
                        required: "Last name field is required"
                    },
                    email: {
                        required: "Email field is required"
                    },
                },
                
                //== Display error  
                invalidHandler: function(event, validator) {
                    
                },
    
                //== Submit valid form
                submitHandler: function (form) {
                    var fdata = new FormData();                    
                    fdata.append("first_name",$("input[name=first_name]").val());
                    fdata.append("last_name",$("input[name=last_name]").val());
                    fdata.append("email",$("input[name=email]").val());
                    fdata.append("phone_code",$("input[name=phone_code]").val());
                    fdata.append("phone_number",$("input[name=phone_number]").val());
                    
                    fdata.append("gender",$("#gender :selected").val());
                    fdata.append("preferred_language",$("#preferred_language :selected").val());
                    fdata.append("preferred_currency",$("#preferred_currency :selected").val());
                    
                    fdata.append("_token",$("input[name=_token]").val());
                    if($("input[name=avatar]")[0].files.length>0){
                       fdata.append("avatar",$("input[name=avatar]")[0].files[0]) 
                    }
                    //console.log(fdata);
                    $.ajax({
                        url:"{{URL::to('addcompanion')}}",
                        type:'POST',
                        dataType:'json',                    
                        data:fdata,
                        contentType: false,
                        processData: false,
                        headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        success:function(response){
                            if(response.status == 'success'){
                                toastr.success(response.message);                                
                                window.location.href = "{{URL::to('user/companion')}}";
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
            $("#updatebtn").click(function(){                
                $("#edit_form").submit();
            }); 
            
           $("#edit_form").validate({
                //== Validate only visible fields
                ignore: ":hidden",
                
                //== Validation rules
                rules: {                 
                    edit_first_name: {
                        required: true
                    },
                    edit_last_name: {
                        required: true
                    },
                    edit_email: {
                        required: true
                    }, 
                },
    
                //== Validation messages
                messages: {
                    edit_first_name: {
                        required: "First name field is required"
                    }, 
                    edit_last_name: {
                        required: "Last name field is required"
                    },
                    edit_email: {
                        required: "Email field is required"
                    },
                },
                
                //== Display error  
                invalidHandler: function(event, validator) {
                    
                    //mUtil.scrollTop();
    
                    //swal({
                    //    "title": "", 
                    //    "text": "There are some errors in your submission. Please correct them.", 
                    //    "type": "error",
                    //    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                    //});
                },
    
                //== Submit valid form
                submitHandler: function (form) {
                    var fdata = new FormData();
                    fdata.append("edit_id",$("input[name=edit_id]").val());
                    fdata.append("edit_first_name",$("input[name=edit_first_name]").val());
                    fdata.append("edit_last_name",$("input[name=edit_last_name]").val());
                    fdata.append("edit_email",$("input[name=edit_email]").val());
                    fdata.append("edit_phone_code",$("input[name=edit_phone_code]").val());
                    fdata.append("edit_phone_number",$("input[name=edit_phone_number]").val());
                    
                    fdata.append("edit_gender",$("#edit_gender :selected").val());
                    fdata.append("edit_preferred_language",$("#edit_preferred_language :selected").val());
                    fdata.append("edit_preferred_currency",$("#edit_preferred_currency :selected").val());
                    
                    fdata.append("_token",$("input[name=_token]").val());
                    if($("input[name=edit_avatar]")[0].files.length>0){
                       fdata.append("edit_avatar",$("input[name=edit_avatar]")[0].files[0]) 
                    }
                    //console.log(fdata);
                    $.ajax({
                        url:"{{URL::to('editcompanion')}}",
                        type:'POST',
                        dataType:'json',                    
                        data:fdata,
                        contentType: false,
                        processData: false,
                        headers: {
                            'Access-Control-Allow-Origin': '*'
                        },
                        success:function(response){
                            if(response.status == 'success'){
                                toastr.success(response.message);
                                $("#edit-modal").modal('hide');
                            }
                            else{
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            });
            $("#updatebtn").click(function(){                
                $("#edit_form").submit();
            });
        });
        function view_companion(id){   
            var tbl = '';
            $.ajax({
                url:"{{URL::to('viewcompanion')}}",
                type:'POST',
                dataType:'json',                
                data:{'id':id},
                headers: {
                    'Access-Control-Allow-Origin': '*'
                },
                success:function(response){ console.log(response[0].first_name);
                    $('#vw_table').html('');
                    if(response.length != 0){
                        tbl += '<table class="table">'; 
                        tbl += '<tr><td width="30%">First name:</td><td>'+response[0].first_name+'</td></tr>';
                        tbl += '<tr><td>Last name:</td><td>'+response[0].last_name+'</td></tr>';
                        tbl += '<tr><td>Email:</td><td>'+response[0].email+'</td></tr>';
                        tbl += '<tr><td>Phone:</td><td>'+response[0].phone_code+' '+response[0].phone_number+'</td></tr>';
                        tbl += '<tr><td>Gender:</td><td>'+response[0].gender+'</td></tr>';
                        tbl += '<tr><td>Preferred language:</td><td>'+response[0].preferred_language+'</td></tr>';
                        tbl += '<tr><td>Preferred currency:</td><td>'+response[0].preferred_currency+'</td></tr>';
                        tbl += '<tr><td>Avatar</td><td><img src="'+b_url+'/uploads/users/companion/'+response[0].avatar+'" width="80px"></td></tr>';
                        tbl += '</table>';
                        $('#vw_table').html(tbl); 
                        $("#view-modal").modal('show');
                    }
                }
            });                  
        }
        function edit_companion(id){            
            $.ajax({
                url:"{{URL::to('viewcompanion')}}",
                type:'POST',
                dataType:'json',                
                data:{'id':id},
                headers: {
                    'Access-Control-Allow-Origin': '*'
                },
                success:function(response){
                    if(response.length != 0){
                        $("#edit_id").val(response[0].id);
                        $("#edit_first_name").val(response[0].first_name);
                        $("#edit_last_name").val(response[0].last_name);
                        $("#edit_email").val(response[0].email);
                        
                        $("#edit_phone_code").val(response[0].phone_code);
                        $("#edit_phone_number").val(response[0].phone_number);
                        
                        $("#edit_gender").val(response[0].gender);
                        $("#edit_preferred_language").val(response[0].preferred_language);
                        $("#edit_preferred_currency").val(response[0].preferred_currency);
                        
                        $("#edit_img").html('<img src="'+b_url+'/uploads/users/companion/'+response[0].avatar+'" width="80px">');
                        
                        $("#edit-modal").modal('show');
                    }
                }
            });             
        }
        function delete_companion(id){ 
            if(confirm("Are you sure want to delete companion")){
                $.ajax({
                    url:"{{URL::to('deletecompanion')}}",
                    type:'POST',
                    dataType:'json',                
                    data:{'id':id},
                    headers: {
                        'Access-Control-Allow-Origin': '*'
                    },
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            window.location.reload();
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                }); 
            }                      
        }        
    </script>
@stop