@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'Home')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
    <!-- slider starts here -->
    <section class="sliderSection"> 
        @if(!empty($slider))
            <div id="myCarousel" class="carousel" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach($slider as $key => $slider_row)
                        <div class="item {{($key == 0)? 'active' : ''}}">
                            <a ><img src="{{url('uploads/slider_images/'.$slider_row->slider_img)}}" alt="{{$slider_row->slider_title}}"></a>
                        </div>
                    @endforeach
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <img src="{{ asset('themes/emporium/images/editorial-left-arrow.png') }}" alt="Icon">
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <img src="{{ asset('themes/emporium/images/editorial-right-arrow.png') }}" alt="Icon">
                </a>
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

        <div class="carousel-caption transferSecFirst openTransferSec">
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            <button data-action="agree-button" class="bnt SendButon agreeButton" type="button">I Agree</button>
        </div>

        <div class="downloadFilesWrapp transferFileSec transferSecSecond">
            @if($filepath!='')
                <a href="{{ URL::to('uploads/varients_imgs/'.$filepath) }}" class="btn downloadFiles" download="{{$filepath}}" target="_self" >Download </a>
            @else
                Wrong Link
            @endif
        </div>
    </section>

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
    <link href="{{ asset('themes/emporium/css/transfer-css.css') }}" rel="stylesheet">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
@endsection

{{-- For custom script --}}
@section('custom_js')
    @parent           
@endsection

{{-- For footer --}}
@section('footer')

@endsection