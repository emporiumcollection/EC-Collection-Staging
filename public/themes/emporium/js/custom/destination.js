$(document).ready(function() {
    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', '[data-action="select-destination"]', function () {
        hideAllOption();
        var datObj = {};
        datObj.catID = 0;
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
    console.log(data);
    putDataOnLeft(data)
    var destinationHtml='';
    $(dataObj).each(function(i,val){
        destinationHtml += '<li><a class="cursor" data-action="select-destination" data-id="'+val.id+'">'+val.category_name+'</a></li>'
    });

    $('[data-option="selected-option-list"]').html(destinationHtml);
}