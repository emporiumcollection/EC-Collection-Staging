//== Class definition
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = new mWizard('m_wizard', {
            startStep: 1
        });

        //== Validation before going to next page
        wizard.on('beforeNext', function(wizard) {
            if (validator.form() !== true) {
                wizard.stop=true;   // don't go to the next step
            }
            else{
                var _wizard_step = wizard.getStep();
                //var base_url = $('#base_url').val();
                if(_wizard_step == '1'){
                       wizard_step_1();
                }
                /*else if(_wizard_step == '2'){
                       wizard_step_2();
                }
                else if(_wizard_step == '3'){
                    wizard_step_3();
                }
                else if(_wizard_step == '4'){
                    wizard_step_4();
                }*/
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
                email: {
                    required: true,
                    email: true 
                },  
                first_name: {
                    required: true,
                    minlength: 2,
                },
                last_name: {
                    required: true,
                    minlength: 2,
                },     
                
                //== Company Details(step 2)
                company_name: {
                    required: true 
                },
                company_owner: {
                    required: true 
                },
                contact_person: {
                    required: true 
                },
                company_email: {
                    required: true 
                },
                company_phone: {
                    required: true 
                },
                company_website: {
                    required: true,
                    url: true 
                },
                company_address: {
                    required: true 
                },
                company_city: {
                    required: true 
                },
                company_postal_code: {
                    required: true, 
                    maxlength: 6
                },
                company_country: {
                    required: true 
                },
                company_logo:{
                    extension: "jpeg|png",
                },
                steuernummer: {
                    required: true 
                },
                umsatzsteuer_id: {
                    required: true 
                },
                geschäftsführer: {
                    required: true 
                },
                handelsregister: {
                    required: true 
                },
                amtsgericht: {
                    required: true,
                    maxlength: 6 
                },

                /*//== Slider Advertisement (step 3)
                adslink: {
                    required: true,
                    url:true                    
                },
                adstitle: {
                    required: true,
                },
                adsdesc: {
                    required: true,
                },
                adsdesc: {
                    ads_slider_cat: true,
                },                

                //== Slider Advertisement (step 4)
                adslink: {
                    required: true,
                    url:true                    
                },
                adstitle: {
                    required: true,
                },
                adsdesc: {
                    required: true
                },
                adsCat: {
                    required: true
                },
                adspos: {
                    required: true,
                },
                //=== Confirmation(step 5)
                accept: {
                    required: true
                }*/
            },

            //== Validation messages
           /* messages: {
                accept: {
                    required: "You must accept the Terms and Conditions agreement!"
                } 
            },*/
            
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
                
                 var fdata = new FormData();
    
    fdata.append("compedit_id",$("input[name=compedit_id]").val());
    fdata.append("company_name",$("input[name=company_name]").val());
    fdata.append("company_owner",$("input[name=company_owner]").val());
    fdata.append("contact_person",$("input[name=contact_person]").val());
    fdata.append("company_email",$("input[name=company_email]").val());
    fdata.append("company_phone",$("input[name=company_phone]").val());
    fdata.append("company_website",$("input[name=company_website]").val());
    fdata.append("company_tax_no",$("input[name=company_tax_no]").val());
    fdata.append("company_address",$("input[name=company_address]").val());
    fdata.append("company_address2",$("input[name=company_address2]").val());
    fdata.append("company_city",$("input[name=company_city]").val());
    fdata.append("company_postal_code",$("input[name=company_postal_code]").val());
    fdata.append("company_country",$("input[name=company_country]").val());
    fdata.append("steuernummer",$("input[name=steuernummer]").val());
    fdata.append("umsatzsteuer_id",$("input[name=umsatzsteuer_id]").val());
    fdata.append("geschäftsführer",$("input[name=geschäftsführer]").val());
    fdata.append("handelsregister",$("input[name=handelsregister]").val());
    fdata.append("amtsgericht",$("input[name=amtsgericht]").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_2]").val());
    if($("input[name=company_logo]")[0].files.length>0){
       fdata.append("company_logo",$("input[name=company_logo]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_company_details',
        type:'POST',
        dataType:'json',
        contentType: false,
        processData: false,
        data:fdata,
        success:function(response){
            if(response.status == 'success'){
                toastr.success(response.message);
                setTimeout(function(){
                       location.reload();
                }, 3000); 
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
                
               /* var fdata = new FormData();
    
                fdata.append("adslink",$("input[name=adslink]").val());
                fdata.append("adstitle",$("input[name=adstitle]").val());
                fdata.append("adsdesc",$("input[name=adsdesc]").val());
                fdata.append("ads_slider_cat",$("#ads_slider_cat :selected").val());
                fdata.append("_token",$("input[name=_token]").val());
                fdata.append("form_wizard",$("input[name=form_wizard_3]").val());
                fdata.append("adscurrency",$("input[name=adscurrency]").val());
                fdata.append("adsType",$("input[name=adsType]").val());
                fdata.append("adsprice",$("input[name=adsprice]").val());
                fdata.append("adsvalidation",$("input[name=adsvalidation]").val());
                fdata.append("advedit_id",$("input[name=advedit_id]").val());
                fdata.append("pay",$("input[name=pay]").val());
                if($("input[name=advertise_img]")[0].files.length>0){
                   fdata.append("advertise_img",$("input[name=advertise_img]")[0].files[0]) 
                }
                   
                var base_url = $('#base_url').val();
                $.ajax({
                    url:base_url+'/save_new_adspayment',
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
                            setTimeout(function(){
                                   location.reload();
                            }, 3000); 
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                });*/
                
                //== See: src\js\framework\base\app.js 
                /*mApp.progress(btn);
                //mApp.block(formEl);
                
                alert('ok'); 

                //== See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function() {
                        mApp.unprogress(btn);
                        //mApp.unblock(formEl);

                        swal({
                            "title": "", 
                            "text": "The application has been successfully submitted!", 
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                        });
                    }
                });*/
            }
        });
    } 
    
    /*var initSubmit = function() {
        var btn = formEl.find('[data-wizard-action="submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                
                var base_url = $('#base_url').val();
                var form_wizard = $("#form_wizard_5").val();
                var accept = $('input[name=accept]').val();
                
                $.ajax({
                    url:base_url+'/confirm_new_profile',
                    type:'POST',
                    dataType:'json',
                    data:{form_wizard:form_wizard,accept:accept},
                    success:function(response){
                        if(response.status == 'success'){
                            toastr.success(response.message);
                            setTimeout(function(){
                                   location.reload();
                              }, 3000); 
                        }
                        else{
                            toastr.error(response.message);
                        }
                    }
                }); 
                
                //== See: src\js\framework\base\app.js */
                /*mApp.progress(btn);
                //mApp.block(formEl);
                
                alert('ok'); 

                //== See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function() {
                        mApp.unprogress(btn);
                        //mApp.unblock(formEl);

                        swal({
                            "title": "", 
                            "text": "The application has been successfully submitted!", 
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                        });
                    }
                });*/
 /*           }
        });
    } */

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_wizard');
            formEl = $('#m_form');

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
    fdata.append("email",$("input[name=email]").val());
    fdata.append("first_name",$("input[name=first_name]").val());
    fdata.append("last_name",$("input[name=last_name]").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard]").val());
    if($("input[type=file]")[0].files.length>0){
       fdata.append("avatar",$("input[type=file]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_profile',
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

function wizard_step_2(){
    var fdata = new FormData();
    
    fdata.append("compedit_id",$("input[name=compedit_id]").val());
    fdata.append("company_name",$("input[name=company_name]").val());
    fdata.append("company_owner",$("input[name=company_owner]").val());
    fdata.append("contact_person",$("input[name=contact_person]").val());
    fdata.append("company_email",$("input[name=company_email]").val());
    fdata.append("company_phone",$("input[name=company_phone]").val());
    fdata.append("company_website",$("input[name=company_website]").val());
    fdata.append("company_tax_no",$("input[name=company_tax_no]").val());
    fdata.append("company_address",$("input[name=company_address]").val());
    fdata.append("company_address2",$("input[name=company_address2]").val());
    fdata.append("company_city",$("input[name=company_city]").val());
    fdata.append("company_postal_code",$("input[name=company_postal_code]").val());
    fdata.append("company_country",$("input[name=company_country]").val());
    fdata.append("steuernummer",$("input[name=steuernummer]").val());
    fdata.append("umsatzsteuer_id",$("input[name=umsatzsteuer_id]").val());
    fdata.append("geschäftsführer",$("input[name=geschäftsführer]").val());
    fdata.append("handelsregister",$("input[name=handelsregister]").val());
    fdata.append("amtsgericht",$("input[name=amtsgericht]").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_2]").val());
    if($("input[name=company_logo]")[0].files.length>0){
       fdata.append("company_logo",$("input[name=company_logo]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_company_details',
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

function wizard_step_3(){
    var fdata = new FormData();
    
    fdata.append("adslink",$("input[name=adslink]").val());
    fdata.append("adstitle",$("input[name=adstitle]").val());
    fdata.append("adsdesc",$("input[name=adsdesc]").val());
    fdata.append("ads_slider_cat",$("#ads_slider_cat :selected").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_3]").val());
    fdata.append("adscurrency",$("input[name=adscurrency]").val());
    fdata.append("adsType",$("input[name=adsType]").val());
    fdata.append("adsprice",$("input[name=adsprice]").val());
    fdata.append("adsvalidation",$("input[name=adsvalidation]").val());
    fdata.append("advedit_id",$("input[name=advedit_id]").val());
    fdata.append("pay",$("input[name=pay]").val());
    if($("input[name=advertise_img]")[0].files.length>0){
       fdata.append("advertise_img",$("input[name=advertise_img]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_adspayment',
        type:'POST',
        dataType:'json',
        contentType: false,
        processData: false,
        data:fdata,
        headers: {
            'Access-Control-Allow-Origin': '*'
        },
        success:function(response){
            /*if(response.url.length > 0){
                window.location.href = response.url;
            }*/
            if(response.status == 'success'){
                toastr.success(response.message);
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}

function wizard_step_4(){
    var fdata = new FormData();
    
    fdata.append("adslink",$("input[name=adslink_2]").val());
    fdata.append("adstitle",$("input[name=adstitle_2]").val());
    fdata.append("adsdesc",$("input[name=adsdesc_2]").val());
    fdata.append("adsCat",$("#adsCat_2 :selected").val());
    fdata.append("adspos",$("#adspos_2 :selected").val());
    fdata.append("_token",$("input[name=_token]").val());
    fdata.append("form_wizard",$("input[name=form_wizard_4]").val());
    fdata.append("adscurrency",$("input[name=adscurrency_2]").val());
    fdata.append("adsType",$("input[name=adsType_2]").val());
    fdata.append("adsprice",$("input[name=adsprice_2]").val());
    fdata.append("adsvalidation",$("input[name=adsvalidation_2]").val());
    fdata.append("advedit_id",$("input[name=advedit_id_2]").val());
    fdata.append("pay",$("input[name=pay_2]").val());
    if($("input[name=advertise_img_2]")[0].files.length>0){
       fdata.append("advertise_img",$("input[name=advertise_img_2]")[0].files[0]) 
    }
       
    var base_url = $('#base_url').val();
    $.ajax({
        url:base_url+'/save_new_adspayment',
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
            }
            else{
                toastr.error(response.message);
            }
        }
    }); 
}