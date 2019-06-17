<div id="secondary">
  <div class="sidebar-main">
    <div class="navigation">
      <div class="desktop-nav">
        <div class="toplinks">
          <p>Logged in as "<?php echo $user_login; ?>"</p>
        </div>
      </div>
      <ul>
        <li<?php echo ($path == '') ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard'); ?>">Dashboard</a></li>
        <li><div class="border">Parents</div>
          <ul>
            <li<?php echo ($path == 'parents-new') ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/new'); ?>">Add New</a></li>
            <li<?php echo ($path == 'parents') ? ' class="active"' : ''; ?>><a href="<?php echo get_home_url(null, '/breeder-dashboard/parents'); ?>">View</a></li>
          </ul>
        </li>
        <li><div class="border">Puppies</div>
          <ul>
            <li><a href="">Add New</a></li>
            <li><a href="">Approved</a></li>
            <li><a href="">Pending</a></li>
            <li><a href="">Sold</a></li>
            <li><a href="">Delivered</a></li>
          </ul>
        </li>
        <!--li><a href="">Edit Profile</a></li-->
        <li><a href="<?php echo wp_logout_url(get_home_url(null, '/breeder-dashboard')); ?>">Logout</a></li>
      </ul>
    </div>
  </div>
</div>