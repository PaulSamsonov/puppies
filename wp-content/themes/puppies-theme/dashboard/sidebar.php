<div id="secondary">
  <div class="sidebar-main">
    <div class="navigation">
      <div class="desktop-nav">
        <div class="toplinks">
          <p>Logged in as "<?php echo $user_login; ?>"</p>
        </div>
      </div>
      <ul>
        <li<?php echo (!isset($vars['type'])) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard'); ?>">Dashboard</a></li>
        <li>
          <div class="border">Parents</div>
          <ul>
            <li<?php echo ( $vars['type'] == 'parents' && $vars['action'] == 'new' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/new'); ?>">Add New</a></li>
            <li<?php echo ( $vars['type'] == 'parents' && (!$vars['action'] || $vars['action'] == 'edit') ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/parents'); ?>">View</a></li>
          </ul>
        </li>
        <li>
          <div class="border">Puppies</div>
          <ul>
            <li<?php echo ( $vars['type'] == 'puppies' && $vars['action'] == 'new' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/new'); ?>">Add New</a></li>
            <li<?php echo ( $vars['type'] == 'puppies' && $vars['action'] == 'approved' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/approved'); ?>">Approved</a></li>
            <li<?php echo ( $vars['type'] == 'puppies' && $vars['action'] == 'pending' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/pending'); ?>">Pending</a></li>
            <li<?php echo ( $vars['type'] == 'puppies' && $vars['action'] == 'sold' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/sold'); ?>">Sold</a></li>
            <li<?php echo ( $vars['type'] == 'puppies' && $vars['action'] == 'delivered' ) ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/delivered'); ?>">Delivered</a></li>
          </ul>
        </li>
        <!--li><a href="">Edit Profile</a></li-->
        <li><a href="<?php echo wp_logout_url(get_home_url(null, '/breeder-dashboard')); ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</div>