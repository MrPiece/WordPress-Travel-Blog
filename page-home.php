<?php get_header('home') ?>

<main>
  <div class="container">
    <section id="about-me">
      <div class="card card-about">
        <img class="card-about__image" src="<?= MEDIA . 'me.jpg' ?>" alt="">
        <div class="card-about__content">
          <h3 class="card-about__greeting">Hi, I am Sam!</h3>
          <p class="card-about__text">Lorem adipisicing incididunt mollit velit dolore pariatur culpa eiusmod non minim voluptate aliqua reprehenderit eiusmod officia culpa mollit amet enim exercitation cupidatat magna eiusmod nostrud laboris occaecat qui aute ex qui aliqua eiusmod laboris sit excepteur voluptate proident commodo</p>
          <a href="/about" class="action-button">Let's get acquinted!</a>
        </div>
      </div>
    </section>
  
    <section class="posts posts_home" id="latest-posts">
      <?php 
      $posts = get_posts(['numberposts' => 3]);

      if (! empty($posts)): 
      foreach($posts as $post): setup_postdata($post) ?>
        <article class="card post">
          <a href="<?php the_permalink() ?>" class="post__img-wrapper">
            <?php the_post_thumbnail() ?>
          </a>

          <div class="post__content">
            <a href="<?php the_permalink() ?>" class="post__title"><?php the_title() ?></a>

            <div class="post__tags">
              <?php $tags = get_the_terms($post->ID, 'post_tag');
              foreach ($tags as $tag): ?>
                <a href="<?= get_tag_link($tag) ?>" class="post__tag"><?= $tag->name ?></a>
              <?php endforeach ?>
            </div>

            <p class="post__excerpt">
              <?php the_excerpt() ?>
            </p>

            <div class="post__stats">
              <div class="post__likes-count">
                <i class="fas fa-heart"></i>
                <span><?= wp_ulike_get_post_likes($post->ID) ?></span>
              </div>

              <div class="post__comments-count">
                <i class="fas fa-comment"></i>
                <span><?= get_comments_number($post->ID) ?></span>
              </div>

              <div class="post__views-count">
                <i class="fas fa-eye"></i>
                <span><?= pvc_get_post_views($post->ID) ?></span>
              </div>
            </div>
          </div>
        </article>
      <?php endforeach ?>
        <a href="/blog" class="action-button">Check all posts</a>
      <?php endif ?>
    </section>

    <section>
      <div class="card card_contact">
        <h3>Let me know your blog experience!</h3>

        <?= do_shortcode('[contact-form-7 id="101" title="Main contact form"]') ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer() ?>