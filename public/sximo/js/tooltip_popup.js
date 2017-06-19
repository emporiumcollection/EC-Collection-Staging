/*
 * Url preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.screenshotPreview = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 10;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.r2 = $(this).attr('rel2');
		this.title = "";
		this.rel2 = "";
		var c = (this.t != "") ? this.t : "";
		var r2 = this.r2;
		var ext = r2.split(".");
		var imgsr = "";
		if(ext.slice(-1).pop()=="jpg" || ext.slice(-1).pop()=="png" || ext.slice(-1).pop()=="gif" || ext.slice(-1).pop()=="bmp" || ext.slice(-1).pop()=="jpeg" || ext.slice(-1).pop()=="JPG")
		{
			imgsr = "<img src='"+ this.rel +"' alt='url preview' />"; 
		}
		$("body").append("<p id='screenshot'>"+ c +"<br>"+imgsr+"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

this.screenshotPreviewimg = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 10;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("img.screenshot").hover(function(e){
		this.t = this.title;
		this.r = $(this).attr('rel');
		this.r2 = $(this).attr('rel2');
		this.title = "";
		this.rel = "";
		this.rel2 = "";
		var fname = (this.t != "") ? this.t : "";
		var ftitle = (this.r != "") ? this.r : "";
		var fdesc = (this.r2 != "") ? this.r2 : "";
		var cont = "";
		cont = "<b>Name:</b> "+ fname +"<br><b>Title:</b> "+ ftitle +"<br><b>Description:</b> "+ fdesc; 
		$("body").append("<p id='screenshot' style='width:300px;'>"+cont+"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;
		this.rel = this.r;
		this.rel2 = this.r2;
		$("#screenshot").remove();
    });	
	$("img.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

this.screenshotPreviewimgclick = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 10;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("img.screenshot").click(function(e){
		this.t = this.title;
		this.r = $(this).attr('rel');
		this.r2 = $(this).attr('rel2');
		this.title = "";
		this.rel = "";
		this.rel2 = "";
		var fname = (this.t != "") ? this.t : "";
		var ftitle = (this.r != "") ? this.r : "";
		var fdesc = (this.r2 != "") ? this.r2 : "";
		var cont = "";
		cont = "<b>Name:</b> "+ fname +"<br><b>Title:</b> "+ ftitle +"<br><b>Description:</b> "+ fdesc; 
		$("body").append("<p id='screenshot' style='width:300px;'>"+cont+"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;
		this.rel = this.r;
		this.rel2 = this.r2;
		$("#screenshot").remove();
    });	
	$("img.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

this.screenshotPreviewmaterialimg = function(){	
	/* CONFIG */
		
		xOffset = 10;
		yOffset = 10;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("img.materialscreenshot").hover(function(e){
		this.t = this.title;
		this.r = $(this).attr('rel');
		this.r2 = $(this).attr('rel2');
		this.title = "";
		this.rel = "";
		this.rel2 = "";
		var fname = (this.t != "") ? this.t : "";
		var ftitle = (this.r != "") ? this.r : "";
		var fdesc = (this.r2 != "") ? this.r2 : "";
		var cont = "";
		cont = fdesc; 
		$("body").append("<p id='screenshot' style='width:300px;'>"+cont+"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;
		this.rel = this.r;
		this.rel2 = this.r2;
		$("#screenshot").remove();
    });	
	$("img.materialscreenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	screenshotPreview();
	screenshotPreviewimg();
	screenshotPreviewimgclick();
	screenshotPreviewmaterialimg();
});