<?php
/*
Plugin Name: Informations Utilisateurs 
Plugin URI: 
Description: 
Version: 1.0
Author: 
Author URI: 
*/
 
//Now start placing your customization code below this line


class UserPlugin {
    public function __construct(){
        add_action( 'plugins_loaded', array( $this, 'check_if_user_logged_in' ) );
    }

    public function check_if_user_logged_in(){
        if ( is_user_logged_in() ){
            $user = wp_get_current_user();
            $user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );
            
            ?>

                <div id='user_id' value='<?= $user_id ?>' hidden></div>

            <?php

        }
    }
}

$UserPlugin = new UserPlugin();
?>