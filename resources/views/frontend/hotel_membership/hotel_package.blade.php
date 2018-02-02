
@extends('frontend.layouts.ev.customer')
@section('content')
<style type="text/css">
    
.hotel-book-now {
                background: #ABA07C;
                color: #fff;
                font-size: 25px;
                height: 71px;
                margin: 0px 0px 10px 3px;
                opacity: 1;
                overflow-wrap: break-word;
                padding: 27px 5px;
                position: absolute;
                text-align: center;
                text-transform: uppercase;
                width: 174px;
                z-index: 99;
                float: left;
            }

</style>
<section class="wow fadeIn big-section cstmaiclass" id="align-to-top">
                    <div class="container-fluid">


                    	       <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-primary btn-circle cursor" disabled="disabled">1</a>
                                        <p>Step 1</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor">2</a>
                                        <p>Step 2</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a  type="button" class="btn btn-default btn-circle cursor" disabled="disabled">3</a>
                                        <p>Step 3</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a type="button" class="btn btn-default btn-circle cursor" disabled="disabled">4</a>
                                        <p>Step 4</p>
                                    </div>
                                </div>
                            </div>
                        <div class="row equalize sm-equalize-auto">
                            <div class="image-slider-container image-slider-margin-align auto-slider" id="rooms">
							@if (!empty($packages))
								<ul class="image-slider">
									{{--*/ $k=1; $tottyp = count($packages); /*--}}
									@foreach($packages as $key=>$package)
									<li class="{{($k==1) ? 'active' : ''}}">
                                        <a href="#">
                                            <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" style="height:580px; width: 100%;">
                                        </a>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="row">
                                                    <div class="image-slider-btns-bg">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="slider-sec-side-text-bg">
                                                            <div class="slider-side-sec-alignment">
                                                                <div class="expeience-small-text">Hotel Marketing Packages</div>
                                                                <div class="slider-side-text-tittle">{{$package->package_title}}</div>
                                                                <div class="slider-side-description-text">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img class="slider-next-image-btn img-responsive" src="http://www.emporium-voyage.com/uploads/properties_subtab_imgs/69726129-32146277.jpg" alt="">
                                                                <a href="#" style="margin-left:100px;" rel="{{$package->id}}" class="book-button open-show_more-page hotel-btn ClickButton">Show More</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
									{{--*/ $k++; /*--}}
												
									@endforeach

                                </ul>
                                <div class="clearfix"></div>
                                <div class=" editorial-images-count images-count">1 / {{$tottyp}}</div>
                                <div class="editorial-image-slider-btns image-slider-btns">
                                    <a class="editorial-image-slider-previous-btn image-slider-previous-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-left-arrow.png')}}" alt="">
                                    </a>
                                    <a class="image-slider-next-btn editorial-image-slider-next-btn" href="#">
                                        <img class="arrow-margin-right" src="{{ asset('sximo/assets/images/editorial-right-arrow.png')}}" alt="">
                                    </a>
                                </div>
								@endif
                            </div>
                        </div>
                    </div>
                </section>



<!--Accordan Code -->
<div class="col-sm-12" >
@if (!empty($packages))
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  

{{--*/ $k=1; $tottyp = count($packages); /*--}}
@foreach($packages as $key=>$package)
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading{{ $k }}">
      <h4 class="panel-title">
        <a  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $k }}" {{($k==1) ? 'aria-expanded="true" ' : ' aria-expanded="false" class="collapsed"'}} aria-controls="collapse{{ $k }}">
          {{$package->package_title}}  :: {{ $package->id }} :: Price: EUR:{{ $package->package_price }}
        </a>
      </h4>
    </div>
    <div id="collapse{{ $k }}" class="panel-collapse collapse {{($k==1) ? 'in ' : ''}}" role="tabpanel" aria-labelledby="heading{{ $k }}">
      <div class="panel-body">        
            <div>
                <div  style="width:20%" class="pull-left">
                    <img class="img-responsive object-fit-size" src="{{URL::to('uploads/packages/'.$package->package_image)}}" alt="{{$package->package_image}}" >



                 

                </div>
                <div class="pull-right" style="width:80%">
                    <p>Package Duration :: {{$package->package_duration}} {{$package->package_duration_type}} </p>  
                    <p>Package Details: {!! nl2br($package->package_description) !!}</p>

                     <div class="book-btn-sec">
               
                    
                        <div class="hotel-book-price">
                          EUR {{ $package->package_price }}
                        </div>
                       <a href="#"><div class="hotel-book-now">Add to cart</div></a>
                 
                    
                 
                </div>
                </div>
           </div>
      </div>
    </div>
</div>


    {{--*/ $k++; /*--}}
                                                
 @endforeach


</div>
@endif
</div>
<!-- end accrodan code -->
  
@endsection


@section('css')

<!-- swiper carousel -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/swiper.min.css')}}">
<!-- style -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{ asset('sximo/assets/memform/css/responsive.css')}}" />
<!-- Custom style -->
<link href="{{ asset('sximo/assets/memform/css/custom-ai.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{ asset('sximo/css/hotel-membership/style.css')}}">

@endsection

@section('script')

<script type="text/javascript" src="{{ asset('sximo/assets/memform/js/smooth-scroll.js')}}"></script>
        <!-- animation -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/wow.min.js')}}"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/swiper.min.js')}}"></script>

        <!-- images loaded -->
        <script type="text/javascript" src="{{ asset('sximo/assets/memform/js/imagesloaded.pkgd.min.js')}}"></script>
@endsection
 <!-- contact email aside -->
    <script>
        $('.contact-aside').hover(
                function () {
                    $(this).addClass('active')
                },
                function () {
                    $(this).removeClass('active')
                }
        );
<!-- Please remove .open-show_more-page- hifen -->
        $(document).on('click', '.open-show_more-page', function () {
            $('.show_more-page').css("background-image", "");
            $('.single-right-text-product').html('');
            $('.rmimgp').html('');
            $.ajax({
                url: "{{ URL::to('fetchpackagedetails')}}" + '/' + $(this).attr('rel'),
                type: "get",
                success: function (data) {
                    var rimg = "{{ URL::to('uploads/packages/')}}/" + data.pdata.package_image;
                    $('.rmimgp').html('<div class="right-text-section"></div>');
                    $('.show_more-page').css("background-image", "url('" + rimg + "')");
                    var imagesPro = '';
                    imagesPro += '<div class="text-section">';
                    imagesPro += '<h2>' + data.pdata.package_title + '</h2>';
                    imagesPro += '<p>' + data.pdata.package_description.replace(/\n/g,"<br>") + '</p>';
                    imagesPro += '</div>';
                    imagesPro += '<div class="book-btn-sec">';
                    if (data.pdata.package_price_type != 1)
                    {
                        imagesPro += '<div class="hotel-book-price">';
                        imagesPro += (data.currency.content != '') ? data.currency.content : '$';
                        imagesPro += data.pdata.package_price;
                        imagesPro += '</div>';
                        imagesPro += '<a href="#"><div class="hotel-book-now">Add to cart</div></a>';
                    }
                    else
                    {
                        imagesPro += '<div class="hotel-book-price">Price on request</div>';
                        imagesPro += '<a href="#"><div class="hotel-book-now">Get in touch</div></a>';
                    }
                    imagesPro += '</div>';
                    /*imagesPro += '<div class="inner-pop-up-book-btn">';
                    imagesPro += '<a href="#">Book</a>';
                    imagesPro += '</div>';*/
                    imagesPro += '</div>';
                    $('#popupopn .single-right-text-product').html(imagesPro);
                    $('.show_more-page').css("width", "100%");
                }
            });
            return false;
        });


    </script>


