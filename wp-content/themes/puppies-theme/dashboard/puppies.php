<h1>Manage Puppies</h1>
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
            <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$post->ID); ?>">
                <div class="thumb">
                    <div class="img">
                        <?php the_post_thumbnail('dashboard-view'); ?>
                    </div>
                    <div class="title"><?php the_title(); ?></div>
                </div>
            </a>
            <div class="ad-info wide-col">
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
                        <td>Registry:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_registry', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td><?php echo get_post_meta( $post->ID, 'pd_dob', true ); ?></td>
                    </tr>
                    <tr>
                        <td>Your Asking Price:</td>
                        <td><?php echo get_post_meta( $post->ID, 'asking_price', true ); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="<?php echo get_home_url(null, '/breeder-dashboard/puppies/edit/'.$post->ID); ?>" class="btn-edit">Edit Details</a><br>
                <div class="right">
                    <a href="" onclick="retireConfirmation(event, this);" data-retireurl="<?php echo get_home_url(null, '/breeder-dashboard/puppies/delete/'.$post->ID); ?>" class="btn-delete">Delete</a>
                </div>
            </div>
        </div>
    </div>
  <?php endwhile; wp_reset_query(); ?>
</div>
<?php } ?>

<div class="modal-popup" id="popup-retire">
    <div class="modal-popup-content">
        <h4 class="modal-popup-title">Are you sure?</h4>
        <div class="modal-popup-footer">
            <button type="button" class="retire">Yes</button>
            <button type="button" class="close">No</button>
        </div>
    </div>
</div>
