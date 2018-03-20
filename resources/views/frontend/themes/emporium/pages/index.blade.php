@extends('frontend.themes.emporium.layouts.home')
<!-- For Title -->
@section('title', 'Home')
<!-- For Page's Content Part -->
@section('content')
    <!-- slider starts here -->
         <section class="sliderSection">
            <div id="myCarousel" class="carousel" data-ride="carousel">
               <!-- Indicators -->
               <!--     <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  </ol> -->
               <!-- Wrapper for slides -->
               <div class="carousel-inner">
                  <div class="item active">
                     <a href="javascript:void(0);"><img src="images/1500111312-92134786.jpg" alt="Los Angeles"></a>
                     <div class="carousel-caption">
                        <h1>Experience Luxury</h1>
                        <p>Experience Luxuy Hotels with Emporium Yachts</p>
                     </div>
                  </div>
                  <div class="item">
                     <a href="javascript:void(0);"><img src="images/1487942280-6276912.jpg" alt="Chicago"></a>
                     <div class="carousel-caption">
                        <h1>Experience Luxury Germany</h1>
                        <p>From the posh, sun-soaked beaches along the Indian Ocean to the epoch heights of the Himalayas, Emporium-Voyage is your ideal, vogue vacation planner! With over 300 posh properties and elite spas huddled in its cococoon.</p>
                     </div>
                  </div>
               </div>
               <!-- Left and right controls -->
               <a class="left carousel-control" href="#myCarousel" data-slide="prev">
               <img src="images/editorial-left-arrow.png" alt="Icon">
               </a>
               <a class="right carousel-control" href="#myCarousel" data-slide="next">
               <img src="images/editorial-right-arrow.png" alt="Icon">
               </a>
            </div>
            <div class="sliderFooter">
               <ul>
                  <li><a href="javascript:void(0);">Imprint</a></li>
                  <li><a href="terms-and-conditions.html">Terms and Conditions</a></li>
               </ul>
            </div>
         </section>
      
@endsection

<!-- For Include style files -->
@section('head')
    @parent
	
@endsection

<!-- For custom style  -->
@section('custom_css')
    @parent
@endsection

<!-- For Include javascript files -->
@section('javascript')
    @parent
@endsection

<!-- For custom script -->
@section('custom_js')
    @parent
@endsection