//== Class definition
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_hotel_wizard');
    var formEl = $('#hotel_form');
    var validator;
    var wizard;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_hotel_wizard', {
            startStep: 1
        });

        //== Validation before going to next page
        wizard.on('beforeNext', function(wizard) {
            if (validator.form() !== true) {
                wizard.stop=true;  // don't go to the next step                
            }
            else{
                var _wizard_step = wizard.getStep();
                //var base_url = $('#base_url').val();
                if(_wizard_step == '1'){
                       wizard_step_1();
                }
            }
        });

        //== Change event
        wizard.on('change', function(wizard) {
            mUtil.scrollTop();
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
                contractSignCheckFinal: {
                    required: true,                    
                },
                contractSignCheck: {
                    required: true,   
                },
                
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

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                
                var base_url = $('#base_url').val();
                var form_wizard = $("#form_wizard_2").val();
                var accept = $('input[name=hotel_contactprsn_agree]').val();
                
                var fdata = $( "form" ).serialize();
                
                $.ajax({
                    url:base_url+'/hotel_membership',
                    type:'POST',
                    dataType:'json',
                    data:fdata,
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            var htmltxt = '<div class="col-md-12 col-xs-12"><div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert"><div class="m-alert__icon"><i class="flaticon-exclamation-1"></i><span></span></div> <div class="m-alert__text"> <strong>Approval pending!</strong> Any further information please contact administrator.</div> </div></div>';
                            $('.m-content .row').html(htmltxt);
                            /*setTimeout(function(){
                                   location.reload();
                              }, 3000);*/ 
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });                
            }
        });
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
    var fdata = new FormData();
    
    fdata.append("username",$("input[name=username]").val());
    //fdata.append("email",$("input[name=email]").val());
    fdata.append("first_name",$("input[name=first_name]").val());
    fdata.append("last_name",$("input[name=last_name]").val());
    fdata.append("contractSignCheck",$("input[name=contractSignCheck]").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard]").val());
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
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}