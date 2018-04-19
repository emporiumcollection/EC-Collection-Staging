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
        <div class="transferFileSec transferSecSecond">
            <form method="get" id="filetransferform" action="{{URL::to('hotel/transferimages')}}">
                <div class="form-errors"> </div>
                <div class="uploadInput">
                    <h2>+ Add Your Files</h2>
                    {{--<input type="file">--}}
                </div>
                <div class="form-group  " >
                    <div class="dropzone" id="dropzoneFileUpload"> </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email to">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Your email">
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Message"></textarea>
                </div>
                <button class="bnt SendButon AddFileButton" type="button">Send</button>
            </form>
        </div>
        <div class="carousel-caption transferSecThird">
            <label class="labelHeading">Lorem Ipsum is simply dummy text
                <input type="checkbox" checked="checked">
                <span class="checkmark"></span>
            </label>
            <label class="labelHeading">Lorem Ipsum is simply dummy text
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="labelHeading">Lorem Ipsum is simply dummy text
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="labelHeading">Lorem Ipsum is simply dummy text
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <button class="bnt SendButon" type="button">Send</button>
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
    <link rel="stylesheet" href="{{ asset('sximo/css/dropzone.css') }}">
@endsection

{{-- For custom style  --}}
@section('custom_css')
    @parent
@endsection

{{-- For Include javascript files --}}
@section('javascript')
    @parent
    <script src="{{ asset('sximo/js/parsley.min.js')}}" type="text/javascript"></script>

    <script src="{{ asset('sximo/js/dropzone.js') }}"></script>
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

    <script>
        $(function () {
            var baseUrl = "{{ url::to('hotel/transferaddfile') }}";
            var token = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("div#dropzoneFileUpload", {
                url: baseUrl,
                params: {
                    _token: token,
                    fold_id: 6200,
                    emailaddress: $('#emailaddress').val(),
                    message: $('textarea#message').val(),
                    propertyname: $('#propertyname').val(),
                },
                paramName: "file", // The name that will be used to transfer the file
                addRemoveLinks: true,
                success: function(file, response){
                    if(response=='error')
                    {
                        $('.form-errors').html('Something went wrong, please check the form and try again!');
                    }
                    else
                    {
                        $('.form-errors').html('Files added successfully!');
                    }

                },
                init: function() {
                    var thisDropzone = this;
                    this.on("processing", function(file) {
                        thisDropzone.options.params.fold_id = localStorage.getItem('fold_id');
                        thisDropzone.options.params.emailaddress = $('#emailaddress').val();
                        thisDropzone.options.params.message = $('textarea#message').val();
                        thisDropzone.options.params.propertyname = $('#propertyname').val();
                    });
                }
            });
        });
    </script>
@endsection

{{-- For footer --}}
@section('footer')

@endsection