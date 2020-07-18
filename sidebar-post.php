<aside class="sidebar">
  <ul class="lift" style="list-style: none;">
    <li class="widget posts-widget">
      <h3>Recent Posts</h3>
      <ul>
        <?php 
        $posts = get_posts([
          'numberposts'  => 3, 
          'post_status'  => 'publish',
          'post__not_in' => [ get_the_ID() ]
        ]); 
        
        foreach ($posts as $post): setup_postdata($post) ?>
          <li class="post">
            <a href="<?= the_permalink($post) ?>" class="post__img-wrapper">
              <img src="<?= get_the_post_thumbnail_url($post) ?>" alt="" class="sidebar-thumbnail">
            </a>

            <a href="<?php the_permalink($post) ?>">
              <h4><?php the_title() ?></h4>
            </a>
            <p class="excerpt"><?= get_the_excerpt($post) ?></p>
          </li>
        <?php endforeach; wp_reset_postdata() ?>
      </ul>
    </li>

    <?php dynamic_sidebar('post-sidebar') ?>
  </ul>
</aside>