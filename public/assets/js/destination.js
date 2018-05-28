$(document).ready(function () {
    /*
     * For Select Destination of Left Sidebar
     */
    $(document).on('click', '[data-action="select-destination"]', function () {
       
        var datObj = {};
        datObj.catID = 0;
        if ($(this).attr('data-id') > 0) {
            datObj.catID = $(this).attr('data-id');
        }
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/destinatinos-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestination;
        doAjax(params);

    });
	
	/*
     * For Back to Destination of Left Sidebar
     */
    $(document).on('click', '[data-option-action="back"][data-option-action-type="destination"]', function () {
      
        var datObj = {};
        datObj.catID = $(this).attr('data-id');
       
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/destinatinos-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestination;
        doAjax(params);
       
    });
	
	 /*
     * For Select Destination of Left Sidebar in youtube social page
     */
    $(document).on('click', '[data-action="select-destination-youtube"]', function () {
       
        var datObj = {};
        datObj.catID = 0;
        if ($(this).attr('data-id') > 0) {
            datObj.catID = $(this).attr('data-id');
        }
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/destinatinos-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestinationSocialYoutube;
        doAjax(params);

    });

    /*
     * For Back to Destination of Left Sidebar in youtube social page
     */
    $(document).on('click', '[data-option-action="back"][data-option-action-type="socialdestination"]', function () {
      
        var datObj = {};
        datObj.catID = $(this).attr('data-id');
       
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/destinatinos-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestinationSocialYoutube;
        doAjax(params);
       
    });

    /*
     * For Select Experience of Left Sidebar
     */
    $(document).on('click', '[data-action="select-experience"]', function () {
        hideAllOption();

        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL + '/destination/experiences-ajax';
        params['successCallbackFunction'] = renderExperience;
        doAjax(params);

    });

    

});
/*
 * For Get Response of Destination Ajax
 */
