<?php get_header(); ?>

  <main role="main">
    <?php
    while ( have_posts() ) {
      the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
    <?php } ?>
  </main>

<?php get_footer(); ?>
