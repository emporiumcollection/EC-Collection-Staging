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
		<li><a href="{{ URL::to('categories?return='.$return) }}">{{ $pageTitle }}</a></li>
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
    
    		 {!! Form::open(array('url'=>'categories/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
            <div class="col-md-12">
    						<!--<fieldset><legend> Categories</legend> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#CategoryDetails" data-toggle="tab">Category Details</a></li>                                
                    <li class=""><a href="#seo" data-toggle="tab">SEO</a></li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane m-t active" id="CategoryDetails">
                    
                    							
    								  <div class="form-group hidethis " style="display:none;">
    									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
    									<div class="col-md-6">
    									  {!! Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Parent Category" class=" control-label col-md-3 text-left"> Parent Category </label>
    									<div class="col-md-7">
    									  
    									<?php $parent_category_id = explode(',',$row['parent_category_id']);
    									$parent_category_id_opt = array( '0' => '-- Select category --' , ); ?>
    									<select name='parent_category_id' rows='5'   class='select2 '  > 
    										<option  value ="0">-- Select Category --</option> 
    										@foreach($parent_categories as $val)
    										
    											<option  value ="{{$val['id']}}" {{($row['parent_category_id'] == $val['id']) ? " selected='selected' " : '' }}>{{$val['name']}}</option> 						
    										@endforeach						
    										</select> 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Category Name" class=" control-label col-md-3 text-left"> Category Name <span class="asterix"> * </span></label>
    									<div class="col-md-7">
    									  {!! Form::text('category_name', $row['category_name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Category Description" class=" control-label col-md-3 text-left"> Category Description <span class="asterix"> * </span></label>
    									<div class="col-md-7">
    									  <textarea name='category_description' rows='5' id='editor' class='form-control editor '  
    						required >{{ $row['category_description'] }}</textarea> 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Category Image" class=" control-label col-md-3 text-left"> Category Image </label>
                                        <div class="col-md-7">
                                            <input  type='file' name='category_image' id='category_image' @if($row['category_image'] =='') class='required' @endif style='width:150px !important;'  />
                                            <div >
    						                  {!! SiteHelpers::showUploadedFile($row['category_image'],'/uploads/category_imgs/') !!}
                                            </div>					 
    									</div> 
    									<div class="col-md-2">
    									 	
    									</div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Category Custom Title" class=" control-label col-md-3 text-left"> Category Custom Title </label>
    									<div class="col-md-7">
    									  {!! Form::text('category_custom_title', $row['category_custom_title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 
    								  <div class="form-group  " >
    									<label for="Youtube Id" class=" control-label col-md-3 text-left"> Youtube Channel Url </label>
    									<div class="col-md-7">
    									  {!! Form::text('category_youtube_channel_url', $row['category_youtube_channel_url'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 
    									
    								  <div class="form-group  " >
    									<label for="Instagram Channel" class=" control-label col-md-3 text-left"> Instagram Channel </label>
    									<div class="col-md-7">
    									  {!! Form::text('category_instagram_channel', $row['category_instagram_channel'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div>
    							      <div class="form-group  " >
        								<label for="InstagramTag" class=" control-label col-md-3 text-left"> Instagram Tag </label>
        								<div class="col-md-7">
        									{!! Form::text('category_instagram_tag', $row['category_instagram_tag'],array('class'=>'form-control', 'placeholder'=>'',   )) !!}
        								</div>
        								<div class="col-md-2">
        
        								</div>
        							  </div>
    								  <div class="form-group  " >
    									<label for="Approved" class=" control-label col-md-3 text-left"> Approved <span class="asterix"> * </span></label>
    									<div class="col-md-7">									  
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_approved' value ='0' required @if($row['category_approved'] == '0') checked="checked" @endif > No </label>
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_approved' value ='1' required @if($row['category_approved'] == '1') checked="checked" @endif > Yes </label> 
    									</div> 
    									<div class="col-md-2">
    									 	
    									</div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Published" class=" control-label col-md-3 text-left"> Published <span class="asterix"> * </span></label>
    									<div class="col-md-7">
    									  
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_published' value ='0' required @if($row['category_published'] == '0') checked="checked" @endif > No </label>
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_published' value ='1' required @if($row['category_published'] == '1') checked="checked" @endif > Yes </label> 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 					
    								  <div class="form-group  " >
    									<label for="Featured" class=" control-label col-md-3 text-left"> Featured <span class="asterix"> * </span></label>
    									<div class="col-md-7">									  
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_featured' value ='0' required @if($row['category_featured'] == '0') checked="checked" @endif > No </label>
                        					<label class='radio radio-inline'>
                        					<input type='radio' name='category_featured' value ='1' required @if($row['category_featured'] == '1') checked="checked" @endif > Yes </label> 
    									 </div> 
    									 <div class="col-md-2">
    									 	
    									 </div>
    								  </div> 
                                      <!--</fieldset>-->
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
                                        {!! Form::text('meta_title', (!empty($metatags)) ? $metatags->meta_title : '', array('class'=>'form-control', 'placeholder'=>'' )) !!}                                
                                     </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                 					
                                <div class="form-group  " >
                                    <label for="meta_description" class=" control-label col-md-4 text-left"> Meta Description </label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('meta_description', (!empty($metatags)) ? $metatags->meta_description : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                 
                                <div class="form-group  " >
                                    <label for="meta_keywords" class=" control-label col-md-4 text-left"> Meta Keywords </label>
                                    <div class="col-md-6">
                                        {!! Form::text('meta_keywords', (!empty($metatags)) ? $metatags->meta_keywords : '',array('class'=>'form-control', 'placeholder'=>'', 'data-role'=>'tagsinput'  )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                 
                                <div class="form-group hidden" >
                                    <label for="canonical_link" class=" control-label col-md-4 text-left"> Canonical link </label>
                                    <div class="col-md-6">
                                        {!! Form::text('canonical_link', (!empty($metatags)) ? $metatags->canonical_link : '',array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane m-t" id="OpenGraph"> 
                                <div class="form-group  " >
                                    <label for="og_title" class=" control-label col-md-4 text-left"> OG Title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_title', (!empty($metatags)) ? $metatags->og_title : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                                <div class="form-group  " >
                                    <label for="og_description" class=" control-label col-md-4 text-left"> OG Description </label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('og_description', (!empty($metatags)) ? $metatags->og_description : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                                <div class="form-group  " >
                                    <label for="og_url" class=" control-label col-md-4 text-left"> OG url </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_url', (!empty($metatags)) ? $metatags->og_url : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                 
                                <div class="form-group  " >
                                    <label for="type" class=" control-label col-md-4 text-left"> OG type </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_type', (!empty($metatags)) ? $metatags->og_type : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <div class="form-group" style="display: none;">
                                    <label for="og_image" class=" control-label col-md-4 text-left"> OG Image </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_image', (!empty($metatags)) ? $metatags->og_image : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                <!-- upload or link section --!>
                                <div class="form-group">
                                    <label for="Video Type" class=" control-label col-md-4 text-left"> Image Type </label>
                                    <div class="col-md-6"> 
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='og_image_type' value ='upload' id='og_image_upload' <?php if(!empty($metatags)){ echo ($metatags->og_upload_type == 'upload') ? 'checked="checked"' : ''; } ?> /> Upload 
                                        </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='og_image_type' value ='link' id='og_image_type_link' <?php if(!empty($metatags)){ echo($metatags->og_upload_type == 'link') ?  'checked="checked"' : '';} ?> /> Link 
                                        </label> 
                                    </div> 

                                </div>

                                <div class="form-group og-image-type-upload" style="display:none;" >
                                    <label for="og_image" class=" control-label col-md-4 text-left"> Image </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='og_image_type_upload' id='og_image_type_upload'  />
                                        <div >
                                        @if(!empty($metatags))
                                            {!! SiteHelpers::showUploadedFile($metatags->og_image,'/uploads/properties_subtab_imgs/') !!} 
                                        @endif   
                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="og-image-type-link" style="display:none;" >
                                    
                                    <div class="form-group" >
                                        <label for="og image Link" class=" control-label col-md-4 text-left"> Link </label>
                                        <div class="col-md-8">
                                            <input type='text' name='og_image_type_link' id='og_image_type_link' class="form-control" value="<?php echo (!empty($metatags)) ? $metatags->og_image_link : ''; ?>" />
                                                                                        
                                        </div> 


                                    </div>
                                    
                                </div>
                                        
                                <!-- End upload or link section --!>
                                
                                <div class="form-group" style="display: none;">
                                    <label for="og_image_width" class=" control-label col-md-4 text-left"> OG Image Width </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_image_width', (!empty($metatags)) ? $metatags->og_image_width : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                 
                                <div class="form-group" style="display: none;">
                                    <label for="og_image_height" class=" control-label col-md-4 text-left"> OG Image Height </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_image_height', (!empty($metatags)) ? $metatags->og_image_height : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                                <div class="form-group  " >
                                    <label for="og_sitename" class=" control-label col-md-4 text-left"> OG Sitename </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_sitename', (!empty($metatags)) ? $metatags->og_sitename : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
        
                                <div class="form-group  " >
                                    <label for="og_locale" class=" control-label col-md-4 text-left"> OG Locale </label>
                                    <div class="col-md-6">
                                        {!! Form::text('og_locale', (!empty($metatags)) ? $metatags->og_locale : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                            </div> 
                            <div class="tab-pane m-t" id="TwitterCard">
                                <div class="form-group  " >
                                    <label for="article_section" class=" control-label col-md-4 text-left"> Article section </label>
                                    <div class="col-md-6">
                                        {!! Form::text('article_section', (!empty($metatags)) ? $metatags->article_section : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
        
                                <div class="form-group  " >
                                    <label for="article_tags" class=" control-label col-md-4 text-left"> Article tags </label>
                                    <div class="col-md-6">
                                        {!! Form::text('article_tags', (!empty($metatags)) ? $metatags->article_tags : '',array('class'=>'form-control', 'placeholder'=>'', 'data-role'=>'tagsinput' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <div class="form-group  " >
                                    <label for="twitter_url" class=" control-label col-md-4 text-left">Twitter url </label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_url', (!empty($metatags)) ? $metatags->twitter_url : '',array('class'=>'form-control', 'placeholder'=>''  )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <div class="form-group  " >
                                    <label for="twitter_title" class=" control-label col-md-4 text-left"> Twitter title </label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_title', (!empty($metatags)) ? $metatags->twitter_title : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <div class="form-group  " >
                                    <label for="twitter_description" class=" control-label col-md-4 text-left"> Twitter description </label>
                                    <div class="col-md-6">
                                        {!! Form::textarea('twitter_description', (!empty($metatags)) ? $metatags->twitter_description : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                                <div class="form-group" style="display: none;">
                                    <label for="twitter_image" class=" control-label col-md-4 text-left">Twitter image</label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_image', (!empty($metatags)) ? $metatags->twitter_image : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <!-- upload or link section --!>
                                <div class="form-group">
                                    <label for="Video Type" class=" control-label col-md-4 text-left"> Image Type </label>
                                    <div class="col-md-6"> 
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='twitter_image_type' value ='upload' id='twitter_image_upload' @if(!empty($metatags)) @if($metatags->twitter_upload_type == 'upload') checked="checked" @endif @endif /> Upload 
                                        </label>
                                        <label class='radio radio-inline'>
                                            <input type='radio' name='twitter_image_type' value ='link' id='twitter_image_link' @if(!empty($metatags)) @if($metatags->twitter_upload_type == 'link') checked="checked" @endif  @endif  /> Link 
                                        </label> 
                                    </div> 

                                </div>

                                <div class="form-group twitter-image-type-upload" style="display:none;" >
                                    <label for="twitter_image" class=" control-label col-md-4 text-left"> Image </label>
                                    <div class="col-md-6">
                                        <input  type='file' name='twitter_image_type_upload' id='twitter_image_type_upload'  />
                                        <div >
                                            @if(!empty($metatags))
                                                {!! SiteHelpers::showUploadedFile($metatags->twitter_image,'/uploads/properties_subtab_imgs/') !!}
                                            @endif    
                                        </div>					

                                    </div> 
                                    <div class="col-md-2">

                                    </div>
                                </div>

                                <div class="twitter-image-type-link" style="display:none;" >
                                    
                                    <div class="form-group" >
                                        <label for="twitter image Link" class=" control-label col-md-4 text-left"> Link </label>
                                        <div class="col-md-8">
                                            <input type='text' name='twitter_image_type_link' id='twitter_image_type_link' class="form-control" value="<?php echo (!empty($metatags)) ? $metatags->twitter_image_link : ''; ?>" />
                                                                                        
                                        </div> 


                                    </div>
                                    
                                </div>
                                        
                                <!-- End upload or link section --!>
                                <div class="form-group  " >
                                    <label for="twitter_domain" class=" control-label col-md-4 text-left"> Twitter domain </label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_domain', (!empty($metatags)) ? $metatags->twitter_domain : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div> 
                                
                                <div class="form-group  " >
                                    <label for="twitter_card" class=" control-label col-md-4 text-left"> Twitter card </label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_card', (!empty($metatags)) ? $metatags->twitter_card : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>
                                
                                <div class="form-group  " >
                                    <label for="twitter_creator" class=" control-label col-md-4 text-left">Twitter creator</label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_creator', (!empty($metatags)) ? $metatags->twitter_creator : '',array('class'=>'form-control', 'placeholder'=>'' )) !!} 
                                    </div> 
                                    <div class="col-md-2">
        
                                    </div>
                                </div>      
                                
                                <div class="form-group  " >
                                    <label for="twitter_site" class=" control-label col-md-4 text-left">Twitter Site</label>
                                    <div class="col-md-6">
                                        {!! Form::text('twitter_site', (!empty($metatags)) ? $metatags->twitter_site : '',array('class'=>'form-control', 'placeholder'=>'')) !!} 
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
                <button type="button" onclick="location.href='{{ URL::to('categories?return='.$return) }}' " class="btn btn-success btn-sm "><i class="fa  fa-arrow-circle-left "></i>  {{ Lang::get('core.sb_cancel') }} </button>
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

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop