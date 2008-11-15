<?php
/*
Plugin Name: Iphoneize my feed
Plugin URI: http://basicblogger.de
Description: Iphonize deinen Feed
Version: 0.3
Author: Ahmet Topal
Author URI: http://www.basicblogger.de
*/
//Change LINK with the Link given
function imf_head_add() {
	echo "<script type=\"text/javascript\">
		<!-- 
// Intersquash.com - iPhoneize your website.
// Just insert this between the <head> tags of your website.
var agent = navigator.userAgent.toLowerCase();
var iphone = ((agent.indexOf('\iphone\'))!=-1);
if (iphone) { 
window.location = \"LINK\";
}
//-->
	</script>
	";
}

function imf_meta_description_option_page() {
?>

<!-- Start Optionen im Admin -->
  <div class="wrap">
    <h2>Iphonize my Feed</h2>
<form action="http://Intersquash.com/index.php" method="post" target="_blank">
	<p class="input">
		<label for="url" class="url">RSS Feed Url:</label>
		<input type="text" name="url" value="<?php bloginfo('rss2_url'); ?>" id="url" />
		</p><p class="input">	
		<label for="title" class="title">Titel of the Blog:</label>
		<input type="text" name="title" value="<?php bloginfo('name'); ?>" id="title" />
		</p>			
		<p><input type="submit" id="iphoneize" name="submit" value="Give me my Link" /></p>			
		</form>
  </div>

<?php
} // Ende Funktion imf_meta_description_option_page()

// Adminmenu Optionen erweitert
function imf_meta_description_add_menu() {
  add_options_page('Iphonize Feed-Plugin', 'Iphonize Feed', 9, __FILE__, 'imf_meta_description_option_page'); //optionenseite hinzufügen
}

// Registrieren des WordPress-Hooks
add_action('admin_menu', 'imf_meta_description_add_menu');
add_action('wp_head', 'imf_head_add');
?> 