<?php
add_filter('default_hidden_meta_boxes', function ($hidden, $screen) {
    if (isset($screen->post_type) && $screen->post_type === 'recipe') {
        return array_diff($hidden, ['postcustom']);
    }
    return $hidden;
}, 10, 2);
add_action('init', function () {
    add_post_type_support('recipe', 'custom-fields');
});


function culinary_enqueue_styles()
{
    wp_enqueue_style(
        'culinary-custom-style',
        get_template_directory_uri() . '/scss/style.css',
        [],
        filemtime(get_template_directory() . '/scss/style.css')
    );
}
add_action('wp_enqueue_scripts', 'culinary_enqueue_styles');


add_shortcode('display_all_recipes', 'display_all_recipes_callback');
function display_all_recipes_callback()
{
    $recipes = new WP_Query([
        'post_type' => 'recipe',
        'posts_per_page' => -1,
    ]);

    $output = '<h1>Culinary Recipes</h1>';
    $output .= '<div class="recipe-grid">';

    if ($recipes->have_posts()) {
        while ($recipes->have_posts()) {
            $recipes->the_post();
            $prep_time = get_post_meta(get_the_ID(), 'prep_time', true);
            $servings = get_post_meta(get_the_ID(), 'servings', true);

            $output .= '<div class="recipe-card">';
            if (has_post_thumbnail()) {
                $output .= get_the_post_thumbnail(get_the_ID(), 'medium');
            }
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<p><strong>Prep Time:</strong> ' . esc_html($prep_time) . ' minutes</p>';
            $output .= '<p><strong>Servings:</strong> ' . esc_html($servings) . '</p>';
            $output .= '<a href="' . get_permalink() . '">View Recipe</a>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>No recipes found.</p>';
    }

    $output .= '</div>';
    return $output;
}
