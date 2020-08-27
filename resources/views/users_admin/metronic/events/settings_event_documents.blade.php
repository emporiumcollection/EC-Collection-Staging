@extends('users_admin.metronic.layouts.app')
@section('breadcrumb')
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('dashboard')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Dashboard </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Event Management System </span> 
        </a> 
    </li>
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('events')}}" class="m-nav__link"> 
            <span class="m-nav__link-text"> Events </span> 
        </a> 
    </li>    
    @if(!empty($event_data))  
    <li class="m-nav__separator"> - </li>
    <li class="m-nav__item"> 
        <a href="{{ URL::to('properties')}}" class="m-nav__link"> 
            <span class="m-nav__link-text breadcrumb-end"> {{$event_data->title}} </span> 
        </a> 
    </li>
    @endif
@stop
@section('content')
     <div class="row">
    
        @if(Session::has('message'))	  
		   {{ Session::get('message') }}	   
	    @endif
                
        <div class="col-xs-12 col-lg-12">
            <ul>
        		@foreach($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
        
        <div class="col-sm-12 col-md-12 col-lg-12">        
    		<div class="m-portlet">
                <div class="m-portlet__head">				
    			     <div class="m-portlet__head-caption">
    					<div class="m-portlet__head-title">
    						<h3 class="m-portlet__head-text">
    							@if(!empty($event_data)) {{$event_data->title}} @endif
    						</h3>
    					</div>
    				 </div>	
    			</div>
    			<div class="m-portlet__body">
    				@include('users_admin/supplier/events/config_tab')
    				<div class="tab-content">
    					<div class="tab-pane active">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <h3 class="main-heading">Event Documents</h3>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="m-portlet__head">
           					            <div class="m-portlet__head-tools">
                                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                    							<li class="nav-item m-tabs__item">
                                                    <a class="nav-link m-tabs__link active" data-toggle="tab" role="tab" href="#tab_hotel_brochure">Event Brochure</a>
                                                </li>            							
                    							<li class="nav-item m-tabs__item">
                                                    <a class="nav-link m-tabs__link" data-toggle="tab" role="tab" href="#tab_contracts" data-toggle="tab">Event Contracts</a>
                                                </li>
                    						</ul>
                                        </div>
                                    </div> 
                                    <div class="tab-content">
            					       <div class="tab-pane active" id="tab_hotel_brochure">
                                            <form id="fileupload" class="fileupload" action="{{URL::to('event_images_uploads')}}" method="POST" enctype="multipart/form-data">
            									<input type="hidden" name="propId" value="{{$pid}}" />
            									<input type="hidden" name="uploadType" value="Event Brochure" />
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
            											<a class="btn btn-success" href="#">
            												<span>Re-Order</span>
            											</a>
            											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('hb');" >
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
            											@if(!empty($event_broch))
            												<tr>
            													<td colspan="5"><input type="checkbox" value="1" id="check_all_hb" class="check-all-hb"> Select all</td>
            												</tr>
            												@foreach($event_broch as $img)
            													<tr class="template-download fade in row{{$img->id}}">
            														<td>
            															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files hb">
            														</td>
            														<td>
            															<span class="preview">
            																<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">
            																	@if($img->file_type=="application/pdf")
            																		<img src="{{URL::to('uploads/images/bigpage_white_acrobat.png')}}">
            																	@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.word")
            																		<img src="{{URL::to('uploads/images/doc.png')}}">
            																	@elseif($img->file_type=="application/vnd.openxmlformats-officedocument.spre")
            																		<img src="{{URL::to('uploads/images/xls.png')}}">
            																		
            																	@else
            																		<img src="{{URL::to('uploads/thumbs/thumb_'.$img->folder_id.'_'.$img->file_name)}}">
            																	@endif
            																	
            																</a>
            															</span>
            														</td>
            														<td>
            															<p class="name">
            																<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#blueimp-gallery">{{$img->file_display_name}}</a>
            															</p>
            														</td>
            														<td>
            															<span class="size">
            																{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
            															</span>
            														</td>
            														<td>
            															<button type="button" class="btn btn-danger" onclick="delete_property_image({{$img->id}});" >
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
            								<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
            									<div class="slides"></div>
            									<h3 class="title"></h3>
            									<a class="prev">‹</a>
            									<a class="next">›</a>
            									<a class="close">×</a>
            									<a class="play-pause"></a>
            									<ol class="indicator"></ol>
            								</div>          
                                       </div>
                                        
                                        <div class="tab-pane use-padding" id="tab_contracts">
            								<!-- The file upload form used as target for the file upload widget -->
            								<form id="fileupload" class="fileupload" action="{{URL::to('event_images_uploads')}}" method="POST" enctype="multipart/form-data">
            									<input type="hidden" name="propId" value="{{$pid}}" />
            									<input type="hidden" name="uploadType" value="Event Contracts" />
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
            											<a class="btn btn-success" href="#">
            												<span>Re-Order</span>
            											</a>
            											<button type="button" class="btn btn-danger" onclick="delete_selected_imgs('hc');" >
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
            											@if(!empty($eventcontacts))
            												<tr>
            													<td colspan="5"><input type="checkbox" value="1" id="check_all_hc" class="check-all-hc"> Select all</td>
            												</tr>
            												@foreach($eventcontacts as $img)
            													<tr class="template-download fade in row{{$img->id}}">
            														<td>
            															<input type="checkbox" name="compont[]" id="compont" value="{{$img->id}}" class="no-border check-files hc">
            														</td>
            														<td>
            															<span class="preview">
            																<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts" >
            																	<img src="{{URL::to('uploads/thumbs/thumb_'.$img->folder_id.'_'.$img->file_name)}}">
            																</a>
            															</span>
            														</td>
            														<td>
            															<p class="name">
            																<a href="{{$img->imgsrc.$img->file_name}}" title="{{$img->file_display_name}}" download="{{$img->file_name}}" data-gallery="#data-gallery-contracts">{{$img->file_display_name}}</a>
            															</p>
            														</td>
            														<td>
            															<span class="size">
            																{{--*/ $sizeKb = ($img->file_size/1024); /*--}} {{ round($sizeKb,2,PHP_ROUND_HALF_UP) }} KB
            															</span>
            														</td>
            														<td>
            															<button type="button" class="btn btn-danger" onclick="delete_property_image({{$img->id}});" >
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
            								<div id="data-gallery-contracts" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
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
                </div>
            </div>
        </div>
    </div>
@stop
{{-- For custom style  --}}
@section('style')
    @parent
    <style>
        .fade {
          opacity: 0;
          transition:opacity .15s linear;
        }
        .fade.in {
            opacity: 1;
          }
    </style>    
    <link href="{{ asset('sximo/css/bookingSys.css')}}" rel="stylesheet">
    <link href="{{ asset('sximo/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui.css')}}">
    <!-- CSS adjustments for browsers with JavaScript disabled -->
    <noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-noscript.css')}}"></noscript>
    <noscript><link rel="stylesheet" href="{{ asset('sximo/file_upload/css/jquery.fileupload-ui-noscript.css')}}"></noscript>    
@endsection
{{-- For custom script --}}
@section('custom_js_script')
    @parent

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
                <button type="button" class="btn btn-danger" onclick="delete_property_image({%=file.id%});">
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
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- blueimp Gallery script -->
    <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
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
    <script> var baseUrl = "{{URL::to('event_images_uploads')}}"; </script>
    <script src="{{ asset('sximo/file_upload/js/main.js')}}"></script>
    <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
    <!--[if (gte IE 8)&(lt IE 10)]>
    <script src="js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
    <script>
    	function delete_property_image(imgID)
    	{
    		if(imgID!='' && imgID>0)
    		{
    			var conf = confirm("Are you sure? you want to delete this record!");
    			if(conf==true)
    			{
    				$.ajax({
    					url: "{{ URL::to('delete_event_image')}}",
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
    	   
            $('input[type="checkbox"][id="check_all_hb"]').on('click', function(){
                if($('input[type="checkbox"][id="check_all_hb"]').is(':checked')){
    			     $('input[type="checkbox"].hb').prop('checked',true);
                }else{
                     $('input[type="checkbox"].hb').prop('checked',false);
                }
    		});
            
            $('input[type="checkbox"][id="check_all_hc"]').on('click', function(){
                if($('input[type="checkbox"][id="check_all_hc"]').is(':checked')){
    			     $('input[type="checkbox"].hc').prop('checked',true);
                }else{
                     $('input[type="checkbox"].hc').prop('checked',false);
                }
    		});
    		
    	});
    	
    	function delete_selected_imgs(cls)
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
    			  url: "{{ URL::to('delete_selected_event_image')}}",
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
   
@endsection