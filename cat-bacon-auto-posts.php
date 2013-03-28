<?php
/*
Plugin Name: Cat Bacon Zombie Auto Posts
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Automatically creates WordPress posts with either cat, bacon or zombie lorem ipsum.
Version: The Plugin's Version Number: 0.1
Author: Thomas McMahon
Author URI: http://www.twistermc.com
License: A "Slug" license name e.g. GPL2
*/

/* Admin Magic */
add_action('admin_menu', 'autopost_add_pages');

function autopost_add_pages() {
    if (function_exists('add_submenu_page'))
        add_submenu_page('tools.php', __('Auto Create Posts'), __('Auto Create Posts'), 1, __FILE__, 'autopost_options_subpanel');
}

function autopost_options_subpanel() { 
    /* Make Posts. Cook Bacon. Pet Cats */
    if ($_POST['autopost_type']) {
        $ipsumType = $_POST['autopost_type'];
        $maxPosts = $_POST['autopost_number'];
        // Setup the author, slug, and title for the post
    	$author_id = 1;
    	$slug = $ipsumType.'-post';
    	$title = 'Super '.$ipsumType.' Post';
    	
    	if ($ipsumType == 'Cat') {
    	   $content = "Give attitude stand in front of the computer screen. Rub face on everything make muffins, intently stare at the same spot so chew iPad power cord for mark territory. Need to chase tail chew foot. Why must they do that missing until dinner time under the bed for make muffins sleep on keyboard but mark territory. Stand in front of the computer screen leave dead animals as gifts. Behind the couch nap all day destroy couch so throwup on your pillow.
    	
    	Behind the couch lick butt swat at dog destroy couch flop over. Hide when guests come over climb leg yet chew iPad power cord so hunt anything that moves or missing until dinner time, need to chase tail, flop over. Cat snacks hunt anything that moves or swat at dog. Use lap as chair. Need to chase tail hate dog intently sniff hand chew foot. Play time give attitude and find something else more interesting so nap all day for nap all day and mark territory.
    	
    	Hide when guests come over hide when guests come over but hate dog, for hopped up on goofballs mark territory for why must they do that so leave dead animals as gifts. Stand in front of the computer screen flop over, or attack feet leave hair everywhere. Destroy couch intrigued by the shower destroy couch so inspect anything brought into the house but rub face on everything so sweet beast why must they do that. Missing until dinner time play time for mark territory.";
    	} else if ($ipsumType == 'Bacon') {
    	   $content = "Bacon ipsum dolor sit amet boudin spare ribs tenderloin capicola sausage, t-bone hamburger. Capicola tail shank pork belly, beef ham hock bresaola jowl short loin cow salami pork loin. Kielbasa salami t-bone, boudin rump chicken jerky ball tip venison. Chicken ground round ham hock brisket pork loin chuck. Meatloaf beef ribs pancetta ribeye shank drumstick salami pork chop pork pig prosciutto kielbasa. Leberkas chuck hamburger, tri-tip meatloaf ham andouille ground round pork belly chicken doner biltong.

Boudin turkey swine short ribs ball tip spare ribs pork ham pastrami bacon shank meatloaf. Venison boudin frankfurter salami ribeye pork pig jowl biltong cow beef ribs. Swine spare ribs biltong brisket turkey pork loin, flank venison kielbasa drumstick. Spare ribs tail pork belly, tongue shank t-bone kielbasa pork bresaola rump. Pork chop corned beef ribeye, bresaola brisket meatloaf frankfurter drumstick bacon beef sausage swine hamburger shankle pork. Venison ham hock shoulder, shank ball tip beef ribs hamburger rump meatloaf t-bone meatball short ribs prosciutto boudin.

Jowl biltong meatloaf, fatback beef chicken frankfurter sirloin chuck. Venison pork chop pancetta sausage. Tri-tip rump shoulder, corned beef shank prosciutto short loin salami boudin flank jerky capicola fatback ground round. Chicken sirloin pork venison bresaola salami, leberkas prosciutto pork loin sausage cow beef. Fatback ground round beef tenderloin ribeye sausage pork shankle rump chuck. Chicken flank sirloin boudin prosciutto ribeye rump pork biltong.";
        } else if ($ipsumType == 'Zombie') {
            $content = 'Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max brucks terribilem incessu zomby. The voodoo sacerdos flesh eater, suscitat mortuos comedere carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro. Nescio brains an Undead zombies. Sicut malus putrid voodoo horror. Nigh tofth eliv ingdead.

Cum horribilem walking dead resurgere de crazed sepulcris creaturis, zombie sicut de grave feeding iride et serpens. Pestilentia, shaun ofthe dead scythe animated corpses ipsa screams. Pestilentia est plague haec decaying ambulabat mortuos. Sicut zeder apathetic malus voodoo. Aenean a dolor plan et terror soulless vulnerum contagium accedunt, mortui iam vivam unlife. Qui tardius moveri, brid eof reanimator sed in magna copia sint terribiles undeath legionis. Alii missing oculis aliorum sicut serpere crabs nostram. Putridi braindead odores kill and infect, aere implent left four dead.

Lucio fulci tremor est dark vivos magna. Expansis creepy arm yof darkness ulnis witchcraft missing carnem armis Kirkman Moore and Adlard caeruleum in locis. Romero morbo Congress amarus in auras. Nihil horum sagittis tincidunt, zombie slack-jawed gelida survival portenta. The unleashed virus est, et iam zombie mortui ambulabunt super terram. Souless mortuum glassy-eyed oculos attonitos indifferent back zom bieapoc alypse. An hoc dead snow braaaiiiins sociopathic incipere Clairvius Narcisse, an ante? Is bello mundi z?';
        }
        
        for ($i=1; $i<=$maxPosts; $i++) {
            $newPosts = array(
        		'comment_status'	=>	'closed',
        		'ping_status'		=>	'closed',
        		'post_author'		=>	$author_id,
        		'post_name'		=>	$slug,
        		'post_title'		=>	$title,
        		'post_status'		=>	'publish',
        		'post_type'		=>	'post',
        		'post_content' => $content
    		);
    		wp_insert_post( $newPosts );
        }
        echo '<div class="success"> Success! Your '.$maxPosts.' '.$ipsumType.' Posts have been created!</div>';
    }
?>

<style type="text/css">
    label { margin-right: 20px; }
    form { margin-bottom: 20px; }
    .success {
        margin-top: 10px;
        padding: 5px;
        background-color: #daf5dc; 
    }
</style>

<h2>Cat, Bacon &amp; Zombie Lorem Ipsum - Auto Create Post</h2>
<form method="post" action="" name="autopost_awesome">      
    <div>
        <h3>What flavor of lorem ipsum would you like?</h3>
        <label for="Cat"><input type="radio" id="Cat" name="autopost_type" value="Cat" checked="checked" /> Cat</label>
        <label for="Bacon"><input type="radio" id="Bacon" name="autopost_type" value="Bacon" /> Bacon</label>
        <label for="Zombie"><input type="radio" id="Zombie" name="autopost_type" value="Zombie" /> Zombie</label>
    </div>
    <div>
        <h3>How many posts?</h3>
        <input type="number" name="autopost_number" value="5" />
    </div>
    <div>
        <input type="submit" value="Create Posts Now &raquo;" name="Submit" />
    </div>
</form>

<h3>Thanks to these folks for the fine lorem ipsum.</h3>
<ul>
    <li><a href="http://baconipsum.com/" target="_blank">Bacon Ipsum | A Meatier Lorem Ipsum Generator</a></li>
    <li><a href="http://www.catipsum.com/" target="_blank">Cat Ipsum | A Furrier Alternative to Lorem Ipsum</a></li>
    <li><a href="http://www.zombieipsum.com/" target="_blank">Zombie Ipsum: Frightful Filler for Your Damned Designs</a></li>
</ul>

<h3>Created by <a href="http://www.twistermc.com/" target="_blank">TwisterMc</a></h3>

<?php } ?>