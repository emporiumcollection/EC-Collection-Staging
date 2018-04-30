<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/', 'HomeController@index');
Route::get('wetransfer', 'PropertiesController@show_wetransfer');
/*
 * AIC: CRM Layout Module
 */
Route::group(['middleware' => 'auth'], function()
{
    
     Route::resource('usercontract', 'UsercontractController');
    
	//Route::get('crmlayouts', 'CrmlayoutController@index');
	Route::resource('crmlayouts', 'CrmlayoutController');
	Route::get('crmlayouts/delete/{crmlayouts}', 'CrmlayoutController@destroy');
	Route::get('crmlayouts/create_template/{template_id}', 'CrmlayoutController@create_template');
	Route::get('crmlayouts/apply_template/{template_id}', 'CrmlayoutController@apply_template');
	Route::get('crmlayouts/add_new_column/{row_id}/{template_id}', 'CrmlayoutController@add_new_column');

	Route::post('crmlayouts/add_custom_field', 'CrmlayoutController@add_custom_field');
	Route::post('crmlayouts/add_new_row', 'CrmlayoutController@add_new_row');
	Route::post('crmlayouts/add_new_column', 'CrmlayoutController@add_new_column');
	Route::post('crmlayouts/edit_custom_field', 'CrmlayoutController@edit_custom_field');
	Route::get('crmlayouts/delete_custom_field/{id}/{template_id}', 'CrmlayoutController@delete_custom_field');
	Route::get('crmlayouts/delete_crm_element/{id}/{template_id}', 'CrmlayoutController@delete_custom_field');
	Route::get('crmlayouts/delete_crm_element/{id}/{template_id}', 'CrmlayoutController@delete_crm_element');
	Route::get('crmlayouts/duplicate_row/{id}/{template_id}', 'CrmlayoutController@duplicate_row');
	Route::get('crmlayouts/duplicate_group/{id}/{template_id}', 'CrmlayoutController@duplicate_group');
	Route::get('crmlayouts/delete_row/{id}/{template_id}', 'CrmlayoutController@delete_row');
	Route::get('crmlayouts/delete_group/{id}/{template_id}', 'CrmlayoutController@delete_group');
	Route::get('crmlayouts/dupliate_custom_field/{id}/{template_id}', 'CrmlayoutController@dupliate_custom_field');
	Route::get('crmlayouts/dupliate_crm_elements/{id}/{template_id}', 'CrmlayoutController@dupliate_crm_elements');
	Route::post('crmlayouts/ajax_get_custom_field/{id}', 'CrmlayoutController@ajax_get_custom_field');
	Route::post('crmlayouts/ajax_get_crm_element/{id}', 'CrmlayoutController@ajax_get_crm_element');
	Route::post('crmlayouts/save_row_columns', 'CrmlayoutController@save_row_columns');
	Route::post('crmlayouts/save_row_element', 'CrmlayoutController@save_row_element');
	Route::post('crmlayouts/ajax_save_row_columns', 'CrmlayoutController@ajax_save_row_columns');
	Route::post('crmlayouts/ajax_save_group_columns', 'CrmlayoutController@ajax_save_group_columns');
	Route::post('crmlayouts/ajax_save_fields_order', 'CrmlayoutController@ajax_save_fields_order');
	Route::post('crmlayouts/ajax_save_crm_elements_order', 'CrmlayoutController@ajax_save_crm_elements_order');
	Route::post('crmlayouts/ajax_save_rows_order', 'CrmlayoutController@ajax_save_rows_order');
	Route::post('crmlayouts/do_apply_template', 'CrmlayoutController@do_apply_template');
	Route::post('crmlayouts/edit_row_element', 'CrmlayoutController@edit_row_element');

	/*
	* Custom Field Module  
	* All Action urls 
	*/
	Route::get('evcustomfields', 'EvcustomfieldsController@index');
	Route::post('evcustomfields/createGroup', 'EvcustomfieldsController@createGroupAjax');
	Route::get('evcustomfields/getGroups/{id}', 'EvcustomfieldsController@getGroupsAjax');
	Route::get('evcustomfields/getCustomFields', 'EvcustomfieldsController@getCustomFieldsAjax');
	Route::post('evcustomfields/createField', 'EvcustomfieldsController@createFieldAjax');
	Route::post('evcustomfields/removeCustomField/{id}', 'EvcustomfieldsController@removeCustomFieldAjax');
	Route::post('evcustomfields/removeGroup', 'EvcustomfieldsController@removeGroupAjax');
	Route::get('evcustomfields/editCustomField/{id}', 'EvcustomfieldsController@editCustomFieldAjax');
	Route::post('evcustomfields/updateCustomField/{id}', 'EvcustomfieldsController@updateCustomFieldAjax');
	Route::post('evcustomfields/updateCustomFieldOrders', 'EvcustomfieldsController@updateCustomFieldOrderAjax');
	Route::post('evcustomfields/updateGroupOrders', 'EvcustomfieldsController@updateGroupOrderAjax');

});

