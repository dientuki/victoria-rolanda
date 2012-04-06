<?php
class tweet {
	
	/**
	 * The wpdb object
	 */
	private $wpdb = null;
	
	/**
	 * Table name
	 */
	private $wp_table = 'day_tweet';
	
	private $picture = '';
	
	private $text = '';
	
	private $user = '';
	
	private $api = 'http://api.twitter.com/1/statuses/show.json?id=';
	
	public $has_tweet = false;
	
	function __construct($frontend = true) {
		global $wpdb;
	
		$this->wpdb = $wpdb;
		$this->wp_table = $this->wpdb->prefix . $this->wp_table;
		if ($frontend == true){
			$this->retrieve_tweet();
		}
	}
	
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
	
	public function delete_tweet($id){
		return $this->wpdb->query('DELETE FROM ' . $this->wp_table . ' WHERE id = \''. $id . '\' LIMIT 1');
	}	
	
	
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
		
		return json_decode($result["body"]);		
	}
	
	public function sanitize_tweet($value){
		$replace = array();
		
		if ( preg_match_all("/http[a-zA-Z0-9.:#%\/]*/", $value, $urls) != false ){
			foreach($urls[0] as $url){
				$tmp = '<a rel="nofollow" target="_blank" href="' . $url . '">' . $url . '</a>';
				$replace[$url] = $tmp;
			}
		}		
		
		if ( preg_match_all("/#[a-zA-Z0-9]*/", $value, $hashtags) != false){			
			foreach($hashtags[0] as $ht){
				$tmp =  substr($ht, 1);
				$tmp = '<a rel="nofollow" target="_blank" href="http://twitter.com/#%21/search/%23'. $tmp .'" title="'. $ht .'"><s>#</s>' . $tmp . '</a>';
				$replace[$ht] = $tmp;
			}
				
		}
		
		if ( preg_match_all("/@[a-zA-Z0-9]*/", $value, $users) != false){
			foreach($users[0] as $user){
				$tmp =  substr($user, 1);
				$tmp = '<a rel="nofollow" target="_blank" href="http://twitter.com/'. $tmp .'" title="'. $user .'"><s>@</s>' . $tmp . '</a>';
				$replace[$user] = $tmp;
				
				//$returned = str_replace($user, $tmp, $value);
			}			
		}
		
		foreach ($replace as $search => $replace){
			$value = str_replace($search, $replace, $value);
		}
		
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