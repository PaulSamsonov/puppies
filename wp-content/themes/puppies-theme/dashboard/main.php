<div class="row">
  <div class="col col-20">
    <a class="tile approved" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/pending'); ?>">
      <?php
          $args = array(
            'post_type'   => 'product',
            'post_status' => 'pending',
            'author'      => get_current_user_id(),
            'posts_per_page' => -1,
            'fields' => 'ids'
          );
          $products = new WP_Query( $args );
          wp_reset_query();
      ?>
      <div>
        <?php echo $products->found_posts; ?><span>Pending Approval</span>
      </div>
    </a>
  </div>
  <div class="col col-20">
    <a class="tile" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/approved'); ?>">
      <?php
          $args = array(
            'post_type'   => 'product',
            'post_status' => 'publish',
            'author'      => get_current_user_id(),
            'meta_query'  => array(
              array(
                'key' => '_stock_status',
                'value' => 'instock',
              )
            ),
            'posts_per_page' => -1,
            'fields' => 'ids'
          );
          $products = new WP_Query( $args );
          wp_reset_query();
      ?>
      <div>
        <?php echo $products->found_posts; ?><span>Approved</span>
      </div>
    </a>
  </div>
  <div class="col col-20">
    <a class="tile" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/sold'); ?>">
      <?php
          $args = array(
            'post_type'   => 'product',
            'post_status' => 'publish',
            'author'      => get_current_user_id(),
            'meta_query'  => array(
              array(
                'key' => '_stock_status',
                'value' => 'outofstock',
              )
            ),
            'posts_per_page' => -1,
            'fields' => 'ids'
          );
          $products = new WP_Query( $args );
          wp_reset_query();
      ?>
      <div>
        <?php echo $products->found_posts; ?><span>Sold</span>
      </div>
    </a>
  </div>
    <div class="col col-20">
        <a class="tile" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/in-transit'); ?>">
            <div>
                0<span>In Transit</span>
            </div>
        </a>
    </div>
  <div class="col col-20">
    <a class="tile" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/delivered'); ?>">
      <div>0<span>Delivered</span></div>
    </a>
  </div>
</div>
<div class="row">
  <div class="col">
    <h2 class="th">Most Viewed Puppies</h2>
    <table class="table-main">
      <tbody class="table-striped">
      <tr>

      </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col">
    <h2 class="th">Recently Approved</h2>
    <?php
        $args = array(
          'post_type'   => 'product',
          'post_status' => 'publish',
          'author'      => get_current_user_id(),
          'posts_per_page' => 5,
        );
        $products = new WP_Query( $args );
    ?>
    <table class="table-main">
      <tbody>
      <?php if($products) { while ( $products->have_posts() ) { $products->the_post(); ?>
          <tr>
            <td>
              <a title="Edit Puppy" href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$post->ID); ?>">
                <?php
                    if(has_post_thumbnail()) {
                      the_post_thumbnail('dashboard-main');
                    } else {
                      echo '<img width="36" height="36" src="'.get_stylesheet_directory_uri().'/dashboard/default.png">';
                    }
                ?>
                <span><?php the_title(); ?></span>
              </a>
            </td>
            <td><?php echo $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') ); ?> ago</td>
          </tr>
      <?php } wp_reset_query(); } ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
    <div class="col">
        <h2 class="th">Upcoming Due Dates</h2>
        <table class="table-main">
            <thead>
            <tr>

            </tr>
            </tbody>
        </table>
    </div>
</div>