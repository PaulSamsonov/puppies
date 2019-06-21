<h1>Manage Parents</h1>
<?php
    $args = array(
      'post_type'   => 'product',
      'post_status' => array('publish', 'pending'),
      'author'    => get_current_user_id(),
      //'orderby'   => 'ID ',
      'posts_per_page' => -1
    );

    $products = new WP_Query( $args );
    while ( $products->have_posts() ) : $products->the_post();
?>
<div class="card">
    <a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/edit/'.$post->ID); ?>">
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
                <td><?php echo get_post_meta( $post->ID, '_pdm_pet_breed', true ); ?></td>
            </tr>
            <tr>
                <td>Sex:</td>
                <td><?php echo get_post_meta( $post->ID, '_pdm_pet_gender', true ); ?></td>
            </tr>
            <tr>
                <td>Weight:</td>
                <td><?php echo get_post_meta( $post->ID, '_pdm_pet_wight', true ); ?></td>
            </tr>
            <tr>
                <td>OFA Certified:</td>
                <td><?php echo get_post_meta( $post->ID, 'pdm_pet_ofa_certified', true ); ?></td>
            </tr>
            <tr>
                <td>Registry:</td>
                <td><?php echo get_post_meta( $post->ID, '_pdm_pet_registry', true ); ?></td>
            </tr>
            <tr>
                <td>Birthdate:</td>
                <td><?php echo get_post_meta( $post->ID, '_pdm_pet_dob', true ); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="actions">
        <a href="<?php echo get_home_url(null, '/breeder-dashboard/parents/edit/'.$post->ID); ?>" class="btn-edit">Edit Details</a><br>
        <div class="right">
            <a href="" onclick="retireConfirmation(event, this);" data-retireurl="<?php echo get_home_url(null, '/breeder-dashboard/parents/delete/'.$post->ID); ?>" class="btn-retire">Retire</a>
        </div>
    </div>
</div>
<?php endwhile; wp_reset_query(); ?>

<div class="modal-popup" id="popup-retire">
    <div class="modal-popup-content">
        <h5 class="modal-popup-title">Are you sure?</h5>
        <div class="modal-popup-footer">
            <a href="" class="retire">Yes</a>
            <a href="" class="close">No</a>
        </div>
    </div>
</div>
