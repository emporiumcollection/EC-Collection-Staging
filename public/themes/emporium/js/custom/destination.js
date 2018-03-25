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
        location.href = BaseURL+'/luxury_destinations/'+dataObj.path;
        return false;
    }
    var data = {};
    data.main_title = 'Select Your Destination';
    data.sub_title = 'Home';
    data.id = 0;
    if (dataObj.current_category != undefined) {
        data.main_title = 'Home';
        data.sub_title = dataObj.current_category.category_name;
        data.id = dataObj.current_category.id;
    }

     hideAllOption();
    putDataOnLeft(data);
    var destinationHtml = '';
    $(dataObj.dests).each(function (i, val) {
        destinationHtml += '<li><a class="cursor" data-action="select-destination" data-id="' + val.id + '">' + val.category_name + '</a>';
        destinationHtml += '<a href="'+BaseURL+'/luxury_destinations/'+val.category_alias+'"><i class="fa fa-external-link" aria-hidden="true"></i></a></li>';
    });

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
    data.main_title = 'Select Your Experience';
    data.sub_title = 'Home';
    data.id = 0;
    if (dataObj.current_category != undefined) {
        data.main_title = 'Home';
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
        experienceHtml += '<img src="'+imagePath+'" alt="" class="mCS_img_loaded">';
        experienceHtml += '<div class="headingoverlay">' + val.category_name + '</div>';
        experienceHtml += '</a></div></li>';
    });

    $('[data-option="selected-option-list"]').html(experienceHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');
}