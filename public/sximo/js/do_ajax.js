/***************** Common Ajax Functions ****************/
var doAjax_params_default = {
    'url': null,
    'method': "GET",
    'dataType': 'json',
    'data': {},
    'beforeSendCallbackFunction': null,
    'successCallbackFunction': null,
    'completeCallbackFunction': null,
    'errorCallBackFunction': null,
};

function doAjax(params){
	params['data']['_token'] = $('meta[name="csrf-token"]').attr('content');
	var url = params['url'];
    var method = params['method'];
    var dataType = params['dataType'];
    var data = params['data'];
    var beforeSendCallbackFunction = params['beforeSendCallbackFunction'];
    var successCallbackFunction = params['successCallbackFunction'];
    var completeCallbackFunction = params['completeCallbackFunction'];
    var errorCallBackFunction = params['errorCallBackFunction'];
	$.ajax({
			type: method,
			url: url,
			data: data,
			dataType: dataType,
			async: false,
	       	beforeSend: function(jqXHR, settings) {
	            if (typeof beforeSendCallbackFunction === "function") {
	                beforeSendCallbackFunction();
	            }
	        },
	        success: function(data, textStatus, jqXHR) {    
	            if (typeof successCallbackFunction === "function") {
	                successCallbackFunction(data);
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	            if (typeof errorCallBackFunction === "function") {
	                errorCallBackFunction(errorThrown);
	            }

	        },
	        complete: function(jqXHR, textStatus) {
	            if (typeof completeCallbackFunction === "function") {
	                completeCallbackFunction();
	            }
	        }
	    });
}