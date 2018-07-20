//== Class definition
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_property_update_wizard');
    var formEl = $('#property_update_form');
    var validator;
    var wizard;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_property_update_wizard', {
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
                }else if(_wizard_step == '2'){
                    wizard_step_2();
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

        btn.on('click', function(e) {
            e.preventDefault();
            if (validator.form()) {
                
                                
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_property_update_wizard');
            formEl = $('#property_update_form');

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
    
}
function wizard_step_2(){
    var fdata = new FormData();    
    
}