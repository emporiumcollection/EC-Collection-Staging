
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     
 @if($presentationPageDetails[0]->page_title!="" && $presentationPageDetails[0]->page_title!="NULL")
        <title>{{ $presentationPageDetails[0]->page_title }}</title>
      @endif
      <meta property="og:title" content="{{ $presentationPageDetails[0]->page_title }}" />
      @if($presentationPageDetails[0]->page_meta_description!="" && $presentationPageDetails[0]->page_meta_description!="NULL")
      <meta name="description" content="{{ $presentationPageDetails[0]->page_meta_description }}">
      <meta property="og:description" content="{{ $presentationPageDetails[0]->page_meta_description }}" />
      @endif

      @if($presentationPageDetails[0]->page_keyword!="" && $presentationPageDetails[0]->page_keyword!="NULL")
      <meta name="keywords" content=" {{ $presentationPageDetails[0]->page_keyword }}">
     @endif


    <!-- Bootstrap -->
    <link href="{{ asset('themes/emporium/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Style -->
    <link href="{{ asset('themes/emporium/css/presentationstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/emporium/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

      <nav id="cd-vertical-nav">
    <ul>
      
      {{--*/ $countersection = 1 /*--}}
      @foreach($presentationslider as $pslider)

        <li>
            <a href="#slidepresentation-{{ $countersection }}" data-number="{{ $countersection }}" @if( $countersection==1) class="is-selected" @else  
            class="" @endif >
              <span class="cd-dot"></span>
            </a>
          </li>

      {{--*/ $countersection++ /*--}}

      @endforeach


      @if($presentatiomode==1)  
      {{--*/ $countersection=$countersection /*--}}
      <li> 
        <a href="#thanksSection" data-number="{{ $countersection }} "  class="">
          <span class="cd-dot"></span>
        </a>
      </li>
      
      @endif
      
    </ul>
  </nav>




    <div class="logoTopSec" @if($presentatiomode==0) style="display: none;" @endif>
      <img src="{{ asset('images/logo.png') }}" alt="Image">
    </div>
    
    <section class="headerSection" @if($presentatiomode==0) style="display: none;" @endif>
       <div class="textCcenterDiv">
        <h2><img src="{{ asset('images/logo.png') }}" alt="Image"></h2>
      </div>
      <a href="#slidepresentation-1" class="scrollToNextrSection scrollToSection"><span><img src="{{ asset('images/down-arrow.png') }}"></span></a>
    </section>
  

     {{--*/ $countersectionsub = 1 /*--}}
      @foreach($presentationslider as $pslider)

      @if($pslider->slide_type=="ImageOnly" && $pslider->slider_img!="")
         <section id="slidepresentation-{{ $countersectionsub }}" class="cd-section fullWidthImg" style="background-image: url({{url()}}/uploads/presentation/{{$pslider->slider_img}});">
          </section>


      @else
      <section id="slidepresentation-{{ $countersectionsub }}" class="cd-section">
        <div class="container-fluid">
         <div class="row">
           <div class="col-md-6 col-sm-6">
               
             <div class="imageSection">
               @if($pslider->slide_type=="Image" && $pslider->slider_img!="")
               <img src=" {{url()}}/uploads/presentation/{{$pslider->slider_img}}" alt="Image">
               @endif
             </div>
           </div>
           <div class="col-md-6 col-sm-6">
             <div class="contactSection">
                <div class="contacSecInner">
                  <h3>{{ $pslider->slider_title}}</h3>
                <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                  <p>{{ $pslider->slider_description}}</p>
                  <div class="accordianSection">
                    <button class="accordianHeading">{{$pslider->slider_sub_title}}<span class="iconSec">+</span></button>
                    <div class="accordianContent">
                      <p>{{$pslider->slider_sub_description}}</p>
                    </div>
                  </div>
                  </div>
                </div>
             </div>
           </div>
           </div>
        </div>
      </section>
@endif

 
     {{--*/ $countersectionsub++ /*--}}
     @endforeach
    @if($presentatiomode==1) 
    <section id="thanksSection" class="cd-section headerSection thankyousection">
       <div class="textCcenterDiv">
        <h2>THANK YOU.</h2>
      </div>
    </section>
    @endif
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('themes/emporium/js/jquery-3.2.1.min.js') }}"></script>
 
    <script src="{{ asset('themes/emporium/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('themes/emporium/js/presentations-custom.js') }}" ></script>


  </body>
</html>

