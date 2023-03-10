<?php
   get_header();
   while(have_posts())
   {
        the_post();
        PageBanner();
        ?>        

        <div class="container container--narrow page-section">
            
            <div class="generic-content">         
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professorProtrait'); ?>
                    </div>
                    <div class="two-third">
                        <p><?php echo get_field('main-content'); ?></p>
                    </div>
                </div>
            </div>
            <hr class="section-break">

            <div>            
            <?php
            $relatedPrograms = get_field('related_program');
            if($relatedPrograms)
            {
                ?>
                <h3 class="text-3xl">Subject(s) Taught</h3>
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
