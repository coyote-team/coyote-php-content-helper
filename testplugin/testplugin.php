<?php
require 'TestDomModule.php';

/*
Plugin Name: DOM module test
Description: Testing DOM module
Version: 1.0
Author: job
License: MIT
*/


function test_plugin_run (): void {
	$contents = file_get_contents(path_join(plugin_dir_path(__FILE__), 'arngren_net.html'));
	$doc = new DOMDocument();

	libxml_use_internal_errors(true);
	$doc->loadHTML($contents);
	libxml_clear_errors();

	$images = $doc->getElementsByTagName('img');
	$amount = count($images);
	$count = 0;
	for ($i = 0; $i < $amount; $i++) {
		if($images[$i]->hasAttribute('src')){
			$count++;
		}
	}
	error_log("${count} src attributes found!");
	error_log("${amount} images found!");
}

add_action('init', 'test_plugin_run');