<?php
$loop = new WP_Query( array(
    'post_type' => 'wiki',
    'posts_per_page' => -1,
    'orderby' => 'id',
    'order' => 'ASC',
  )
);
?>

<?php

/*

This Template only shows the very first Wiki Page as a single.php.
That way the full layout will be controlled in the single.php

*/

$hasPost = true;
while ( $loop->have_posts() && $hasPost ) : $loop->the_post();
  require("single-wiki.php");
  $hasPost = false;
endwhile;

wp_reset_query();

?>
