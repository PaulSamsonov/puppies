<h1>Manage Parents</h1>
<?php
    $args = array(
      'post_type'   => 'puppy_parents',
      'post_status' => array('publish', 'pending'),
      'author'    => get_current_user_id(),
      //'orderby'   => 'ID ',
      'posts_per_page' => -1
    );
    $products = new WP_Query( $args );
    if($products) {
?>
<div class="cards">
  <?php while ( $products->have_posts() ) : $products->the_post();?>
    <div class="card">
        <div class="card-content">
            <a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/edit/'.$post->ID); ?>">
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
                <table>
                    <tbody>
                    <tr>
                        <td>Breed:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_breed', true ); ?></td>
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
                        <td>OFA Certified:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_ofa_certified', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Registry:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_registry', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_dob', true ); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/edit/'.$post->ID); ?>" class="btn-edit">Edit Details</a>
                <div class="left">
                    <a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/media/'.$post->ID); ?>" class="btn-photos"><span class="icon photos"></span>Photos</a>
                </div>
                <div class="right">
                    <a class="modal-popup-link btn-retire" href="#popup-confirm" data-url="<?php echo get_home_url(null, '/breeder-dashboard/parents/delete/'.$post->ID); ?>">Retire</a>
                </div>
            </div>
        </div>
    </div>
  <?php endwhile; wp_reset_query(); ?>
</div>
<?php } ?>