/********** Added By Ravinder *********/
Route::get('generate/destination', 'GenerateController@destinationGenerate');
Route::get('generate/hotel', 'GenerateController@hotelGenerate');
Route::get('personalized-service', 'Frontend\PersonalizedServiceController@index');
Route::post('personalized-service/save', 'Frontend\PersonalizedServiceController@save');
Route::post('personalized-service/update', 'Frontend\PersonalizedServiceController@update');
Route::get('personalized-service/my-services', 'Frontend\PersonalizedServiceController@list_my_services');
Route::get('personalized-service/edit/{ps_id}', 'Frontend\PersonalizedServiceController@edit');
Route::get('personalized-service/delete/{ps_id}', 'Frontend\PersonalizedServiceController@delete');
Route::controller('/importdata','ImportdataController');
Route::controller('destination','Frontend\DestinationController');
/*************** End *************/
Route::controller('home', 'HomeController');

Route::controller('/user', 'UserController');
Route::controller('/customer', 'CustomerController');
Route::get('/whoiam', 'CustomerController@whoIam');  

Route::post('customer_ajaxPostCreate', 'CustomerController@ajaxPostCreate'); 
Route::post('customer_ajaxPostSignin', 'CustomerController@ajaxPostSignin'); 
Route::post('customer_ajaxPostRequest', 'CustomerController@ajaxPostRequest'); 

include('pageroutes.php');
include('moduleroutes.php');
include('custompageroutes.php');
include('pagemanagementroutes.php');

Route::get('/restric',function(){

	return view('errors.blocked');

});

Route::get('changelang/{lang}', 'HomeController@changeLang');
Route::get('userImport', 'UserimportController@userImportFromDB');
Route::get('propertyimport', 'PropertydataimportController@Propertyimport');
Route::get('propertyimgfix', 'PropertydataimportController@Propertyimagefixes');

Route::get('runInsta', 'instaApiController@runInsta');
Route::get('bars', 'HomeController@barspage');
Route::get('spas', 'HomeController@spaspage');

Route::get('social-youtube', 'Frontend\FrontendPagesController@socialYoutube');
Route::get('social-youtube/{cat}', 'Frontend\FrontendPagesController@socialYoutube');
Route::get('social-youtube/{continent}/{cat}', 'Frontend\FrontendPagesController@socialYoutube');
Route::get('social-youtube/{continent}/{region}/{cat}', 'Frontend\FrontendPagesController@socialYoutube');
Route::get('social-youtube/{continent}/{region}/{country}/{cat}', 'Frontend\FrontendPagesController@socialYoutube');
Route::get('social-stream', 'Frontend\FrontendPagesController@socialStreamWall');

