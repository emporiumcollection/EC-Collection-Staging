@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Meta Keywords --}}
@section('meta_keywords', 'Emporium Voyage, Luxury Hotel Booking, Luxury 5 Star Hotels')
{{-- For Meta Description --}}
@section('meta_description', 'Emporium Voyage - Your Ultimate Luxury Travel Partner')
{{-- For Page's Content Part --}}
@section('content')
<div class="logo-box">
    <a href="{{url('/')}}" class="logo-bx">
          <img src="{{ asset('themes/emporium/images/emporium-voyage-logo.png')}}" alt="Emporium Voyage" class="img-responsive"/>
    </a>
</div>
<div class="u-inline-block menu-bx unlog"><button class="c-header__btn-sound t-btn u-inline-block u-valign-middle u-vacuum log_in-btn"><div class="u-inline-block u-valign-middle u-marg-r-sm u-hide@sm" style="display: none;"><div class="c-header__btn-sound__bar u-relative u-inline-block"></div><div class="c-header__btn-sound__bar u-relative u-inline-block"></div><div class="c-header__btn-sound__bar u-relative u-inline-block"></div><div class="c-header__btn-sound__bar u-relative u-inline-block"></div><div class="c-header__btn-sound__bar u-relative u-inline-block"></div></div>

  <span class="t-text--xs t-text--ls-xxs t-text--black u-inline-block u-uppercase u-valign-middle log-hover"><span class="log-hide">Login</span> <span class="hover-dsp">Join</span></span></button><button class="c-header__btn-menu t-btn u-relative u-inline-block u-valign-middle u-vacuum"><div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div><div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div><div class="c-header__btn-menu__dot u-inline-block u-bg--white"></div> <div class="c-header__btn-menu__bar u-absolute u-pos-center u-inline-block"></div><div class="c-header__btn-menu__bar u-absolute u-pos-center u-inline-block"></div> <div class="c-header__btn-menu__circle u-absolute u-shape-circle"></div> <div class="c-header__btn-menu__content u-absolute u-pos-tl u-backface-hidden u-hide@sm"><p class="c-header__btn-menu__content__label t-text--xs t-text--ls-xxs t-text--black u-absolute u-pos-tl u-uppercase u-force-inline"><span class="c-header__btn-menu__content__label__word u-inline-block">Open</span> <span class="c-header__btn-menu__content__label__word u-inline-block">Menu</span></p> <p class="c-header__btn-menu__content__label t-text--xs t-text--ls-xxs t-text--black u-absolute u-pos-tl u-uppercase u-force-inline"><span class="c-header__btn-menu__content__label__word u-inline-block">Close</span> <span class="c-header__btn-menu__content__label__word u-inline-block">Menu</span></p></div></button></div>
    <!-- slider starts here -->
         <section class="sliderSection" id="home_sld">
            @if(!empty($slider))
              <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                 <!-- Wrapper for slides -->
                 <div class="carousel-inner wrapper">
                    @foreach($slider as $key => $slider_row)
                      <div class="card item {{($key == 0)? 'active' : ''}}" data-tilt>
          <div class="image-overaly-bg"></div>
          <div class="image-overaly-bg bg-dark"></div>
                         <a href="{{$slider_row->slider_link}}">
                           <img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}"> alt=""/>
                         </a>
                         <div class="carousel-caption item-front">
                          <div class="head-sec">
                           <div class="round-crcle">
                                  <button class="c-slide__icon-more t-btn u-inline-block u-absolute u-pos-t u-marg-l-xxs u-valign-top u-shape-circle u-marg-t-xs u-marg-t-0@sm" style="left: 20px; transform: translateX(7.14446e-25px) translateY(5.59666e-25px) scale(1) translateZ(0px);"><div class="c-slide__icon-more__container u-absolute u-pos-center"><div class="c-slide__icon-more__bar u-absolute u-bg--white"></div><div class="c-slide__icon-more__bar u-absolute u-bg--white"></div></div> <img src="{{ asset('themes/emporium/images/gradient-circle.svg')}}" class="c-slide__icon-more__gradient o-wrapper--panel u-fit"></button>
                          </div>
                          <h1><a href="{{$slider_row->slider_link}}">{{$slider_row->slider_title}}</a></h1>
                         </div>

                           <div class="cnt-box">
                            <p><a href="{{$slider_row->slider_link}}" style="color:white;">{{$slider_row->slider_description}}</a></p>
                         </div>
                       </div>
                      </div>
                    @endforeach
          {{--*/ $sliderads = CommonHelper::getSliderAds('landing_slider', 'Hotel') /*--}}
          @if(!empty($sliderads['leftsidebarads']))
            @foreach($sliderads['leftsidebarads'] as $ads)
              <div class="item">
                <a><img src="{{URL::to('uploads/users/advertisement/'.$ads->adv_img)}}" alt="" /></a>
                <div class="carousel-caption">
                  <div class="round-crcle"></div>
                           <div class="cnt-box">
                  <h1><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}">{{$ads->adv_title}}</a></h1>
                  <p><a href="{{ (strpos($ads->adv_link, 'http://') !== false) ? $ads->adv_link : 'http://'.$ads->adv_link }}" style="color:white;">{{$ads->adv_desc}} </a></p>
                </div>
              </div>
              </div>
            @endforeach
          @endif
                 </div>
                 <!-- Left and right controls -->


<!-- arrow animation -->
 <footer class="first-arw c-slideshow__footer u-absolute u-pos-bl u-fit-w u-pad-x-w1of12"><a href="#myCarousel" data-slide="prev" class="c-slideshow__control c-slideshow__control--left t-link u-absolute u-pos-bl u-pad-t-sm u-pad-b-xs u-marg-l-w1of13 u-marg-b-vh1of12 u-rtl u-vacuum router-link-active hide-frst"><div><div class="c-slideshow__control__line--before u-bg--white u-inline-block u-valign-middle u-hide@sm"></div> <span class="c-slideshow__control__label t-text--xs t-text--ls-md t-text--black u-inline-block u-valign-middle u-marg-l-lg u-uppercase u-marg-l-md@md u-block@sm u-marg-b-xs@sm u-marg-l-0@sm">Prev</span> <div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle"></div>
  <img src="{{ asset('themes/emporium/images/arrow-x-left-end.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />

</div></a> <div class="log_in-btn c-slideshow__control__bottom u-cursor-pointer u-absolute u-pos-bl u-marg-b-vh1of12 u-marg-l-w5of12 u-vacuum u-marg-l-0@sm u-align-center@sm u-w3of12@sm hide-frst"><div class="c-slideshow__control__bottom__border u-absolute u-pos-tl u-w1of2 u-fit-h u-hide@sm "><div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-bl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-h u-bg--white"></div></div> <div class="c-slideshow__control__bottom__border u-absolute u-pos-tr u-w1of2 u-fit-h u-hide@sm"><div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-bl u-fit-w u-bg--white"></div> <div class="c-slideshow__control__bottom__border__bar u-absolute u-pos-tr u-fit-h u-bg--white"></div></div> <span class="c-slideshow__control__bottom__label t-text--xs t-text--ls-md t-text--black u-relative u-inline-block u-valign-middle u-marg-r-md u-uppercase u-force-3d u-marg-r-0@sm u-marg-b-xs@sm">Join the Club</span> <div class="c-slideshow__control__bottom__container u-absolute u-pos-r u-pos-y-center u-marg-r-md u-inline-block u-valign-middle u-force-3d u-overflow-h u-relative@sm u-block@sm u-marg-x-auto@sm"><div class="c-slideshow__control__bottom__arrow u-absolute"><div class="c-slideshow__control__bottom__line u-bg--white"></div>

<img src="{{ asset('themes/emporium/images/arrow-y-top-end.svg')}}" alt="" class="c-slideshow__control__bottom__arrow__icon t-icon--arrow-y" />

</div>

<img src="{{ asset('themes/emporium/images/arrow-y-top-end.svg')}}" alt="" class="c-slideshow__control__bottom__icon t-icon--arrow-y u-absolute u-pos-bl" />

</div></div> <a href="#myCarousel" data-slide="next" class="c-slideshow__control c-slideshow__control--right t-link u-absolute u-vacuum u-pos-br u-pad-t-sm u-pad-b-xs u-marg-r-w1of13 u-marg-b-vh1of12 u-align-right"><div><div class="c-slideshow__control__line--before u-bg--white u-inline-block u-valign-middle u-hide@sm"></div> <span class="c-slideshow__control__label t-text--xs t-text--ls-md t-text--black u-relative u-inline-block u-valign-middle u-marg-r-lg u-uppercase u-marg-r-md@md u-block@sm u-align-right@sm u-marg-b-xs@sm u-marg-r-0@sm"><span class="c-slideshow__control__label__word u-absolute u-pos-tr u-force-inline u-inline-block u-inline-block nxt-pg">Next</span>
  <span class="c-slideshow__control__label__word">Scroll explore</span>
  <span class="frst-scn">Ultra Luxury by invitation only</span>
</span> <div class="u-relative u-inline-block u-valign-middle u-overflow-h"><div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle"></div>


  <img src="{{ asset('themes/emporium/images/arrow-x-right-end.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />


  <div class="c-slideshow__control__discover__container__panel__mask-in o-wrapper--panel u-fit u-overflow-h"><div class="c-slideshow__control__discover__container__panel__mask-out o-wrapper--panel u-fit u-overflow-h"><div class="c-slideshow__control__line--after u-bg--white u-inline-block u-valign-middle u-bg--gray-dark"></div>


  <img src="{{ asset('themes/emporium/images/arrow-x-right-end-gray.svg')}}" alt="" class="t-icon--arrow-x-end u-inline-block u-valign-middle" />

</div></div></div></div></a></footer>
<!-- end of ARRow -->

              </div>
            @endif
            <div class="sliderFooter">
                {{--*/ $landing_menus = SiteHelpers::menus('landing') /*--}}
               @if(!empty($landing_menus))
                 <ul>
                  @foreach ($landing_menus as $fmenu)
                    <li>
                        <a @if($fmenu['menu_type'] =='external') href="{{ URL::to($fmenu['url'])}}" @else href="{{ URL::to($fmenu['module'])}}" @endif >
                          @if(CNF_MULTILANG ==1 && isset($fmenu['menu_lang']['title'][Session::get('lang')]))
                              {{ $fmenu['menu_lang']['title'][Session::get('lang')] }}
                          @else
                              {{$fmenu['menu_name']}}
                          @endif
                        </a>
                    </li>
                  @endforeach
          <li><a href="javascript:void(0);" class="termAndConditionBtn">Contact us</a></li>
                 </ul>
                @ENDIF
            </div>
         </section>

         <div class="pop-hetel">

         </div>

    @include('frontend.themes.emporium.layouts.sections.contactus_popup')
@endsection

{{--For Right Side Icons --}}
      @section('right_side_iconbar')

      @include('frontend.themes.emporium.layouts.sections.home_right_iconbar')
      @endsection

{{-- For Include style files --}}
@section('head')
    @parent
  <link href="{{ asset('themes/emporium/css/terms-and-conditions.css') }}" rel="stylesheet">
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
