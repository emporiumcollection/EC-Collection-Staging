<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class bookings extends Sximo  {
	
	protected $table = 'tb_reservations';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_reservations.*, td_booking_preferences.*, CONCAT((tb_users.first_name), (' '), (tb_users.last_name)) As user_name, tb_reservations.id AS reservation_number, tb_reservations.checkin_date, tb_reservations.checkout_date, tb_reservations.number_of_nights, tb_reservations.created_date FROM tb_reservations INNER JOIN td_booking_preferences ON tb_reservations.id = td_booking_preferences.booking_preference_id INNER JOIN tb_users ON tb_reservations.client_id = tb_users.id  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_reservations.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