Route::resource('sximoapi', 'SximoapiController'); 
Route::group(['middleware' => 'auth'], function()
{

	Route::get('core/elfinder', 'Core\ElfinderController@getIndex');
	Route::post('core/elfinder', 'Core\ElfinderController@getIndex'); 
	Route::controller('/dashboard', 'DashboardController');
	Route::controllers([
		'core/users'		=> 'Core\UsersController',
		'notification'		=> 'NotificationController',
		'core/logs'			=> 'Core\LogsController',
		'core/pages' 		=> 'Core\PagesController',
		'core/groups' 		=> 'Core\GroupsController',
		'core/template' 	=> 'Core\TemplateController',
	]);
	
	Route::post('addfolder', 'ContainerController@createfolder'); 
	Route::post('addfile', 'ContainerController@uploadFile');
	Route::get('folders/{id}', 'ContainerController@getIndex');
	Route::get('getFolderListAjax/{id}', 'ContainerController@getFolderListAjax');
	Route::get('getFolderListAjaxonload/{id}', 'ContainerController@getFolderListAjaxonload');
	Route::get('getFoldersAjax/{id}', 'ContainerController@getFoldersAjax');
	Route::get('getFoldersAjax/{id}/{wnd}', 'ContainerController@getFoldersAjax');
	Route::get('getUserList', 'ContainerController@getUserListAjax');
	Route::post('deletefilefolder', 'ContainerController@deleteFilesFolders');
	Route::post('copyfolderfile', 'ContainerController@copyFilesFolders');
	Route::post('movefolderfile', 'ContainerController@moveFilesFolders');
	Route::get('files/view/{fid}/{id}', 'ContainerController@Showfiles');
	Route::get('tfiles/view/{fid}/{id}', 'ContainerController@ShowTiffFiles');
	Route::post('sendemail', 'EmployeeController@postDoemail');
	Route::post('seletedfileszip', 'ContainerController@DownloadZipSelected');
	Route::post('entirefolderzip', 'ContainerController@DownloadZipEntire');
	Route::post('seletedfileslowPdf', 'ContainerController@DownloadlowPdfSelected');
	Route::post('seletedfileshighPdf', 'ContainerController@DownloadhighPdfSelected');
	Route::post('folderpermission', 'ContainerController@Directorypermission');
	Route::post('makeflipbook', 'ContainerController@makeFlipbook');
	Route::post('sendemail_flipbook', 'ContainerController@DoflipbookEmail');
	Route::get('containeriframe/{id}/{wnd}', 'ContainerController@getIndex');
	Route::get('foldersiframe/{id}/{wnd}', 'ContainerController@getIndex');
	Route::post('globalPermission', 'ContainerController@globalDirectorypermission');
	Route::post('removeglobalPermission', 'ContainerController@removeglobalDirectorypermission');
	Route::get('generateInvoicePdf/{id}', 'InvoicesController@generateInvoicePdf');
	Route::post('editfolder', 'ContainerController@editfolder');
	Route::post('folderdelete', 'ContainerController@folderdelete');
	Route::post('assignAttribute', 'ContainerController@assignAttributefolderfile');
	Route::post('getAttributeOptions', 'ContainerController@getAttributeOptions');
	Route::post('addnewtag', 'ContainerController@addNewTag');
	Route::post('assignTags', 'ContainerController@assignTagsfolderfile');
	Route::post('search_exist_tag', 'ContainerController@search_tag');
	Route::post('remove_exist_tag', 'ContainerController@remove_exist_tag');
	Route::post('remove_exist_attribute', 'ContainerController@remove_exist_attribute');
	
	Route::get('ifolders/{id}', 'ImapperController@getIndex');
	Route::get('ifiles/view/{fid}/{id}', 'ImapperController@Showfiles');
	Route::get('ifiles/edit/{fid}/{id}', 'ImapperController@Editfiles');
	Route::post('savepin', 'ImapperController@savePinData');
	
	Route::get('getBillTo/{qury}', 'InvoicesController@fetchuserinfoForbillto');
	Route::post('getprofileBillto', 'InvoicesController@fetchprofileForbillto');
	Route::post('importUsers', 'MyusersController@importUsersCsv');
	Route::post('addtab', 'AttributesController@addTab');
	Route::get('tab_content/{aid}', 'AttributesController@TabContent');
	Route::post('save_tab_content', 'AttributesController@SaveTabContent');
	Route::get('group_content/{aid}', 'AttributesController@GroupContent');
	Route::post('save_group_content', 'AttributesController@SaveGroupContent');
	Route::get('edit_tab_content/{aid}/{tab}', 'AttributesController@EditTabContent');
	Route::post('editfile', 'ContainerController@editfile');
	Route::post('assignMainImage', 'ContainerController@assignMainImage');
	Route::post('seletedfilesfrontend', 'ContainerController@seletedFilesFrontend');
	Route::post('assignDesigner', 'ContainerController@assignDesignercontainer');
	Route::post('unassign_seletedfilesfrontend', 'ContainerController@UnassignSeletedFilesFrontend');
	Route::post('activate_deactivate_product_frontend', 'ContainerController@ActivateDeactivateProductFrontend');
	Route::post('deactivate_hotelhelp', 'ContainerController@deactivateHotelhelp');
	Route::post('addsubimage', 'ContainerController@addSubImageContainerFile');
	Route::post('activate_deactivate_product_slider_images', 'ContainerController@ActivateDeactivateProductSliderImages');
	Route::post('remove_subimage', 'ContainerController@RemoveSubimage');
	Route::post('update_container_sortnum', 'ContainerController@UpdateContainerSortnum');
	Route::post('add_varients', 'ContainerController@AddVarientsfile');
	Route::post('remove_exist_varients', 'ContainerController@RemoveExistVarients');
	Route::get('containersearch', 'ContainerController@containerSearchAjax');
	Route::post('assignTagsFile', 'ContainerController@assignTagsFile');
	Route::post('seletedfilesfrontendslider', 'ContainerController@seletedFrontendSlider');
	Route::post('add_slider_variant_folder', 'ContainerController@create_slider_variant_folders');
	Route::post('landing_page_products', 'ContainerController@landingPageProducts');
	Route::post('seletedfiles_activatelightbox', 'ContainerController@seletedfilesActivatelightbox');
	Route::post('seletedfiles_deactivatelightbox', 'ContainerController@seletedfilesDeactivatelightbox');	
	Route::post('activate_deactivate_product_lightbox', 'ContainerController@ActivateDeactivateProductLightbox');
	
	Route::post('create_lightbox', 'HomeController@create_newlightbox');
	Route::post('delete_lightbox', 'HomeController@lightboxdelete');
	Route::post('lightboxupdatename', 'HomeController@lightboxupdatename');
	Route::post('lightbox_addcontent', 'HomeController@lightboxAddcontents');
	Route::get('lightbox_content_downloadpdf/{cid}', 'HomeController@lightbox_content_downloadpdf');
	Route::post('sendemail_lightbox', 'HomeController@SendEmailLightbox');
	Route::post('lightbox_reserve', 'HomeController@lightboxReserveItems');
	Route::post('delete_lightbox_content', 'HomeController@lightbox_content_delete');
	Route::post('lightbox_addcontent_container', 'ContainerController@lightboxAddcontentsContainer');
	
	Route::post('delete_attribute_option', 'AttributesController@remove_attribute_option');
	Route::post('copy_attributes', 'AttributesController@copyAttribute');
	Route::post('assignPdfImage', 'ContainerController@assignPdfImage');
	Route::post('delete_shop_product', 'ShopController@remove_shop_product');
	Route::post('getshopcategories', 'ShopController@shop_categories');
	
	Route::post('shop_order', 'HomeController@place_shop_order');
	Route::post('lightbox_ordered_item_update', 'LightboxordersController@lightbox_ordered_item_update');
	
	Route::post('seletedfolderslanding', 'ContainerController@assign_landing_products');
	
	Route::post('enable_diable_field_option', 'CustomfieldsController@enable_diable_field_option');
	Route::post('change_order_num', 'CustomfieldsController@change_fileds_ordering');
	Route::post('enable_diable_category_option', 'CategoriesController@enable_diable_category_option');
	Route::post('change_category_order_num', 'CategoriesController@change_category_ordering');
	Route::post('addGroupTab', 'CustomfieldsController@addGroupTab');
	Route::get('customfields_tabs/{fldid}', 'CustomfieldsController@CustomfieldsTabs');
	Route::get('customfields_group/{fldid}', 'CustomfieldsController@CustomfieldsGroup');
	Route::post('save_customfield_group_content', 'CustomfieldsController@SaveCustomfieldsGroupContent');
	Route::post('getCustomfieldOptions', 'CustomfieldsController@getCustomfieldOptions');
	Route::post('save_customfield_tab_content', 'CustomfieldsController@SaveCustomfieldsTabContent');
	Route::get('customfields_edit_tab_content/{fid}/{tab}', 'CustomfieldsController@CustomfieldsEditTabContent');
	
	Route::get('properties_settings/{pid}/{tab}', 'PropertiesController@show_settings');
	Route::post('properties_settings/{pid}/{tab}', 'PropertiesController@show_settings');
	Route::post('add_property_type', 'PropertiesController@save_property_type_data');
	Route::post('delete_property_type', 'PropertiesController@delete_property_type');
	Route::post('add_property_category_rooms', 'PropertiesController@save_property_rooms_data');
	Route::post('delete_property_category_rooms', 'PropertiesController@delete_property_room');
	Route::post('copy_category_rooms', 'PropertiesController@copy_category_rooms');
	Route::post('property_images_uploads', 'PropertiesController@property_images_uploads');


	Route::post('property_images_wetransfer', 'PropertiesController@property_images_wetransfer');

	
	Route::post('delete_property_image', 'PropertiesController@delete_property_image');
	Route::post('save_rooms_amenities', 'PropertiesController@save_rooms_amenities');
	Route::post('add_property_category_rooms_price', 'PropertiesController@save_property_rooms_price_data');
	Route::post('change_property_type', 'PropertiesController@change_property_type');
	Route::post('enable_diable_propertystatus', 'PropertiesController@enable_diable_propertystatus');
	Route::post('get_category_rooms_reservations', 'PropertiesController@get_category_rooms_reservations');
	Route::post('add_new_reservation', 'PropertiesController@add_new_reservation');
	Route::post('add_new_booking', 'HomeController@new_booking');
	
	Route::post('add_season_details', 'SeasonsController@add_season_details');
	Route::post('add_season_dates_details', 'SeasonsController@add_season_dates_details');
	Route::post('delete_season_data', 'SeasonsController@delete_season_data');
	Route::post('delete_season_dates_data', 'SeasonsController@delete_season_dates_data');
	
	Route::post('deleteUserAds', 'UserController@deleteUserAds');
	Route::post('delete_selected_image', 'PropertiesController@delete_selectedproperty_image');
	Route::post('fetch_property_info', 'CrmhotelController@fetch_property_info');
	Route::post('fetch_company_info', 'CrmhotelController@fetch_company_info');
	Route::post('emailCRM', 'CrmhotelController@emailCRM');
	Route::get('pull_property_hotels', 'CrmhotelController@pull_property_hotels');
	Route::post('getfolderlistforselectoptions', 'ContainerController@fetchFolderTreeOptions');
	Route::post('getPropertyRates', 'PropertiesController@getPropertyRates');

	Route::post('gallery_images_uploads', 'CitycontentController@gallery_images_uploads');
	Route::post('delete_gallery_image', 'CitycontentController@delete_gallery_image');
	
	Route::post('enable_diable_sliderstatus', 'SliderController@enable_diable_sliderstatus');
	Route::post('change_order_num_sliders', 'SliderController@change_sliders_ordering');
	Route::post('change_order_num_pagessliders', 'PagessliderController@change_pagessliders_ordering');
	Route::post('enable_diable_pagessliderstatus', 'PagessliderController@enable_diable_pagessliderstatus');
	
	Route::get('fetchpackagedetails/{pckid}', 'HomeController@fetchpackagedetails');
	Route::get('userorder_downloadinvoicepdf/{ordid}', 'UserorderController@ordersdownloadinvoicepdf');
	Route::post('delete_menu_image', 'Sximo\MenuController@deleteMenuImage');
	Route::get('restaurant_reservations/{id}', 'RestaurantController@Reservations');
	Route::get('bar_reservations/{id}', 'BarController@Reservations');


});	



