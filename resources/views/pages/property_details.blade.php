<link rel="stylesheet" type="text/css" href="{{ asset('sximo/themes/elliot/project7/css/project7.css') }}">	
<link rel="stylesheet" type="text/css" href="{{ asset('sximo/themes/elliot/project7/css/project7_ans.css') }}">
<link rel="stylesheet" type="text/safari" href="{{ asset('sximo/themes/elliot/project7/css/project7_safari.css') }}"> 
<!--<div id="content_wrapper">
<div class="wrapperforliineedforlightboxremoval">
							<div class="cat_product_medium">
						
								<div class="listDetails">
									<div class="photographBox">
										<a title="{{$data->property_name}}" class="photograph" href="#">
											<h2 style="font-size:26px; margin:20px;">{{$data->property_name}}</h2>
										</a>
									</div>
									<img alt="" src="{{$image[0]}}">
								
								</div>
							</div>
						</div>
</div>
-->

         
<link href="{{ asset('sximo/themes/elliot/project7/css/js-image-slider.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('sximo/themes/elliot/project7/js/js-image-slider.js') }}" type="text/javascript"></script>
<!----------------------- Header end ------------------------->

    <div id="sliderFrame">
        <div class="slider-main">
        <div id="sliders"> 
			
			@foreach($image as $obj)   
            <a href="#"><img src="{{$obj}}" /></a>
			@endforeach
        </div>
		<div class="slider-btn">
		   <ul>
		   <li><a href="#">info</a></li>
		   <li><a href="#">Gallery</a></li>
		   <li><a href="#">Lightbox</a></li>
		   </ul>
		</div>
   
                
        <!--thumbnails-->
        <div id="thumbs">
            <!--<div class="thumb"><img src="images/1.jpg" /></div>
           -->
        </div>
    </div>
	
	
<div class="slider-content">	
 <div class="slider-content-contact">
 <p>For Sale</p> 
<b>AED 7,197,888</b>
<h3>{{$data->property_name}}</h3>

