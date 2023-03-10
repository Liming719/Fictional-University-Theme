<?php
    get_header();
    /*
    // while(have_posts())
    // {
    //  the_post();
    //  ?>
    //  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    //  <p><?php the_time(get_option('date_format'));?> </p>
    //  <p><?php the_time(get_option('time_format'));?></p>
    //  <p><?php the_excerpt(); ?></p>
    //  <hr>
    //  <?php
    // }
    */
    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg') ?>)"></div>
      <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large text-green-500 hover:text-pink-300">Welcome !</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="<?php echo get_post_type_archive_link('program')  ?>" class="btn btn--large btn--blue">Find Your Major</a>
      </div>
    </div>

    <div class="full-width-split group">
      <div class="full-width-split__one">
        <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Events</h2>
          <?php
            $today=date('Ymd');
            $NewsPost = new WP_Query([
                'posts_per_page'=>2,
                'post_type'=>'event',
                'meta_key'=>'event_date',
                'orderby'=>'meta_value',
                'order'=>'ASC',
                'meta_query'=>[
                    [
                        'key'=>'event_date',
                        'compare'=>'>=',
                        'value'=>$today,
                        'type'=>'numeric'
                    ]
                ]
            ]);

            while($NewsPost->have_posts()){
                $NewsPost->the_post();
                get_template_part('template-parts/content','event');                
                //wp_reset_postdata();
            }
          ?>

          <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>
        </div>
      </div>
      <div class="full-width-split__two">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">News</h2>
          <?php 
            $NewsPost = new WP_Query(['posts_per_page'=>2,'category_name'=>'News']);

            while($NewsPost->have_posts()){
                $NewsPost->the_post();
                get_template_part('template-parts/content','event');
            }
          ?>

          <p class="t-center no-margin"><a href="<?php echo site_url('/category/news'); ?>" class="btn btn--yellow">View All News</a></p>
        </div>
      </div>
    </div>

    <div class="hero-slider">
      <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Transportation</h2>
                <p class="t-center">All students have free unlimited bus fare.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                <p class="t-center">Our dentistry program recommends eating apples.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg') ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Food</h2>
                <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
      </div>
    </div>
    <?php
    get_footer();
?>
