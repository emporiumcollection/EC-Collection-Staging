@extends('layouts.ev.checkout')
@section('content')
<style>
    input#submitBtn {
        border: none;
    }
</style>
 
  <div class="col-md-12 sm-clear-both wow fadeInLeft no-padding">
    <div class="padding-ten-half-all bg-light-gray md-padding-seven-all xs-padding-30px-all height-100">
    <div class="panel panel-default credit-card-box">
            <div class="row display-tr" >
                <!--<h3 class="panel-title display-td" >Payment Details </h3>-->
                <h5 class="ev-regural-heading text-uppercase margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Payment Details</h5>
                <div classs="display-td" >                            
                    
                </div>
            </div>                    
        <div class="panel-body no-padding">
            <div class="col-md-12 no-padding">
              {!! Form::open(['url' => 'order-post', 'data-parsley-validate', 'id' => 'payment-form']) !!}
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="form-group" id="product-group">
                    {!! Form::label('plane', 'Select Plan:') !!}
                    {!! Form::select('plane', $stripePackagesData, 'Book', [


                        'class'                       => 'form-control',
                        'required'                    => 'required',
                        'data-parsley-class-handler'  => '#product-group'
                        ]) !!}
                </div>
                <div class="form-group" id="cc-group">
                    {!! Form::label(null, 'Credit card number:') !!}
                    {!! Form::text(null, null, [
                        'class'                         => 'form-control',
                        'required'                      => 'required',
                        'data-stripe'                   => 'number',
                        'data-parsley-type'             => 'number',
                        'maxlength'                     => '16',
                        'data-parsley-trigger'          => 'change focusout',
                        'data-parsley-class-handler'    => '#cc-group'
                        ]) !!}
                </div>
                <div class="form-group" id="ccv-group">
                    {!! Form::label(null, 'CVC (3 or 4 digit number):') !!}
                    {!! Form::text(null, null, [
                        'class'                         => 'form-control',
                        'required'                      => 'required',
                        'data-stripe'                   => 'cvc',
                        'data-parsley-type'             => 'number',
                        'data-parsley-trigger'          => 'change focusout',
                        'maxlength'                     => '4',
                        'data-parsley-class-handler'    => '#ccv-group'
                        ]) !!}
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="exp-m-group">
                        {!! Form::label(null, 'Ex. Month') !!}
                        {!! Form::selectMonth(null, null, [
                            'class'                 => 'form-control',
                            'required'              => 'required',
                            'data-stripe'           => 'exp-month'
                        ], '%m') !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="exp-y-group">
                        {!! Form::label(null, 'Ex. Year') !!}
                        {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                            'class'             => 'form-control',
                            'required'          => 'required',
                            'data-stripe'       => 'exp-year'
                            ]) !!}
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                      {!! Form::submit('Place order!', ['class' => 'btn btn-lg btn-block btn-primary btn-order btn btn-white', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                    </div>
                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                  </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
    
  </div>
  </div>
    <!-- PARSLEY -->
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>

    
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey("<?php echo env('STRIPE_API_SECRET_KEY') ?>");

        $(document).ready(function () {
            alert();

            $('#payment-form').submit(function(event) {
                var $form = $(this);
                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                    formInstance.submitEvent.preventDefault();
                
                    return false;
                });
                $form.find('#submitBtn').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                return false;
            });
  //your code here
});
    
        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                var token = response.id;

                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.get(0).submit();
            }
        };
    </script>
<!-- END CONTENT -->
@stop