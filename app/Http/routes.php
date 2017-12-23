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
Route::controller('home', 'HomeController');

Route::controller('/user', 'UserController');
Route::controller('/customer', 'CustomerController'); 
include('pageroutes.php');
include('moduleroutes.php');
include('custompageroutes.php');

Route::get('/restric',function(){

	return view('errors.blocked');

});

Route::get('changelang/{lang}', 'HomeController@changeLang');
Route::get('userImport', 'UserimportController@userImportFromDB');
Route::get('propertyimport', 'PropertydataimportController@Propertyimport');
Route::get('propertyimgfix', 'PropertydataimportController@Propertyimagefixes');

Route::get('runInsta', 'instaApiController@runInsta');

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
});	

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
Route::get('filter_search_destionation', 'HomeController@getPropertyBySearchDestination');
Route::get('{slug}', 'HomeController@getPropertyDetail');
Route::get('our-collection-pages/{slug}/{page}', 'HomeController@getPropertyDetail_pages');
Route::get('book-property/{slug}', 'HomeController@bookProperty');
Route::get('luxurytravel/{slug}', 'HomeController@getPropertyByCategory');
Route::get('ourcollections/{id}', 'HomeController@getPropertyByCategoryQuickView');
Route::get('search', 'HomeController@propertiesSearch');
Route::get('luxury_experience/{cat}', 'HomeController@SearchLuxuryExperience');
Route::get('luxury_destinations/{continent}/{region}/{cat}', 'HomeController@SearchLuxuryExperience');
Route::get('luxury_hotels/{cat}', 'HomeController@SearchLuxuryExperience');
Route::get('getpropertygallery/{id}/{type}', 'HomeController@getPropertyGalleryQuickView');
Route::get('getpropertyroomimages/{id}', 'HomeController@getPropertyRoomimageGalleryView');
Route::get('getpropertytypedetail/{id}', 'HomeController@getPropertyTypeQuickView');
Route::post('filter_category_destionation', 'HomeController@getPropertyByCategoryDestination');

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