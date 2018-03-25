
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
      @if($presentatiomode==true)  
      <li>
        <a href="#firstSection" data-number="1" @if($presentatiomode==true) class="is-selected" @endif>
          <span class="cd-dot"></span>
        </a>
      </li>
      
      @endif
      <li>
        <a href="#slidepresentation-1" data-number="2" @if($presentatiomode==false) class="is-selected" @endif >
          <span class="cd-dot"></span>
        </a>
      </li>
      <li>
        <a href="#slidepresentation-2" data-number="3" class="">
          <span class="cd-dot"></span>
        </a>
      </li>
      <li>
        <a href="#slidepresentation-3" data-number="4" class="">
          <span class="cd-dot"></span>
        </a>
      </li>
      <li>
        <a href="#slidepresentation-4" data-number="5" class="">
          <span class="cd-dot"></span>
        </a>
      </li>
      <li>
        <a href="#slidepresentation-5" data-number="6" class="">
          <span class="cd-dot"></span>
        </a>
      </li>
    </ul>
  </nav>


@if($presentatiomode==true) 
<div class="logoTopSec">
  <img src="{{ asset('images/logo.png') }}" alt="Image">
</div>
    <section class="headerSection">
       <div class="textCcenterDiv">
        <h2><img src="{{ asset('images/logo.png') }}" alt="Image"></h2>
      </div>
      <a href="#firstSection" class="scrollToNextrSection scrollToSection"><span><img src="{{ asset('images/down-arrow.png') }}"></span></a>
    </section>
    @endif
    <section id="firstSection" class="cd-section">
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
                <h3>Lorem Ipsum <span>dummy text</span></h3>
              <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="accordianSection">
                  <button class="accordianHeading">Lorem Ipsum is dummy text<span class="iconSec">+</span></button>
                  <div class="accordianContent">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                  </div>
                </div>
                </div>
              </div>
           </div>
         </div>
         </div>
      </div>
    </section>
    <section id="slidepresentation-1" class="cd-section">
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
                <h3>Lorem Ipsum <span>dummy text</span></h3>
              <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="accordianSection">
                  <button class="accordianHeading">Lorem Ipsum is dummy text<span class="iconSec">+</span></button>
                  <div class="accordianContent">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                  </div>
                </div>
                </div>
              </div>
           </div>
         </div>
         </div>
      </div>
    </section>
    <section id="slidepresentation-2" class="cd-section">
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
                <h3>Lorem Ipsum <span>dummy text</span></h3>
              <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="accordianSection">
                  <button class="accordianHeading">Lorem Ipsum is dummy text<span class="iconSec">+</span></button>
                  <div class="accordianContent">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                  </div>
                </div>
                </div>
              </div>
           </div>
         </div>
         </div>
      </div>
    </section>
    
    <section id="slidepresentation-3" class="cd-section">
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
                <h3>Lorem Ipsum <span>dummy text</span></h3>
              <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="accordianSection">
                  <button class="accordianHeading">Lorem Ipsum is dummy text<span class="iconSec">+</span></button>
                  <div class="accordianContent">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                  </div>
                </div>
                </div>
              </div>
           </div>
         </div>
         </div>
      </div>
    </section>
    <section id="slidepresentation-4" class="cd-section">
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
                <h3>Lorem Ipsum <span>dummy text</span></h3>
              <div class="contentScroller mCustomScrollbar" data-mcs-theme="minimal-dark">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="accordianSection">
                  <button class="accordianHeading">Lorem Ipsum is dummy text<span class="iconSec">+</span></button>
                  <div class="accordianContent">
                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                  </div>
                </div>
                </div>
              </div>
           </div>
         </div>
         </div>
      </div>
    </section>
    @if($presentatiomode==true) 
    <section id="sixthSection" class="cd-section headerSection thankyousection">
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

