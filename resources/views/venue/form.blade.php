@extends('layouts.app')

@section('content')
<link href="{{ asset('sximo/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
<style>
.radio-inline{ padding-left: 0px;}
.bootstrap-tagsinput{ width: 100%; }
</style>
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
        </div>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
            <li><a href="{{ URL::to('venue?return='.$return) }}">{{ $pageTitle }}</a></li>
            <li class="active">{{ Lang::get('core.addedit') }} </li>
        </ul>	  	  
    </div>
 
 	<div class="page-content-wrapper">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
        <div class="sbox animated fadeInRight">
            <div class="sbox-title"> <h4> <i class="fa fa-table"></i> </h4></div>
            <div class="sbox-content"> 	
            {!! Form::open(array('url'=>'venue/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#VenueDetails" data-toggle="tab">Venue Details</a></li>
                        <li class=""><a href="#seo" data-toggle="tab">SEO</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane m-t active" id="VenueDetails">
									
                            <div class="form-group  " style="display:none;">
                                <label for="Id" class=" control-label col-md-4 text-left"> Id </label>
                                <div class="col-md-6">
                                    {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Name" class=" control-label col-md-4 text-left"> Name </label>
                                <div class="col-md-6">
                                    {!! Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Address" class=" control-label col-md-4 text-left"> Address </label>
                                <div class="col-md-6">
                                    {!! Form::text('address', $row['address'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Email" class=" control-label col-md-4 text-left"> Email </label>
                                <div class="col-md-6">
                                    {!! Form::text('email', $row['email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Website" class=" control-label col-md-4 text-left"> Website </label>
                                <div class="col-md-6">
                                    {!! Form::text('website', $row['website'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group">
                                <label for="Youtube Channel" class=" control-label col-md-4 text-left"> Youtube Channel </label>
                                <div class="col-md-6">
                                    {!! Form::text('youtube_channel', $row['youtube_channel'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                 	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Instagram" class=" control-label col-md-4 text-left"> Instagram </label>
                                <div class="col-md-6">
                                {!! Form::text('instagram', $row['instagram'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">
                                	
                                </div>
                            </div> 					
                            <div class="form-group  " >
                                <label for="Phone" class=" control-label col-md-4 text-left"> Phone </label>
                                <div class="col-md-6">
                                    {!! Form::text('phone', $row['phone'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">                             	
                                </div>
                            </div> 
                            <div class="form-group">
                            	<label for="Location" class=" control-label col-md-4 text-left"> Location </label>
                            	<div class="col-md-6">
                            	  {!! Form::text('event_location', $row['location'],array('class'=>'form-control', 'placeholder'=>'Copy the address from google map to get lat long',   )) !!} 
                            	 </div> 
                            	 <div class="col-md-2">    									 	
                            	 </div>
                            </div>
                            <div class="form-group">
                                <label for="Website" class=" control-label col-md-4 text-left"> Latitude </label>
                                <div class="col-md-6">
                                    {!! Form::text('event_latitude', $row['latitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Website" class=" control-label col-md-4 text-left"> Longitude </label>
                                <div class="col-md-6">
                                    {!! Form::text('event_longitude', $row['longitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                </div> 
                                <div class="col-md-2">            
                                </div>
                            </div> 
                            
                        </div>
                        <div class="tab-pane m-t " id="seo">                        
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#MetaTags" data-toggle="tab">Meta Tags</a></li>
                                <li class=""><a href="#OpenGraph" data-toggle="tab">Open Graph</a></li>
                                <li class=""><a href="#TwitterCard" data-toggle="tab">Twitter Card</a></li>                                                     
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane m-t active" id="MetaTags">                        
                            
                                    <div class="form-group  " >
                                        <label for="meta_title" class=" control-label col-md-4 text-left"> Meta Title </label>
                                        <div class="col-md-6">                                
                                            {!! Form::text('meta_title', $row['meta_title'], array('class'=>'form-control', 'placeholder'=>'' )) !!}                                
                                         </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                     					
                                    <div class="form-group  " >
                                        <label for="meta_description" class=" control-label col-md-4 text-left"> Meta Description </label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('meta_description', $row['meta_description'] ,array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                     
                                    <div class="form-group  " >
                                        <label for="meta_keywords" class=" control-label col-md-4 text-left"> Meta Keywords </label>
                                        <div class="col-md-6">
                                            {!! Form::text('meta_keyword', $row['meta_keywords'],array('class'=>'form-control', 'placeholder'=>'', 'data-role'=>'tagsinput'  )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane m-t" id="OpenGraph"> 
                                    <div class="form-group  " >
                                        <label for="og_title" class=" control-label col-md-4 text-left"> OG Title </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_title', $row['og_title'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group  " >
                                        <label for="og_description" class=" control-label col-md-4 text-left"> OG Description </label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('og_description', $row['og_description'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group  " >
                                        <label for="og_url" class=" control-label col-md-4 text-left"> OG url </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_url', $row['og_url'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                     
                                    <div class="form-group  " >
                                        <label for="type" class=" control-label col-md-4 text-left"> OG type </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_type', $row['og_type'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group" style="display: none;">
                                        <label for="og_image" class=" control-label col-md-4 text-left"> OG Image </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_image', $row['og_image'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    <!-- upload or link section --!>
                                    <div class="form-group">
                                        <label for="Video Type" class=" control-label col-md-4 text-left"> Image Type </label>
                                        <div class="col-md-6"> 
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='og_image_type' value ='upload' id='og_image_upload' <?php echo ($row['og_upload_type'] == 'upload') ? 'checked="checked"' : '';  ?> /> Upload 
                                            </label>
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='og_image_type' value ='link' id='og_image_type_link' <?php echo($row['og_upload_type'] == 'link') ?  'checked="checked"' : ''; ?> /> Link 
                                            </label> 
                                        </div> 
    
                                    </div>
    
                                    <div class="form-group og-image-type-upload" style="display:none;" >
                                        <label for="og_image" class=" control-label col-md-4 text-left"> Image </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='og_image_type_upload' id='og_image_type_upload'  />
                                            <div >                                            
                                                {!! SiteHelpers::showUploadedFile($row['og_image'],'/uploads/venue_meta_imgs/') !!}                 
                                            </div>    
                                        </div> 
                                        <div class="col-md-2">
    
                                        </div>
                                    </div>
    
                                    <div class="og-image-type-link" style="display:none;" >
                                        
                                        <div class="form-group" >
                                            <label for="og image Link" class=" control-label col-md-4 text-left"> Link </label>
                                            <div class="col-md-8">
                                                <input type='text' name='og_image_type_link' id='og_image_type_link' class="form-control" value="<?php echo $row['og_image_link']; ?>" />
                                                                                            
                                            </div> 
    
    
                                        </div>
                                        
                                    </div>
                                            
                                    <!-- End upload or link section --!>
                                    
                                    <div class="form-group  " >
                                        <label for="og_sitename" class=" control-label col-md-4 text-left"> OG Sitename </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_sitename', $row['og_sitename'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
            
                                    <div class="form-group  " >
                                        <label for="og_locale" class=" control-label col-md-4 text-left"> OG Locale </label>
                                        <div class="col-md-6">
                                            {!! Form::text('og_locale', $row['og_locale'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                </div> 
                                <div class="tab-pane m-t" id="TwitterCard">
                                    <div class="form-group  " >
                                        <label for="article_section" class=" control-label col-md-4 text-left"> Article section </label>
                                        <div class="col-md-6">
                                            {!! Form::text('article_section', $row['article_section'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
            
                                    <div class="form-group  " >
                                        <label for="article_tags" class=" control-label col-md-4 text-left"> Article tags </label>
                                        <div class="col-md-6">
                                            {!! Form::text('article_tags', $row['article_tags'],array('class'=>'form-control', 'placeholder'=>'', 'data-role'=>'tagsinput' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_url" class=" control-label col-md-4 text-left">Twitter url </label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_url', $row['twitter_url'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_title" class=" control-label col-md-4 text-left"> Twitter title </label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_title', $row['twitter_title'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_description" class=" control-label col-md-4 text-left"> Twitter description </label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('twitter_description', $row['twitter_description'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" style="display: none;">
                                        <label for="twitter_image" class=" control-label col-md-4 text-left">Twitter image</label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_image', $row['twitter_image'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <!-- upload or link section --!>
                                    <div class="form-group">
                                        <label for="Video Type" class=" control-label col-md-4 text-left"> Image Type </label>
                                        <div class="col-md-6"> 
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='twitter_image_type' value ='upload' id='twitter_image_upload' @if($row['twitter_upload_type'] == 'upload') checked="checked" @endif /> Upload 
                                            </label>
                                            <label class='radio radio-inline'>
                                                <input type='radio' name='twitter_image_type' value ='link' id='twitter_image_link' @if($row['twitter_upload_type'] == 'link') checked="checked" @endif  /> Link 
                                            </label> 
                                        </div> 
    
                                    </div>
    
                                    <div class="form-group twitter-image-type-upload" style="display:none;" >
                                        <label for="twitter_image" class=" control-label col-md-4 text-left"> Image </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='twitter_image_type_upload' id='twitter_image_type_upload'  />
                                            <div>                                                
                                                {!! SiteHelpers::showUploadedFile($row['twitter_image'],'/uploads/venue_meta_imgs/') !!}                   
                                            </div>					
    
                                        </div> 
                                        <div class="col-md-2">
    
                                        </div>
                                    </div>
    
                                    <div class="twitter-image-type-link" style="display:none;" >
                                        
                                        <div class="form-group" >
                                            <label for="twitter image Link" class=" control-label col-md-4 text-left"> Link </label>
                                            <div class="col-md-8">
                                                <input type='text' name='twitter_image_type_link' id='twitter_image_type_link' class="form-control" value="<?php echo ($row['twitter_image_link']); ?>" />
                                                                                            
                                            </div> 
    
    
                                        </div>
                                        
                                    </div>
                                            
                                    <!-- End upload or link section --!>
                                    <div class="form-group  " >
                                        <label for="twitter_domain" class=" control-label col-md-4 text-left"> Twitter domain </label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_domain', $row['twitter_domain'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_card" class=" control-label col-md-4 text-left"> Twitter card </label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_card', $row['twitter_card'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_creator" class=" control-label col-md-4 text-left">Twitter creator</label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_creator', $row['twitter_creator'],array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>      
                                    
                                    <div class="form-group  " >
                                        <label for="twitter_site" class=" control-label col-md-4 text-left">Twitter Site</label>
                                        <div class="col-md-6">
                                            {!! Form::text('twitter_site', $row['twitter_site'],array('class'=>'form-control', 'placeholder'=>'')) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
		
                <div style="clear:both"></div>	
				
					
                <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
    					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
    					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
    					<button type="button" onclick="location.href='{{ URL::to('venue?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>			
	           </div> 
		 
		      {!! Form::close() !!}
	       </div>
        </div>		 
    </div>	
</div>		
<script src="{{ asset('sximo/js/typeahead.min.js')}}"></script>
<script src="{{ asset('sximo/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>	 
<script type="text/javascript">
	$(document).ready(function() {
        $('input[name="meta_keywords"]').tagsinput({
          itemText: 'label'
        });
        $('input[name="article_tags"]').tagsinput();
        
        /* OG Upload Image section */
        if ($('input[type="radio"][id="og_image_upload"]').is(":checked"))
        {
            $(".og-image-type-upload").show();
            $(".og-image-type-link").hide();
        }

        if ($('input[type="radio"][id="og_image_type_link"]').is(":checked"))
        {
            $(".og-image-type-upload").hide();
            $(".og-image-type-link").show();                
        }

        $('input[type="radio"][id="og_image_upload"]').on('ifChecked', function () {
            $(".og-image-type-upload").show();
            $(".og-image-type-link").hide();
        });

        $('input[type="radio"][id="og_image_type_link"]').on('ifChecked', function () {
            $(".og-image-type-upload").hide();
            $(".og-image-type-link").show();
        });
        /* End Upload Image */
        
        /* Twitter Upload Image section */
        if ($('input[type="radio"][id="twitter_image_upload"]').is(":checked"))
        {
            $(".twitter-image-type-upload").show();
            $(".twitter-image-type-link").hide();
        }

        if ($('input[type="radio"][id="twitter_image_link"]').is(":checked"))
        {
            $(".twitter-image-type-upload").hide();
            $(".twitter-image-type-link").show();                
        }

        $('input[type="radio"][id="twitter_image_upload"]').on('ifChecked', function () { console.log("heel");
            $(".twitter-image-type-upload").show();
            $(".twitter-image-type-link").hide();
        });

        $('input[type="radio"][id="twitter_image_link"]').on('ifChecked', function () { console.log("ggg");
            $(".twitter-image-type-upload").hide();
            $(".twitter-image-type-link").show();
        });
        /* End Upload Image */ 
		
        $('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});
	});
</script>		 
@stop