<?php
class twett {
	
	/**
	 * The wpdb object
	 */
	private $wpdb = null;
	
	/**
	 * Table name
	 */
	private $wp_table = 'day_twett';
	
	private $picture = '';
	
	private $text = '';
	
	private $user = '';
	
	public $has_twett = false;
	
	function __construct() {
		global $wpdb;
	
		$this->wpdb = $wpdb;
		$this->wp_table = $this->wpdb->prefix . $this->wp_table;
		$this->retrieve_twett();
	}
	
	private function retrieve_twett(){

		$sql = 'SELECT user, picture, text FROM ' . $this->wp_table . ' WHERE id = 1';
		$result = $this->wpdb->get_results($sql);
		if (count($result) == 0){
			return false;
		}
		
		$this->user = $result[0]->user;
		$this->picture = $result[0]->picture;
		$this->text = $this->sanitize_tweet($result[0]->text);
		$this->has_twett = true;
	}
	
	private function sanitize_tweet($value){
		return $value;
	}

	public function get_picture(){
		return $this->picture;
	}
	public function get_text(){
		return $this->text;
	}
	public function get_user(){
		return $this->user;
	}

}