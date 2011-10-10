<?php
/*
Plugin Name: Shortcode Plugin Download Counter 
Version: 1.0
Description: Makes it easy to display a plugin download counter on your posts or pages by using shortcodes 
Author: soundwaves-productions
Plugin URI: http://www.soundwaves-productions.com/soundwavesblog/wordpress-plugins/shortcode-plugin-download-counter/
*/
function PluginDownloadCounterShortcode_call( $atts ) {
	extract(shortcode_atts(array(  
	   	"pluginname" 		=> '',  
			"regexp" 		=> '/<strong>Downloads:<\/strong>(.*?)<br \/>/'
			), $atts));
				$c = curl_init();
       curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, "http://wordpress.org/extend/plugins/".$pluginname."/");
        $contents = curl_exec($c);
				 curl_close($c);
        if ($contents) {
							  $pattern = $regexp;
    						if(	preg_match($pattern, $contents, $matches) ) {
									return trim($matches[1]);
								} else {
									return 0;
								}
				} else { return 0; }
}
add_shortcode( 'PluginDownloadCounter', 'PluginDownloadCounterShortcode_call' );
