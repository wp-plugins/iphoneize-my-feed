<?php
/*
Plugin Name: Iphoneize my feed
Plugin URI: http://basicblogger.de/2008/11/22/wp-plugin-iphoneize-my-feed-07/
Description: Iphonize deinen Feed
Version: 0.7
Author: Ahmet Topal
Author URI: http://www.basicblogger.de
*/
$imf_meta_field = get_option('imf_meta_field');

if ('insert' == $HTTP_POST_VARS['action'])
{
    update_option("imf_meta_field",$HTTP_POST_VARS['imf_meta_field']);
}

// Innerhalb von the_loop reicht das
function imf_meta_description() {
  global $id, $post_meta_cache, $imf_meta_field; // globale Variablen

  if ( $keys = get_post_custom_keys() ) {
    foreach ( $keys as $key ) {
      $values = array_map('trim', get_post_custom_values($key));
      $value = implode($values,', ');
      if ( $key == $imf_meta_field ) {
        echo "$value";
      }
    }
  }
} // Ende Funktion imf_meta_description()

function imf_meta_description_option_page() {
?>

<!-- Start Optionen im Admin -->
  <div class="wrap">
    <h2>Iphonize my Feed</h2>
<form action="http://www.Intersquash.com/index.php" method="post" target="target1">
	<p class="input">
		<label for="url" class="url">RSS Feed URL</label>
                <input type="text" name="url" value="<?php bloginfo('rss2_url'); ?>" id="url" />
		</p><p class="input">	
		<label for="title" class="title">Titel of the Blog:</label>
		<input type="text" name="title" value="<?php bloginfo('name'); ?>" id="title" />
		</p>			
		<p><input type="submit" id="iphoneize" name="submit" value="Give me my Link" /></p>
<p><h3 id="premium"><a href="http://www.Intersquash.com/premiuminfo.php">Go Premium</a></h3></p>			
		</form><br />
<form name="form1" method="post" action="<?=$location ?>">
	<label for="Link" class="Link">Paste here Link URL:</label>
      <input name="imf_meta_field" value="<?=get_option("imf_meta_field");?>" type="text" />
      <input type="submit" value="Save" />
      <input name="action" value="insert" type="hidden" />
    </form><br />
<iframe width="500" height="200" src="http://basicblogger.de/2008/11/12/wp-plugin-iphoneize-my-feed/" name="target1"></iframe>
  </div>

<?php
} // Ende Funktion imf_meta_description_option_page()

// Adminmenu Optionen erweitert
function imf_meta_description_add_menu() {
  add_option("imf_meta_field","description"); // optionsfield in Tabelle TABLEPRÄFIX_options
  add_options_page('Iphonize Feed-Plugin', 'Iphonize Feed', 9, __FILE__, 'imf_meta_description_option_page'); //optionenseite hinzufügen
}

//Change LINK with the Link given
function imf_head_add() {
$imf_meta_field = get_option('imf_meta_field');
	echo "<script type=\"text/javascript\">
		<!-- 
// Intersquash.com - iPhoneize your website.
// Just insert this between the <head> tags of your website.
var agent = navigator.userAgent.toLowerCase();
var iphone = ((agent.indexOf('\iphone\'))!=-1);
if (iphone) { 
window.location = \"$imf_meta_field\";

}
//-->
	</script>
	";
}

// Registrieren des WordPress-Hooks
add_action('admin_menu', 'imf_meta_description_add_menu');
add_action('wp_head', 'imf_head_add');
?> 