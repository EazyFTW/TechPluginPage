<?php get_header(); ?>

<?php
$loop = new WP_Query( array(
    'post_type' => 'update',
    'posts_per_page' => -1
  )
);
?>

<div class="entry-content">

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <div class="update condensed">
    <h3 class="sideline"><?php the_title(); ?></h3>
    <ul class="tagline">
      <?php
      $terms = get_the_terms(get_the_ID(), "tags");
      foreach($terms as $term){
        echo "<li>".$term->name."</li>\n";
      }
       ?>
    </ul>

    <?php the_content(); ?>

    <div class="postFooter">
      <?php echo "written by ".get_author_name()." on ".get_the_time();?>
    </div>
  </div>
<?php endwhile; wp_reset_query(); ?>

</div>

<?php get_footer(); ?>