<div class="slider-form">
<button onclick="javascript:$('.slider-form-fields').show('slow');$(this).hide('slow');" class="slider-form-btn">Contact Agent</button>
  <div class="slider-form-fields" style="display:none;">
     <form action="#" method="POST" id="enquiry-form">
					<input type="hidden" value="3338" name="ref">
					<input type="hidden" value="1" name="type">
					<div class="mt-m hidden" id="property-contact" style="display: block;">
						<div class="grey-line"></div>
						<div class="ml-b mr-m">
							<p class="f12 mt-m mb-b lh13">Contact our Luxury Specialist on <span class="white">+971 45 50 83 35</span> or kindly provide your details below</p>
							<div class="s-100 mb-m relative">
								<input type="text" required="" placeholder="Full Name" name="name" class="s100" aria-required="true">
							</div>
							<div class="s-100 mb-m relative">
								<input type="email" required="" placeholder="E-mail" name="email" class="s100" aria-required="true">
							</div>
							<div class="s-100 mb-m relative">
								<div class="s-100 mb-m block">
	<div class="country-selector">
		<div class="current-selection">
			<span style="background-position: 0px -1078px" class="country-flag"></span>
			<i class="fa fa-angle-down country-arrow-down"></i>
		</div>

		<div role="listbox" class="options-selector" style="display: none;">
			<span data-code="+93" data-id="1" role="option" class="country-option">
				<span style="background-position: 0px -0px" class="country-flag"></span>
				<span class="country-name">Afghanistan</span> +93
			</span>
			<span data-code="+355" data-id="2" role="option" class="country-option selected">
				<span style="background-position: 0px -11px" class="country-flag"></span>
				<span class="country-name">Albania</span> +355
			</span>
			<span data-code="+213" data-id="3" role="option" class="country-option">
				<span style="background-position: 0px -22px" class="country-flag"></span>
				<span class="country-name">Algeria</span> +213
			</span>
			<span data-code="+684" data-id="4" role="option" class="country-option">
				<span style="background-position: 0px -33px" class="country-flag"></span>
				<span class="country-name">American Samoa</span> +684
			</span>
			<span data-code="+376" data-id="5" role="option" class="country-option">
				<span style="background-position: 0px -44px" class="country-flag"></span>
				<span class="country-name">Andorra</span> +376
			</span>
			<span data-code="+244" data-id="6" role="option" class="country-option">
				<span style="background-position: 0px -55px" class="country-flag"></span>
				<span class="country-name">Angola</span> +244
			</span>
			<span data-code="+1264" data-id="7" role="option" class="country-option">
				<span style="background-position: 0px -66px" class="country-flag"></span>
				<span class="country-name">Anguilla</span> +1264
			</span>
			<span data-code="+0" data-id="8" role="option" class="country-option">
				<span style="background-position: 0px -77px" class="country-flag"></span>
				<span class="country-name">Antarctica</span> +0
			</span>
			<span data-code="+1268" data-id="9" role="option" class="country-option">
				<span style="background-position: 0px -88px" class="country-flag"></span>
				<span class="country-name">Antigua and Barbuda</span> +1268
			</span>
			<span data-code="+54" data-id="10" role="option" class="country-option">
				<span style="background-position: 0px -99px" class="country-flag"></span>
				<span class="country-name">Argentina</span> +54
			</span>
			<span data-code="+374" data-id="11" role="option" class="country-option">
				<span style="background-position: 0px -110px" class="country-flag"></span>
				<span class="country-name">Armenia</span> +374
			</span>
			<span data-code="+297" data-id="12" role="option" class="country-option">
				<span style="background-position: 0px -121px" class="country-flag"></span>
				<span class="country-name">Aruba</span> +297
			</span>
			<span data-code="+61" data-id="13" role="option" class="country-option">
				<span style="background-position: 0px -132px" class="country-flag"></span>
				<span class="country-name">Australia</span> +61
			</span>
			<span data-code="+43" data-id="14" role="option" class="country-option">
				<span style="background-position: 0px -143px" class="country-flag"></span>
				<span class="country-name">Austria</span> +43
			</span>
			<span data-code="+994" data-id="15" role="option" class="country-option">
				<span style="background-position: 0px -154px" class="country-flag"></span>
				<span class="country-name">Azerbaijan</span> +994
			</span>
			<span data-code="+1242" data-id="16" role="option" class="country-option">
				<span style="background-position: 0px -165px" class="country-flag"></span>
				<span class="country-name">Bahamas</span> +1242
			</span>
			<span data-code="+973" data-id="17" role="option" class="country-option">
				<span style="background-position: 0px -176px" class="country-flag"></span>
				<span class="country-name">Bahrain</span> +973
			</span>
			<span data-code="+880" data-id="18" role="option" class="country-option">
				<span style="background-position: 0px -187px" class="country-flag"></span>
				<span class="country-name">Bangladesh</span> +880
			</span>
			<span data-code="+1246" data-id="19" role="option" class="country-option">
				<span style="background-position: 0px -198px" class="country-flag"></span>
				<span class="country-name">Barbados</span> +1246
			</span>
			<span data-code="+375" data-id="20" role="option" class="country-option">
				<span style="background-position: 0px -209px" class="country-flag"></span>
				<span class="country-name">Belarus</span> +375
			</span>
			<span data-code="+32" data-id="21" role="option" class="country-option">
				<span style="background-position: 0px -220px" class="country-flag"></span>
				<span class="country-name">Belgium</span> +32
			</span>
			<span data-code="+501" data-id="22" role="option" class="country-option">
				<span style="background-position: 0px -231px" class="country-flag"></span>
				<span class="country-name">Belize</span> +501
			</span>
			<span data-code="+229" data-id="23" role="option" class="country-option">
				<span style="background-position: 0px -242px" class="country-flag"></span>
				<span class="country-name">Benin</span> +229
			</span>
			<span data-code="+1441" data-id="24" role="option" class="country-option">
				<span style="background-position: 0px -253px" class="country-flag"></span>
				<span class="country-name">Bermuda</span> +1441
			</span>
			<span data-code="+975" data-id="25" role="option" class="country-option">
				<span style="background-position: 0px -264px" class="country-flag"></span>
				<span class="country-name">Bhutan</span> +975
			</span>
			<span data-code="+591" data-id="26" role="option" class="country-option">
				<span style="background-position: 0px -275px" class="country-flag"></span>
				<span class="country-name">Bolivia</span> +591
			</span>
			<span data-code="+387" data-id="27" role="option" class="country-option">
				<span style="background-position: 0px -286px" class="country-flag"></span>
				<span class="country-name">Bosnia and Herzegovina</span> +387
			</span>
			<span data-code="+267" data-id="28" role="option" class="country-option">
				<span style="background-position: 0px -297px" class="country-flag"></span>
				<span class="country-name">Botswana</span> +267
			</span>
			<span data-code="+0" data-id="29" role="option" class="country-option">
				<span style="background-position: 0px -308px" class="country-flag"></span>
				<span class="country-name">Bouvet Island</span> +0
			</span>
			<span data-code="+55" data-id="30" role="option" class="country-option">
				<span style="background-position: 0px -319px" class="country-flag"></span>
				<span class="country-name">Brazil</span> +55
			</span>
			<span data-code="+0" data-id="31" role="option" class="country-option">
				<span style="background-position: 0px -330px" class="country-flag"></span>
				<span class="country-name">British Indian Ocean Territory</span> +0
			</span>
			<span data-code="+673" data-id="32" role="option" class="country-option">
				<span style="background-position: 0px -341px" class="country-flag"></span>
				<span class="country-name">Brunei Darussalam</span> +673
			</span>
			<span data-code="+359" data-id="33" role="option" class="country-option">
				<span style="background-position: 0px -352px" class="country-flag"></span>
				<span class="country-name">Bulgaria</span> +359
			</span>
			<span data-code="+226" data-id="34" role="option" class="country-option">
				<span style="background-position: 0px -363px" class="country-flag"></span>
				<span class="country-name">Burkina Faso</span> +226
			</span>
			<span data-code="+257" data-id="35" role="option" class="country-option">
				<span style="background-position: 0px -374px" class="country-flag"></span>
				<span class="country-name">Burundi</span> +257
			</span>
			<span data-code="+855" data-id="36" role="option" class="country-option">
				<span style="background-position: 0px -385px" class="country-flag"></span>
				<span class="country-name">Cambodia</span> +855
			</span>
			<span data-code="+237" data-id="37" role="option" class="country-option">
				<span style="background-position: 0px -396px" class="country-flag"></span>
				<span class="country-name">Cameroon</span> +237
			</span>
			<span data-code="+1" data-id="38" role="option" class="country-option">
				<span style="background-position: 0px -407px" class="country-flag"></span>
				<span class="country-name">Canada</span> +1
			</span>
			<span data-code="+238" data-id="39" role="option" class="country-option">
				<span style="background-position: 0px -418px" class="country-flag"></span>
				<span class="country-name">Cape Verde</span> +238
			</span>
			<span data-code="+1" data-id="40" role="option" class="country-option">
				<span style="background-position: 0px -429px" class="country-flag"></span>
				<span class="country-name">Cayman Islands</span> +1
			</span>
			<span data-code="+236" data-id="41" role="option" class="country-option">
				<span style="background-position: 0px -440px" class="country-flag"></span>
				<span class="country-name">Central African Republic</span> +236
			</span>
			<span data-code="+235" data-id="42" role="option" class="country-option">
				<span style="background-position: 0px -451px" class="country-flag"></span>
				<span class="country-name">Chad</span> +235
			</span>
			<span data-code="+56" data-id="43" role="option" class="country-option">
				<span style="background-position: 0px -462px" class="country-flag"></span>
				<span class="country-name">Chile</span> +56
			</span>
			<span data-code="+86" data-id="44" role="option" class="country-option">
				<span style="background-position: 0px -473px" class="country-flag"></span>
				<span class="country-name">China</span> +86
			</span>
			<span data-code="+618" data-id="45" role="option" class="country-option">
				<span style="background-position: 0px -484px" class="country-flag"></span>
				<span class="country-name">Christmas Island</span> +618
			</span>
			<span data-code="+61" data-id="46" role="option" class="country-option">
				<span style="background-position: 0px -495px" class="country-flag"></span>
				<span class="country-name">Cocos (Keeling) Islands</span> +61
			</span>
			<span data-code="+57" data-id="47" role="option" class="country-option">
				<span style="background-position: 0px -506px" class="country-flag"></span>
				<span class="country-name">Colombia</span> +57
			</span>
			<span data-code="+269" data-id="48" role="option" class="country-option">
				<span style="background-position: 0px -517px" class="country-flag"></span>
				<span class="country-name">Comoros</span> +269
			</span>
			<span data-code="+242" data-id="49" role="option" class="country-option">
				<span style="background-position: 0px -528px" class="country-flag"></span>
				<span class="country-name">Congo</span> +242
			</span>
			<span data-code="+243" data-id="50" role="option" class="country-option">
				<span style="background-position: 0px -539px" class="country-flag"></span>
				<span class="country-name">Congo, the Democratic Republic of the</span> +243
			</span>
			<span data-code="+682" data-id="51" role="option" class="country-option">
				<span style="background-position: 0px -550px" class="country-flag"></span>
				<span class="country-name">Cook Islands</span> +682
			</span>
			<span data-code="+506" data-id="52" role="option" class="country-option">
				<span style="background-position: 0px -561px" class="country-flag"></span>
				<span class="country-name">Costa Rica</span> +506
			</span>
			<span data-code="+225" data-id="53" role="option" class="country-option">
				<span style="background-position: 0px -572px" class="country-flag"></span>
				<span class="country-name">Cote D'Ivoire</span> +225
			</span>
			<span data-code="+385" data-id="54" role="option" class="country-option">
				<span style="background-position: 0px -583px" class="country-flag"></span>
				<span class="country-name">Croatia</span> +385
			</span>
			<span data-code="+53" data-id="55" role="option" class="country-option">
				<span style="background-position: 0px -594px" class="country-flag"></span>
				<span class="country-name">Cuba</span> +53
			</span>
			<span data-code="+357" data-id="56" role="option" class="country-option">
				<span style="background-position: 0px -605px" class="country-flag"></span>
				<span class="country-name">Cyprus</span> +357
			</span>
			<span data-code="+420" data-id="57" role="option" class="country-option">
				<span style="background-position: 0px -616px" class="country-flag"></span>
				<span class="country-name">Czech Republic</span> +420
			</span>
			<span data-code="+45" data-id="58" role="option" class="country-option">
				<span style="background-position: 0px -627px" class="country-flag"></span>
				<span class="country-name">Denmark</span> +45
			</span>
			<span data-code="+253" data-id="59" role="option" class="country-option">
				<span style="background-position: 0px -638px" class="country-flag"></span>
				<span class="country-name">Djibouti</span> +253
			</span>
			<span data-code="+1767" data-id="60" role="option" class="country-option">
				<span style="background-position: 0px -649px" class="country-flag"></span>
				<span class="country-name">Dominica</span> +1767
			</span>
			<span data-code="+1809" data-id="61" role="option" class="country-option">
				<span style="background-position: 0px -660px" class="country-flag"></span>
				<span class="country-name">Dominican Republic</span> +1809
			</span>
			<span data-code="+593" data-id="62" role="option" class="country-option">
				<span style="background-position: 0px -671px" class="country-flag"></span>
				<span class="country-name">Ecuador</span> +593
			</span>
			<span data-code="+20" data-id="63" role="option" class="country-option">
				<span style="background-position: 0px -682px" class="country-flag"></span>
				<span class="country-name">Egypt</span> +20
			</span>
			<span data-code="+503" data-id="64" role="option" class="country-option">
				<span style="background-position: 0px -693px" class="country-flag"></span>
				<span class="country-name">El Salvador</span> +503
			</span>
			<span data-code="+240" data-id="65" role="option" class="country-option">
				<span style="background-position: 0px -704px" class="country-flag"></span>
				<span class="country-name">Equatorial Guinea</span> +240
			</span>
			<span data-code="+291" data-id="66" role="option" class="country-option">
				<span style="background-position: 0px -715px" class="country-flag"></span>
				<span class="country-name">Eritrea</span> +291
			</span>
			<span data-code="+372" data-id="67" role="option" class="country-option">
				<span style="background-position: 0px -726px" class="country-flag"></span>
				<span class="country-name">Estonia</span> +372
			</span>
			<span data-code="+251" data-id="68" role="option" class="country-option">
				<span style="background-position: 0px -737px" class="country-flag"></span>
				<span class="country-name">Ethiopia</span> +251
			</span>
			<span data-code="+500" data-id="69" role="option" class="country-option">
				<span style="background-position: 0px -748px" class="country-flag"></span>
				<span class="country-name">Falkland Islands (Malvinas)</span> +500
			</span>
			<span data-code="+298" data-id="70" role="option" class="country-option">
				<span style="background-position: 0px -759px" class="country-flag"></span>
				<span class="country-name">Faroe Islands</span> +298
			</span>
			<span data-code="+679" data-id="71" role="option" class="country-option">
				<span style="background-position: 0px -770px" class="country-flag"></span>
				<span class="country-name">Fiji</span> +679
			</span>
			<span data-code="+358" data-id="72" role="option" class="country-option">
				<span style="background-position: 0px -781px" class="country-flag"></span>
				<span class="country-name">Finland</span> +358
			</span>
			<span data-code="+33" data-id="73" role="option" class="country-option">
				<span style="background-position: 0px -792px" class="country-flag"></span>
				<span class="country-name">France</span> +33
			</span>
			<span data-code="+594" data-id="74" role="option" class="country-option">
				<span style="background-position: 0px -803px" class="country-flag"></span>
				<span class="country-name">French Guiana</span> +594
			</span>
			<span data-code="+689" data-id="75" role="option" class="country-option">
				<span style="background-position: 0px -814px" class="country-flag"></span>
				<span class="country-name">French Polynesia</span> +689
			</span>
			<span data-code="+0" data-id="76" role="option" class="country-option">
				<span style="background-position: 0px -825px" class="country-flag"></span>
				<span class="country-name">French Southern Territories</span> +0
			</span>
			<span data-code="+241" data-id="77" role="option" class="country-option">
				<span style="background-position: 0px -836px" class="country-flag"></span>
				<span class="country-name">Gabon</span> +241
			</span>
			<span data-code="+220" data-id="78" role="option" class="country-option">
				<span style="background-position: 0px -847px" class="country-flag"></span>
				<span class="country-name">Gambia</span> +220
			</span>
			<span data-code="+995" data-id="79" role="option" class="country-option">
				<span style="background-position: 0px -858px" class="country-flag"></span>
				<span class="country-name">Georgia</span> +995
			</span>
			<span data-code="+49" data-id="80" role="option" class="country-option">
				<span style="background-position: 0px -869px" class="country-flag"></span>
				<span class="country-name">Germany</span> +49
			</span>
			<span data-code="+233" data-id="81" role="option" class="country-option">
				<span style="background-position: 0px -880px" class="country-flag"></span>
				<span class="country-name">Ghana</span> +233
			</span>
			<span data-code="+350" data-id="82" role="option" class="country-option">
				<span style="background-position: 0px -891px" class="country-flag"></span>
				<span class="country-name">Gibraltar</span> +350
			</span>
			<span data-code="+30" data-id="83" role="option" class="country-option">
				<span style="background-position: 0px -902px" class="country-flag"></span>
				<span class="country-name">Greece</span> +30
			</span>
			<span data-code="+299" data-id="84" role="option" class="country-option">
				<span style="background-position: 0px -913px" class="country-flag"></span>
				<span class="country-name">Greenland</span> +299
			</span>
			<span data-code="+473" data-id="85" role="option" class="country-option">
				<span style="background-position: 0px -924px" class="country-flag"></span>
				<span class="country-name">Grenada</span> +473
			</span>
			<span data-code="+590" data-id="86" role="option" class="country-option">
				<span style="background-position: 0px -935px" class="country-flag"></span>
				<span class="country-name">Guadeloupe</span> +590
			</span>
			<span data-code="+1671" data-id="87" role="option" class="country-option">
				<span style="background-position: 0px -946px" class="country-flag"></span>
				<span class="country-name">Guam</span> +1671
			</span>
			<span data-code="+502" data-id="88" role="option" class="country-option">
				<span style="background-position: 0px -957px" class="country-flag"></span>
				<span class="country-name">Guatemala</span> +502
			</span>
			<span data-code="+224" data-id="89" role="option" class="country-option">
				<span style="background-position: 0px -968px" class="country-flag"></span>
				<span class="country-name">Guinea</span> +224
			</span>
			<span data-code="+245" data-id="90" role="option" class="country-option">
				<span style="background-position: 0px -979px" class="country-flag"></span>
				<span class="country-name">Guinea-Bissau</span> +245
			</span>
			<span data-code="+592" data-id="91" role="option" class="country-option">
				<span style="background-position: 0px -990px" class="country-flag"></span>
				<span class="country-name">Guyana</span> +592
			</span>
			<span data-code="+509" data-id="92" role="option" class="country-option">
				<span style="background-position: 0px -1001px" class="country-flag"></span>
				<span class="country-name">Haiti</span> +509
			</span>
			<span data-code="+0" data-id="93" role="option" class="country-option">
				<span style="background-position: 0px -1012px" class="country-flag"></span>
				<span class="country-name">Heard Island and Mcdonald Islands</span> +0
			</span>
			<span data-code="+379" data-id="94" role="option" class="country-option">
				<span style="background-position: 0px -1023px" class="country-flag"></span>
				<span class="country-name">Holy See (Vatican City State)</span> +379
			</span>
			<span data-code="+504" data-id="95" role="option" class="country-option">
				<span style="background-position: 0px -1034px" class="country-flag"></span>
				<span class="country-name">Honduras</span> +504
			</span>
			<span data-code="+852" data-id="96" role="option" class="country-option">
				<span style="background-position: 0px -1045px" class="country-flag"></span>
				<span class="country-name">Hong Kong</span> +852
			</span>
			<span data-code="+36" data-id="97" role="option" class="country-option">
				<span style="background-position: 0px -1056px" class="country-flag"></span>
				<span class="country-name">Hungary</span> +36
			</span>
			<span data-code="+354" data-id="98" role="option" class="country-option">
				<span style="background-position: 0px -1067px" class="country-flag"></span>
				<span class="country-name">Iceland</span> +354
			</span>
			<span data-code="+91" data-id="99" role="option" class="country-option">
				<span style="background-position: 0px -1078px" class="country-flag"></span>
				<span class="country-name">India</span> +91
			</span>
			<span data-code="+62" data-id="100" role="option" class="country-option">
				<span style="background-position: 0px -1089px" class="country-flag"></span>
				<span class="country-name">Indonesia</span> +62
			</span>
			<span data-code="+98" data-id="101" role="option" class="country-option">
				<span style="background-position: 0px -1100px" class="country-flag"></span>
				<span class="country-name">Iran, Islamic Republic of</span> +98
			</span>
			<span data-code="+964" data-id="102" role="option" class="country-option">
				<span style="background-position: 0px -1111px" class="country-flag"></span>
				<span class="country-name">Iraq</span> +964
			</span>
			<span data-code="+353" data-id="103" role="option" class="country-option">
				<span style="background-position: 0px -1122px" class="country-flag"></span>
				<span class="country-name">Ireland</span> +353
			</span>
			<span data-code="+972" data-id="104" role="option" class="country-option">
				<span style="background-position: 0px -1133px" class="country-flag"></span>
				<span class="country-name">Israel</span> +972
			</span>
			<span data-code="+39" data-id="105" role="option" class="country-option">
				<span style="background-position: 0px -1144px" class="country-flag"></span>
				<span class="country-name">Italy</span> +39
			</span>
			<span data-code="+1876" data-id="106" role="option" class="country-option">
				<span style="background-position: 0px -1155px" class="country-flag"></span>
				<span class="country-name">Jamaica</span> +1876
			</span>
			<span data-code="+81" data-id="107" role="option" class="country-option">
				<span style="background-position: 0px -1166px" class="country-flag"></span>
				<span class="country-name">Japan</span> +81
			</span>
			<span data-code="+962" data-id="108" role="option" class="country-option">
				<span style="background-position: 0px -1177px" class="country-flag"></span>
				<span class="country-name">Jordan</span> +962
			</span>
			<span data-code="+7" data-id="109" role="option" class="country-option">
				<span style="background-position: 0px -1188px" class="country-flag"></span>
				<span class="country-name">Kazakhstan</span> +7
			</span>
			<span data-code="+254" data-id="110" role="option" class="country-option">
				<span style="background-position: 0px -1199px" class="country-flag"></span>
				<span class="country-name">Kenya</span> +254
			</span>
			<span data-code="+686" data-id="111" role="option" class="country-option">
				<span style="background-position: 0px -1210px" class="country-flag"></span>
				<span class="country-name">Kiribati</span> +686
			</span>
			<span data-code="+850" data-id="112" role="option" class="country-option">
				<span style="background-position: 0px -1221px" class="country-flag"></span>
				<span class="country-name">Korea, Democratic People's Republic of</span> +850
			</span>
			<span data-code="+82" data-id="113" role="option" class="country-option">
				<span style="background-position: 0px -1232px" class="country-flag"></span>
				<span class="country-name">Korea, Republic of</span> +82
			</span>
			<span data-code="+965" data-id="114" role="option" class="country-option">
				<span style="background-position: 0px -1243px" class="country-flag"></span>
				<span class="country-name">Kuwait</span> +965
			</span>
			<span data-code="+7" data-id="115" role="option" class="country-option">
				<span style="background-position: 0px -1254px" class="country-flag"></span>
				<span class="country-name">Kyrgyzstan</span> +7
			</span>
			<span data-code="+856" data-id="116" role="option" class="country-option">
				<span style="background-position: 0px -1265px" class="country-flag"></span>
				<span class="country-name">Lao People's Democratic Republic</span> +856
			</span>
			<span data-code="+371" data-id="117" role="option" class="country-option">
				<span style="background-position: 0px -1276px" class="country-flag"></span>
				<span class="country-name">Latvia</span> +371
			</span>
			<span data-code="+961" data-id="118" role="option" class="country-option">
				<span style="background-position: 0px -1287px" class="country-flag"></span>
				<span class="country-name">Lebanon</span> +961
			</span>
			<span data-code="+266" data-id="119" role="option" class="country-option">
				<span style="background-position: 0px -1298px" class="country-flag"></span>
				<span class="country-name">Lesotho</span> +266
			</span>
			<span data-code="+231" data-id="120" role="option" class="country-option">
				<span style="background-position: 0px -1309px" class="country-flag"></span>
				<span class="country-name">Liberia</span> +231
			</span>
			<span data-code="+218" data-id="121" role="option" class="country-option">
				<span style="background-position: 0px -1320px" class="country-flag"></span>
				<span class="country-name">Libyan Arab Jamahiriya</span> +218
			</span>
			<span data-code="+423" data-id="122" role="option" class="country-option">
				<span style="background-position: 0px -1331px" class="country-flag"></span>
				<span class="country-name">Liechtenstein</span> +423
			</span>
			<span data-code="+370" data-id="123" role="option" class="country-option">
				<span style="background-position: 0px -1342px" class="country-flag"></span>
				<span class="country-name">Lithuania</span> +370
			</span>
			<span data-code="+352" data-id="124" role="option" class="country-option">
				<span style="background-position: 0px -1353px" class="country-flag"></span>
				<span class="country-name">Luxembourg</span> +352
			</span>
			<span data-code="+853" data-id="125" role="option" class="country-option">
				<span style="background-position: 0px -1364px" class="country-flag"></span>
				<span class="country-name">Macao</span> +853
			</span>
			<span data-code="+389" data-id="126" role="option" class="country-option">
				<span style="background-position: 0px -1375px" class="country-flag"></span>
				<span class="country-name">Macedonia, the Former Yugoslav Republic of</span> +389
			</span>
			<span data-code="+261" data-id="127" role="option" class="country-option">
				<span style="background-position: 0px -1386px" class="country-flag"></span>
				<span class="country-name">Madagascar</span> +261
			</span>
			<span data-code="+265" data-id="128" role="option" class="country-option">
				<span style="background-position: 0px -1397px" class="country-flag"></span>
				<span class="country-name">Malawi</span> +265
			</span>
			<span data-code="+60" data-id="129" role="option" class="country-option">
				<span style="background-position: 0px -1408px" class="country-flag"></span>
				<span class="country-name">Malaysia</span> +60
			</span>
			<span data-code="+960" data-id="130" role="option" class="country-option">
				<span style="background-position: 0px -1419px" class="country-flag"></span>
				<span class="country-name">Maldives</span> +960
			</span>
			<span data-code="+223" data-id="131" role="option" class="country-option">
				<span style="background-position: 0px -1430px" class="country-flag"></span>
				<span class="country-name">Mali</span> +223
			</span>
			<span data-code="+356" data-id="132" role="option" class="country-option">
				<span style="background-position: 0px -1441px" class="country-flag"></span>
				<span class="country-name">Malta</span> +356
			</span>
			<span data-code="+692" data-id="133" role="option" class="country-option">
				<span style="background-position: 0px -1452px" class="country-flag"></span>
				<span class="country-name">Marshall Islands</span> +692
			</span>
			<span data-code="+596" data-id="134" role="option" class="country-option">
				<span style="background-position: 0px -1463px" class="country-flag"></span>
				<span class="country-name">Martinique</span> +596
			</span>
			<span data-code="+222" data-id="135" role="option" class="country-option">
				<span style="background-position: 0px -1474px" class="country-flag"></span>
				<span class="country-name">Mauritania</span> +222
			</span>
			<span data-code="+230" data-id="136" role="option" class="country-option">
				<span style="background-position: 0px -1485px" class="country-flag"></span>
				<span class="country-name">Mauritius</span> +230
			</span>
			<span data-code="+269" data-id="137" role="option" class="country-option">
				<span style="background-position: 0px -1496px" class="country-flag"></span>
				<span class="country-name">Mayotte</span> +269
			</span>
			<span data-code="+52" data-id="138" role="option" class="country-option">
				<span style="background-position: 0px -1507px" class="country-flag"></span>
				<span class="country-name">Mexico</span> +52
			</span>
			<span data-code="+691" data-id="139" role="option" class="country-option">
				<span style="background-position: 0px -1518px" class="country-flag"></span>
				<span class="country-name">Micronesia, Federated States of</span> +691
			</span>
			<span data-code="+373" data-id="140" role="option" class="country-option">
				<span style="background-position: 0px -1529px" class="country-flag"></span>
				<span class="country-name">Moldova, Republic of</span> +373
			</span>
			<span data-code="+377" data-id="141" role="option" class="country-option">
				<span style="background-position: 0px -1540px" class="country-flag"></span>
				<span class="country-name">Monaco</span> +377
			</span>
			<span data-code="+976" data-id="142" role="option" class="country-option">
				<span style="background-position: 0px -1551px" class="country-flag"></span>
				<span class="country-name">Mongolia</span> +976
			</span>
			<span data-code="+382" data-id="240" role="option" class="country-option">
				<span style="background-position: 0px -2629px" class="country-flag"></span>
				<span class="country-name">Montenegro</span> +382
			</span>
			<span data-code="+1664" data-id="143" role="option" class="country-option">
				<span style="background-position: 0px -1562px" class="country-flag"></span>
				<span class="country-name">Montserrat</span> +1664
			</span>
			<span data-code="+212" data-id="144" role="option" class="country-option">
				<span style="background-position: 0px -1573px" class="country-flag"></span>
				<span class="country-name">Morocco</span> +212
			</span>
			<span data-code="+258" data-id="145" role="option" class="country-option">
				<span style="background-position: 0px -1584px" class="country-flag"></span>
				<span class="country-name">Mozambique</span> +258
			</span>
			<span data-code="+95" data-id="146" role="option" class="country-option">
				<span style="background-position: 0px -1595px" class="country-flag"></span>
				<span class="country-name">Myanmar</span> +95
			</span>
			<span data-code="+264" data-id="147" role="option" class="country-option">
				<span style="background-position: 0px -1606px" class="country-flag"></span>
				<span class="country-name">Namibia</span> +264
			</span>
			<span data-code="+674" data-id="148" role="option" class="country-option">
				<span style="background-position: 0px -1617px" class="country-flag"></span>
				<span class="country-name">Nauru</span> +674
			</span>
			<span data-code="+977" data-id="149" role="option" class="country-option">
				<span style="background-position: 0px -1628px" class="country-flag"></span>
				<span class="country-name">Nepal</span> +977
			</span>
			<span data-code="+31" data-id="150" role="option" class="country-option">
				<span style="background-position: 0px -1639px" class="country-flag"></span>
				<span class="country-name">Netherlands</span> +31
			</span>
			<span data-code="+599" data-id="151" role="option" class="country-option">
				<span style="background-position: 0px -1650px" class="country-flag"></span>
				<span class="country-name">Netherlands Antilles</span> +599
			</span>
			<span data-code="+687" data-id="152" role="option" class="country-option">
				<span style="background-position: 0px -1661px" class="country-flag"></span>
				<span class="country-name">New Caledonia</span> +687
			</span>
			<span data-code="+64" data-id="153" role="option" class="country-option">
				<span style="background-position: 0px -1672px" class="country-flag"></span>
				<span class="country-name">New Zealand</span> +64
			</span>
			<span data-code="+505" data-id="154" role="option" class="country-option">
				<span style="background-position: 0px -1683px" class="country-flag"></span>
				<span class="country-name">Nicaragua</span> +505
			</span>
			<span data-code="+227" data-id="155" role="option" class="country-option">
				<span style="background-position: 0px -1694px" class="country-flag"></span>
				<span class="country-name">Niger</span> +227
			</span>
			<span data-code="+234" data-id="156" role="option" class="country-option">
				<span style="background-position: 0px -1705px" class="country-flag"></span>
				<span class="country-name">Nigeria</span> +234
			</span>
			<span data-code="+683" data-id="157" role="option" class="country-option">
				<span style="background-position: 0px -1716px" class="country-flag"></span>
				<span class="country-name">Niue</span> +683
			</span>
			<span data-code="+672" data-id="158" role="option" class="country-option">
				<span style="background-position: 0px -1727px" class="country-flag"></span>
				<span class="country-name">Norfolk Island</span> +672
			</span>
			<span data-code="+1670" data-id="159" role="option" class="country-option">
				<span style="background-position: 0px -1738px" class="country-flag"></span>
				<span class="country-name">Northern Mariana Islands</span> +1670
			</span>
			<span data-code="+470" data-id="160" role="option" class="country-option">
				<span style="background-position: 0px -1749px" class="country-flag"></span>
				<span class="country-name">Norway</span> +470
			</span>
			<span data-code="+968" data-id="161" role="option" class="country-option">
				<span style="background-position: 0px -1760px" class="country-flag"></span>
				<span class="country-name">Oman</span> +968
			</span>
			<span data-code="+92" data-id="162" role="option" class="country-option">
				<span style="background-position: 0px -1771px" class="country-flag"></span>
				<span class="country-name">Pakistan</span> +92
			</span>
			<span data-code="+680" data-id="163" role="option" class="country-option">
				<span style="background-position: 0px -1782px" class="country-flag"></span>
				<span class="country-name">Palau</span> +680
			</span>
			<span data-code="+0" data-id="164" role="option" class="country-option">
				<span style="background-position: 0px -1793px" class="country-flag"></span>
				<span class="country-name">Palestinian Territory, Occupied</span> +0
			</span>
			<span data-code="+507" data-id="165" role="option" class="country-option">
				<span style="background-position: 0px -1804px" class="country-flag"></span>
				<span class="country-name">Panama</span> +507
			</span>
			<span data-code="+675" data-id="166" role="option" class="country-option">
				<span style="background-position: 0px -1815px" class="country-flag"></span>
				<span class="country-name">Papua New Guinea</span> +675
			</span>
			<span data-code="+595" data-id="167" role="option" class="country-option">
				<span style="background-position: 0px -1826px" class="country-flag"></span>
				<span class="country-name">Paraguay</span> +595
			</span>
			<span data-code="+51" data-id="168" role="option" class="country-option">
				<span style="background-position: 0px -1837px" class="country-flag"></span>
				<span class="country-name">Peru</span> +51
			</span>
			<span data-code="+63" data-id="169" role="option" class="country-option">
				<span style="background-position: 0px -1848px" class="country-flag"></span>
				<span class="country-name">Philippines</span> +63
			</span>
			<span data-code="+64" data-id="170" role="option" class="country-option">
				<span style="background-position: 0px -1859px" class="country-flag"></span>
				<span class="country-name">Pitcairn</span> +64
			</span>
			<span data-code="+48" data-id="171" role="option" class="country-option">
				<span style="background-position: 0px -1870px" class="country-flag"></span>
				<span class="country-name">Poland</span> +48
			</span>
			<span data-code="+351" data-id="172" role="option" class="country-option">
				<span style="background-position: 0px -1881px" class="country-flag"></span>
				<span class="country-name">Portugal</span> +351
			</span>
			<span data-code="+1939" data-id="173" role="option" class="country-option">
				<span style="background-position: 0px -1892px" class="country-flag"></span>
				<span class="country-name">Puerto Rico</span> +1939
			</span>
			<span data-code="+974" data-id="174" role="option" class="country-option">
				<span style="background-position: 0px -1903px" class="country-flag"></span>
				<span class="country-name">Qatar</span> +974
			</span>
			<span data-code="+262" data-id="175" role="option" class="country-option">
				<span style="background-position: 0px -1914px" class="country-flag"></span>
				<span class="country-name">Reunion</span> +262
			</span>
			<span data-code="+40" data-id="176" role="option" class="country-option">
				<span style="background-position: 0px -1925px" class="country-flag"></span>
				<span class="country-name">Romania</span> +40
			</span>
			<span data-code="+7" data-id="177" role="option" class="country-option">
				<span style="background-position: 0px -1936px" class="country-flag"></span>
				<span class="country-name">Russian Federation</span> +7
			</span>
			<span data-code="+250" data-id="178" role="option" class="country-option">
				<span style="background-position: 0px -1947px" class="country-flag"></span>
				<span class="country-name">Rwanda</span> +250
			</span>
			<span data-code="+290" data-id="179" role="option" class="country-option">
				<span style="background-position: 0px -1958px" class="country-flag"></span>
				<span class="country-name">Saint Helena</span> +290
			</span>
			<span data-code="+1869" data-id="180" role="option" class="country-option">
				<span style="background-position: 0px -1969px" class="country-flag"></span>
				<span class="country-name">Saint Kitts and Nevis</span> +1869
			</span>
			<span data-code="+1758" data-id="181" role="option" class="country-option">
				<span style="background-position: 0px -1980px" class="country-flag"></span>
				<span class="country-name">Saint Lucia</span> +1758
			</span>
			<span data-code="+508" data-id="182" role="option" class="country-option">
				<span style="background-position: 0px -1991px" class="country-flag"></span>
				<span class="country-name">Saint Pierre and Miquelon</span> +508
			</span>
			<span data-code="+1784" data-id="183" role="option" class="country-option">
				<span style="background-position: 0px -2002px" class="country-flag"></span>
				<span class="country-name">Saint Vincent and the Grenadines</span> +1784
			</span>
			<span data-code="+685" data-id="184" role="option" class="country-option">
				<span style="background-position: 0px -2013px" class="country-flag"></span>
				<span class="country-name">Samoa</span> +685
			</span>
			<span data-code="+378" data-id="185" role="option" class="country-option">
				<span style="background-position: 0px -2024px" class="country-flag"></span>
				<span class="country-name">San Marino</span> +378
			</span>
			<span data-code="+239" data-id="186" role="option" class="country-option">
				<span style="background-position: 0px -2035px" class="country-flag"></span>
				<span class="country-name">Sao Tome and Principe</span> +239
			</span>
			<span data-code="+966" data-id="187" role="option" class="country-option">
				<span style="background-position: 0px -2046px" class="country-flag"></span>
				<span class="country-name">Saudi Arabia</span> +966
			</span>
			<span data-code="+221" data-id="188" role="option" class="country-option">
				<span style="background-position: 0px -2057px" class="country-flag"></span>
				<span class="country-name">Senegal</span> +221
			</span>
			<span data-code="+381" data-id="189" role="option" class="country-option">
				<span style="background-position: 0px -2068px" class="country-flag"></span>
				<span class="country-name">Serbia</span> +381
			</span>
			<span data-code="+248" data-id="190" role="option" class="country-option">
				<span style="background-position: 0px -2079px" class="country-flag"></span>
				<span class="country-name">Seychelles</span> +248
			</span>
			<span data-code="+232" data-id="191" role="option" class="country-option">
				<span style="background-position: 0px -2090px" class="country-flag"></span>
				<span class="country-name">Sierra Leone</span> +232
			</span>
			<span data-code="+65" data-id="192" role="option" class="country-option">
				<span style="background-position: 0px -2101px" class="country-flag"></span>
				<span class="country-name">Singapore</span> +65
			</span>
			<span data-code="+421" data-id="193" role="option" class="country-option">
				<span style="background-position: 0px -2112px" class="country-flag"></span>
				<span class="country-name">Slovakia</span> +421
			</span>
			<span data-code="+386" data-id="194" role="option" class="country-option">
				<span style="background-position: 0px -2123px" class="country-flag"></span>
				<span class="country-name">Slovenia</span> +386
			</span>
			<span data-code="+677" data-id="195" role="option" class="country-option">
				<span style="background-position: 0px -2134px" class="country-flag"></span>
				<span class="country-name">Solomon Islands</span> +677
			</span>
			<span data-code="+252" data-id="196" role="option" class="country-option">
				<span style="background-position: 0px -2145px" class="country-flag"></span>
				<span class="country-name">Somalia</span> +252
			</span>
			<span data-code="+27" data-id="197" role="option" class="country-option">
				<span style="background-position: 0px -2156px" class="country-flag"></span>
				<span class="country-name">South Africa</span> +27
			</span>
			<span data-code="+0" data-id="198" role="option" class="country-option">
				<span style="background-position: 0px -2167px" class="country-flag"></span>
				<span class="country-name">South Georgia and the South Sandwich Islands</span> +0
			</span>
			<span data-code="+34" data-id="199" role="option" class="country-option">
				<span style="background-position: 0px -2178px" class="country-flag"></span>
				<span class="country-name">Spain</span> +34
			</span>
			<span data-code="+94" data-id="200" role="option" class="country-option">
				<span style="background-position: 0px -2189px" class="country-flag"></span>
				<span class="country-name">Sri Lanka</span> +94
			</span>
			<span data-code="+249" data-id="201" role="option" class="country-option">
				<span style="background-position: 0px -2200px" class="country-flag"></span>
				<span class="country-name">Sudan</span> +249
			</span>
			<span data-code="+597" data-id="202" role="option" class="country-option">
				<span style="background-position: 0px -2211px" class="country-flag"></span>
				<span class="country-name">Suriname</span> +597
			</span>
			<span data-code="+0" data-id="203" role="option" class="country-option">
				<span style="background-position: 0px -2222px" class="country-flag"></span>
				<span class="country-name">Svalbard and Jan Mayen</span> +0
			</span>
			<span data-code="+268" data-id="204" role="option" class="country-option">
				<span style="background-position: 0px -2233px" class="country-flag"></span>
				<span class="country-name">Swaziland</span> +268
			</span>
			<span data-code="+46" data-id="205" role="option" class="country-option">
				<span style="background-position: 0px -2244px" class="country-flag"></span>
				<span class="country-name">Sweden</span> +46
			</span>
			<span data-code="+41" data-id="206" role="option" class="country-option">
				<span style="background-position: 0px -2255px" class="country-flag"></span>
				<span class="country-name">Switzerland</span> +41
			</span>
			<span data-code="+963" data-id="207" role="option" class="country-option">
				<span style="background-position: 0px -2266px" class="country-flag"></span>
				<span class="country-name">Syrian Arab Republic</span> +963
			</span>
			<span data-code="+886" data-id="208" role="option" class="country-option">
				<span style="background-position: 0px -2277px" class="country-flag"></span>
				<span class="country-name">Taiwan, Province of China</span> +886
			</span>
			<span data-code="+7" data-id="209" role="option" class="country-option">
				<span style="background-position: 0px -2288px" class="country-flag"></span>
				<span class="country-name">Tajikistan</span> +7
			</span>
			<span data-code="+255" data-id="210" role="option" class="country-option">
				<span style="background-position: 0px -2299px" class="country-flag"></span>
				<span class="country-name">Tanzania, United Republic of</span> +255
			</span>
			<span data-code="+66" data-id="211" role="option" class="country-option">
				<span style="background-position: 0px -2310px" class="country-flag"></span>
				<span class="country-name">Thailand</span> +66
			</span>
			<span data-code="+670" data-id="212" role="option" class="country-option">
				<span style="background-position: 0px -2321px" class="country-flag"></span>
				<span class="country-name">Timor-Leste</span> +670
			</span>
			<span data-code="+228" data-id="213" role="option" class="country-option">
				<span style="background-position: 0px -2332px" class="country-flag"></span>
				<span class="country-name">Togo</span> +228
			</span>
			<span data-code="+690" data-id="214" role="option" class="country-option">
				<span style="background-position: 0px -2343px" class="country-flag"></span>
				<span class="country-name">Tokelau</span> +690
			</span>
			<span data-code="+676" data-id="215" role="option" class="country-option">
				<span style="background-position: 0px -2354px" class="country-flag"></span>
				<span class="country-name">Tonga</span> +676
			</span>
			<span data-code="+1868" data-id="216" role="option" class="country-option">
				<span style="background-position: 0px -2365px" class="country-flag"></span>
				<span class="country-name">Trinidad and Tobago</span> +1868
			</span>
			<span data-code="+216" data-id="217" role="option" class="country-option">
				<span style="background-position: 0px -2376px" class="country-flag"></span>
				<span class="country-name">Tunisia</span> +216
			</span>
			<span data-code="+90" data-id="218" role="option" class="country-option">
				<span style="background-position: 0px -2387px" class="country-flag"></span>
				<span class="country-name">Turkey</span> +90
			</span>
			<span data-code="+933" data-id="219" role="option" class="country-option">
				<span style="background-position: 0px -2398px" class="country-flag"></span>
				<span class="country-name">Turkmenistan</span> +933
			</span>
			<span data-code="+649" data-id="220" role="option" class="country-option">
				<span style="background-position: 0px -2409px" class="country-flag"></span>
				<span class="country-name">Turks and Caicos Islands</span> +649
			</span>
			<span data-code="+688" data-id="221" role="option" class="country-option">
				<span style="background-position: 0px -2420px" class="country-flag"></span>
				<span class="country-name">Tuvalu</span> +688
			</span>
			<span data-code="+256" data-id="222" role="option" class="country-option">
				<span style="background-position: 0px -2431px" class="country-flag"></span>
				<span class="country-name">Uganda</span> +256
			</span>
			<span data-code="+380" data-id="223" role="option" class="country-option">
				<span style="background-position: 0px -2442px" class="country-flag"></span>
				<span class="country-name">Ukraine</span> +380
			</span>
			<span data-code="+971" data-id="224" role="option" class="country-option">
				<span style="background-position: 0px -2453px" class="country-flag"></span>
				<span class="country-name">United Arab Emirates</span> +971
			</span>
			<span data-code="+44" data-id="225" role="option" class="country-option">
				<span style="background-position: 0px -2464px" class="country-flag"></span>
				<span class="country-name">United Kingdom</span> +44
			</span>
			<span data-code="+1" data-id="226" role="option" class="country-option">
				<span style="background-position: 0px -2475px" class="country-flag"></span>
				<span class="country-name">United States</span> +1
			</span>
			<span data-code="+0" data-id="227" role="option" class="country-option">
				<span style="background-position: 0px -2486px" class="country-flag"></span>
				<span class="country-name">United States Minor Outlying Islands</span> +0
			</span>
			<span data-code="+598" data-id="228" role="option" class="country-option">
				<span style="background-position: 0px -2497px" class="country-flag"></span>
				<span class="country-name">Uruguay</span> +598
			</span>
			<span data-code="+7" data-id="229" role="option" class="country-option">
				<span style="background-position: 0px -2508px" class="country-flag"></span>
				<span class="country-name">Uzbekistan</span> +7
			</span>
			<span data-code="+678" data-id="230" role="option" class="country-option">
				<span style="background-position: 0px -2519px" class="country-flag"></span>
				<span class="country-name">Vanuatu</span> +678
			</span>
			<span data-code="+58" data-id="231" role="option" class="country-option">
				<span style="background-position: 0px -2530px" class="country-flag"></span>
				<span class="country-name">Venezuela</span> +58
			</span>
			<span data-code="+84" data-id="232" role="option" class="country-option">
				<span style="background-position: 0px -2541px" class="country-flag"></span>
				<span class="country-name">Viet Nam</span> +84
			</span>
			<span data-code="+1284" data-id="233" role="option" class="country-option">
				<span style="background-position: 0px -2552px" class="country-flag"></span>
				<span class="country-name">Virgin Islands, British</span> +1284
			</span>
			<span data-code="+1340" data-id="234" role="option" class="country-option">
				<span style="background-position: 0px -2563px" class="country-flag"></span>
				<span class="country-name">Virgin Islands, U.s.</span> +1340
			</span>
			<span data-code="+681" data-id="235" role="option" class="country-option">
				<span style="background-position: 0px -2574px" class="country-flag"></span>
				<span class="country-name">Wallis and Futuna</span> +681
			</span>
			<span data-code="+0" data-id="236" role="option" class="country-option">
				<span style="background-position: 0px -2585px" class="country-flag"></span>
				<span class="country-name">Western Sahara</span> +0
			</span>
			<span data-code="+967" data-id="237" role="option" class="country-option">
				<span style="background-position: 0px -2596px" class="country-flag"></span>
				<span class="country-name">Yemen</span> +967
			</span>
			<span data-code="+260" data-id="238" role="option" class="country-option">
				<span style="background-position: 0px -2607px" class="country-flag"></span>
				<span class="country-name">Zambia</span> +260
			</span>
			<span data-code="+263" data-id="239" role="option" class="country-option">
				<span style="background-position: 0px -2618px" class="country-flag"></span>
				<span class="country-name">Zimbabwe</span> +263
			</span></div>
	</div>
	<div class="country-phone">
		<div class="country-blocker"></div>
		<input type="hidden" value="99" name="country" id="country">
		<input type="text" value="+91" name="country_code" id="country_code" class="country-code">
		<input type="tel" required="" value="" placeholder="Phone Number" name="phone" id="phone" class="country-phone-number" aria-required="true"> <!-- Telephone -->
	</div>
