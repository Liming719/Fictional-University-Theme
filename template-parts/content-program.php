<div class="post-item">
  <h2 class="text-3xl my-2 text-orange-500"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

  <div class="generic-content">
    <?php the_excerpt(); ?>
    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">View Program</a></p>
  </div>
</div>