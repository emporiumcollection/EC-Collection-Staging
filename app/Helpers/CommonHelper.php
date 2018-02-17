<?php
namespace App\Helpers;
use Session, DB ;
class CommonHelper
{
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

    static function calc_price($actprice,$actdays,$customdays){
		if($actprice>0 && $actdays > 0 && $customdays > 0)
		{
			$calcperunit = $actprice / $actdays;
			$calcallunit = $calcperunit * $customdays;
			return number_format($calcallunit,2,'.','');
		}
	}



      static function getCurrencyList(){

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
                     return (json_decode($response));
                }
       
    }
}
