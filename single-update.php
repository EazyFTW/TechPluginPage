<?php

get_header();
the_post();
include("update.php");

?>

<script>
  <?php $updatesPage = get_page_by_title("Updates"); ?>
  targetPageItems = document.getElementsByClassName("page-item-<?php echo $updatesPage->ID; ?>");

  if(targetPageItems.length != 0){
    targetPageItems[0].classList.add("current_page_item");
  }
</script>

<?php get_footer(); ?>