Route::get('hotel/membership', 'Frontend\HotelMembershipController@membershipSignup');
Route::post('hotel/membership', 'Frontend\HotelMembershipController@membershipSignupSave');
Route::get('hotel/package', 'Frontend\HotelMembershipController@hotelPackage');
Route::get('hotel/advertiser', 'Frontend\HotelMembershipController@advertisementPackage');
Route::get('hotel/cart', 'Frontend\HotelMembershipController@hotelCart');
Route::get('hotel/add_package_to_cart', 'Frontend\HotelMembershipController@addToCartAjax');
Route::post('hotel/getAdvertPrice', 'Frontend\HotelMembershipController@getAdvertPriceAjax');
Route::get('hotel/checkout', 'Frontend\HotelMembershipController@hotelCheckout');	
Route::get('thanks', 'Frontend\HotelMembershipController@getThanks');
Route::get('removecartitem', 'Frontend\HotelMembershipController@getCartItemRemovedAjax');	
Route::get('advertiser/package', 'Frontend\AdvertisementController@advertisementPackage');

Route::get('hotel/transferimages', 'Frontend\PropertyimagesmanagementController@propertyImageupload');
Route::post('hotel/transferaddfile', 'Frontend\PropertyimagesmanagementController@transferaddfile');
Route::post('hotel/transferaddfilessend', 'Frontend\PropertyimagesmanagementController@transferaddfilessend');
Route::get('download-document/{code}', 'Frontend\PropertyimagesmanagementController@downloadFileCrm');
Route::get('hotel/propertyimagereminder', 'Frontend\PropertyimagesmanagementController@propertyimageReminder');

