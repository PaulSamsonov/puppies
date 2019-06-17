<h1>Manage Parents</h1>
<?php
    $args = array(
      'post_type'   => 'product',
      'post_status' => 'published',
      'author'    => get_current_user_id(),
      'posts_per_page' => -1,
    );

    $products = new WP_Query( $args );
    while ( $products->have_posts() ) : $products->the_post();
?>
<div class="card">
    <a href="/breeders/parents/edit/43370">
        <div class="thumb">
            <img src="">
            <div class="title"><?php the_title(); ?></div>
        </div>
    </a>
    <div class="ad-info wide-col">
        <table>
            <tbody><tr>
                <td>Breed:</td>
                <td><span><?php echo get_post_meta( $post->ID, '_pdm_pet_breed', true ); ?></span></td>
            </tr>
            <tr>
                <td>Sex:</td>
                <td><span><?php echo get_post_meta( $post->ID, '_pdm_pet_gender', true ); ?></span></td>
            </tr>
            <tr>
                <td>Weight:</td>
                <td><span><?php echo get_post_meta( $post->ID, '_pdm_pet_wight', true ); ?></span></td>
            </tr>
            <tr>
                <td>OFA Certified:</td>
                <td><span></span></td>
            </tr>
            <tr>
                <td>Registry:</td>
                <td><span><?php echo get_post_meta( $post->ID, '_pdm_pet_registry', true ); ?></span></td>
            </tr>
            <tr>
                <td>Birthdate:</td>
                <td><span><?php echo get_post_meta( $post->ID, '_pdm_pet_dob', true ); ?></span></td>
            </tr>
            </tbody></table>
    </div>
    <div class="actions">
        <a href="/breeders/parents/edit/43370" class="control btn-edit">Edit Parent Details</a><br> <div class="left">
            <a href="/breeders/parents/images/43370" class="control btn-photos"><span class="icon photos"></span><span class="ps-only">Add</span> Photos</a>
        </div>
        <div class="right">
            <a href="javascript:void(0)" onclick="retireConfirmation(this);" data-retireurl="/breeders/parents/retire/43370" class="control btn-retire"><span class="icon retire"></span>Retire</a>
        </div>
    </div>
</div>
<?php endwhile; wp_reset_query(); ?>