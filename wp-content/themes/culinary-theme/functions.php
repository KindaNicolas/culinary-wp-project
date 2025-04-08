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
