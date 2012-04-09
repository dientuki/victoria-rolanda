<?php
class dt_tweet extends dt_common {
	
	/**
	* Picture url
	*/	
	private $picture = '';
	
	/**
	* Twett
	*/	
	private $text = '';
	
	/**
	* Username
	*/	
	private $user = '';
	
	/**
	* Has a twett?
	*/	
	public $has_tweet = false;
	
	/**
	 * Constructor
	 * 
	 * @return void
	 */
	function __construct() {
		global $wpdb;
	
		$this->wpdb = $wpdb;
		$this->wp_table = $this->wpdb->prefix . $this->wp_table;
		$this->retrieve_tweet();
	}
	
	/**
	 * Retrieve a twett to show in the theme 
	 */
	private function retrieve_tweet(){
		// @todo: tal ves haya problema con la fecha
		$sql = 'SELECT user, picture, text FROM ' . $this->wp_table . ' WHERE date_show = \'' . date('Y-m-d', time()) . '\' LIMIT 1';
		$result = $this->wpdb->get_results($sql);
		if (count($result) == 0){
			return false;
		}
		
		$this->user = $result[0]->user;
		$this->picture = $result[0]->picture;
		$this->text = $this->sanitize_tweet($result[0]->text);
		$this->has_tweet = true;
	}

	/**
	 * Get the picture
	 * 
	 * @return string
	 */
	public function get_picture(){
		return $this->picture;
	}
	
	/**
	* Get the twett
	*
	* @return string
	*/	
	public function get_text(){
		return $this->text;
	}
	
	/**
	* Get the username
	*
	* @return string
	*/	
	public function get_user(){
		return $this->user;
	}

}