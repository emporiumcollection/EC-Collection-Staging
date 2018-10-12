//== Class definition
var wizard;
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_hotel_wizard');
    var formEl = $('#hotel_form');
    var validator;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_hotel_wizard', {
            startStep: activeTab
        });
        if(wizard.isLastStep()){
            $("#wizard_submit_btn").css('display', 'none'); 
        }else{
            $("#wizard_submit_btn").css('display', ''); 
        }
        //== Validation before going to next page
        wizard.on('beforeNext', function(wizard) {
            if (validator.form() !== true) {
                wizard.stop=true;  // don't go to the next step                
            }
            else{
                var _wizard_step = wizard.getStep();
                //var base_url = $('#base_url').val();
                if((_wizard_step == '1') && (prevTab != _wizard_step)){
                       wizard_step_1();
                }
                else if((_wizard_step == '2') && (prevTab != _wizard_step)){
                       wizard_step_2();
                }
                else if((_wizard_step == '3') && (prevTab != _wizard_step)){
                       wizard_step_3();
                }
                else if((_wizard_step == '4') && (prevTab != _wizard_step)){
                       wizard_step_4();
                }
                else if(_wizard_step == '5'){
                    $("#wizard_submit_btn").css('display', 'none'); 
                //       wizard_step_5();
                }
            }
        });
        wizard.on('beforePrev', function(wizard) {
            prevTab--;
        });
        //== Change event
        wizard.on('change', function(wizard) {
            mUtil.scrollTop();
            if(wizard.isLastStep()){
                $("#wizard_submit_btn").css('display', 'none'); 
            }else{
                $("#wizard_submit_btn").css('display', ''); 
            }
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",

            //== Validation rules
            rules: {
                //=== User Information(step 1)
                username: {
                    required: true,
                    minlength: 2, 
                },                  
                first_name: {
                    required: true,
                    minlength: 2,
                },
                last_name: {
                    required: true,
                    minlength: 2,
                },
                txtPhoneNumber: {
                    required: true,                    
                }, 
                //contractSignCheckFinal: {
                //    required: true,                    
                //},
                //contractSignCheck: {
                //    required: true,   
                //},
                
                //=== Confirmation(last step)
                hotelinfo_name: {
                    required: true,                    
                }, 
                hotelinfo_status: {
                    required: true,                    
                }, 
                hotelinfo_type: {
                    required: true,                    
                }, 
                hotelinfo_building: {
                    required: true,                    
                }, 
                hotelinfo_opening_date: {
                    required: true,                    
                }, 
                hotelinfo_address: {
                    required: true,                    
                }, 
                hotelinfo_city: {
                    required: true,                    
                }, 
                hotelinfo_country: {
                    required: true,                    
                }, 
                hotelinfo_postal: {
                    required: true,                    
                }, 
                hotelinfo_website: {
                    required: true,                    
                }, 
                hotelinfo_daysopen: {
                    required: true,                    
                }, 
                hotelfac_num_rooms: {
                    required: true,                    
                }, 
                hotelfac_num_suites: {
                    required: true,                    
                }, 
                hoteldesc_concept: {
                    required: true,                    
                }, 
                hotelinfo_city: {
                    required: true,                    
                }, 
                hotel_contactinfo_address: {
                    required: true,                    
                },
                
                hotel_contactinfo_city: {
                    required: true,                    
                }, 
                hotel_contactinfo_country: {
                    required: true,                    
                }, 
                hotelfac_num_rooms: {
                    required: true,                    
                }, 
                hotel_contactinfo_postal: {
                    required: true,                    
                }, 
                hotel_contactprsn_firstname: {
                    required: true,                    
                }, 
                hotel_contactprsn_lastname: {
                    required: true,                    
                }, 
                hotel_contactprsn_companyname: {
                    required: true,                    
                },
                hotel_contactprsn_jobtitle: {
                    required: true,                    
                }, 
                hotel_contactprsn_phone: {
                    required: true,                    
                }, 
                
                
                accept: {
                    required: true
                }
            },

            //== Validation messages
            messages: {
                accept: {
                    required: "You must accept the Terms and Conditions agreement!"
                },
                contractSignCheck: {
                    required: "You must accept the Terms and Conditions agreement!"
                }  
            },
            
            //== Display error  
            invalidHandler: function(event, validator) {
                
                mUtil.scrollTop();

                swal({
                    "title": "", 
                    "text": "There are some errors in your submission. Please correct them.", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
            },

            //== Submit valid form
            submitHandler: function (form) {
                
            }
        });   
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-wizard-action="submit"]');
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_hotel_wizard');
            formEl = $('#hotel_form');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {    
    WizardDemo.init();
});

function wizard_step_1(){
    wizard.stop = true;
    var fdata = new FormData();    
    fdata.append("form_wizard_1",$("input[name=form_wizard_1]").val());  
    fdata.append("own_hotel_setup",$("input[name=accountsetup]:checked").val());       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/ownhotelsetup',
        type:'POST',
        dataType:'json',
        contentType: false,
        processData: false,
        data:fdata,
        success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                prevTab++;
                wizard.goNext();
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}

function wizard_step_2(){
    wizard.stop = true;
    var fdata = new FormData();
    
    fdata.append("username",$("input[name=username]").val());
    //fdata.append("email",$("input[name=email]").val());
    fdata.append("first_name",$("input[name=first_name]").val());
    fdata.append("last_name",$("input[name=last_name]").val());
    fdata.append("contractSignCheck",$("input[name=contractSignCheck]").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_2]").val());
    if($("input[type=file]")[0].files.length>0){
       fdata.append("avatar",$("input[type=file]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_hotel_profile',
        type:'POST',
        dataType:'json',
        contentType: false,
        processData: false,
        data:fdata,
        success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                prevTab++;
                wizard.goNext();
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}
function wizard_step_3(){
    wizard.stop = true;
    var fdata = new FormData();    
    fdata.append("form_wizard",$("input[name=form_wizard_3]").val());  
    fdata.append("roomavailability",$("input[name=roomavailability]:checked").val());       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/hotelavaibility',
        type:'POST',
        dataType:'json',
        contentType: false,
        processData: false,
        data:fdata,
        success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                prevTab++;
                wizard.goNext();
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}
function wizard_step_4(){ 
    wizard.stop = true;
    var is_runajax = true;
    var agreedval = new Array();
    var disagreedval = new Array(); 
    $("input.rad_contracts").each(function(){
        var pr = true; console.log("gg");
        if($(this).is(":checked") === false){ pr = false; if($(this).hasClass('rad_required')){ is_runajax = false; } }
        console.log(pr);
        if(pr === true){ agreedval.push($(this).val()); }
        else{disagreedval.push($(this).val());}            
    });
    
    //run ajax if user will accept all required contracts
    if((is_runajax === true) && ((agreedval.length > 0) || (disagreedval.length > 0))){
        $.ajax({
    	  url: base_url+'/user/wizardacceptcontracts',
    	  type: "post",
    	  data: {"agree_contracts":agreedval,"disagree_contracts":disagreedval},
    	  dataType: "json",
    	  success: function(data){
            if(data.status == "fail"){
                toastr.error(data.message);
            }else
            {
                toastr.success(data.message);
                prevTab++;
                wizard.goNext();
            }
    	  },
          error: function(e){
            toastr.error("Unexpected error occured, Please try again after some time!");
          }
    	});
    }else
    {
        toastr.error("Please accept all required contracts!");
    }
    //End
    return false;
}