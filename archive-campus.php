<?php
  get_header();
  PageBanner([
    'title'=>'Our Campuses',
    'subtitle'=>'We have several campuses',
    'bg-image'=>get_theme_file_uri('images/ocean.jpg')
  ]);
  ?>
  <div class="container container--narrow page-section">
  <!-- <div class="acf-map">     -->
  <?php
  
  while(have_posts()){
    the_post();
    $mapLocation = get_field('map_location');
    ?>
      <!-- <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
        <h2><?php the_title() ?></h2>      
      </div> -->

      <div class="post-item">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p><?php echo $mapLocation['lat'] ?></p>
      <p><?php echo $mapLocation['lng'] ?></p>
      </div>
    <?php
  }
  echo paginate_links();
  ?>
  <!-- </div> -->
  </div>
  <?php
  get_footer();

?>