Route::get('advertiser/cart', 'Frontend\AdvertisementController@advertiserCart');
Route::get('advertiser/add_package_to_cart', 'Frontend\AdvertisementController@addToCartAjax');
Route::post('advertiser/getAdvertPrice', 'Frontend\AdvertisementController@getAdvertPriceAjax');
Route::get('advertiser/checkout', 'Frontend\AdvertisementController@advertiserCheckout');

Route::get('fetchadvertisementpackagedetails/{pckid}', 'Frontend\AdvertisementController@fetchadvertisementpackagedetails');

Route::get('hotel/propertymanagement', 'Frontend\PropertymanagementController@propertyManagementList');
Route::get('hotel/propertymanagement/property-detail/{propid}', 'Frontend\PropertymanagementController@propertyManagementDetail');
Route::post('hotel/propertymanagement/savepropertydetail', 'Frontend\PropertymanagementController@propertyManagementSaveDetail');

Route::post('frontend_hotelpost', 'HomeController@addHotelInfoFrontend');
Route::post('save_previous_page_image', 'HomeController@save_previous_page_image');
Route::post('_ajax_login', 'HomeController@ajax_login');
Route::post('add_new_room_booking', 'HomeController@new_room_booking');
Route::get('getflipbook/{uniq}', 'ContainerController@getFlipbook');
Route::get('getslideshow/{uniq}', 'ContainerController@getSlideshow');
Route::get('post/{news_title}', 'HomeController@show_full_news');
Route::get('subproduct/{fid}', 'HomeController@subProductPage');
Route::get('subproductmasonry/{fid}', 'HomeController@subProductPage');
Route::get('feature/{pid}', 'HomeController@ProductDetail');
Route::get('projectdetail/{pro_id}', 'HomeController@show_full_project');
Route::get('productsearch', 'HomeController@productSearch');
Route::get('downloadproduct/{parent}/{proname}', 'HomeController@downloadProduct');
Route::get('downloadaszip/{fid}', 'HomeController@downloadZip');
Route::get('service/{ser_id}', 'HomeController@show_service_detail');
Route::post('save_query', 'HomeController@save_contact_queries');
Route::get('designer/{des_name}', 'HomeController@show_designer_detail');
Route::get('submaterials/{fid}', 'HomeController@subMaterialsPage');
Route::get('databanken/{fid}', 'HomeController@databankenPage');
Route::get('downloadhighresaszip/{fid}', 'HomeController@downloadHighresZip');
Route::get('productgallery/{parent}/{proname}', 'HomeController@downloadProduct');
Route::get('ViewFlipbookFrontend/{pdfId}', 'HomeController@ViewFlipbookFrontend');

