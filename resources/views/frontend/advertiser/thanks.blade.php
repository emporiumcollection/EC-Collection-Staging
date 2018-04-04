@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', $pageTitle)
{{-- For Meta Keywords --}}
@section('meta_keywords', $pageMetakey)
{{-- For Meta Description --}}
@section('meta_description', $pageMetadesc)
{{-- For Page's Content Part --}}

@section('content')

    <!-- start Slider form section -->

    <section class="sliderSection termConditionSlider">
    @if(!empty($pageslider))
      <div id="restaurantSlider" class="carousel" data-ride="carousel">
        <!-- Indicators -->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($pageslider as $key => $slider_row)
              <div class="item {{($key == 0)? 'active' : ''}}" style="background:url({{url('uploads/slider_images/'.$slider_row->slider_img)}}) center center no-repeat; background-size:cover;">
                <div class="carousel-caption">
                  <h1>{{$slider_row->slider_title}}</h1>
                  <p>{{$slider_row->slider_description}}</p>
                  <button type="button" class="button viewGalleryBtn">Contact us</button>
                </div>
              </div>
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#restaurantSlider" data-slide="prev">
          <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
        </a>
        <a class="right carousel-control" href="#restaurantSlider" data-slide="next">
          <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
        </a>
      </div>
      <span class="scrollNextDiv"><a class="scrollpage" href="#thankYouSec">Scroll Down</a></span>
    @endif
    </section>
    <!-- End Slider form section -->
<section id="thankYouSec" class="thankYouSec">
    <div class="thankYouContent">
        <img src="{{ asset('themes/emporium/images/thankyou.png') }}" alt="Icon">
        <h2>Thank You!</h2>
        <div class="formPreview">
            <div class="col-xs-6 col-sm-4"><label>First Name</label><p>John</p></div>
            <div class="col-xs-6 col-sm-4"><label>Last Name</label><p>Doe</p></div>
            <div class="col-xs-6 col-sm-4"><label>E-mail</label><p>example@demo.com</p></div>
            <div class="col-xs-6 col-sm-4"><label>Mobile No</label><p>0-000-000-000</p></div>
            <div class="col-xs-6 col-sm-4"><label>Pereferred Date</label><p>12-03-2018</p></div>
            <div class="col-xs-6 col-sm-4"><label>Pereferred Time</label><p>12:45 Am</p></div>
            <div class="col-xs-6 col-sm-4"><label>No Of Guest</label><p>3</p></div>
            <div class="col-xs-12"><label>Message</label><p> Thank you for submitting your information, you will be contact soon by our customer service department.</p></div>

        </div>
        <a href="{{ URL::to('')}}">Back to Home</a>
    </div>
</section>

@endsection

{{--For Right Side Icons --}}
      @section('right_side_iconbar')
      
      @include('frontend.themes.emporium.layouts.sections.home_right_iconbar')
      @endsection

{{-- For Include style files --}}
@section('head')
    @parent
    
    <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/restaurant-css.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
    <script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent
    <script>
         window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };

        $(function () {
            $('#conatctform').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
            submit_contact_request();
            return false; // Don't submit form for this demo
            });
        });
        
        function submit_contact_request()
        {
            $.ajax({
                  url: "{{ URL::to('save_query')}}",
                  type: "post",
                  data: $('#conatctform').serialize(),
                  dataType: "json",
                  success: function(data){
                    var html = '';
                    if(data.status=='error')
                    {
                        html +='<ul class="parsley-error-list">';
                        $.each(data.errors, function(idx, obj) {
                            html +='<li>'+obj+'</li>';
                        });
                        html +='</ul>';
                        $('#formerrors').html(html);
                    }
                    else{
                        var htmli = '';
                        htmli +='<div class="alert alert-success fade in block-inner">';
                        htmli +='<button data-dismiss="alert" class="close" type="button">×</button>';
                        htmli +='<i class="icon-checkmark-circle"></i> Contact Form Submitted Successfully </div>';
                        $('#formerrors').html(htmli);
                        $('#conatctform')[0].reset();
                    }
                  }
            });
        }
    </script>
@endsection

{{-- For footer --}}
@section('footer')
    
@endsection