<?php get_header() ?>

<main>
  <div class="container">   
    <section class="blog blog-singular">
      <div class="posts">
				<?php
				$search = esc_sql( wp_kses($_GET['s'], '' ) );

				// Checking for taxonomies
				$args = [
					'post_type' => 'post',
					'tax_query' => [
						'relation' => 'OR',
						[
							'taxonomy' => 'post_tag',
							'field'    => 'name',
							'terms'    => $search
						],
						[
							'taxonomy' => 'category',
							'field'    => 'name',
							'terms'    => $search
						],
						[
							'taxonomy' => 'country',
							'field'    => 'name',
							'terms'    => $search
						]
					],
					'nopaging' => true
				];

				$postsByTaxonomy = new WP_Query($args);

				$args = [
					'post_type' => 'post',
					'title'     => $search
				];

				global $wpdb;

				$searchQuery = $wpdb->esc_like($search);
				$searchQuery = '%' . $searchQuery . '%';

				$postsByTitle = $wpdb->get_results( 
					$wpdb->prepare("
						SELECT * FROM $wpdb->posts
						WHERE `post_title` LIKE '%s'
						AND `post_status` = 'publish'
					  AND `post_type` = 'post'
					", $searchQuery) 
				);

				$posts = array_merge( $postsByTaxonomy->get_posts(), $postsByTitle );

				$uniqueIDs = [];
				$posts = array_filter($posts, function($post, $k) {
					global $uniqueIDs;

					if ( in_array( $post->ID, $uniqueIDs ) )
						return false;
					else {
						array_push($uniqueIDs, $post->ID);
						return true;
					}
				}, ARRAY_FILTER_USE_BOTH);

				if ( !empty($posts) ): 
				?>
					<header class="search-results singular-header">
						<h2>
							<?php
							printf( esc_html__( 'Search Results for: %s', 'travel-blog' ), '<span>' . $search . '</span>' );
							?>
						</h2>
					</header>

					<?php foreach ( $posts as $post ): setup_postdata($post) ?>		
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
					<?php endforeach;
					wp_reset_query();
					wp_reset_postdata();
				else: ?>
          <div style="grid-column: 1/4;">
            <h2>Sorry, there are no such posts!</h2>
            <p style="text-align: center;">Take me back to <a href="<?= get_home_url() . '/blog/' ?>">blog page</a></p>
          </div>
        <?php endif ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer() ?>