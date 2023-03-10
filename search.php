<?php
  get_header();
  PageBanner([
    'title'=>'Seach Results',
    'subtitle'=>'You Search For &ldquo;'. esc_html(get_search_query(false)) .'&ldquo;',
    'bg-image'=>get_theme_file_uri('images/ocean.jpg')
  ]);
  ?>
  
  <div class="container container--narrow page-section">
  <?php
  if(have_posts()){
    while(have_posts()){
        the_post();
        get_template_part('template-parts/content',get_post_type());
      }
      echo paginate_links();
  }
  else{
    ?>
    <h2 class="headline headline--small-plus">There is no results math. Pleasr try again.</h2>    
    <?php
    get_search_form();
  }  
  ?>
  </div>
  <?php
  get_footer();

?>