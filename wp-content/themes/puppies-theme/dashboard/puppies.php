<h1><?php echo ucfirst($vars['action']); ?> Puppies</h1>
<?php
    switch( $vars['action'] ) {
      case 'approved':
        $status = 'publish';
        break;
      case 'pending':
        $status = 'pending';
        break;
      default:
        $status = 'publish';
    }
    $args = array(
      'post_type'   => 'product',
      'post_status' => $status,
      'author'      => get_current_user_id(),
      //'orderby'   => 'ID ',
      'posts_per_page' => -1
    );
    if($vars['action'] == 'approved' || $vars['action'] == 'sold') {
      $args['meta_query'] = array(
        array(
          'key' => '_stock_status',
          'value' => ($vars['action'] == 'approved') ? 'instock': 'outofstock',
        )
      );
    }
    $products = new WP_Query( $args );
    if($products->found_posts && $vars['action'] != 'delivered' && $vars['action'] != 'in-transit') {
?>
<div class="cards">
  <?php while ( $products->have_posts() ) { $products->the_post(); ?>
    <?php
        $breed = get_post_meta( $post->ID, 'pd_breed', true );
    ?>
    <div class="card">
        <div class="card-content">
            <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$post->ID); ?>">
                <div class="thumb">
                    <div class="title"><?php the_title(); ?></div>
                    <div class="img">
                        <?php
                            if(has_post_thumbnail()) {
                                the_post_thumbnail('dashboard-view');
                            } else {
                                echo '<img width="258" height="258" src="'.get_stylesheet_directory_uri().'/dashboard/default.png">';
                            }
                        ?>
                    </div>
                </div>
            </a>
            <div class="ad-info">
                <?php
                    $args = array(
                        'post_type' => 'puppy_parents',
                        'post_status' => 'publish',
                        'author'    => get_current_user_id(),
                        'meta_query' => array(
                            array(
                                'key' => 'pd_breed',
                                'value' => $breed,
                            )
                        ),
                        'posts_per_page' => 2
                    );
                    $parents = get_posts( $args );
                    if($parents) {
                ?>
                    <div class="parents-row">
                        <?php foreach ( $parents as $parent ) { ?>
                        <div class="parent-col">
                            <a title="Edit Parent" href="<?php echo get_home_url(null, '/breeder-dashboard/parents/edit/'.$parent->ID); ?>">
                              <?php
                                  if(has_post_thumbnail($parent->ID)) {
                                    echo get_the_post_thumbnail($parent->ID, 'dashboard-parent');
                                  } else {
                                    echo '<img src="'.get_stylesheet_directory_uri().'/dashboard/default.png">';
                                  }
                              ?>
                              <div class="name"><?php echo get_the_title($parent->ID); ?></div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <table>
                    <tbody>
                    <tr>
                        <td>Breed:</td>
                        <td><?php echo $breed; ?></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_gender', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Weight:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_wight', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Registry:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_registry', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_dob', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Your Asking Price:</td>
                        <td><?php echo get_woocommerce_currency_symbol() . get_post_meta( $post->ID, 'asking_price', true ); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$post->ID); ?>" class="btn-edit">Edit Details</a>
                <div class="left">
                    <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/media/'.$post->ID); ?>" class="btn-photos"><span class="icon photos"></span>Photos</a>
                    <?php
                      if( $vars['action'] == 'approved' || $vars['action'] == 'sold') {
                        $status = get_post_meta( $post->ID, '_stock_status', true );
                    ?>
                    <a href="" data-pid="<?php echo $post->ID; ?>" data-tostatus="<?php echo ($status == 'instock') ? 'outofstock' : 'instock'; ?>" class="btn-mark-sold"><span class="icon check"></span>Mark Puppy<?php echo ($status == 'instock') ? ' Sold' : ' Unsold'; ?></a>
                    <?php } ?>
                </div>
                <div class="right">
                    <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/media/'.$post->ID); ?>#section-video" class="btn-videos"><span class="icon videos"></span>Videos</a>
                    <a class="modal-popup-link btn-delete" href="#popup-confirm" data-url="<?php echo get_home_url(null, '/breeder-dashboard/puppies/delete/'.$post->ID.'?redirect='.$vars['action']); ?>">Delete</a>
                </div>
                <a class="view-link" href="<?php echo get_permalink($post->ID); ?>" target="_blank">View on site</a>
            </div>
        </div>
    </div>
  <?php } wp_reset_query(); ?>
</div>
<?php } else { ?>
<p>There are no puppies</p>
<?php } ?>
