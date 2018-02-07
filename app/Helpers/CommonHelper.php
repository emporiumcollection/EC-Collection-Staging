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
			return number_format($calcallunit,2);
		}
	}
}