</div>							</div>
							<div class="s-100 relative">
								<textarea required="" placeholder="Insert your comments here" name="comments" class="s100" aria-required="true">I'd like to have more information about the property ID 3338.</textarea>
							</div>
						</div>
					</div>
					<button id="submit-button" class="btn btn-white mt-m mb-m ml-b mr-m form-btn send-form" type="submit">Submit Enquiry</button><a style="display: inline;" onclick="javascript:$('.slider-form-fields').hide('slow');$('.slider-form-btn').show('slow');" class="cancel-contact">Cancel</a>
				</form>
  </div>

</div>

 </div>
<div class="manu-toggle-tabs">
	<div class="toggle-container active-tab">
		<h2>Essentials</h2>
		<div class="toggle-content">
		<table class="f12 mt-s">
						<tbody><tr>
							<td class="dark-grey">Property ID</td>
							<td class="light-grey">3338</td>
						</tr>
						<tr>
							<td class="dark-grey">City</td>
							<td class="light-grey"><a class="hover-white underline" href="#">Dubai </a></td>
						</tr>
						<tr>
							<td class="dark-grey">Area</td>
							<td class="light-grey"><a class="hover-white underline" href="#">Arabian Ranches</a></td>
						</tr>
												<tr>
							<td class="dark-grey">Development</td>
							<td class="light-grey"><a class="hover-white underline" href="#">Yasmin</a></td>
						</tr>
												<tr>
							<td class="dark-grey">Type</td>
							<td class="light-grey">Villa</td>
						</tr>
						<tr>
							<td class="dark-grey">Availability</td>
							<td class="light-grey">Off-plan</td>
						</tr>
												<tr>
							<td class="dark-grey">Lifestyle</td>
							<td class="light-grey"><a class="hover-white underline" href="#">Private Communities</a></td>
						</tr>
												<tr>
							<td class="dark-grey">Bedrooms</td>
							<td class="light-grey">
							<a title="6 bedrooms Villa" class="underline" href="#">6 bedrooms</a>
															</td>
						</tr>
												<tr>
							<td class="dark-grey">Bathrooms</td>
							<td class="light-grey">8 (5 ensuite)</td>
						</tr>
												<tr>
							<td class="dark-grey">Built up area</td>
							<td class="light-grey">6,006 sq ft</td>
						</tr>
												<tr>
							<td class="dark-grey">Plot size</td>
							<td class="light-grey">8,000 sq ft</td>
						</tr>
												<tr>
							<td class="dark-grey">Pool</td>
							<td class="light-grey">Community pool</td>
						</tr>
											</tbody></table>
		
		</div>
	</div>
	<div class="toggle-container">
		<h2>Description</h2>
		<div style="display: none;" class="toggle-content">
		<p>{{$data->about_property}}</p>
		</div>
	</div>
	<div class="toggle-container">
		<h2>Features</h2>
		<div style="display: none;" class="toggle-content">
		<table class="f12 mt-s mb-m">
												<tbody><tr>
							<td class="dark-grey">Facing</td>
							<td class="light-grey">West</td>
						</tr>
												<tr>
							<td class="dark-grey">Views</td>
							<td class="light-grey">Full Community, full Skyline, full Golf course, full Park</td>
						</tr>
												<tr>
							<td class="dark-grey">Kitchen</td>
							<td class="light-grey">Open kitchen equipped with stove, fridge and dish washer. Tile, Wood and Marble countertops. with 1 back kitchen.</td>
						</tr>
												<tr>
							<td class="dark-grey">Laundry</td>
							<td class="light-grey">1 laundry room equipped with washing machine and dryer</td>
						</tr>
												<tr>
							<td class="dark-grey">Rooms</td>
							<td class="light-grey">Study room, maid's room, 2 terraces, 3 balconies and 2 landing areas</td>
						</tr>
												<tr>
							<td class="dark-grey">Finishings</td>
							<td class="light-grey">Tile, marble, wood, carpet flooring. 5 wardrobes, walk in closet and smart home technology</td>
						</tr>
												<tr>
							<td class="dark-grey">Facilities</td>
							<td class="light-grey">Golf course, 2 allocated parkings, communal jacuzzi, communal steam room, communal sauna, communal gymnasium, communal bbq and communal tennis court</td>
						</tr>
											</tbody></table>
		</div>
	</div>
