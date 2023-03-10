<?php
  get_header();
  PageBanner([
    'title'=>get_the_archive_title(),
    'subtitle'=>get_the_archive_description(),
    'bg-image'=>get_theme_file_uri('images/ocean.jpg')
  ]);
  ?>
  <div class="container container--narrow page-section">
  <?php
  
  while(have_posts()){
    the_post();
    ?>
    <div class="post-item">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
      <div class="meta-box">
        <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('Y-m-d H:i'); ?> in <?php echo get_the_category_list(', '); ?></p>
      </div>

      <div class="generic-content">
        <p>      
        <?php
        if(has_excerpt()){
            the_excerpt();
        }
        else{
            echo wp_trim_words(get_the_content(),50);
        }  
        ?>
        </p>
        <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Read Full Content.</a></p>
      </div>


    </div>
    <?php
  }
  echo paginate_links();
  ?>
  </div>
  <?php
  get_footer();

?>