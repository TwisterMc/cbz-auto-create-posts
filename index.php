<?php
/*
Plugin Name: CBZ Auto Create Posts
Plugin URI: https://github.com/TwisterMc/cat-bacon-zombie-wp
Description: Automatically creates WordPress posts with either cat, bacon or zombie lorem ipsum.
Version: The Plugin's Version Number: 0.2
Author: Thomas McMahon
Author URI: http://www.twistermc.com
License: GPL2
*/

/* Admin Magic */
add_action('admin_menu', 'autopost_add_pages');

function autopost_add_pages() {
    if (function_exists('add_submenu_page'))
        add_submenu_page('tools.php', __('CBZ Auto Create Posts'), __('CBZ Auto Create Posts'), 1, __FILE__, 'autopost_options_subpanel');
}

function autopost_options_subpanel() { 
    /* Make Posts. Cook Bacon. Pet Cats */
    if ($_POST['cbz_autopost_type']) {
    include (plugin_dir_path(__FILE__).'ipsum.php');
    
        $cbz_ipsumType = $_POST['cbz_autopost_type'];
        $cbz_maxPosts = $_POST['cbz_autopost_number'];
        // Setup the author, slug, and title for the post
    	$cbz_author_id = 1;
    	$cbz_slug = $cbz_ipsumType.'-post';
    	$cbz_title = 'Super '.$cbz_ipsumType.' Post';
    	// Get the content
    	if ($cbz_ipsumType == 'Cat') {
    	   $cbz_content = $cbz_cat_text;
    	} else if ($cbz_ipsumType == 'Bacon') {
    	   $cbz_content = $cbz_bacon_text;
        } else if ($cbz_ipsumType == 'Zombie') {
            $cbz_content = $cbz_zombie_text;
        }
        
        for ($cbz_i=1; $cbz_i<=$cbz_maxPosts; $cbz_i++) {
            $cbz_newPosts = array(
        		'comment_status'	=>	'closed',
        		'ping_status'		=>	'closed',
        		'post_author'		=>	$cbz_author_id,
        		'post_name'		=>	$cbz_slug,
        		'post_title'		=>	$cbz_title,
        		'post_status'		=>	'publish',
        		'post_type'		=>	'post',
        		'post_content' => $cbz_content
    		);
    		wp_insert_post( $cbz_newPosts );
        }
        $cbz_success = 1;
    }
?>

<link rel='stylesheet' href='<?php echo plugins_url('css/style.css',__FILE__); ?>' type='text/css' media='all' />

<div class="wrap cbz_wrap">
    <h2>Cat, Bacon &amp; Zombie Lorem Ipsum - Auto Create Posts</h2>
    <div class="cbz_logo"><img src="<?php echo plugins_url('images/logo.jpg',__FILE__); ?>" /></div>
    <?php if ($cbz_success) {
        echo '<div class="updated"><p><strong>Success! Your '.$cbz_maxPosts.' '.$cbz_ipsumType.' Posts have been created!</strong></p></div>';
    } ?>
    <form method="post" action="" name="cbz_autopost_awesome">      
        <div>
            <h3>What flavor of lorem ipsum would you like?</h3>
            <label for="Cat"><input type="radio" id="Cat" name="cbz_autopost_type" value="Cat" checked="checked" /> Cat</label>
            <label for="Bacon"><input type="radio" id="Bacon" name="cbz_autopost_type" value="Bacon" /> Bacon</label>
            <label for="Zombie"><input type="radio" id="Zombie" name="cbz_autopost_type" value="Zombie" /> Zombie</label>
        </div>
        <div>
            <h3>How many posts?</h3>
            <input type="number" name="cbz_autopost_number" value="5" class="code" />
        </div>
        <div>
            <input type="submit" value="Create Posts Now &raquo;" name="Submit" class="button button-primary" />
        </div>
    </form>
    
    <h3>Thanks to these folks for the fine lorem ipsum.</h3>
    <ul>
        <li><a href="http://www.catipsum.com/" target="_blank">Cat Ipsum | A Furrier Alternative to Lorem Ipsum</a></li>
        <li><a href="http://baconipsum.com/" target="_blank">Bacon Ipsum | A Meatier Lorem Ipsum Generator</a></li>
        <li><a href="http://www.zombieipsum.com/" target="_blank">Zombie Ipsum: Frightful Filler for Your Damned Designs</a></li>
    </ul>
    
    <div class="cbz_author">Created by <a href="http://www.twistermc.com/" target="_blank">TwisterMc</a></div>
</div>

<?php } ?>