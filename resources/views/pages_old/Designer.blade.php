<div class="row new-box" >
		
	<div class="container2">
		{{--*/ $imglink = (!empty($designer))?URL::to('uploads/designer_images/'.$designer->designer_image):URL::to('uploads/images/111.png');  /*--}}
		<section data-selector="section" id="download-line-2" class="dark-bg2 cover-bg newcol" style="background-image: url('{{$imglink}}');">
			
		</section>
	</div>	
</div>
		
<div class="container2">
		
		<section data-selector="section" id="text-2col">
			
			
				<div class="row header-line about-sec">
				
				<h1 data-selector="h3" class="title">{{(!empty($designer))?$designer->designer_name:'Hoffmann & Kahleyss'}} </h1>

				
				</div>
			
		</section><!-- PORTFOLIO GRID FULL 2 BLOCK -->
	
	
    
    	<!-- TEXT 1COL BLOCK -->
		<section id="text-1col">
			<div class="row">
				<div class="col-md-12 editContent">
					
					<p>{{(!empty($designer))?$designer->designer_description:'So, what is the secret of successful template design? First of all, it is its friendliness – both for the template’s owner and for his or her future targeted audience. UX and UI are not just empty phrases for us. It is very important for us that the user could understand correctly the message your project’s trying to say to him or her. But, correct giving of the information is just a half of success. Emotions that causes your project in visitor are no less important ticket to success. Modern solutions, interesting elements, unique approach to details make this template recognizable and interesting. You project will not look like a template bought in a store and adapted within couple of hours. Oh, no! This is not your case. You obtain qualitative, fascinating and juicy final product that is modern and actual. Qualitative and flexible code lays in base of this great product.'}}</p>
				</div>
			</div>
			
		</section>
		
		<header>
		
			<div class="page-1-head">
				<h1 data-selector="h3" class="title">Die neue Vitrine BC 04 / </h1>
				
			</div>
			
	</header><!-- TEXT 2COL BLOCK -->
	
    
    	<!-- BENEFITS 2COLUMNS CENTER BLOCK -->
		<div class="row scf-img">
			
		<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" style="background-image: url({{URL::to('uploads/images/Page-2.jpg')}});">
		
				<div class="row">
					<div class="col-md-12">
					
					</div>
				</div>	
			
		</section><!-- TEXT 2COL BLOCK -->
	
	</div>
	<div class="page-1-head">
		<h4>BC 04 / Vitrine</h4>
		<p>Korpus: Eiche natur geölt / Schubfächern: HPL<br/> H: 75 cm, L: 150 cm, T: 60 cm </p>			
	</div>
			
	<div class="row scf-img">
			
		<section data-selector="section" id="download-line-2" class="dark-bg cover-bg2" style="background-image: url({{URL::to('uploads/images/Untitled-16.png')}});">
		
				<div class="row">
					
					
					</div>	
			
		</section>
	</div><!-- TEXT 2COL BLOCK -->
		<div class="page-1-head">
			<h4>BC 01 / Sideboard</h4>
				<p>Korpus: Eiche natur geölt / Schubfächern: HPL<br/> H: 75 cm, L: 150 cm, T: 60 cm </p>
				
				
		</div>
	
	
		<div class="row  social-icon">
		
		</div>
	
	
	</div>

<!-- footer include start -->
	@include('layouts/elliot/bottombar')
  <!-- footer include end -->