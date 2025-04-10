<?php get_header(); ?>
<div class="container">
    <main class="recipe-listing">
        <?php
        $recipes = new WP_Query([
            'post_type' => 'recipe',
            'posts_per_page' => 10
        ]);

        if ($recipes->have_posts()):
            while ($recipes->have_posts()): $recipes->the_post(); ?>
                <article class="recipe-card">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="recipe-image"><?php the_post_thumbnail('medium'); ?></div>
                    <?php endif; ?>
                    <div class="content">
                        <h2><?php the_title(); ?></h2>
                        <div class="meta">
                            <p><strong>Prep Time:</strong> <?php echo get_post_meta(get_the_ID(), 'prep_time', true); ?> minutes</p>
                            <p><strong>Servings:</strong> <?php echo get_post_meta(get_the_ID(), 'servings', true); ?></p>
                        </div>
                        <a class="button" href="<?php the_permalink(); ?>">View Recipe</a>
                    </div>
                </article>
        <?php endwhile;
        else:
            echo '<p>No recipes found.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </main>
</div>
<?php get_footer(); ?>