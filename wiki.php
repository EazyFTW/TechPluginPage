<?php
$loop = new WP_Query( array(
    'post_type' => 'wiki',
    'posts_per_page' => -1,
    'orderby' => 'id',
    'order' => 'ASC'
  )
);
?>

<div class="wikiWrapper">
  <div class="wikiPage">
    <h3><?php the_title(); ?></h3>
    <hr class="line">

    <div class="wikiContent page-content">
      <?php the_content(); ?>
    </div>
  </div>
  <div class="wikiSidebar">
    <h4>Navigation</h4>

    <ul class="wikiNavigation">
      <?php
      $currentPageId = get_the_ID();
      while ( $loop->have_posts() ) : $loop->the_post();
        $navItemPageId = get_the_ID();

        if($currentPageId == $navItemPageId){
          echo '<li class="wikiNavItem wikiActiveNavItem"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        } else {
          echo '<li class="wikiNavItem"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        }

      endwhile; wp_reset_query();
      ?>
    </ul>
  </div>
</div>
