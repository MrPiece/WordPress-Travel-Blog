<?php get_header();
setup_postdata($post) ?>

<main class="post">
  <div class="container">   
    <article class="blog">
      <article class="post-full">
        <h2 class="post-full__title"><?php the_title() ?></h2>
      
        <div class="post-full__meta">
          <div class="post-full__author">
            <span>Author: <strong><?php the_author() ?></strong></span>
          </div>

          <div class="post-full__date">
            <!-- September 18, 2019 4:10 AM -->
            <span>Date: <?php the_date('F d, Y') ?></span>
          </div>

          <div>
            <?php $tags = wp_get_post_tags($post->ID) ?>
            <span>Tags: 
              <?php foreach ($tags as $tag): ?>
                <a href="<?= get_tag_link($tag) ?>" class="post__tag"><?= $tag->name ?></a>
              <?php endforeach ?>
            </span>
          </div>
        </div>

        <div class="post-full__body">
          <img class="post-full__thumbnail" src="<?= get_the_post_thumbnail_url() ?>">
          <p class="post-full__text-block">
            <?php the_content() ?>
          </p>
          
          <div class="post-full__stats post__stats">
            <div class="post__likes-count">
              <i class="fas fa-heart"></i>
              <span><?= wp_ulike_get_post_likes( $post->ID ) ?></span>
            </div>

            <div class="post__comments-count">
              <i class="fas fa-comment"></i>
              <span><?= get_comments_number( $post->ID ) ?></span>
            </div>

            <div class="post__views-count">
              <i class="fas fa-eye"></i>
              <span><?= pvc_get_post_views($post->ID) ?></span>
            </div>
          </div>
        </div>

        <hr>

        <?php comments_template() ?>
      </article>

      <?php get_sidebar('post') ?>
    </article>
  </div>
</main>

<?php get_footer() ?>