<?php

class Singleton
{
	private $id;

	private static $instance;

	private function __construct() {
		$this->id = microtime();
	}

	public function getId() {
		return $this->id;
	}

	public static function getInstance() {
		self::$instance = self::$instance ?: new Singleton();

		return self::$instance;
	}
}

$single = Singleton::getInstance();
var_dump($single);
var_dump($single->getId());

$single2 = Singleton::getInstance();
var_dump($single2);
 var_dump($single2->getId());
