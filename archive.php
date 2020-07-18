<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Travel_Blog
 */

get_header();
?>
<main>
  <div class="container">   
    <section class="blog blog-singular">
      <aside class="mobile-dropmenu" id="list" data-height="30">
        <div class="mobile-dropmenu__options">
          <span id="list-button-sort">Sort <i class="arrow-down"></i></span>
          <span id="list-button-filter">Filter <i class="arrow-down"></i></span>
        </div>

        <div class="mobile-dropmenu__container" id="list-container-sort">
          <div class="mobile-dropmenu__sort">
            <a class="mobile-dropmenu__sort-option" href="#">Newest</a>
            <a class="mobile-dropmenu__sort-option" href="#">Most relevant</a>
            <a class="mobile-dropmenu__sort-option" href="#">Top rated</a>
          </div>
        </div>

        <div class="mobile-dropmenu__container" id="list-container-filter">
          <form action="#" method="get" class="mobile-dropmenu__filter">
            <div class="accordion" data-height="46">
              <div class="accordion__button">
                Countries
                <i class="arrow-down accordion__arrow"></i>
              </div>
              <div class="accordion__panel" id="list-container">
                <div class="checkbox">
                  <label for="russia-mobile" class="checkbox-input">
                    <input type="checkbox" name="russia-mobile" id="russia-mobile">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="russia-mobile">Russia</label>
                </div>

                <div class="checkbox">
                  <label for="canada-mobile" class="checkbox-input">
                    <input type="checkbox" name="canada-mobile" id="canada-mobile">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="canada-mobile">Canada</label>
                </div>

                <div class="checkbox">
                  <label for="france-mobile" class="checkbox-input">
                    <input type="checkbox" name="france-mobile" id="france-mobile">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="france-mobile">France</label>
                </div>
              </div>
            </div>

            <div class="accordion" data-height="46">
              <div class="accordion__button">
                Categories
                <i class="arrow-down accordion__arrow"></i>
              </div>
              <div class="accordion__panel">
                <div class="checkbox">
                  <label for="sightseeing-mobile" class="checkbox-input">
                    <input type="checkbox" name="sightseeing-mobile" id="sightseeing-mobile">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="sightseeing-mobile">Sightseeing</label>
                </div>
              </div>
            </div>
            <div class="accordion" data-height="46">
              <div class="accordion__button">
                Tags
                <i class="arrow-down accordion__arrow"></i>
              </div>
              <div class="accordion__panel">
                <div class="checkbox">
                  <label for="alone-mobile" class="checkbox-input">
                    <input type="checkbox" name="alone-mobile" id="alone-mobile">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="alone-mobile">Alone</label>
                </div>
              </div>
            </div>
            <button class="button mobile-dropmenu__submit" type="submit">Apply filters</button>
          </form>
        </div>
      </aside>

      <div class="posts">
			<header class="page-header singular-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
				<?php
        if ( have_posts() ):
          while( have_posts() ): the_post() ?>
            <article class="card post">
              <a href="<?php the_permalink() ?>" class="post__img-wrapper">
                <?php the_post_thumbnail() ?>
              </a>

              <div class="post__content">
                <a href="<?php the_permalink() ?>" class="post__title"><?php the_title() ?></a>

                <div class="post__tags">
                  <?php $postTags = get_the_terms($post->ID, 'post_tag');
                  foreach ($postTags as $tag): ?>
                    <a href="<?= get_tag_link($tag) ?>" class="post__tag"><?= $tag->name ?></a>
                  <?php endforeach ?>
                </div>

                <p class="post__excerpt">
                  <?php the_excerpt() ?>
                </p>

                <div class="post__stats">
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
                    <span><?= pvc_get_post_views( $post->ID ) ?></span>
                  </div>
                </div>
              </div>
            </article>
          <?php endwhile ?>

        <?php
        $pagination = get_the_posts_pagination();
        $pagination = preg_replace('/<h2.*>.*<\/h2>/', '', $pagination);
        $pagination = preg_replace('/<a (.*)>Next<\/a>/', '<a $1><span>&#8250;</span></a>', $pagination);
        $pagination = preg_replace('/<a (.*)>Previous<\/a>/', '<a $1><span>&#8249;</span></a>', $pagination);
  
        echo $pagination;
        
        else: ?>
          <div style="grid-column: 1/3;">
            <h2>Sorry, there are no such posts!</h2>
            <p style="text-align: center;">Take me back to <a href="<?= get_home_url() . '/blog/' ?>">blog page</a></p>
          </div>
        <?php endif ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer() ?>