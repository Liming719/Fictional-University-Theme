<?php
   get_header();
   while(have_posts())
   {
      the_post();
      PageBanner();
      ?>
      <!-- <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
        <div class="page-banner__content container container--narrow">
          <h1 class="page-banner__title"><?php the_title(); ?></h1>
          <div class="page-banner__intro">
            <p>Learn how the school of your dreams got started.</p>
          </div>
        </div>
      </div> -->

        <div class="container container--narrow page-section">
            <div class="meta-box">
                <div class="metabox metabox--position-up metabox--with-home-link">
                      <p>
                        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i> All Programs
                        </a> 
                        <span class="metabox__main"><?php the_title(); ?></span>
                      </p>
                </div>        
            </div>
            
            <div class="generic-content">         
               <p><?php echo get_field('main-content') ?></p>
            </div>
            <hr class="section-break">
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
                    ],
                    [
                      'key'=>'related_program',
                      'compare'=>'LIKE',
                      'value'=>'"' . get_the_ID() . '"'
                    ]
                ]
            ]);

            $OldPost = new WP_Query([
              'posts_per_page'=>2,
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
                  ],
                  [
                    'key'=>'related_program',
                    'compare'=>'LIKE',
                    'value'=>'"' . get_the_ID() . '"'
                  ]
              ]
            ]);

            $relatedProfessors = new WP_Query([
                'posts_per_page'=>-1,
                'post_type'=>'professor',
                'orderby'=>'title',
                'order'=>'ASC',
                'meta_query'=>[                    
                    [
                      'key'=>'related_program',
                      'compare'=>'LIKE',
                      'value'=>'"' . get_the_ID() . '"'
                    ]
                ]
            ]);

            ?>
            <p class="p-10"></p>
            <h3 class="text-3xl"><?php the_title(); ?> Proffesors</h3>
            <hr class="section-break">
            <ul class="professor-cards">
            <?php
            while($relatedProfessors->have_posts()){
                $relatedProfessors->the_post();?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink(); ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                        <span class="professor-card__name"><?php the_title(); ?></span>                    
                    </a>
                </li>
                
                <?php
                wp_reset_postdata();
              }
            ?>
            </ul>
            <p class="p-10"></p>
            <h3 class="text-3xl">The New Events</h3>
            <hr class="section-break">
            <?php
            while($NewsPost->have_posts()){
              $NewsPost->the_post();
              get_template_part('template-parts/content','event');
            }
            ?>

            <p class="p-10"></p>
            <h3 class="text-3xl">Out Of Date Events</h3>
            <hr class="section-break">
            <?php

            while($OldPost->have_posts()){
              $OldPost->the_post();
              get_template_part('template-parts/content','event');              
            }
            ?>
        </div>
    <?php


   }
   get_footer();
?>
