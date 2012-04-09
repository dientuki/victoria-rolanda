<?php
abstract class dt_common {
	
	/**
	* The wpdb object
	*/
	protected $wpdb = null;
	
	/**
	 * Table name
	 */
	protected $wp_table = 'day_tweet';	
	
	/**
	* Constructor
	*/	
	function __construct() {
	}	
		
	/**
	* Sanitize a twett
	* 
	* @parama string $value raw twett
	* @return void
	*/	
	public function sanitize_tweet($value){
		$replace = array();
		
		if ( preg_match_all("/http[a-zA-Z0-9.:#%\/]*/", $value, $urls) != false ){
			foreach($urls[0] as $url){
				$tmp = '<a class="twett-url" rel="nofollow" target="_blank" href="' . $url . '">' . $url . '</a>';
				$replace[$url] = $tmp;
			}
		}		
		
		if ( preg_match_all("/#[a-zA-Z0-9]*/", $value, $hashtags) != false){			
			foreach($hashtags[0] as $ht){
				$tmp =  substr($ht, 1);
				$tmp = '<a class="twett-hashtag" rel="nofollow" target="_blank" href="http://twitter.com/#%21/search/%23'. $tmp .'" title="'. $ht .'"><s>#</s><b>' . $tmp . '</b></a>';
				$replace[$ht] = $tmp;
			}
				
		}
		
		if ( preg_match_all("/@[a-zA-Z0-9]*/", $value, $users) != false){
			foreach($users[0] as $user){
				$tmp =  substr($user, 1);
				$tmp = '<a class="twett-users" rel="nofollow" target="_blank" href="http://twitter.com/'. $tmp .'" title="'. $user .'"><s>@</s><b>' . $tmp . '</b></a>';
				$replace[$user] = $tmp;
			}			
		}
		
		foreach ($replace as $search => $replace){
			$value = str_replace($search, $replace, $value);
		}
		
		return $value;
	}

}