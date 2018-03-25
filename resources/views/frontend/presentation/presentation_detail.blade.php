
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Emporium Voyage</title>

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
      
      {{--*/ $countersection = 2 /*--}}
      @foreach($presentationslider as $pslider)

        <li>
            <a href="#slidepresentation-{{ $countersection }}" data-number="{{ $countersection }}" @if($presentatiomode==0 && $countersection==2) class="is-selected" @endif >
              <span class="cd-dot"></span>
            </a>
          </li>

      {{--*/ $countersection++ /*--}}

      @endforeach


      @if($presentatiomode==1)  
      <li>
        <a href="#thanksSection" data-number="1" @if($presentatiomode==1)  @endif>
          <span class="cd-dot"></span>
        </a>
      </li>
      
      @endif
      
    </ul>
  </nav>



@if($presentatiomode==1) 
    <div class="logoTopSec">
      <img src="{{ asset('images/logo.png') }}" alt="Image">
    </div>
    <section class="headerSection">
       <div class="textCcenterDiv">
        <h2><img src="{{ asset('images/logo.png') }}" alt="Image"></h2>
      </div>
      <a href="#slidepresentation-2" class="scrollToNextrSection scrollToSection"><span><img src="{{ asset('images/down-arrow.png') }}"></span></a>
    </section>
    @endif

     {{--*/ $countersectionsub = 2 /*--}}
      @foreach($presentationslider as $pslider)

      <section id="slidepresentation-{{ $countersectionsub }}" class="cd-section">
        <div class="container-fluid">
         <div class="row">
           <div class="col-md-6 col-sm-6">
               
             <div class="imageSection">
               <img src="{{ asset('images/image-3.jpg') }}" alt="Image">
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

