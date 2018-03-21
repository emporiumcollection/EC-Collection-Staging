@extends('frontend.themes.emporium.layouts.home')
{{--  For Title --}}
@section('title', 'List Page')
{{-- For Meta Keywords --}}
@section('meta_keywords', '')
{{-- For Meta Description --}}
@section('meta_description', '')
{{-- For Page's Content Part --}}
@section('content')
    <!-- Restaurant slider starts here -->
    <section id="search-result-slider" class="luxuryHotelSlider">
        <div id="myCarousel" class="carousel" data-ride="carousel">
            <!-- Indicators -->

            {{--  Wrapper for slides --}}
            <div class="carousel-inner">
                <div class="item active" style="background-image:url(images/search-result-img01.jpg);">
                    <div class="carousel-caption">
                        <h6>HOTEL</h6>
                        <h2>DISCOVER LUXURY HOTELS WITH EMPORIUM VOYAGE</h2>
                        <p>From the posh, sun-soaked beaches along the Indian Ocean to the epoch heights of the Himalayas, Emporium-Voyageis your ideal, vogue vacation planner! With over 300 posh properties and elite spas huddled in its cocoon, Our Design Locations ensure the ultimate luxury experience. Our expertise lies in our utmost diligence to provide our beau monde customers with an exotic experience they will relish forever.</p>
                    </div>
                </div>
                <div class="item" style="background-image:url(images/search-result-img02.jpg);">
                    <div class="carousel-caption">
                        <h6>HOTEL</h6>
                        <h2>DISCOVER LUXURY HOTELS WITH EMPORIUM VOYAGE</h2>
                        <p>From the posh, sun-soaked beaches along the Indian Ocean to the epoch heights of the Himalayas, Emporium-Voyageis your ideal, vogue vacation planner! With over 300 posh properties and elite spas huddled in its cocoon, Our Design Locations ensure the ultimate luxury experience. Our expertise lies in our utmost diligence to provide our beau monde customers with an exotic experience they will relish forever.</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <img src="images/editorial-left-arrow.png" alt="Icon"/>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <img src="images/editorial-right-arrow.png" alt="Icon"/>
            </a>
        </div>
    </section>
    {{-- Search Result --}}
    <section id="luxury-hotel-selection" class="search-result">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="heading">129 Hotel(s) Found for Hotel</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img02.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>The Soho Hotel</h5>
                                <p>From € 4000 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 4279 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">The Soho Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <!--<ul class="quicklinks">
                            <li><a href="javascript:void(0)">Quick View</a></li>
                            <li><a href="javascript:void(0)">Details View</a></li>
                        </ul>-->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img03.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Haymarket Hotel</h5>
                                <p>From € 2737 | Berlin</p>
                            </a>
                            <div class="pricelabel">From EUR 5200 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Haymarket Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <!--<ul class="quicklinks">
                            <li><a href="javascript:void(0)">Quick View</a></li>
                            <li><a href="javascript:void(0)">Details View</a></li>
                        </ul>-->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img04.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Covent Garden Hotel</h5>
                                <p>From € 2590 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3547 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Covent Garden Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <!--<ul class="quicklinks">
                            <li><a href="javascript:void(0)">Quick View</a></li>
                            <li><a href="javascript:void(0)">Details View</a></li>
                        </ul>-->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img01.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Ham Yard Hotel</h5>
                                <p>From € 4141 | Berlin</p>
                            </a>
                            <div class="pricelabel">From EUR 6984 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Ham Yard Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <!--<ul class="quicklinks">
                            <li><a href="javascript:void(0)">Quick View</a></li>
                            <li><a href="javascript:void(0)">Details View</a></li>
                        </ul>-->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img02.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>The Soho Hotel</h5>
                                <p>From € 4000 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 8714 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">The Soho Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img03.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Haymarket Hotel</h5>
                                <p>From € 2737 | New York</p>
                            </a>
                            <div class="pricelabel">From EUR 2547 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Haymarket Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img04.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Covent Garden Hotel</h5>
                                <p>From € 2590 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3651 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Covent Garden Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img01.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Ham Yard Hotel</h5>
                                <p>From € 4141 | Berlin</p>
                            </a>
                            <div class="pricelabel">From EUR 3682 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Ham Yard Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img02.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>The Soho Hotel</h5>
                                <p>From € 4000 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 2389 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">The Soho Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img03.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Haymarket Hotel</h5>
                                <p>From € 2737 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3879 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Haymarket Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img04.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Covent Garden Hotel</h5>
                                <p>From € 2590 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3628 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Covent Garden Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img01.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Ham Yard Hotel</h5>
                                <p>From € 4141 | Berlin</p>
                            </a>
                            <div class="pricelabel">From EUR 3496 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Ham Yard Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img02.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>The Soho Hotel</h5>
                                <p>From € 4000 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 4537 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">The Soho Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img03.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Haymarket Hotel</h5>
                                <p>From € 2737 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3287 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Haymarket Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="hotel-card">
                        <figure>
                            <img src="images/hotel-img04.jpg" alt="Emporium"/>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="content-overlay">
                                <h5>Covent Garden Hotel</h5>
                                <p>From € 2590 | London</p>
                            </a>
                            <div class="pricelabel">From EUR 3695 / night</div>
                        </figure>
                        <div class="title">
                            <h3><a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como">Covent Garden Hotel</a></h3>
                            <a href="https://www.emporium-voyage.com/luxury-hotel-cocoa-island-by-como" class="cartlink"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--  Search Result end --}}



@endsection

{{-- For Include Top Bar --}}
@section('top_search_bar')
    @parent
@endsection

{{-- For Include Side Bar --}}
@section('sidebar')
    @include('frontend.themes.emporium.layouts.sections.grid_sidebar')
@endsection

{{-- For Include style files --}}
@section('head')
    @parent

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
    @parent
@endsection