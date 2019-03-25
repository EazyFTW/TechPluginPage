<?php
$version = explode(" ", get_the_title())[0];
$title = substr(get_the_title(), strlen($version));

$tags = array("Version ".$version);

$terms = get_the_terms(get_the_ID(), "tags");

if(is_array($terms)){
  foreach($terms as $term){
    array_push($tags, $term->name);
  }
}

?>

<div class="update condensed">
  <h3 class="sideline"><?php echo $title; ?></h3>
  <ul class="tagline">
    <?php
    foreach($tags as $tag){
      echo "<li>".$tag."</li>\n";
    }
     ?>
  </ul>

  <?php the_content(); ?>

  <div class="postFooter">
    <?php echo "written by ".get_author_name()." on ".get_the_time();?>
  </div>
</div>
