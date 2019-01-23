//== Class definition
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_traveller_wizard');
    var formEl = $('#traveller_form');
    var validator;
    var wizard;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_traveller_wizard', {
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
                if(_wizard_step == '2'){
                       wizard_step_2();
                }
                if(_wizard_step == '3'){
                       
                }
            }
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
                }               
            },

            //== Validation messages
            messages: {
                
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
            wizardEl = $('#m_traveller_wizard');
            formEl = $('#traveller_form');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {    
    WizardDemo.init();
});

function wizard_step_2(){
    var fdata = new FormData();
    //fdata.append("email",$("input[name=email]").val());
    fdata.append("first_name",$("input[name=first_name]").val());
    fdata.append("last_name",$("input[name=last_name]").val());
    fdata.append("gender",$("#gender :selected").val());
    fdata.append("prefer_communication_with",$("#prefer_communication_with :selected").val());
    fdata.append("preferred_currency",$("#preferred_currency :selected").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard]").val());    
    if($("input[type=file]")[0].files.length>0){
       fdata.append("avatar",$("input[type=file]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_traveller_profile', 
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