</div>
<div class="slider-content-bottom">
<div class="property-view-more">
		<p>Property ID: 3338 - More questions? <a class="view-more-contact" href="">Contact us</a></p>
		<h4>View More</h4>
		<ul>
		<li><a href="#">Dubai ,</a></li>
		<li><a href="#">Arabian Ranches ,</a></li>
		<li><a href="#">Yasmin</a></li>
		</ul>
</div>
</div>
<div class="slider-content-bottom-share">
    <table>
    <tr><td><span>Share:</span></td>
<td>
<ul>
<li><a class="share-mi" href="#"></a></li>
<li><a class="share-fb" href="#"></a></li>
<li><a class="share-tw" href="#"></a></li>
<li><a class="share-in" href="#"></a></li>
<li><a class="share-p" href="#"></a></li>
<li><a class="share-gp" href="#"></a></li>
</ul>
</td>
</tr>
    </table>
</div>
</div>
</div>
    
    <div class="three-cols">
        <ul>
            <li>
                <h1>follow us</h1>
                <a href="#">Facebook</a> / <a href="#">linkedin</a> / <a href="#">instagram</a>
            </li>
            <li>
                <h1>newsletter</h1>
                <h3>sign up for product news</h3>
                <input type="text" name="email" placeholder="Enter Email">
            </li>
            <li>
                <h1>contact</h1>
                <a class="tree-col-ph" href="#">1234 5678 000</a>
                <a class="tree-col-email" href="#">info@gmail.com</a>
            </li>
        </ul>
        
    </div>



