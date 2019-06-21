<?php
  /**
   * Template Name: Breeder Dashboard
   */

get_header(); ?>

<?php if ( is_user_logged_in() ) { ?>
  
    <?php
        $vars = get_query_var('dashboard_variables');
        include('dashboard/sidebar.php');
    ?>

    <div id="primary" <?php astra_primary_class(); ?>>
        <?php
            //print_r($wp_query->query);
            include($vars['template']);
        ?>
    </div>

<?php } else { ?>

<div id="primary" <?php astra_primary_class(); ?>>

    <form name="loginform" id="loginform" action="<?php echo get_home_url(null, '/wp-login.php'); ?>" method="post">

        <p class="login-username">
            <label for="user_login">Username</label>
            <input type="text" name="log" id="user_login" class="input" value="" size="20">
        </p>
        <p class="login-password">
            <label for="user_pass">Password</label>
            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20">
        </p>

        <p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" checked="checked"> Remember Me</label></p>
        <p class="login-submit">
            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">
            <input type="hidden" name="redirect_to" value="<?php echo get_home_url(null, '/breeder-dashboard'); ?>">
            OR <a class="button button-register" href="<?php echo get_home_url(null, '/breeder-register'); ?>">Register</a>
        </p>
        <p>
            <a href="<?php echo wp_lostpassword_url(); ?>">forgot password?</a>
        </p>

    </form>

</div>

<?php } ?>

<?php get_footer(); ?>
