<?php
require_once('wp-load.php');
$res = $wpdb->get_results("SELECT post_id, meta_value FROM $wpdb->postmeta WHERE meta_key = 'blogger_permalink'");
$wpdb->print_error();
foreach ($res as $row){
$slug = explode("/",$row->meta_value);
$slug = explode(".",$slug[3]);
$wpdb->query("UPDATE $wpdb->posts SET post_name ='" . $slug[0] . "' WHERE ID = $row->post_id");
$wpdb->print_error();
}
echo "DONE";
