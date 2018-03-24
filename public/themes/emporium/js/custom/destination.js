$(document).ready(function() {
    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', '[data-action="select-destination"]', function () {
        hideAllOption();
        var datObj = {};
        datObj.catID = 0;
        if($(this).attr('data-id')>0){
            datObj.catID = $(this).attr('data-id');
        }
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL+'/destination/destinatinos-ajax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestination;
        doAjax(params);

    });

});

function renderDestination(dataObj){

    var data = {};
    data.main_title = 'Select Your Destination';
    data.sub_title = 'Home';
    data.id = 0;
    if(dataObj.current_category!=undefined){
        data.main_title = 'Home';
        data.sub_title =  dataObj.current_category.category_name;
        data.id = dataObj.current_category.id;
    }

    console.log(data);
    putDataOnLeft(data)
    var destinationHtml='';
    $(dataObj.dests).each(function(i,val){
        destinationHtml += '<li><a class="cursor" data-action="select-destination" data-id="'+val.id+'">'+val.category_name+'</a><a></a></li>'
    });

    $('[data-option="selected-option-list"]').html(destinationHtml);
    $('[data-option="global"]').removeClass('hide');
    $('[data-option="child-global"]').removeClass('hide');
    $('[data-option="selected-option-list"]').removeClass('hide');
}