<?php 
  /**
   * Template Name: Book List
   */
?>
<?php get_header(); ?>
  <?php 
    $args = [
      'post_type' => 'product',
      'posts_par_page' => -1,
    ];

    $query = new WP_Query($args);
  ?>
  <div class="sct-product-wrapper">
    <?php 
      if($query->have_posts()):
        while($query->have_posts()):
          $query->the_post();
          $product_price = wc_get_product(get_the_ID());
          $thumbnail_img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
    ?>
      <div class="sct-single-product">
        <div class="sct-product-image" style="background-image:url(<?php echo esc_url($thumbnail_img[0]);?>)"></div>
        <h2><a href="<?php echo esc_url(get_the_permalink());?>"><?php echo esc_html(get_the_title()); ?></a></h2>
        <p><?php echo $product_price->get_price_html(); ?></p>
        <a class="view-more" href="<?php echo esc_url(get_the_permalink());?>"><?php echo _e('View More', 'sct'); ?></a>
      </div>
    <?php 
        wp_reset_postdata();
      endwhile;
    endif;
    ?>
  </div>
<?php get_footer(); ?>