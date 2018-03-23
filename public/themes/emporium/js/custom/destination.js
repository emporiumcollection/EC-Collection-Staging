$(document).ready(function() {
    /*
     * For Select Collection of Left Sidebar
     */
    $(document).on('click', '[data-action="select-destination"]', function () {
        hideAllOption();
        var datObj = {};
        datObj.id = 0;
        var params = $.extend({}, doAjax_params_default);
        params['url'] = BaseURL+'/destination/DestinatinoAjax';
        params['data'] = datObj;
        params['successCallbackFunction'] = renderDestination;
        doAjax(params);

    });

});

function renderDestination(data){
    console.log(data);
}