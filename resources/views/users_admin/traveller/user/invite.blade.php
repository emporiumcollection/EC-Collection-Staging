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
        <div class="col-xl-3 col-lg-4 bg-gray">
            <div class="row margin-top">
                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                    <h2>Invited Guests</h2>                
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php 
                            if(count($invitees)>0){
                            ?>
                                <table class="table">
                                    <tr>
                                        <th>Name</th>                                        
                                        <th>Actions</th>
                                    </tr>
                                
                                    <?php
                                    foreach($invitees as $invitee){ 
                                    ?>
                                        <tr>
                                            <td><?php echo $invitee->first_name." ".$invitee->last_name; ?></td>                                            
                                            <td>
                                                <a href="#" title="View" onclick="view_invitee({{$invitee->id}});"><i class="fa fa-search fa-lg"></i></a>
                                                <a href="#" title="Edit" onclick="edit_invitee({{$invitee->id}});"><i class="fa fa-edit fa-lg"></i></a>
                                                <a href="#" title="Delete" onclick="delete_invitee({{$invitee->id}});"><i class="fa fa-trash fa-lg"></i></a></td>
                                        </tr>    
                                    <?php 
                                    } 
                                    ?>
                                </table>
                            <?php
                            }else{
                                echo "You haven't sent any invitation.";
                            }
                            ?>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad m--align-center">
                <div class="m-card-profile__pic">
                    <div class="m-card-profile__pic-wrapper">
                        <div class="b2c-banner-text">Invite Your Friends</div>
						<img src="{{URL::to('images/invite.jpg')}}" style="width: 100%;" />
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
                        
                        <form class="m-form">
                            <div class="m-portlet__body">
                                
								<div class="col-sm-12 col-md-12">
									First Name: <span id="first_name"></span>  
								</div>
								
                                <div class="col-sm-12 col-md-12">
									Last Name: <span id="last_name"></span>  
								</div>
								
                                <div class="col-sm-12 col-md-12">
									Email: <span id="email"></span> 
								</div>
								
                                <div class="col-sm-12 col-md-12">
									Message: <span id="message"></span>  
								</div>
								<div class="col-sm-12 col-md-12">
									Refferal Code: <span id="refferal_code"></span>  
								</div>
                            </div>
                        </form>
                        
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
                        
                        <form class="m-form" name="edit_form" id="edit_form">
                            <div class="m-portlet__body">
                                
								<div class="form-group m-form__group row">
									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
										First Name
									</label>
									<div class="col-sm-12 col-md-10">
                                        <input type="hidden" id="edit_id" name="edit_id" />
										<input name="edit_first_name" type="text" id="edit_first_name" class="form-control" />  
									</div>
								</div>
								
                                <div class="form-group m-form__group row">
									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
										Last Name
									</label>
									<div class="col-sm-12 col-md-10">
										<input name="edit_last_name" type="text" id="edit_last_name" class="form-control" />  
									</div>  
								</div>
								
                                <div class="form-group m-form__group row">
                                    <label for="ipt" class="col-sm-12 col-md-2 col-form-label">
										Email
									</label>
									<div class="col-sm-12 col-md-10">
										<input name="edit_email" type="text" id="edit_email" class="form-control" />  
									</div>
								</div>
								
                                <div class="form-group m-form__group row">
									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
										Message
									</label>
									<div class="col-sm-12 col-md-10">
										<textarea name="edit_message" id="edit_message" class="form-control"></textarea>
									</div>
								</div>
                                <div class="form-group m-form__group row">
									<label for="ipt" class="col-sm-12 col-md-2 col-form-label">
										refferal_code
									</label>
									<div class="col-sm-12 col-md-10">
										<input name="edit_refferal_code" id="edit_refferal_code" class="form-control" />
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
        $(document).ready(function(){
        /*   $("#btn_send_invites").click(function(){ console.log("ff23");
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
           }); */
           $("#edit_form").validate({
                        //== Validate only visible fields
                        ignore: ":hidden",
                        
                        //== Validation rules
                        rules: {                 
                            edit_first_name: {
                                required: true,
                                minlength: 2,
                            },
                            edit_last_name: {
                                required: true,
                                minlength: 2,
                            },
                            edit_email: {
                                required: true,
                                email: true 
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
                            var fdata = $( form ).serialize();
                            //console.log(fdata);
                            $.ajax({
                                url:"{{URL::to('editinvite')}}",
                                type:'POST',
                                dataType:'json',                    
                                data:fdata,
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
        function view_invitee(id){
            
            $.ajax({
                url:"{{URL::to('viewInvite')}}",
                type:'POST',
                dataType:'json',                
                data:{'id':id},
                headers: {
                    'Access-Control-Allow-Origin': '*'
                },
                success:function(response){
                    if(response.length != 0){
                        $("#first_name").html(response[0].first_name);
                        $("#last_name").html(response[0].last_name);
                        $("#email").html(response[0].email);
                        $("#message").html(response[0].message);
                        $("#refferal_code").html(response[0].referral_code);
                        
                        $("#view-modal").modal('show');
                    }
                }
            }); 
                       
        }
        function edit_invitee(id){
            
            $.ajax({
                url:"{{URL::to('viewInvite')}}",
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
                        $("#edit_message").val(response[0].message);
                        $("#edit_refferal_code").val(response[0].referral_code);
                        $("#edit-modal").modal('show');
                    }
                }
            }); 
                       
        }
        function delete_invitee(id){
            
            $.ajax({
                url:"{{URL::to('deleteinvite')}}",
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
        
    </script>
@stop