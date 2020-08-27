@extends('layouts.app')
@section('content')
<link href="{{ asset('sximo/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
<style>
.radio-inline{ padding-left: 0px;}
.bootstrap-tagsinput{ width: 100%; }
</style>
<link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload.css')}}">
<link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui.css')}}">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-noscript.css')}}"></noscript>
<noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui-noscript.css')}}"></noscript>
<div class="page-content row">
	<!-- Page header -->
	<div class="page-header">
		<div class="page-title">
			<h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
		</div>
		<ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
			<li><a href="{{ URL::to('bar?return='.$return) }}">{{ $pageTitle }}</a></li>
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
			<div class="sbox-title"> <h4> <i class="fa fa-table"></i> {{($id)?'Edit':'Add'}} Bar<a href="{{url('bar')}}" class="tips btn btn-xs btn-default pull-right" title="" ><i class="fa fa-arrow-circle-left"></i>&nbsp;Zurück</a></h4></div>
			<div class="sbox-content">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#BarDetails" data-toggle="tab">Bar Details</a></li>
                    @if($id)
                    <li class=""><a href="#GalleryImages" data-toggle="tab">Gallery Images</a></li>
                    <li class=""><a href="#SliderImages" data-toggle="tab">Slider Images</a></li>
                    <li class=""><a href="#Menu" data-toggle="tab">Menu</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane m-t active" id="BarDetails">
        				{!! Form::open(array('url'=>'bar/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
        				{!! Form::hidden('id', $row['id']) !!} 
                        
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#SubtabRestaurantDetails" data-toggle="tab">Details</a></li>
                            <li class=""><a href="#seo" data-toggle="tab">SEO</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane m-t active" id="SubtabRestaurantDetails">
                        
                				<div class="col-md-12">
                					
                					
                					<div class="form-group  " >
                						<label for="Title" class=" control-label col-md-4 text-left"> Title <span class="asterix"> * </span></label>
                						<div class="col-md-6">
                							{!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Sub Title" class=" control-label col-md-4 text-left"> Sub Title </label>
                						<div class="col-md-6">
                							{!! Form::text('sub_title', $row['sub_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
                						<div class="col-md-6">
                
                							{!! Form::textarea('description', $row['description'], ['class' => 'form-control','size' => '30x5']) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                                    
                                    <div class="form-group">
                                        <label for="main_image1" class=" control-label col-md-4 text-left"> Portraite Image1 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='portraite_image1' id='portraite_image1'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['portraite_image1'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="main_image2" class=" control-label col-md-4 text-left"> Portraite Image2 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='portraite_image2' id='portraite_image2'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['portraite_image2'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="main_image3" class=" control-label col-md-4 text-left"> Portraite Image3 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='portraite_image3' id='portraite_image3'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['portraite_image3'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="main_image4" class=" control-label col-md-4 text-left"> Portraite Image4 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='portraite_image4' id='portraite_image4'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['portraite_image4'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="main_image5" class=" control-label col-md-4 text-left"> Landscape Image1 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='landscape_image1' id='landscape_image1'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['landscape_image1'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="main_image6" class=" control-label col-md-4 text-left"> Landscape Image2 </label>
                                        <div class="col-md-6">
                                            <input  type='file' name='landscape_image2' id='landscape_image2'  />
                                            <div >
                                                {!! SiteHelpers::showUploadedFile($row['landscape_image2'],'/uploads/properties_subtab_imgs/') !!}
                                            </div>
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Title" class="control-label col-md-4 text-left"> Landscape Image1 hover text </label>
                                        <div class="col-md-6">
                                            {!! Form::text('landscapehovertext_image1', $row['landscapehovertext_image1'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div> 
                                    
                                    <div class="form-group  " >
                                        <label for="Title" class=" control-label col-md-4 text-left"> Landscape Image2 hover text </label>
                                        <div class="col-md-6">
                                            {!! Form::text('landscapehovertext_image2', $row['landscapehovertext_image2'],array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                        </div> 
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    
                					<div class="form-group  " >
                						<label for="Url" class=" control-label col-md-4 text-left"> Website </label>
                						<div class="col-md-6">
                							{!! Form::text('website', $row['website'],array('class'=>'form-control', 'placeholder'=>'http://example.com',   )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Url" class=" control-label col-md-4 text-left"> Reservation Email </label>
                						<div class="col-md-6">
                							{!! Form::text('reservation_email', $row['reservation_email'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Url" class=" control-label col-md-4 text-left"> Reservation Contact </label>
                						<div class="col-md-6">
                							{!! Form::text('reservation_contact', $row['reservation_contact'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Category Id" class=" control-label col-md-4 text-left"> City </label>
                						<div class="col-md-6">
                						<select name='category_id[]' id="category_id" rows='5'   class='select2 ' multiple="multiple"   > 
                                                            <option  value ="0">-- Select Category --</option> 
                                                            @foreach($categories as $val)
                
                                                            <option  value ="{{$val->id}}" {{(isset($row['category_id']) && in_array($val->id,explode(',',$row['category_id']))) ? " selected='selected' " : '' }}>{{$val->category_name}}</option> 						
                                                            @endforeach						
                                                        </select> 
                					</div>
                					<div class="col-md-2">
                						
                					</div>
                				</div> 
                				
                					<div class="form-group  " >
                						<label for="Part of hotel" class=" control-label col-md-4 text-left"> Part of hotel </label>
                						<div class="col-md-6">
                							<input name="part_of_hotel" id="part_of_hotel" type="checkbox" class="form-control input-sm" value="1" {{($row['part_of_hotel'] == 1) ? " checked='checked' " : '' }}  /> 
                						</div> 
                						<div class="col-md-2">
                
                						</div>
                					</div> 
                					
                					<div class="form-group  " >
                						<label for="Video Type" class=" control-label col-md-4 text-left"> Video Type </label>
                						<div class="col-md-6">
                							
                							<label class='radio radio-inline'>
                							<input type='radio' name='video_type' value ='upload'  @if($row['video_type'] == 'upload') checked="checked" @endif > Upload </label>
                							<label class='radio radio-inline'>
                							<input type='radio' name='video_type' value ='link'  @if($row['video_type'] == 'link') checked="checked" @endif > Link </label>
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					 <div class="restaurant_videotypelink" style="display:none;" >
                						<div class="form-group  " >
                							<label for="Video Link Type" class=" control-label col-md-4 text-left"> Video Link Type </label>
                							<div class="col-md-6">
                								
                								<label class='radio radio-inline'>
                								<input type='radio' name='video_link_type' value ='youtube'  @if($row['video_link_type'] == 'youtube') checked="checked" @endif > Youtube </label>
                								<label class='radio radio-inline'>
                								<input type='radio' name='video_link_type' value ='vimeo'  @if($row['video_link_type'] == 'vimeo') checked="checked" @endif > Vimeo </label>
                							</div>
                							<div class="col-md-2">
                								
                							</div>
                						</div>
                						<div class="form-group  " >
                							<label for="Video Link" class=" control-label col-md-4 text-left"> Video Link </label>
                							<div class="col-md-6">
                								{!! Form::text('video_link', $row['video_link'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
                							</div>
                							<div class="col-md-2">
                								
                							</div>
                						</div>
                					</div>
                
                					<div class="form-group restaurant_videotypeupload" style="display:none;" >
                						<label for="Video" class=" control-label col-md-4 text-left"> Video </label>
                						<div class="col-md-6">
                							<input  type='file' name='video' id='video' @if($row['video'] =='') class='required' @endif style='width:150px !important;'  />
                							<div >
                								{!! SiteHelpers::showUploadedFile($row['video'],'') !!}
                								
                							</div>
                							
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					
                					<div class="form-group  " >
                						<label for="Bar location" class=" control-label col-md-4 text-left"> Bar Location </label>
                						<div class="col-md-6">
                							{!! Form::text('location', $row['location'],array('class'=>'form-control', 'placeholder'=>'Copy the address from google map to get lat long',   )) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                                    <div class="form-group  " >
                                        <label for="Website" class=" control-label col-md-4 text-left"> Latitude </label>
                                        <div class="col-md-6">
                                            {!! Form::text('latitude', $row['latitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                                    <div class="form-group  " >
                                        <label for="Website" class=" control-label col-md-4 text-left"> Longitude </label>
                                        <div class="col-md-6">
                                            {!! Form::text('longitude', $row['longitude'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
                                        </div> 
                                        <div class="col-md-2">
            
                                        </div>
                                    </div>
                					<div class="form-group  " >
                						<label for="Restaurant Usp Text" class=" control-label col-md-4 text-left"> Bar Usp Text </label>
                						<div class="col-md-6">
                
                							{!! Form::textarea('usp_text', $row['usp_text'], ['class' => 'form-control','size' => '30x5']) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Restaurant Usp Person" class=" control-label col-md-4 text-left"> Bar Usp Person </label>
                						<div class="col-md-6">
                
                							{!! Form::textarea('usp_person', $row['usp_person'], ['class' => 'form-control','size' => '30x5']) !!}
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					<div class="form-group  " >
                						<label for="Opening Hrs" class=" control-label col-md-4 text-left"> Opening Hrs </label>
                						<div class="col-md-6">
                
                							{!! Form::textarea('opening_hrs', $row['opening_hrs'], ['class' => 'form-control','size' => '30x5']) !!}
                
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                                    <div class="form-group  " >
                						<label for="instagram id" class=" control-label col-md-4 text-left"> Instagram </label>
                						<div class="col-md-6">
                
                							{!! Form::text('instagram_id', $row['instagram_id'], ['class' => 'form-control','placeholder' => '']) !!}
                
                						</div>
                						<div class="col-md-2">
                							
                						</div>
                					</div>
                					</fieldset>
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
                                            {!! Form::text('meta_keyword', $row['meta_keyword'],array('class'=>'form-control', 'placeholder'=>'', 'data-role'=>'tagsinput'  )) !!} 
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
                                                {!! SiteHelpers::showUploadedFile($row['og_image'],'/uploads/properties_subtab_imgs/') !!}                 
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
                                                {!! SiteHelpers::showUploadedFile($row['twitter_image'],'/uploads/properties_subtab_imgs/') !!}                   
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
        			
        			
        			
        			<div style="clear:both"></div>
        			
        			
        			<div class="form-group">
        				<label class="col-sm-4 text-right">&nbsp;</label>
        				<div class="col-sm-8">
        					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
        					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
        					<button type="button" onclick="location.href='{{ URL::to('spa?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
        				</div>
        				
        			</div>
        			
        			{!! Form::close() !!}
                </div>
                
                
                
                
                <div class="tab-pane m-t" id="GalleryImages">
                    <!-- The file upload form used as target for the file upload widget -->
					<form id="fileuploadgalleryimages" class="fileupload" action="{{URL::to('bar_images_uploads')}}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="propId" value="{{$row['id']}}" />
						<input type="hidden" name="uploadType" value="Gallery" />
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Start upload</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancel upload</span>
								</button>
								<a class="btn btn-success" @if(!empty($res_gallery)) href="{{URL::to('folders/'.$res_gallery[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
									<span>Re-Order</span>
								</a>
								<button type="button" class="btn btn-danger" onclick="delete_bar_selected_imgs('sgi');" >
									<i class="glyphicon glyphicon-trash"></i>
									<span>Delete</span>
								</button>
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped prese">
							<tbody class="files">
                                
								@if(!empty($res_gallery))
									<tr>
										<td colspan="5"><input type="checkbox" value="1" id="check_all_sgi" class="check-all-sgi"> Select all</td>
									</tr>
									@foreach($res_gallery as $img)
										<tr class="template-download fade in row{{$img->id}}">
											<td>
												<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files sgi">
											</td>
											<td>
												<span class="preview">
													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">
														<img src="{{URL::to('uploads/thumbs/thumb_'.$img->folder_id.'_'.$img->file_name)}}" width="128">
													</a>
												</span>
											</td>
											<td>
												<p class="name">
													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">{{$img->file_display_name}}</a>
												</p>
											</td>
											<td>
												<span class="size">
													{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
												</span>
											</td>
											<td>
												<button type="button" class="btn btn-danger" onclick="delete_bar_image({{$img->id}});" >
													<i class="glyphicon glyphicon-trash"></i>
													<span>Delete</span>
												</button>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</form>
					
					<!-- The blueimp Gallery widget -->
					<div id="blueimp-gallery-sgi" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						<div class="slides"></div>
						<h3 class="title"></h3>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="close">×</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
                </div>
                <div class="tab-pane m-t" id="SliderImages">
                    <!-- The file upload form used as target for the file upload widget -->
					<form id="fileuploadsliderimages" class="fileupload" action="{{URL::to('bar_images_uploads')}}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="propId" value="{{$row['id']}}" />
						<input type="hidden" name="uploadType" value="Slider" />
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Start upload</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancel upload</span>
								</button>
								<a class="btn btn-success" @if(!empty($res_slider)) href="{{URL::to('folders/'.$res_slider[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
									<span>Re-Order</span>
								</a>
								<button type="button" class="btn btn-danger" onclick="delete_bar_selected_imgs('sgi');" >
									<i class="glyphicon glyphicon-trash"></i>
									<span>Delete</span>
								</button>
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped prese">
							<tbody class="files">
								@if(!empty($res_slider))
									<tr>
										<td colspan="5"><input type="checkbox" value="1" id="check_all_sgi" class="check-all-sgi"> Select all</td>
									</tr>
									@foreach($res_slider as $img)
										<tr class="template-download fade in row{{$img->id}}">
											<td>
												<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files sgi">
											</td>
											<td>
												<span class="preview">
													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">
														<img src="{{URL::to('uploads/thumbs/thumb_'.$img->folder_id.'_'.$img->file_name)}}" width="128">
													</a>
												</span>
											</td>
											<td>
												<p class="name">
													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">{{$img->file_display_name}}</a>
												</p>
											</td>
											<td>
												<span class="size">
													{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
												</span>
											</td>
											<td>
												<button type="button" class="btn btn-danger" onclick="delete_bar_image({{$img->id}});" >
													<i class="glyphicon glyphicon-trash"></i>
													<span>Delete</span>
												</button>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</form>
					
					<!-- The blueimp Gallery widget -->
					<div id="blueimp-gallery-sgi" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						<div class="slides"></div>
						<h3 class="title"></h3>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="close">×</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
                </div>
                <div class="tab-pane m-t" id="Menu">
                    <!-- The file upload form used as target for the file upload widget -->
					<form id="fileuploadmenu" class="fileupload" action="{{URL::to('bar_images_uploads')}}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="propId" value="{{$row['id']}}" />
						<input type="hidden" name="uploadType" value="Menu" />
						<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
						<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
								<!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Add files...</span>
									<input type="file" name="files[]" multiple>
								</span>
								<button type="submit" class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span>Start upload</span>
								</button>
								<button type="reset" class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span>Cancel upload</span>
								</button>
								<a class="btn btn-success" @if(!empty($res_menu)) href="{{URL::to('folders/'.$res_menu[0]->folder_id.'?show=thumb')}}" @else href="#" @endif>
									<span>Re-Order</span>
								</a>
								<button type="button" class="btn btn-danger" onclick="delete_bar_selected_imgs('sgi');" >
									<i class="glyphicon glyphicon-trash"></i>
									<span>Delete</span>
								</button>
								<!-- The global file processing state -->
								<span class="fileupload-process"></span>
							</div>
							<!-- The global progress state -->
							<div class="col-lg-5 fileupload-progress fade">
								<!-- The global progress bar -->
								<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
									<div class="progress-bar progress-bar-success" style="width:0%;"></div>
								</div>
								<!-- The extended global progress state -->
								<div class="progress-extended">&nbsp;</div>
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
						<table role="presentation" class="table table-striped prese">
							<tbody class="files">
								@if(!empty($res_menu))
									<tr>
										<td colspan="5"><input type="checkbox" value="1" id="check_all_sgi" class="check-all-sgi"> Select all</td>
									</tr>
									@foreach($res_menu as $img)
										<tr class="template-download fade in row{{$img->id}}">
											<td>
												<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files sgi">
											</td>
											<td>
												<span class="preview">
                                                    @if($img->file_type == "application/pdf")
                                                        <a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">
    														<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
    													</a>
                                                    @else
    													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">
    														<img src="{{URL::to('uploads/thumbs/thumb_'.$img->folder_id.'_'.$img->file_name)}}" width="128">
    													</a>
                                                    @endif
													
												</span>
											</td>
											<td>
												<p class="m_title_{{$img->id}}">
													{{$img->title}}
												</p>
											</td>
                                            <td>
												<p class="name">
													<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery-sgi">{{$img->file_display_name}}</a>
												</p>
											</td>
											<td>
												<span class="size">
													{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
												</span>
											</td>
											<td>
												<button type="button" class="btn btn-danger" onclick="delete_bar_image({{$img->id}});" >
													<i class="glyphicon glyphicon-trash"></i>
													<span>Delete</span>
												</button>
                                                <button type="button" class="btn btn-danger" onclick="add_bar_menu_title({{$img->id}});" >
													<i class="glyphicon glyphicon-plus"></i>
													<span>Add Menu Name</span>
												</button>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</form>
					
					<!-- The blueimp Gallery widget -->
					<div id="blueimp-gallery-sgi" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						<div class="slides"></div>
						<h3 class="title"></h3>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="close">×</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
                </div>
                
                
                
                
            </div>                    
		</div>

		
	</div>
</div>
</div>

<div id="addMenuTitlePopupSection" class="custom_modal modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Menu Title</h5>
            </div>
            <div class="modal-body">
                <div id="formerrors"></div>
                <form id="add_menu_title_form"> 
                    <div class="row">                   
                        <div class="form-group col-lg-12">
                            <label for="Title">Title</label>                            
                            <input class="form-control" type="text" name="menuTitle" value="" />                            				
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="hidden" name="mID" id="mID" />
                            <button type="submit" class="btn btn-default submit-btn" id="sbt_btn_menu_title" >Submit</button>
                        </div>
                    </div>
                </form>
            </div>        
        </div>	
	</div>
</div>


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
		<td></td>
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade row{%=file.id%}">
		<td></td>
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(parseInt(file.size))%}</span>
        </td>
        <td>
            <button type="button" class="btn btn-danger" onclick="delete_bar_image({%=file.id%});">
				<i class="glyphicon glyphicon-trash"></i>
				<span>Delete</span>
			</button>
        </td>
    </tr>
{% } %}
</script>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ asset('sximo/file_upload/js/vendor/jquery.ui.widget.js')}}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<!-- blueimp Gallery script 
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<script src="{{ asset('sximo/file_upload/js/jquery.blueimp-gallery.min.js')}}"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset('sximo/file_upload/js/jquery.iframe-transport.js')}}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload.js')}}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-process.js')}}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-image.js')}}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-audio.js')}}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-video.js')}}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-validate.js')}}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{ asset('sximo/file_upload/js/jquery.fileupload-ui.js')}}"></script>
<!-- The main application script -->
<script> var baseUrl = "{{URL::to('bar_images_uploads')}}"; </script>
<script src="{{ asset('sximo/file_upload/js/main.js')}}"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script src="{{ asset('sximo/js/typeahead.min.js')}}"></script>
<script src="{{ asset('sximo/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script>
    $(document).ready(function(){
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
    });
    
    $(document).on('click', '#sbt_btn_menu_title', function(e){
       e.preventDefault();
       submit_menuTitle();
    });

    function submit_menuTitle(){
        $.ajax({
            url: "{{ URL::to('bar/addmenutitle')}}",
            type: "post",
            data: $('#add_menu_title_form').serialize(),
            dataType: "json",
            success: function(data){
                var html = '';
                if(data.status=='error')
                {
                	html +='<ul class="parsley-error-list">';
                	$.each(data.message, function(idx, obj) {
                		html +='<li>'+obj+'</li>';
                	});
                	html +='</ul>';
                	$('#formerrors').html(html);
                }
                else{
                	var htmli = '';
                	htmli +='<div class="alert alert-success fade in block-inner">';
                	htmli +='<button data-dismiss="alert" class="close" type="button">x</button>';
                	htmli +='<i class="icon-checkmark-circle"></i> '+data.message+' </div>';
                	$('#formerrors').html(htmli);
                	$('#add_menu_title_form')[0].reset();
                    $(".m_title_"+data.mid).html(data.menutitle);
                    $("#addMenuTitlePopupSection").modal('hide');
                    $('#formerrors').html('');
                }
            }
        });
    }
    function add_bar_menu_title(mid){
        
        $.ajax({
            url: "{{ URL::to('bar/menutitle')}}",
            type: "get",
            data: {mid:mid},
            dataType: "json",
            success: function(data){
                if(data.status=='success'){
                    $obj = data.objmenu;
                    $("#mID").val(mid);
                    $('input[name="menuTitle"]').val($obj.title);
                }
            }
        });
        $("#addMenuTitlePopupSection").modal();
    }

	function delete_bar_image(imgID)
	{
		if(imgID!='' && imgID>0)
		{
			var conf = confirm("Are you sure? you want to delete this record!");
			if(conf==true)
			{
				$.ajax({
					url: "{{ URL::to('bar/deletebarimage')}}",
					type: "post",
					data: "img_id="+imgID,
					dataType: "json",
					success: function(data){
					  var html ='';
					  if(data.status=='error')
					  {
							html +='<div class="alert alert-danger fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
							$('.page-content-wrapper #formerrors').html(html);
							window.scrollTo(0, 0);
					  }
					  else{
							$('.prese tr.row'+imgID).remove();
							html +='<div class="alert alert-success fade in block-inner">';
							html +='<button data-dismiss="alert" class="close" type="button">×</button>';
							html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
							$('.page-content-wrapper #formerrors').html(html);
							window.scrollTo(0, 0);
					  }
					}
				});
			}
		}
	}
	
	$(function(){
		$('input[type="checkbox"][id="check_all_sgi"]').on('ifChecked', function(){
			$('input[type="checkbox"].sgi').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_sgi"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].sgi').iCheck('uncheck');
		});
		
		$('input[type="checkbox"][id="check_all_rgi"]').on('ifChecked', function(){
			$('input[type="checkbox"].rgi').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_rgi"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].rgi').iCheck('uncheck');
		});
		
		$('input[type="checkbox"][id="check_all_bgi"]').on('ifChecked', function(){
			$('input[type="checkbox"].bgi').iCheck('check');
		});
		
		$('input[type="checkbox"][id="check_all_bgi"]').on('ifUnchecked', function(){
			$('input[type="checkbox"].bgi').iCheck('uncheck');
		});
	});
	
	function delete_bar_selected_imgs(cls)
	{
		var conf = confirm("Are you sure? you want to delete this record!");
		if(conf==true)
		{
			var sList = "";
			$('input[type=checkbox].'+cls).each(function () {
				if(this.checked)
				{
					sList += (sList=="" ? $(this).val() : "," + $(this).val());
				}
				
			});
			
			$.ajax({
			  url: "{{ URL::to('bar/deletebarselectedimage')}}",
			  type: "post",
			  data: "items=" + sList,
			  dataType: "json",
			  success: function(data){
				  var html ='';
				  if(data.status=='error')
				  {
						html +='<div class="alert alert-danger fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Not Found </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
				  else{
						$.each(data.imgs, function(idx, obj) {
							$('.prese tr.row'+obj).remove();
						});
						html +='<div class="alert alert-success fade in block-inner">';
						html +='<button data-dismiss="alert" class="close" type="button">×</button>';
						html +='<i class="icon-checkmark-circle"></i> Record Deleted Successfully </div>';
						$('.page-content-wrapper #formerrors').html(html);
						window.scrollTo(0, 0);
				  }
			  }
			});
		}
	}
</script>



<script type="text/javascript">
	$(document).ready(function() {
		
		
		
		
		$('.removeCurrentFiles').on('click',function(){
				var removeUrl = $(this).attr('href');
				$.get(removeUrl,function(response){});
				$(this).parent('div').empty();
				return false;
		});

		//For choose video upload type
		$('input[type="radio"][name="video_type"]').on('ifChecked', function () {
                
                if($(this).val()=='upload'){
                	$(".restaurant_videotypeupload").show();
					$(".restaurant_videotypelink").hide();
                }else{
					$(".restaurant_videotypeupload").hide();
					$(".restaurant_videotypelink").show();
				}

        });

      
		
	});
</script>
@stop