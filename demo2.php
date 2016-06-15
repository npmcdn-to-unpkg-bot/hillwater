<?php
class Man{
	static public function eat(){
		echo 123;
	}
	public function demo(){
		return Man::eat();
	}
	demo();
}