function renderDestination(dataObj) {
    if(dataObj.dests==undefined){
        //location.href = BaseURL+'/luxury_destinations/'+dataObj.path;
        //return false;
    }
    var data = {};
    data.main_title = 'Search By Destination';
    data.sub_title = 'Home';
    data.id = 0;
    data.type = 'home';
    var destinationHtml = '';
    if (dataObj.current_category != undefined) {
        data.main_title = '<a style="color:#fff;" href="'+ BaseURL +'">Home</a>';
        if (dataObj.currentParentCate != undefined) {
            data.sub_title = 'Back To '+dataObj.currentParentCate.category_name;
            data.id = dataObj.currentParentCate.id;
        }else{
            data.sub_title = 'Back To Destination';
            data.id = dataObj.current_category.parent_category_id;
        }

        data.type = 'destination';
        var imagePath = BaseURL+'/uploads/category_imgs/'+dataObj.current_category.category_image;
        if(dataObj.current_category.category_image==''){
            imagePath = BaseURL+'/themes/emporium/images/mountain-image.jpg';
        }
        destinationHtml += '<li>';
        destinationHtml += '<div class="navheadimage">';
        destinationHtml += '<img src="'+imagePath+'" alt="" class="mCS_img_loaded desaturate">';
        destinationHtml += '<div class="headingoverlay"><span class="destinationTitle">' + dataObj.current_category.category_name + '<br><span class="hashTag">' + dataObj.current_category.category_instagram_tag + '</span></span></div></div>';
        destinationHtml += '</li>';
        destinationHtml += '<li><ul class="mobilesublinks">';
    }

     hideAllOption();
    putDataOnLeft(data);
    
    
    $(dataObj.dests).each(function (i, val) {
            var  linkMenu = BaseURL+'/luxury_destinations/'+val.category_alias;
            if(dataObj.path!=undefined){
                  linkMenu = BaseURL+'/luxury_destinations/'+dataObj.path+'/'+val.category_alias;
            }
        destinationHtml += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
             //destinationHtml += '<li><a class="cursor menu_item" data-action="select-destination" data-id="' + val.id + '">' + val.category_name + '</a>';
       // destinationHtml += '<a href="'+linkMenu+'" class="external-link"><i class="fa fa-external-link" aria-hidden="true"></i></a></li>';
         
       
       });
    if (dataObj.current_category != undefined) {
        destinationHtml += '</ul></li>';
    }

    $('[data-option="selected-option-list"]').html(destinationHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');

}

/*
 * For Get Response of social youtube Destination Ajax
 */
function renderDestinationSocialYoutube(dataObj) {
    if(dataObj.dests==undefined){
        //location.href = BaseURL+'/luxury_destinations/'+dataObj.path;
        //return false;
    }
    var data = {};
    data.main_title = 'Search By Destination';
    data.sub_title = 'Home';
    data.id = 0;
    data.type = 'home';
    var destinationHtml = '';
    if (dataObj.current_category != undefined) {
        data.main_title = '<a style="color:#fff;" href="'+ BaseURL +'">Home</a>';

        if (dataObj.currentParentCate != undefined) {
            data.sub_title = 'Back To '+dataObj.currentParentCate.category_name;
            data.id = dataObj.currentParentCate.id;
        }else{
            data.sub_title = 'Back To Destination';
            data.id = dataObj.current_category.parent_category_id;
        }
        data.type = 'socialdestination';
        var imagePath = BaseURL+'/uploads/category_imgs/'+dataObj.current_category.category_image;
        if(dataObj.current_category.category_image==''){
            imagePath = BaseURL+'/themes/emporium/images/mountain-image.jpg';
        }
        destinationHtml += '<li>';
        destinationHtml += '<div class="navheadimage">';
        destinationHtml += '<img src="'+imagePath+'" alt="" class="mCS_img_loaded desaturate">';
        destinationHtml += '<div class="headingoverlay"><span class="destinationTitle">' + dataObj.current_category.category_name + '<br><span class="hashTag">' + dataObj.current_category.category_instagram_tag + '</span></span></div></div>';
        destinationHtml += '</li>';
        destinationHtml += '<li><ul class="mobilesublinks">';
    }

     hideAllOption();
    putDataOnLeft(data);
    
    
    $(dataObj.dests).each(function (i, val) {
		if(val.category_youtube_channel_url!='')
		{
			var  linkMenu = BaseURL+'/social-youtube/'+val.category_alias;
			if(dataObj.path!=undefined){
				linkMenu = BaseURL+'/social-youtube/'+dataObj.path+'/'+val.category_alias;
			}
			destinationHtml += '<li><a class="cursor menu_item" href="'+linkMenu+'">' + val.category_name + '</a></li>';
		  //  destinationHtml += '<li><a class="cursor menu_item" data-action="select-destination-youtube" data-id="' + val.id + '">' + val.category_name + '</a>';
		  //  destinationHtml += '<a href="'+linkMenu+'" class="external-link"><i class="fa fa-external-link" aria-hidden="true"></i></a></li>';
		}
       });
    if (dataObj.current_category != undefined) {
        destinationHtml += '</ul></li>';
    }

    $('[data-option="selected-option-list"]').html(destinationHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');

}


/*
 * For Get Response of Experience Ajax
 */
function renderExperience(dataObj) {

    var data = {};
    data.main_title = 'Search By Experience';
    data.sub_title = 'Home';
    data.id = 0;
    if (dataObj.current_category != undefined) {
        data.main_title = '<a style="color:#fff;" href="'+ BaseURL +'">Home</a>';
        data.sub_title = dataObj.current_category.category_name;
        data.id = dataObj.current_category.id;
    }

    
    putDataOnLeft(data);
    var experienceHtml = '';
    $(dataObj.dests).each(function (i, val) {
        var imagePath = BaseURL+'/uploads/category_imgs/'+val.category_image;
        if(val.category_image==''){
            imagePath = BaseURL+'/themes/emporium/images/mountain-image.jpg';
        }
        experienceHtml += '<li><div class="navheadimage">';
        experienceHtml += '<a href="'+BaseURL+'/luxury_experience/'+val.category_alias+'">';
        experienceHtml += '<img src="'+imagePath+'" alt="" class="mCS_img_loaded desaturate">';
        experienceHtml += '<div class="headingoverlay"><span class="destinationTitle">' + val.category_name + '</span></div>';
        experienceHtml += '</a></div></li>';
    });

    $('[data-option="selected-option-list"]').html(experienceHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');
}

