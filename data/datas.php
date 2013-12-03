<?php 
/**
 * NB : Previous datas.php was certainly exported with var_export($arg)
 * When $arg is an object, it produced things like an array with stdClass::__set_state(array(something=>value, [...] )) in it
 * stdClass is an internal class using by Php for converting object. Kind like Object class in Java or object in Python, but
 * it has no methods ...
 * Previously it causes me a Fatal Error : no __set_state in stdClass
 * Lots of phpdoc and stackoverflow and co later, I kick off stdClass::__set_state ...
 * 
 * I have also changed 'state' => '1' to 'publish' because it's clearer.
 * I have also changed  \' for ’ because I didn't succeed to manage it with str_replace or stripslashes, I don't know why.
 * 
 * @link  http://php.net/manual/fr/function.var-export.php
 */
$episodes = array (
  1 => 
  array(
     'alias' => 'hasard-ou-creation',
     'state' => 'publish',
     'category' => 'Paroles de vie',
     'pubdate' => '2010-10-04 00:00:00',
     'order' => '111',
     'tags' => 'Philosophie, Sciences / Technologies',
     'desc' => '',
     'h1' => 'Hasard ou Création?',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image1.jpg',
     'mp3' => 'here/themp3file2.mp3',
     'duree' => '15',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
  
  5 => 
  array(
     'alias' => 'la-brique-miampo',
     'state' => 'publish',
     'category' => 'Paroles de vie',
     'pubdate' => '2010-11-23 00:00:00',
     'order' => '103',
     'tags' => 'Humanitaire, Témoignage, Afrique',
     'desc' => '',
     'h1' => 'Quand un Africain relève l Afrique...',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image1.jpg',
     'mp3' => 'here/themp3file6.mp3',
     'duree' => '15',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
  
  7 => 
  array(
     'alias' => 'ces-crises-inevitables',
     'state' => 'publish',
     'category' => 'Réflexion Faite',
     'pubdate' => '2010-11-24 11:48:18',
     'order' => '155',
     'tags' => 'Psychologies / Relations, Société',
     'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sollicitudin fringilla cursus. Nam sit amet posuere tortor. Cum sociis natoque penatibus.',
     'h1' => 'Ces crises inévitables',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image2.jpg',
     'mp3' => 'here/themp3file8.mp3',
     'duree' => '4',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
  
  12 => 
  array(
     'alias' => 'otage-prison-temoignage',
     'state' => 'publish',
     'category' => 'Paroles de vie',
     'pubdate' => '2011-01-28 00:00:00',
     'order' => '75',
     'tags' => 'Témoignage, Sciences / Technologies',
     'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sollicitudin fringilla cursus. Nam sit amet posuere tortor. Cum sociis natoque penatibus.',
     'h1' => 'Un geôlier pris en otage',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image3.jpg',
     'mp3' => 'here/themp3file13.mp3',
     'duree' => '27',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
  
  14 => 
  array(
     'alias' => 'rosa-parks',
     'state' => 'publish',
     'category' => 'Réflexion Faite',
     'pubdate' => '2013-05-01 00:00:00',
     'order' => '16',
     'tags' => 'Histoire / Archéo',
     'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sollicitudin fringilla cursus. Nam sit amet posuere tortor. Cum sociis natoque penatibus.',
     'h1' => 'Rosa Parks: une voix contre la ségrégation raciale',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image3.jpg',
     'mp3' => 'here/themp3file15.mp3',
     'duree' => '16',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
  
  21 => 
  array(
     'alias' => 'comment-bien-viellir-13',
     'state' => 'publish',
     'category' => 'Paroles de vie',
     'pubdate' => '2010-12-08 15:23:28',
     'order' => '102',
     'tags' => 'Santé / Bien-être, Vieillesse, Psychologies / Relations, Hennezel',
     'desc' => '',
     'h1' => 'Comment bien vieillir? (1/3)',
     'h2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pulvinar quis orci ac auctor. Praesent nec quam eu.',
     'image' => 'http://www.platform5.vn/resources/image1.jpg',
     'mp3' => 'here/themp3file22.mp3',
     'duree' => '15',
     'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus id eros pellentesque, malesuada vehicula dolor blandit. Curabitur congue ipsum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum condimentum mauris sed massa molestie, vel imperdiet lacus pretium. Proin iaculis erat.</p>',
  ),
);
$data = serialize($episodes);
?>