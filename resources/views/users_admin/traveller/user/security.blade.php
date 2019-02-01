@extends('users_admin.traveller.layouts.app')

@section('page_name')
    Security &amp; privacy  <small></small>
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
            <span class="m-nav__link-text"> Security &amp; privacy </span> 
        </a> 
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4 bg-gray">
            <div class="row margin-top">
                <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                    <h2>Security &amp; privacy</h2>                
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <a href="https://www.iubenda.com/privacy-policy/70156957" class="iubenda-white iubenda-embed iub-legal-only iub-no-markup" title="Privacy Policy" target="_blank">Emporium-Voyage Privacy Policy</a>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy" class="iubenda-white iubenda-embed iub-no-markup" title="Cookie Policy" target="_blank">Cookie Policy</a>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="col-sm-12 col-md-12 col-lg-12 bottom-pad">
                <div class="b2c-banner-text">Security &amp; privacy</div>
                <img src="{{URL::to('images/companion.jpg')}}" style="width: 100%;" />
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2>Security &amp; privacy</h2>
                <p>Intro text</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <button class="btn btn-primary b-btn" id="deactivate_account"><i class="fa fa-save"></i> Deactivate My Account</button>
            </div>
        </div>
    </div>
@stop
@section('custom_js_script')
    <script src="{{ asset('metronic/assets/demo/demo6/base/toastr.js') }}"></script>
    <script src="{{ asset('assets/js/bootbox.min.js') }}"></script>
    <script>
        $(document).ready(function(){           
           $("#deactivate_account").click(function(e){
              e.preventDefault();
              bootbox.confirm("Are you sure want to deactivate your account, your account will be removed from Emporium Voyage after one year till then you can download invoices", 
                function(result){ 
                    if(result){
                        $.ajax({
                    	  url: "{{ URL::to('user/deactivateaccount')}}",
                    	  type: "post",
                    	  dataType: "json",
                    	  success: function(response){
                    		if(response.status == 'success'){
                                toastr.success(response.message);
                                window.location.href = "{{Url::to('/')}}";
                            }
                          }
                       });
                    }
                }
              );
              /*if(bootbox.confirm('Are you sure, You want to deactivate your account')){
                  $.ajax({
                	  url: "{{ URL::to('user/deactivateaccount')}}",
                	  type: "post",
                	  dataType: "json",
                	  success: function(response){
                		if(response.status == 'success'){
                            toastr.success(response.message);
                            //window.location.href = "{{Url::to('/')}}";
                        }
                      }
                   });
               }*/
           });           
        });
    </script>
@stop