//seo urls
Route::get('product/{pname}', 'HomeController@MakeProductSeoUrls');
Route::get('product/{parent}/{proname}', 'HomeController@MakeProductdetailSeoUrls');
Route::get('material/{mname}', 'HomeController@MakeMaterialSeoUrls');

//Shop URL(s)
Route::get('product-grid-shuffle', 'HomeController@listShopProducts');
Route::get('product-grid-shuffle/{cat}', 'HomeController@listShopProducts');
Route::get('product-grid-shuffle/{cat}/{cat_title}', 'HomeController@listShopProducts');
Route::get('products/{id}/{slug}', 'HomeController@viewShopProduct');
Route::get('products/{id}', 'HomeController@viewShopProduct');

Route::post('ajax-product-grid-shuffle', 'HomeController@ajax_listShopProducts');
Route::post('get-product-by-title', 'HomeController@getProductByTitle');
Route::post('products/{id}/{slug}', 'HomeController@viewShopProduct');

//Content URL(s)
Route::get('content-grid-shuffle', 'HomeController@contentGridShuffle');
Route::post('ajax-content-grid-shuffle', 'HomeController@ajax_contentGridShuffle');
Route::get('article/{id}', 'HomeController@viewArticleDetails');
Route::post('get-article-by-title', 'HomeController@getArticleByTitle');

