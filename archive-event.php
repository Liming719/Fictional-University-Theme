<?php
  get_header();
  PageBanner([
    'title'=>'All Events',
    'subtitle'=>the_archive_description(),
    'bg-image'=>get_theme_file_uri('images/ocean.jpg')
  ]);
  ?>
  <!-- <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
        All Events
      </h1>
      <div class="page-banner__intro">
        <p><?php the_archive_description(); ?></p>
      </div>
    </div>
  </div> -->

  <div class="container container--narrow page-section">
  <?php
  while(have_posts()){
    the_post();
    get_template_part('template-parts/content','event');
  }
  echo paginate_links();
  ?>

  <hr>
  <P><a href="<?php echo site_url('/past-events') ?>">Here is Our Past Events！</a></P>


  </div>
  <?php
  get_footer();

?>