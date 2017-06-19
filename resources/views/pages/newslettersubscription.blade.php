<style>
	input[type="text"], input[type="email"], textarea
	{
		width:230px;
	}
	form label { font-weight:bold; }
	.parsley-error-list li { color:red; }
	form { border:0; color:#000; }
	.MarTop40 { margin-top:40px; }
	.MarTop25 { margin-top:25px; }
</style>
<section data-selector="section" id="text-2col2">
	<div class="container">
	
		<div class="row header-line2 about-sec">
		
		<h1 data-selector="h3" class="title bjproduct-title">{{\Lang::get('core.menu_frontend_newsletter_subscribe')}}</h1>

		</div>
	</div>
</section>

<div class="container gg MarTop40">
	<section id="benefits-grid-images-left">
		<div class="container">
			<div class="row">
				<form action="http://just-emarketing.com/app/index.php/lists/nb401bazxm535/subscribe" class="form-horizontal"  method="post" accept-charset="utf-8" target="_blank">
					<div class="col-md-12">
						<h4>Bestellung Newsletter</h4>
						<fieldset>	
						
						  <div class="row MarBot10 MarTop25">
							<label for="email" class="col-md-3"> {{\Lang::get('core.menu_frontend_newsletterpage_email')}} <span class="asterix"> * </span></label>
							<label for="attention" class="col-md-3"> {{\Lang::get('core.menu_frontend_newsletterpage_attention')}} </label>
							<label for="firstname" class="col-md-3"> {{\Lang::get('core.menu_frontend_newsletterpage_firstname')}}<span class="asterix"> * </span></label>
							<label for="lastname" class="col-md-3"> {{\Lang::get('core.menu_frontend_newsletterpage_lastname')}}<span class="asterix"> * </span> </label>
							
						  </div> 					
						  <div class="row MarBot10">
							<div class="col-md-3">
							  <input name="EMAIL" type="email" value="" required="required"> 
							 </div> 
							<div class="col-md-3">
							  <input name="ANREDE" type="text" value="" > 
							 </div> 
							 <div class="col-md-3">
							  <input  placeholder="" name="FIRSTNAME" type="text" value="" required="required"> 
							 </div>
							 <div class="col-md-3">
							  <input  placeholder="" name="LASTNAME" type="text" value="" required="required"> 
							 </div> 
						  </div> 
						  <div class="row MarBot10 MarTop40">
							<div class="col-md-12">
							  <span >Ich mochte den Newsletter abonnieren :</span>
							</div> 
							
						  </div>
						  <div class="row MarBot10 MarTop10">
							<div class="col-md-12">
							  <span ><input type="checkbox" name="newslettercheck" value="1" /> <b>JANUA®</b> Newsletter</span>
							</div> 
							
						  </div> 
						<div class="row MarBot10 MarTop40">
							<div class="col-md-12">
							  <span><b>Datenschutz </b><span class="asterix"> * </span></span>
							</div> 
							
						  </div>
						  <div class="row MarBot10 MarTop10">
							<div class="col-md-12">
							  <span ><input type="checkbox" name="unnewslettercheck" value="1" /> Ich mochte den Datenschutzbestimmungen zu.</span>
							</div> 
							
						  </div>
						<div class="row MarBot10 MarTop10">
							<div class="col-md-12">
							  <span >Naturlich konnen Sie den newsltter jederzeit abbestellen.<br>Ein Klick auf den ,,abbestellen"-Link am Ende des Newsletter genugt.</span>
							</div> 
							
						  </div>
						 <div class="row MarBot10 MarTop25">
							<div class="col-md-12">
							  <span >{{ (\Session::get('newlang')=='English') ? '* Required fields' : '* erforderliche Felder' }}</span>
						  </div> 
							
						  </div> 
					</fieldset><br />
					<div class="">
						<div class="col-sm-12">
							<button class="btn btn-sm btn-primary" type="submit" style="background: transparent; color: #000; border-bottom: 3px solid #000; font-weight: bold; font-size: 14px;">{{\Lang::get('core.menu_frontend_newsletterpage_submit_button')}}</button>
						</div>
					  </div> 
				</div>				
				
				<div style="clear:both"></div>	
						
			 
			 </form>
			</div>
		</div>
   
</section>
 </div>