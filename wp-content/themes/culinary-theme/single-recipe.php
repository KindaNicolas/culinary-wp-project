<?php get_header(); ?>

<div class="single-recipe-container">
    <main class="recipe-content">
        <?php while (have_posts()) : the_post(); ?>
            <div class="recipe-hero">
                <?php the_post_thumbnail('full', ['class' => 'hero-image']); ?>
            </div>

            <div class="recipe-body">
                <h1><?php the_title(); ?></h1>
                <p class="price-tag">$<?php echo get_post_meta(get_the_ID(), 'price', true); ?></p>

                <div class="meta-info">
                    <p><strong>Prep Time:</strong> <?php echo get_post_meta(get_the_ID(), 'prep_time', true); ?> minutes</p>
                    <p><strong>Servings:</strong> <?php echo get_post_meta(get_the_ID(), 'servings', true); ?></p>
                    <p><strong>Difficulty:</strong> <?php echo get_post_meta(get_the_ID(), 'difficulty', true); ?></p>
                </div>

                <div class="star-rating">⭐⭐⭐⭐☆</div>

                <div class="recipe-tags">
                    <?php the_terms(get_the_ID(), 'post_tag', '<span>Tags:</span> ', ', '); ?>
                </div>

                <div class="recipe-instructions">
                    <?php
                    $content = apply_filters('the_content', get_the_content());
                    $content = preg_replace('/<img[^>]+\>/i', '', $content); // remove images
                    echo $content;
                    ?>
                </div>

                <a class="button-primary" href="#">View Recipe</a>

                <div class="recipe-share">
                    <button onclick="window.print()">🖨️ Print</button>
                    <button onclick="alert('Share feature coming soon')">📤 Share</button>
                </div>
            </div>
        <?php endwhile; ?>
    </main>

    <aside class="recipe-sidebar">
        <h2>More Recipes</h2>
        <?php
        $related = new WP_Query([
            'post_type' => 'recipe',
            'posts_per_page' => 3,
            'post__not_in' => [get_the_ID()]
        ]);
        if ($related->have_posts()) :
            while ($related->have_posts()) : $related->the_post(); ?>
                <div class="sidebar-recipe">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
                    <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                </div>
        <?php endwhile;
        endif;
        wp_reset_postdata(); ?>
    </aside>
</div>

<?php get_footer(); ?>