<script>
$(document).ready(function(){
	$('.manu-toggle-tabs h2').click(function(){
		if(!$(this).parent().find('.toggle-content').hasClass('active')) {
			$('.manu-toggle-tabs .toggle-content').hide();
			$('.manu-toggle-tabs .toggle-content').removeClass('active');
			$('.manu-toggle-tabs .toggle-container').removeClass('active-tab');
			$(this).parent().find('.toggle-content').show('slow');
			$(this).parent().find('.toggle-content').addClass('active');
			$(this).parent().addClass('active-tab');
		}
	});
});
</script>

	
   <script type="text/javascript" src="{{ asset('sximo/themes/elliot/project7/js/slideshow.js') }}"></script>
 
        		
        <script>
$(document).ready(function () {
    $('#frontpage-tiles li').click(function () {
        $('#frontpage-layer-bj').fadeIn('slow');
        $('html').addClass('hidescroll');
    });
    $('#frontpage-layer-bj-header-close').click(function () {
        $('#frontpage-layer-bj').fadeOut('slow');
        $('html').removeClass('hidescroll');
    });
});
</script>

<style>
h1, h2, h3, h4, h5, h6 {
    margin: 0 0 25px 0;
    font-family: 'Playfair Display', serif;
    font-weight: 400;
   
    text-transform: uppercase;
}
#sliders{    clear: both;
    display: inline-table;
    background: #000;
}

</style>        