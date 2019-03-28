<?php

get_header();

$loop = new WP_Query( array(
    'post_type' => 'wiki',
    'posts_per_page' => -1,
    'orderby' => 'id',
    'order' => 'ASC',
  )
);

$hasPost = true;
while ( $loop->have_posts() && $hasPost ) : $loop->the_post();
  include("wiki.php");
  $hasPost = false;
endwhile;

wp_reset_query();


get_footer();

?>
