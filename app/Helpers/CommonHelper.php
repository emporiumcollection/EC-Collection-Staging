<?php
namespace App\Helpers;
use Session, DB ;

class CommonHelper
{
    static function url_title($str, $separator = '-', $lowercase = FALSE)
    {
        if ($separator == 'dash') 
        {
            $separator = '-';
        }
        else if ($separator == 'underscore')
        {
            $separator = '_';
        }
    
        $q_separator = preg_quote($separator);
    
        $trans = array(
            '&.+?;'                 => '',
            '[^a-z0-9 _-]'          => '',
            '\s+'                   => $separator,
            '('.$q_separator.')+'   => $separator
        );
    
        $str = strip_tags($str);
    
        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }
    
        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }
    
        return trim($str, $separator);
    }

    // check user type
    static function getusertype($postData){
        
        $type = ((is_int($postData))?'int':((is_string($postData))?'string':''));
        
        $rtype = false;
        
        if(!defined('RUSER_GROUPS')){
            $rgroups  = \DB::table('tb_groups')->select('group_id','name','level')->get();
            $tarra = array(); 
            foreach($rgroups as $si_group){
                $group_id = (int) $si_group->group_id;
                $group_name = self::url_title(trim($si_group->name),'-',true);
                
                $tarra[$group_name] = $group_id;
            }   
            
            define('RUSER_GROUPS',$tarra);
        }        
                
        $users = RUSER_GROUPS;
        
        if($type == 'string'){            
            if(isset($users[$postData])){ $rtype = $users[$postData]; }
        }elseif($type == 'int')
        {
            $postData = (int) $postData;
            $rtype = array_search($postData, $users);
        }
        
        return $rtype;
    }
    //End
    
    //is user metronic dashboard
    static function isHotelDashBoard($g_id=0){
        $g_id = (int) $g_id;
        $group_id = (int) (($g_id > 0)?$g_id:\Auth::user()->group_id);
        $user = self::getusertype($group_id);
        $match_array = array('hotel-b2b');
        $return = "";
        
        if(in_array($user,$match_array)){ $return = 'users_admin.metronic'; }
        
        return $return;
    }
    //end
    
    //is user metronic dashboard
    static function check_membership_package($u_id=0){
        $u_id = (int) $u_id;
        $g_id = \Auth::user()->group_id;
        
        $g_id = (int) $g_id;
        $group_id = (int) (($g_id > 0)?$g_id:\Auth::user()->group_id);
        $user = self::getusertype($group_id);
        $match_array = array('hotel-b2b');
        $return = "";
        
        if(in_array($user,$match_array)){ 
            $obj_hotel  = \DB::table('tb_properties')->where('user_id', $u_id)->first();
            $red_url = '';
            if(!empty($obj_hotel)){ 
                if(isset($obj_hotel->approved)){ 
                    if($obj_hotel->approved==0){ 
                        $red_url = 'whoiam';
                    }else{ 
                        $obj_order  = \DB::table('tb_orders')->where('user_id', $u_id)->get();
                        //print_r($obj_order); die;
                        if(count($obj_order) > 0){
                            foreach($obj_order as $order){
                                if($order->status=="Success"){
                                    $red_url = '';
                                    break;
                                }else{
                                    $red_url = 'hotel/package';
                                }
                            }
                        }else{                        
                            $red_url = 'hotel/package';
                        }
                    }
                }
                $red_url = 'whoiam';
            }
            return $red_url;
        } 
    }
    //end
    
    //Return All images path of Property
    static function getInfo(){

    	$data = array();
		\Session::put('lang', 'en');
        $getlang = \Session::get('newlang');
        $arrive_date = \Session::get('arrive_date');
        $destination_date = \Session::get('destination_date');
        $adults = \Session::get('adults');
        $childs = \Session::get('childs');
        $data['arrive_date'] = $data['destination_date'] = $data['childs'] = $data['adults'] = '';
        if (!isset($getlang)) {
            \Session::put('newlang', 'English');
        } else {
            \Session::put('lang', $getlang);
        }
        if (isset($arrive_date)) {
            $data['arrive_date'] = $arrive_date;
        }
        if (isset($destination_date)) {
            $data['destination_date'] = $destination_date;
        }
        if (isset($adults)) {
            $data['adults'] = $adults;
        }
        if (isset($childs)) {
            $data['childs'] = $childs;
        }
        $invoice_num = \DB::table('tb_settings')->where('key_value', 'default_tax_amount')->first();
        $data['vatsettings']=$invoice_num;
        $data['footer_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'footer_text')->first();
        $data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
    	$data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
    	return $data;
    }

    static function getAboutInfo(){

        $data = array();
        $data['about_text'] = \DB::table('tb_settings')->select('content')->where('key_value', 'about_text')->first();
        return $data;
    }
	
	static function getUspMod(){

        $data = array();
        $data['whybookwithus'] = \DB::table('tb_whybookwithus')->select('id', 'title', 'sub_title')->where('status', 0)->get();
        return $data;
    }
	
	static function getSidebarAds($pos='landing', $cat_id = 'Hotel'){

        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_title', 'adv_desc', 'adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->get();
        return $data;
    }
	
	static function getSliderAds($pos='landing', $cat_id = 'Hotel'){

        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_title', 'adv_desc', 'adv_img', 'adv_link')->where('adv_type', 'slider')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->get();
        return $data;
    }
	
	static function getGridResultAds($pos, $cat_id = 'Hotel'){

        $data = array();
        $data['resultads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link', 'adv_title')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->where('ads_cat_id', $cat_id)->orderByRaw('RAND()')->first();
        return $data;
    }
	
	static function getDetailpageSidebarAds($pos, $cat_ids){
		$cats = explode(',', $cat_ids);
        $data = array();
        $data['leftsidebarads'] = \DB::table('tb_advertisement')->select('adv_img', 'adv_link')->where('adv_type', 'sidebar')->where('adv_status', 1)->where('adv_position', $pos)->whereIn('ads_cat_id', $cats)->get();
        return $data;
    }

    static function calc_price($actprice,$actdays,$customdays){
		if($actprice>0 && $actdays > 0 && $customdays > 0)
		{
			$calcperunit = $actprice / $actdays;
			$calcallunit = $calcperunit * $customdays;
			return number_format($calcallunit,2,'.','');
		}
	}



      static function getCurrencyList(){

                        $currency_symbols = array(
                            'AED' => '&#1583;.&#1573;', // ?
                            'AFN' => '&#65;&#102;',
                            'ALL' => '&#76;&#101;&#107;',
                            'AMD' => '',
                            'ANG' => '&#402;',
                            'AOA' => '&#75;&#122;', // ?
                            'ARS' => '&#36;',
                            'AUD' => '&#36;',
                            'AWG' => '&#402;',
                            'AZN' => '&#1084;&#1072;&#1085;',
                            'BAM' => '&#75;&#77;',
                            'BBD' => '&#36;',
                            'BDT' => '&#2547;', // ?
                            'BGN' => '&#1083;&#1074;',
                            'BHD' => '.&#1583;.&#1576;', // ?
                            'BIF' => '&#70;&#66;&#117;', // ?
                            'BMD' => '&#36;',
                            'BND' => '&#36;',
                            'BOB' => '&#36;&#98;',
                            'BRL' => '&#82;&#36;',
                            'BSD' => '&#36;',
                            'BTN' => '&#78;&#117;&#46;', // ?
                            'BWP' => '&#80;',
                            'BYR' => '&#112;&#46;',
                            'BZD' => '&#66;&#90;&#36;',
                            'CAD' => '&#36;',
                            'CDF' => '&#70;&#67;',
                            'CHF' => '&#67;&#72;&#70;',
                            'CLF' => '', // ?
                            'CLP' => '&#36;',
                            'CNY' => '&#165;',
                            'COP' => '&#36;',
                            'CRC' => '&#8353;',
                            'CUP' => '&#8396;',
                            'CVE' => '&#36;', // ?
                            'CZK' => '&#75;&#269;',
                            'DJF' => '&#70;&#100;&#106;', // ?
                            'DKK' => '&#107;&#114;',
                            'DOP' => '&#82;&#68;&#36;',
                            'DZD' => '&#1583;&#1580;', // ?
                            'EGP' => '&#163;',
                            'ETB' => '&#66;&#114;',
                            'EUR' => '&#8364;',
                            'FJD' => '&#36;',
                            'FKP' => '&#163;',
                            'GBP' => '&#163;',
                            'GEL' => '&#4314;', // ?
                            'GHS' => '&#162;',
                            'GIP' => '&#163;',
                            'GMD' => '&#68;', // ?
                            'GNF' => '&#70;&#71;', // ?
                            'GTQ' => '&#81;',
                            'GYD' => '&#36;',
                            'HKD' => '&#36;',
                            'HNL' => '&#76;',
                            'HRK' => '&#107;&#110;',
                            'HTG' => '&#71;', // ?
                            'HUF' => '&#70;&#116;',
                            'IDR' => '&#82;&#112;',
                            'ILS' => '&#8362;',
                            'INR' => '&#8377;',
                            'IQD' => '&#1593;.&#1583;', // ?
                            'IRR' => '&#65020;',
                            'ISK' => '&#107;&#114;',
                            'JEP' => '&#163;',
                            'JMD' => '&#74;&#36;',
                            'JOD' => '&#74;&#68;', // ?
                            'JPY' => '&#165;',
                            'KES' => '&#75;&#83;&#104;', // ?
                            'KGS' => '&#1083;&#1074;',
                            'KHR' => '&#6107;',
                            'KMF' => '&#67;&#70;', // ?
                            'KPW' => '&#8361;',
                            'KRW' => '&#8361;',
                            'KWD' => '&#1583;.&#1603;', // ?
                            'KYD' => '&#36;',
                            'KZT' => '&#1083;&#1074;',
                            'LAK' => '&#8365;',
                            'LBP' => '&#163;',
                            'LKR' => '&#8360;',
                            'LRD' => '&#36;',
                            'LSL' => '&#76;', // ?
                            'LTL' => '&#76;&#116;',
                            'LVL' => '&#76;&#115;',
                            'LYD' => '&#1604;.&#1583;', // ?
                            'MAD' => '&#1583;.&#1605;.', //?
                            'MDL' => '&#76;',
                            'MGA' => '&#65;&#114;', // ?
                            'MKD' => '&#1076;&#1077;&#1085;',
                            'MMK' => '&#75;',
                            'MNT' => '&#8366;',
                            'MOP' => '&#77;&#79;&#80;&#36;', // ?
                            'MRO' => '&#85;&#77;', // ?
                            'MUR' => '&#8360;', // ?
                            'MVR' => '.&#1923;', // ?
                            'MWK' => '&#77;&#75;',
                            'MXN' => '&#36;',
                            'MYR' => '&#82;&#77;',
                            'MZN' => '&#77;&#84;',
                            'NAD' => '&#36;',
                            'NGN' => '&#8358;',
                            'NIO' => '&#67;&#36;',
                            'NOK' => '&#107;&#114;',
                            'NPR' => '&#8360;',
                            'NZD' => '&#36;',
                            'OMR' => '&#65020;',
                            'PAB' => '&#66;&#47;&#46;',
                            'PEN' => '&#83;&#47;&#46;',
                            'PGK' => '&#75;', // ?
                            'PHP' => '&#8369;',
                            'PKR' => '&#8360;',
                            'PLN' => '&#122;&#322;',
                            'PYG' => '&#71;&#115;',
                            'QAR' => '&#65020;',
                            'RON' => '&#108;&#101;&#105;',
                            'RSD' => '&#1044;&#1080;&#1085;&#46;',
                            'RUB' => '&#1088;&#1091;&#1073;',
                            'RWF' => '&#1585;.&#1587;',
                            'SAR' => '&#65020;',
                            'SBD' => '&#36;',
                            'SCR' => '&#8360;',
                            'SDG' => '&#163;', // ?
                            'SEK' => '&#107;&#114;',
                            'SGD' => '&#36;',
                            'SHP' => '&#163;',
                            'SLL' => '&#76;&#101;', // ?
                            'SOS' => '&#83;',
                            'SRD' => '&#36;',
                            'STD' => '&#68;&#98;', // ?
                            'SVC' => '&#36;',
                            'SYP' => '&#163;',
                            'SZL' => '&#76;', // ?
                            'THB' => '&#3647;',
                            'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
                            'TMT' => '&#109;',
                            'TND' => '&#1583;.&#1578;',
                            'TOP' => '&#84;&#36;',
                            'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
                            'TTD' => '&#36;',
                            'TWD' => '&#78;&#84;&#36;',
                            'TZS' => '',
                            'UAH' => '&#8372;',
                            'UGX' => '&#85;&#83;&#104;',
                            'USD' => '&#36;',
                            'UYU' => '&#36;&#85;',
                            'UZS' => '&#1083;&#1074;',
                            'VEF' => '&#66;&#115;',
                            'VND' => '&#8363;',
                            'VUV' => '&#86;&#84;',
                            'WST' => '&#87;&#83;&#36;',
                            'XAF' => '&#70;&#67;&#70;&#65;',
                            'XCD' => '&#36;',
                            'XDR' => '',
                            'XOF' => '',
                            'XPF' => '&#70;',
                            'YER' => '&#65020;',
                            'ZAR' => '&#82;',
                            'ZMK' => '&#90;&#75;', // ?
                            'ZWL' => '&#90;&#36;',
                            'BTC'=>'',
                            'BYN'=>'',
                            'CNH'=>'',
                            'CUC'=>'',
                            'ERN'=>'',
                            'GGP'=>'',
                            'IMP'=>'', 
                            'MRU'=>'',
                            'SSP'=>'',
                            'STN'=>'', 
                            'XAG'=>'', 
                            'XAU'=>'',
                            'XPD'=>'', 
                            'XPT'=>'',  
                            'ZMW'=>'', 

                        );
$allowedCurrenciesinProject=array("OMR","BHD","KWD","USD","CHF","EUR","KYD","GIP","GBP","JOD","FJD","AWG","AM","BGN","NZD","LYD","SGD","BND","AUD","CAD","INR");

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://openexchangerates.org/api/currencies.json?app_id=635960bf627e404fa235281f10de6aa9",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $returnCurrenyList=array();
                    $currencyList=json_decode($response);
                foreach($allowedCurrenciesinProject as $currencyCodeAllowed){
                    foreach($currencyList as $currencyCode => $currencyName){
                            if($currencyCodeAllowed==$currencyCode){

                                $returnCurrenyList[$currencyCode]=$currencyCode."-".$currency_symbols[$currencyCode];
                            }

                        }
                     }
                     
                     return (json_decode(json_encode($returnCurrenyList)));
                }
       
    }



 static function convertPriceFromCurrency($fromCurrencyCode="EUR", $toCurrencyCode="USD", $amount=1){

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.fixer.io/latest?base=".$fromCurrencyCode,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $currencyPriceList=array();
                    $currencyPrice=json_decode($response);

            }




            if($fromCurrencyCode!=""  && $toCurrencyCode !="" && $amount > 0)
            {
                


            if($toCurrencyCode!="EUR"){

                $calcperunit = $currencyPrice->rates->$toCurrencyCode;
                $calFinalPrice = $calcperunit * $amount;
                return number_format($calFinalPrice,2,'.','');
            }else{

                 return number_format($amount,2,'.','');
            }


               
            }
    }


}
