<?php
    get_header();
    while(have_posts())
    {
     the_post();
     PageBanner();
     ?>
        <div class="container container--narrow page-section">
            <?php
            $parentID = wp_get_post_parent_id(0);
            if($parentID>0){
                ?>
                <div class="metabox metabox--position-up metabox--with-home-link">
                  <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentID) ?>">
                        <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentID); ?>
                    </a> 
                    <span class="metabox__main"><?php the_title() ?></span>
                  </p>
                </div>
                <?php
            }                
            ?>
          
            <?php 
                if($parentID or !empty(get_pages(['child_of'=>get_the_ID()]))){
                    ?>
                    <div class="page-links">
                        <h2 class="page-links__title"><a href="<?php echo get_permalink($parentID) ?>"><?php echo get_the_title($parentID); ?></a></h2>
                        <ul class="min-list">
                            <?php
                            $findChildOf = get_the_ID();
                            if($parentID)
                                $findChildOf = $parentID;

                            wp_list_pages(array(
                                'title_li'=>null,
                                'child_of'=>$findChildOf
                            ));
                            ?>             
                        </ul>
                    </div>
                    <?php
                }
            ?>
            

          <div class="generic-content">
            <?php get_search_form(); ?>
          </div>
        </div>
     <?php
    }
    get_footer();
?>
