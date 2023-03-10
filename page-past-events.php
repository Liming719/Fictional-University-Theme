<?php
  get_header();
  PageBanner([
    'title'=>'Past Events',
    'subtitle'=>'A recap of our past events.',
    'bg-image'=>get_theme_file_uri('images/ocean.jpg')
  ]);
  ?>
 
  <div class="container container--narrow page-section">
  <?php
  $today=date('Ymd');
  $PastEvents = new WP_Query([      
      'paged' => get_query_var('paged', 1), //get current page number, if there is no page number return mean that is default page - first page, so return 1. 
      'post_type'=>'event',
      'meta_key'=>'event_date',
      'orderby'=>'meta_value',
      'order'=>'ASC',
      'meta_query'=>[
          [
              'key'=>'event_date',
              'compare'=>'<',
              'value'=>$today,
              'type'=>'numeric'
          ]
      ]
  ]);
  while($PastEvents->have_posts()){
    $PastEvents->the_post();
    get_template_part('template-parts/content','event');
  }
  echo paginate_links(array(
    'total'=>$PastEvents->max_num_pages
  ));
  ?>
  </div>
  <?php
  get_footer();

?>