// property search urls
Route::get('getproperty/{id}', 'HomeController@getPropertyQuickView');
Route::get('search-property-ajax', 'Frontend\PropertyController@getSearchPropertyAjax');
Route::get('propertyimagebyid/{propid}', 'Frontend\PropertyController@getPropertyImageById');
Route::get('{slug}', 'Frontend\PropertyController@getPropertyDetail');
Route::get('{slug}/restaurant', 'Frontend\RestaurantFrontController@propertyRestrurant');

Route::get('{slug}/events', 'Frontend\PropertyController@getEventsDetail');

Route::get('restaurants/{slug}', 'Frontend\RestaurantFrontController@restrurantDetail');
Route::get('bars/{slug}', 'Frontend\RestaurantFrontController@barDetail');
Route::get('spas/{slug}', 'Frontend\RestaurantFrontController@spaDetail');
Route::get('reserve_resto_table_request', 'Frontend\RestaurantFrontController@reserveRestoTableRequest');
Route::post('resturantspabar_by_typecity_ajax', 'Frontend\RestaurantFrontController@resturantSpaBarByTypeCityAjax');
Route::post('resturantspabarSearch_ajax', 'Frontend\RestaurantFrontController@resturantSpaBarSearchAjax');
Route::get('pdp/{slug}', 'Frontend\PropertyController@getPropertyDetail');
Route::get('search', 'Frontend\PropertyController@propertySearch');
Route::get('our-collection-pages/{slug}/{page}', 'HomeController@getPropertyDetail_pages');
Route::get('book-property/{slug}', 'HomeController@bookProperty');
Route::get('luxurytravel/{slug}', 'Frontend\PropertyController@getPropertyGridListByCategory');
Route::get('ourcollections/{id}', 'HomeController@getPropertyByCategoryQuickView');
//Route::get('search', 'HomeController@SearchLuxuryExperience');
Route::get('luxury_experience/{cat}', 'Frontend\PropertyController@propertySearch');
Route::get('luxury_destinations/{cat}', 'Frontend\PropertyController@propertySearch');
Route::get('luxury_destinations/{continent}/{cat}', 'Frontend\PropertyController@propertySearch');
Route::get('luxury_destinations/{continent}/{region}/{cat}', 'Frontend\PropertyController@propertySearch');
Route::get('luxury_destinations/{continent}/{region}/{country}/{cat}', 'Frontend\PropertyController@propertySearch');

