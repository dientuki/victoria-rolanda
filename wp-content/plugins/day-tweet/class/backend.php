<?php
class dt_backend extends dt_common {
	
	/**
	 * Api's url
	 * 
	 * @var string $api 
	 */
	private $api = 'http://api.twitter.com/1/statuses/show.json?id=';

	/**
	 * Constructor
	 * 
	 */
	function __construct() {
		global $wpdb;
	
		$this->wpdb = $wpdb;
		$this->wp_table = $this->wpdb->prefix . $this->wp_table;
	}
	
	/**
	 * Add a twett to the db
	 * 
	 * @param array $values
	 */
	public function add_tweet($values){
		
		$tweet = $this->get_tweet_from_twitter($values['url']);
		if ($tweet == false) {
			return false;
		}		
		
		$values['user'] = $tweet->user->screen_name;
		$values['picture'] = $tweet->user->profile_image_url;
		$values['text'] = $tweet->text;
		
		$sql = 'INSERT INTO ' . $this->wp_table . ' (id,url,user,picture,text,date_show) VALUES (NULL,';
		$sql .= '\'' . $values['url'] . '\', ';
		$sql .= '\'' . $values['user'] . '\', ';
		$sql .= '\'' . $values['picture'] . '\', ';
		$sql .= '\'' . $values['text'] . '\', ';
		$sql .= '\'' . $values['date_show'] . '\')';
		
		return $this->wpdb->query($sql);
	}
	
	/**
	* Edit a twett
	*
	* @param integer $id
	* @param array $values
	*/	
	public function edit_tweet($id, $values){
		
		$tweet = $this->get_tweet_from_twitter($values['url']);
		if ($tweet == false) {
			return false;
		}
		
		$values['user'] = $tweet->user->screen_name;
		$values['picture'] = $tweet->user->profile_image_url;
		$values['text'] = $tweet->text;
		
		
		$tmp = array();
		
		foreach ($values as $k => $v){
			$tmp[] = $k . ' = \'' . $v . '\'';
		}
		$sql = 'UPDATE ' . $this->wp_table . ' SET ' . implode(', ', $tmp) . ' WHERE id = ' . $id;
		
		return $this->wpdb->query($sql);
	}
	
	/**
	* Delete a twett
	*
	* @param integer $id
	*/	
	public function delete_tweet($id){
		return $this->wpdb->query('DELETE FROM ' . $this->wp_table . ' WHERE id = \''. $id . '\' LIMIT 1');
	}	
	
	public function get_tweet($id){
		$sql = 'SELECT id, date_format(date_show, \'%d/%m/%Y\') as date, user, picture, text, url FROM ' . $this->wp_table . ' WHERE id = ' . $id . ' LIMIT 1';
		$result = $this->wpdb->get_results($sql);
		
		if (count($result) == 0){
			return false;
		}
		return $result[0];		
	}
	
	public function get_all_tweets(){
		$sql = 'SELECT id, date_format(date_show, \'%d/%m/%Y\') as date, user, picture, text, url FROM ' . $this->wp_table . ' ORDER BY date_show ASC';
		$result = $this->wpdb->get_results($sql);

		if (count($result) == 0){
			return false;
		}
		return $result;
	}
	
	public function clean_table(){
		return $this->wpdb->query('TRUNCATE ' . $this->wp_table);
	}	
	
	public function clear_tweets(){
		
		$date = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));
		
		return $this->wpdb->query('DELETE FROM ' . $this->wp_table . ' WHERE date_show <= \''. $date . '\'');
	}	
	
	public function get_tweet_from_twitter($url){
		
		if ( preg_match("/^(http|https):\/\/twitter\.com\/(?:#!\/)?(\w+)\/status(es)?\/(\d+)$/", $url, $matches) == false) {
			return false;
		}	
		$id = $matches[4];
		
		$request = new WP_Http;
		$result = $request->request($this->api . $id);
		
		if (gettype($result) == "object" && get_class($result) == "WP_Error"){
			return false;
		}
		
		$json = json_decode($result["body"]);
		
		if (isset($json->error)){
			return false;
		}
		
		return $json;
		
	}

}