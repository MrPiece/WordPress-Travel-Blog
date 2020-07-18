<?php get_header() ?>

<main>
  <div class="container">   
    <section class="blog">
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
        <?php 
        if ( !empty($_GET) ) {
          $data = [
            'categories' => [],
            'tags' => [],
            'countries' => []
          ];

          foreach ( $_GET as $field => $v ) {
            if ( strpos($field, 'category') !== false )
              $data['categories'][] = wp_kses($v, null);
            elseif ( strpos($field, 'tag') !== false )
              $data['tags'][] = wp_kses($v, null);
            elseif ( strpos($field, 'country') !== false )
              $data['countries'][] = wp_kses($v, null);
          }

          $taxCountry = [
            'taxonomy' => 'country',
            'field'    => 'slug',
            'terms'    => $data['countries'],
            'operator' => 'IN'
          ];
          $taxCategory = [
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $data['categories'],
            'operator' => 'IN'
          ];
          $taxPostTag = [
            'taxonomy' => 'post_tag',
            'field'    => 'slug',
            'terms'    => $data['tags'],
            'operator' => 'IN'
          ];

          remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

          $args = [
            'numberposts'  => -1,
            'paged' => get_query_var('paged'),
            'tax_query'    => [
              'relation' => 'AND',
              !empty($taxCountry['terms']) ? $taxCountry : '',
              !empty($taxCategory['terms']) ? $taxCategory : '',
              !empty($taxPostTag['terms']) ? $taxPostTag : '',
            ]
          ];

          global $wp_query;
          $wp_query = new WP_Query($args);
        }
        ?>
        <?php
        if ( $wp_query->have_posts() ):
          while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;
        ?>
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
        wp_reset_query();
        
        else: ?>
          <div style="grid-column: 1/3;">
            <h2>Sorry, there are no such posts!</h2>
            <p style="text-align: center;">Take me back to <a href="<?= get_home_url() . '/blog/' ?>">blog page</a></p>
          </div>
        <?php endif ?>
      </div>

      <aside class="sidebar">
        <div class="lift">
          <form class="sidebar__widget-search search card" action="<?= get_home_url() ?>" method="get">
            <input class="search__input" name="s" type="search" placeholder="Search...">
            <button type="submit" class="button search__button">
              <i class="fas fa-search search-icon"></i>
            </button>
          </form>

          <form method="GET" class="sidebar__widget-filter card">
            <h3 class="sidebar__title">Countries</h3>

            <?php $i = 1 ?>
            <div class="sidebar__checkboxes-grid">
              <?php
              $countries = get_terms(['taxonomy' => 'country']);
              foreach ($countries as $country): setup_postdata($country)
              ?>
                <div class="checkbox">
                  <label for="<?= $country->slug ?>" class="checkbox-input">
                    <input type="checkbox" name="country<?= $i++ ?>" value="<?= $country->slug ?>" id="<?= $country->slug ?>">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="<?= $country->slug ?>"><?= $country->name ?></label>
                </div>
              <?php endforeach ?>
            </div>

            <hr class="sidebar__hr">

            <h3 class="sidebar__title">Categories</h3>

            <?php $i = 1 ?>
            <div class="sidebar__checkboxes-grid">
              <?php
              $categories = get_categories();
              foreach ($categories as $category): 
              ?>
                <div class="checkbox">
                  <label for="<?= $category->slug ?>" class="checkbox-input">
                    <input type="checkbox" name="category<?= $i++ ?>" value="<?= $category->slug ?>" id="<?= $category->slug ?>">
                    <span class="fas fa-check tick"></span>
                  </label>
                  <label for="<?= $category->slug ?>"><?= $category->name ?></label>
                </div>
              <?php endforeach ?>
            </div>

            <hr class="sidebar__hr">

            <h3 class="sidebar__title">Tags</h3>
            <?php $i = 1 ?>

            <div class="sidebar__checkboxes-grid">
            <?php
            $args = [
              'number'       => 0,
              'offset'       => 0,
              'orderby'      => 'id',
              'order'        => 'ASC',
              'hide_empty'   => true,
              'fields'       => 'all',
              'slug'         => '',
              'hierarchical' => true,
              'name__like'   => '',
              'pad_counts'   => false,
              'get'          => '',
              'child_of'     => 0,
              'parent'       => '',
            ];

            $tags = get_tags($args);
            foreach ($tags as $tag):
            ?>
              <div class="checkbox">
                <label for="<?= $tag->slug ?>" class="checkbox-input">
                  <input type="checkbox" name="tag<?= $i++ ?>" value="<?= $tag->slug ?>" id="<?= $tag->slug ?>">
                  <span class="fas fa-check tick"></span>
                </label>
                <label for="<?= $tag->slug ?>"><?= $tag->name ?></label>
              </div>
            <?php endforeach ?>
            </div>

            <button class="button" type="submit">Show related posts</button>
            <br>
            <a href="<?= preg_replace("/\?.*/", '', $_SERVER['REQUEST_URI']) ?>" class="button">Reset filters</a>
          </form>
        </div>
      </aside>
    </section>
  </div>
</main>

<?php get_footer() ?>