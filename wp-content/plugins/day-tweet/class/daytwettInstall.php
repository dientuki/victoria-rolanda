<?php
class daytwettInstall{	
	
	/**
	 * The wpdb object
	 */		
	private $wpdb = null;
	
	/**
	 * Table name
	 */
	private $wp_table = 'day_twett';	
	
	/**
	 * The constructor
	 *
	 * @return void 
	 */		
	function __construct() {
		global $wpdb;
				
		$this->wpdb = $wpdb;
		$this->wp_table = $this->wpdb->prefix . $this->wp_table;

		$role = get_role('administrator');
		if(!$role->has_cap('manage_day_twetts')) {
			$role->add_cap('manage_day_twetts');
		}		
	}

	/**
	 * Activation function
	 * 
	 * @return void
	 */		
	public function activate(){
			$this->create_table();
	}
	
	/**
	 * Deactivation function
	 * 
	 * @return void
	 */		
	public function deactivate(){
			$this->drop_table();
	}

	/**
	 * Create table in db
	 * 
	 * @return void
	 */		
	private function create_table(){
		$sql = 'CREATE TABLE ' . $this->wp_table . ' (
				id INT NOT NULL AUTO_INCREMENT,
				url VARCHAR( 50 ) NOT NULL,
				user VARCHAR( 50 ) NOT NULL,
				picture VARCHAR( 150 ) NOT NULL,
				text VARCHAR( 140 ) NOT NULL,
				date_show DATE NOT NULL,
			PRIMARY KEY (id)
		)';
		$this->wpdb->query($sql);		
	}
	
	/**
	 * Drop table in db
	 * 
	 * @return void
	 */		
	private function drop_table(){
		$this->wpdb->query('DROP TABLE ' . $this->wp_table);
	}
}