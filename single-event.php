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
                        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>">
                            <i class="fa fa-home" aria-hidden="true"></i> Event Home
                        </a> 
                        <span class="metabox__main"><?php the_title(); ?></span>
                      </p>
                </div>

            </div>

            <div class="generic-content">         
               <p><?php the_content(); ?></p>
            </div>
            
            <div>            
            <?php
            $relatedPrograms = get_field('related_program');
            if($relatedPrograms)
            {
                ?>
                <h3 class="text-3xl">Related Programs</h3>
                <hr class="section-break">
                <?php
                // print_r($relatedProgram);
                foreach($relatedPrograms as $program){
                    ?>                
                    <a href="<?php echo get_the_permalink($program); ?>">#<?php echo get_the_title($program) ?></a>                
                    <?php
                }                    
            }
            
            ?>
            </div>
        </div>
      <?php
   }
   get_footer();
?>