<?php
$copyMode = isset($_GET['copyMode']);
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

<div class="update condensed page-content">
  <h3 class="sideline"><a href="<?php echo get_post_permalink(); ?>"><?php echo $title; ?></a></h3>
  <ul class="tagline">
    <?php
    foreach($tags as $tag){
      echo "<li>".$tag."</li>\n";
    }
     ?>
  </ul>

  <?php echo get_the_content(); ?>

  <?php
  if(!$copyMode){
    echo '<div class="postFooter">';
    echo "written by ".get_author_name()." on ".get_the_time();
    echo '</div>';
  }
  ?>
</div>
