<?php get_header(); ?>

<main class="single-recipe">
    <h1><?php the_title(); ?></h1>

    <?php if (has_post_thumbnail()) : ?>
        <div class="recipe-image">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <div class="meta">
        <p><strong>Prep Time:</strong> <?php echo get_post_meta(get_the_ID(), 'prep_time', true); ?> minutes</p>
        <p><strong>Servings:</strong> <?php echo get_post_meta(get_the_ID(), 'servings', true); ?></p>
    </div>

    <div class="content">
        <?php the_content(); ?>
    </div>
</main>

<?php get_footer(); ?>