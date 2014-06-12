<?php

class Base62 {

	private static $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	/**
	 *	method to encode data to base62
	 *
	 *	@param mixed $data the number to convert to base62
	 *	@return mixed if is a number the encoded number in string format
	 *			else returns false
	 */

	public static function encode($data){

		if(preg_match('/^\d+$/', $data)){
			if(!($data instanceof Math_BigInteger)){
				$data = new Math_BigInteger($data);
			}

			if($data->toString() == 0){
				return '0';
			}

			$base = new Math_BigInteger(62);
			$base62 = '';
			$quotient = new Math_BigInteger();
			$remainder = new Math_BigInteger();

			while($data->toString() > 0){
				list($quotient, $remainder) = $data->divide($base);
				$base62 .= self::$chars[$remainder->toString()];
				$data = $quotient;
			}

			return $base62;
		}else{
			return false;
		}
		
	}

	/**
	 *	check if a number is even or odd
	 *
	 *	@param int $num the number to eval if is even
	 *	@return bool true if is even, false if odd
	 */

	private static function isEven($num){
		return (($num % 2) % 2 == 0) ? true : false;
	}

	/**
	 * trip operations to avoid overflow
	 *
	 * @param int $size the exponent of the potence
	 * @return Math_BigInteger the potence
	 */

	private static function bigPow($size){
		if($size < 2){
			return new Math_BigInteger((string)pow(62, $size), 10);
		}

		$iterations = $size / 2;
		$total = new Math_BigInteger('1', 10);
		$result = new Math_BigInteger('0', 10);
		$results = array();

		for($i = 0; $i < $iterations; $i++){
			$results[] = new Math_BigInteger(pow(62, 2), 10);
		}
		if(!self::isEven($size % 2)){
			$results[$iterations] = new Math_BigInteger(62, 10);
		}

		for($i = 0; $i < $iterations; $i++){
			$results[$i] = new Math_BigInteger($results[$i], 10);
			$result = $total->multiply($results[$i]);
			$total = $result;
		}

		unset($results);

		return $result;

	}

	/**
	 * decode the string to obtain the number
	 *
	 * @param string $data the base62 encoded number
	 * @return mixed false if the base doesn't matches
	 *			or if the position is less than 0.
	 *			String the decoded string
	 */

	public static function decode($data){
		if(preg_match('/^[a-zA-Z0-9]+$/', $data)){
			
			$len = strlen($data);
			$position = new Math_BigInteger();	// posicion del numero o letra de la cadena codificada dentro del bucle
			$aux = new Math_BigInteger();		// valor posicion ocupada por el numero o letra de la cadena
			$result = new Math_BigInteger();	// contiene el valor resultante 

			for($i = 0; $i < $len; $i++){
				
				$position = new Math_BigInteger((string)strpos(self::$chars, $data[$i]));
				
				if($position->toString() >= 0){
					$aux = $position->multiply(new Math_BigInteger(self::bigPow($i)));
					$result = $result->add($aux);
				}else{
					return false;
				}
			}


			return $result;
		}else{
			return false;
		}
	}

}