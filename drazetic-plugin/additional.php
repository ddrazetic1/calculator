<?php
include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');
//$options = get_option('second_field_name', 'default name' );
?>
<h3 class="greeting-text" >Welcome   <?php echo get_name(); ?></h3>