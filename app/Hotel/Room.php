<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService {

	public function get( $roomId ) {
		$parameters = [
			':room_id' => $roomId,
		];
		return $this->fetch( 'SELECT *, room_type.title as room_type
		FROM room
		INNER JOIN room_type ON room.type_id = room_type.type_id
		WHERE room_id = :room_id', $parameters );
	}


	public function getCities() {

		//Get all cities
		$cities = [];
		$rows   = $this->fetchAll( 'SELECT DISTINCT city FROM room' );
		foreach ( $rows as $row ) {
			$cities[] = $row['city'];
		}
		return $cities;
	}

	public function getAllCountOfGuests() {

		//Get all count of guests
		$allCountOfGuests = [];
		$rows             = $this->fetchAll( 'SELECT DISTINCT count_of_guests FROM room' );
		foreach ( $rows as $row ) {
			$allCountOfGuests[] = $row['count_of_guests'];
		}
		return $allCountOfGuests;
	}


	public function search( $checkInDate, $checkOutDate, $city = '', $typeId = '', $countOfGuests = '', $priceMin = '',  $priceMax = '') {

		//Get all available rooms
		$parameters = [
			':check_in_date'  => $checkInDate->format( DateTime::ATOM ),
			':check_out_date' => $checkOutDate->format( DateTime::ATOM ),
		];
		if ( ! empty( $city ) ) {
			$parameters[':city'] = $city;
		}
		if ( ! empty( $typeId ) ) {
			$parameters[':type_id'] = $typeId;
		}
		if ( ! empty( $countOfGuests ) ) {
			$parameters[':count_of_guests'] = $countOfGuests;
		}
		if ( ! empty( $priceMin ) ) {
			$parameters[':price_min'] = $priceMin;
		}
		if ( ! empty( $priceMax ) ) {
			$parameters[':price_max'] = $priceMax;
		}

		//Build query
		$sql = 'SELECT * FROM room WHERE ';
		if ( ! empty( $city ) ) {
			$sql .= 'city = :city AND ';
		}
		if ( ! empty( $typeId ) ) {
			$sql .= 'type_id = :type_id AND ';
		}
		if ( ! empty ( $countOfGuests ) ) {
			$sql .= 'count_of_guests = :count_of_guests AND ';
		}
		if ( ! empty ( $priceMin ) || ! empty ( $priceMax ) ) {
			$sql .= 'price <= :price_max AND price >= :price_min AND ';
		}
		$sql .= 'room_id NOT IN (
			SELECT room_id
			FROM booking
			WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date )';

		//Get results
		return $this->fetchAll( $sql, $parameters );
	}
}

