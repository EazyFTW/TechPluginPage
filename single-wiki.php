<?php

get_header();

the_post();
include("wiki.php");

?>

<script>
  <?php $wikiPage = get_page_by_title("Wiki"); ?>
  targetPageItems = document.getElementsByClassName("page-item-<?php echo $wikiPage->ID; ?>");

  if(targetPageItems.length != 0){
    targetPageItems[0].classList.add("current_page_item");
  }
</script>

<?php get_footer(); ?>
