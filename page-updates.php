<?php get_header(); ?>

<?php
$loop = new WP_Query( array(
    'post_type' => 'update',
    'posts_per_page' => -1
  )
);
?>

<div class="entry-content">

<?php
while ( $loop->have_posts() ) : $loop->the_post();

include("update.php");

endwhile; wp_reset_query();
?>

</div>

<?php get_footer(); ?>