Route::get('luxury_hotels/{cat}', 'Frontend\PropertyController@propertySearch');
Route::get('getpropertygallery/{id}/{type}', 'HomeController@getPropertyGalleryQuickView');
Route::get('getpropertyroomimages/{id}', 'Frontend\PropertyController@getPropertyRoomimageGalleryView');
Route::get('getpropertytypedetail/{id}', 'Frontend\PropertyController@getPropertyTypeQuickView');
Route::post('filter_category_destionation', 'HomeController@getPropertyByCategoryDestination');
//Route::get('choosepackage/{id}', 'HomeController@index');


Route::post('find_property_by_name', 'HomeController@find_property_by_name');
Route::get('getRooms/{slug}', 'PropertiesDetailController@getRoomsAjax');
Route::group(['prefix' => 'api', 'after' => 'allowOrigin'], function() {
   Route::get('user', 'ApiController@userProfileSave');
   Route::get('user/{id}', 'ApiController@retriveUserprofile');
   Route::get('user/update/{id}', 'ApiController@userProfileUpdate');
   
});


Route::get('choose/{mid}', 'UserController@chosepay');
Route::get('bankdetails/{uid}', 'UserController@showBankDetails');
Route::post('bank_agree', 'UserController@bankAgree');
Route::post('getUserprofile', 'UserController@getUserprofile');
Route::get('stripedetails/{uid}', 'StripepaymentController@index');


Route::get('choosepackage/{packageid}', 'StripepaymentController@checkout');
Route::post('order-post', 'StripepaymentController@checkoutPost');

// Add this route for checkout or submit form to pass the item into paypal
Route::post('payment', array(
	'as' => 'payment',
	'uses' => 'PaypalController@choosePayment',
));

Route::post('adspayment', array(
	'as' => 'adspayment',
	'uses' => 'PaypalController@advertisementPayment',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));

Route::get('adspayment/status', array(
	'as' => 'adspayment.status',
	'uses' => 'PaypalController@getadsPaymentStatus',
));

Route::group(['middleware' => 'auth' , 'middleware'=>'sximoauth'], function()
{

	Route::controllers([
		'sximo/menu'		=> 'Sximo\MenuController',
		'sximo/config' 		=> 'Sximo\ConfigController',
		'sximo/module' 		=> 'Sximo\ModuleController',
		'sximo/tables'		=> 'Sximo\TablesController'
	]);			



});

Route::filter('allowOrigin', function($route, $request, $response) 
{
    $response->header('access-control-allow-origin','*');
});

Route::resource('sximoapi', 'SximoapiController');

Route::controller('restaurantfront/{id}', 'Frontend\RestaurantFrontController');
Route::controller('luxury-travel/{slug}', 'Frontend\PresentationController');
Route::get('getEventPackages/{eventID}', 'Frontend\RestaurantFrontController@getEventPackages');


