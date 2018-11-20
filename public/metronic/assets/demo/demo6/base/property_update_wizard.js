//== Class definition
var wizard;
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_property_update_wizard');
    var formEl = $('#property_update_form');
    var validator;
    
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
                if((_wizard_step == '1')  && (prevTab != _wizard_step)){
                    wizard_step_1();
                }else if((_wizard_step == '2') && (prevTab != _wizard_step)){
                    console.log("ggg");
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
                property_name: {
                    required: true                    
                },                  
                property_short_name: {
                    required: true
                },
                property_type: {
                    required: true
                },
                booking_type: {
                    required: true
                },
                /*assigned_user_id: {
                    required: true
                }*/
            },

            //== Validation messages
            messages: {
                property_name: {
                    required: "Property name field is required"
                },
                property_short_name: {
                    required: "Property short name field is required"
                },
                property_type: {
                    required: "Property type field is required"
                },
                booking_type: {
                    required: "Booking type field is required"
                },
                /*assigned_user_id: {
                    required: "Assigned user field is required"
                }*/
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
            $pid = $("input[name=id]").val();
            if (validator.form()) {
                
                var fdata = new FormData();
                fdata.append("_token",$("input[name=_token]").val());
                fdata.append("id",$("input[name=id]").val());
                fdata.append("form_wizard",$("input[name=form_wizard_3]").val());
                fdata.append("social_status",$("input[name=social_status]:checked").val());
                fdata.append("social_facebook",$("input[name=social_facebook]").val());
                fdata.append("social_twitter",$("input[name=social_twitter]").val());
                fdata.append("social_google",$("input[name=social_google]").val());
                fdata.append("social_youtube",$("input[name=social_youtube]").val());
                fdata.append("social_pinterest",$("input[name=social_pinterest]").val());
                fdata.append("social_vimeo",$("input[name=social_vimeo]").val());
                fdata.append("social_instagram",$("input[name=social_instagram]").val());
                
                $.ajax({
                    url:base_url+'/save_hotel_social_info',
                    type:'POST',
                    dataType:'json',
                    contentType: false,
                    processData: false,
                    data:fdata,
                    success:function(response){
                        if(response.status == 'success'){
                            
                            toastr.success(response.message);
                            window.location.href= base_url+'/properties_settings/'+$pid+'/types';
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
    wizard.stop = true;
    var fdata = new FormData();
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard]").val());
    
    fdata.append("id",$("input[name=id]").val());  
    fdata.append("property_name",$("input[name=property_name]").val());    
    fdata.append("property_short_name",$("input[name=property_short_name]").val());
    fdata.append("property_type",$("select[name=property_type]").val());
    fdata.append("booking_type",$("select[name=booking_type]").val());
    fdata.append("city_tax",$("input[name=city_tax]").val());
    fdata.append("about_property",$("textarea[name=about_property]").val());
    fdata.append("property_usp",$("textarea[name=property_usp]").val());
    fdata.append("assigned_user_id",($("select[name=assigned_user_id]").val()) ? $("select[name=assigned_user_id]").val() : '');    
    fdata.append("assigned_amenities", ($("select[name=assigned_amenities]").val()) ? $("select[name=assigned_amenities]").val() : '');
    fdata.append("copy_amenities_rooms", $("input[name=copy_amenities_rooms]:checked").val());    
    fdata.append("destinations",($("select[name=destinations]:selected").val())? $("select[name=destinations]:selected").val() :'');
    fdata.append("default_seasons",($("input[name=default_seasons]:checked").val()) ? $("input[name=default_seasons]:checked").val() :'');
    fdata.append("detail_section1_title",$("input[name=detail_section1_title]").val());
    fdata.append("detail_section1_description_box1",$("textarea[name=detail_section1_description_box1]").val());    
    fdata.append("detail_section1_description_box2", $("textarea[name=detail_section1_description_box2]").val());
    fdata.append("detail_section2_title", $("input[name=detail_section2_title]").val());    
    fdata.append("detail_section2_description_box1",$("textarea[name=detail_section2_description_box1]").val());
    fdata.append("detail_section2_description_box2",$("textarea[name=detail_section2_description_box2]").val());
    fdata.append("assign_detail_city",($("select[name=assign_detail_city]").val()) ? $("select[name=assign_detail_city]").val() : '');
    
    $.ajax({
        url:base_url+'/save_hotel_info',
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
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_2]").val());
    
    fdata.append("id",$("input[name=id]").val()); 
     
    fdata.append("architecture_title",$("input[name=architecture_title]").val());    
    fdata.append("architecture_desciription",$("textarea[name=architecture_desciription]").val());    
    if($("input[name=architecture_image]")[0].files.length>0){
       fdata.append("architecture_image",$("input[name=architecture_image]")[0].files[0]) 
    }    
    fdata.append("architecture_video_type",($("input[name=architecture_video_type]:checked").val()) ? $("input[name=architecture_video_type]:checked").val() :'');    
    if($("input[name=architecture_video]")[0].files.length>0){
       fdata.append("architecture_video",$("input[name=architecture_video]")[0].files[0]) 
    }    
    fdata.append("architecture_video_link_type",($("input[name=architecture_video_link_type]:checked").val()) ? $("input[name=architecture_video_link_type]:checked").val() :'');
    fdata.append("architecture_video_link",$("input[name=architecture_video_link]").val());
    
    
    
    fdata.append("architecture_design_title",$("input[name=architecture_design_title]").val());    
    fdata.append("architecture_design_desciription",$("textarea[name=architecture_design_desciription]").val());    
    if($("input[name=architecture_design_image]")[0].files.length>0){
       fdata.append("architecture_design_image",$("input[name=architecture_design_image]")[0].files[0]) 
    }    
    fdata.append("architecture_design_video_type",($("input[name=architecture_design_video_type]:checked").val()) ? $("input[name=architecture_design_video_type]:checked").val() :'');    
    if($("input[name=architecture_design_video]")[0].files.length>0){
       fdata.append("architecture_design_video",$("input[name=architecture_design_video]")[0].files[0]) 
    }    
    fdata.append("architecture_design_video_link_type",($("input[name=architecture_design_video_link_type]:checked").val()) ? $("input[name=architecture_design_video_link_type]:checked").val() :'');
    fdata.append("architecture_design_video_link",$("input[name=architecture_design_video_link]").val());
    fdata.append("architecture_design_url",$("input[name=architecture_design_url]").val());
    
    
    fdata.append("architecture_designer_title",$("input[name=architecture_designer_title]").val());    
    fdata.append("architecture_designer_desciription",$("textarea[name=architecture_designer_desciription]").val());    
    if($("input[name=architecture_designer_image]")[0].files.length>0){
       fdata.append("architecture_designer_image",$("input[name=architecture_designer_image]")[0].files[0]) 
    }    
    fdata.append("architecture_designer_video_type",($("input[name=architecture_designer_video_type]:checked").val()) ? $("input[name=architecture_designer_video_type]:checked").val() :'');    
    if($("input[name=architecture_designer_video]")[0].files.length>0){
       fdata.append("architecture_designer_video",$("input[name=architecture_designer_video]")[0].files[0]) 
    }    
    fdata.append("architecture_designer_video_link_type",($("input[name=architecture_designer_video_link_type]:checked").val()) ? $("input[name=architecture_designer_video_link_type]:checked").val() :'');
    fdata.append("architecture_designer_video_link",$("input[name=architecture_designer_video_link]").val());
    fdata.append("architecture_designer_url",$("input[name=architecture_designer_url]").val());
    console.log("fff");
    $.ajax({
        url:base_url+'/save_hotel_architect_info',
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