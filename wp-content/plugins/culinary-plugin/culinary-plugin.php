<?php
/*
Plugin Name: Culinary Plugin
Description: Handles custom recipe post type and Spoonacular API integration.
Version: 1.0
Author: KindaNicolas
*/

add_action('init', 'culinary_register_recipe_post_type');

function culinary_register_recipe_post_type()
{
    register_post_type('recipe', [
        'labels' => [
            'name' => __('Recipes'),
            'singular_name' => __('Recipe'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Recipe'),
            'edit_item' => __('Edit Recipe'),
            'new_item' => __('New Recipe'),
            'view_item' => __('View Recipe'),
            'search_items' => __('Search Recipes'),
            'not_found' => __('No recipes found'),
        ],
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-carrot',
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
    ]);
}
// Add admin menu for Spoonacular importer
add_action('admin_menu', 'culinary_api_menu');

function culinary_api_menu()
{
    add_menu_page(
        'Import Recipes',
        'Import Recipes',
        'manage_options',
        'import-recipes',
        'culinary_import_recipes_page'
    );
}

function culinary_import_recipes_page()
{
    if (isset($_POST['import_recipes'])) {
        culinary_fetch_and_import_recipes();
    }
?>
    <div class="wrap">
        <h1>Import Recipes</h1>
        <form method="post">
            <input type="submit" name="import_recipes" class="button button-primary" value="Import Recipes from Spoonacular">
        </form>
    </div>
<?php
}


function culinary_fetch_and_import_recipes()
{
    $api_key = 'aee379bd113a4e6e85d141296715786c';
    $response = wp_remote_get("https://api.spoonacular.com/recipes/random?number=5&apiKey=$api_key");

    if (is_wp_error($response)) {
        echo '<p style="color:red;">Error fetching recipes.</p>';
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!empty($data['recipes'])) {
        foreach ($data['recipes'] as $recipe) {

            // Build the ingredients list
            $ingredients_html = '<ul>';
            foreach ($recipe['extendedIngredients'] as $ingredient) {
                $ingredients_html .= '<li>' . esc_html($ingredient['original']) . '</li>';
            }
            $ingredients_html .= '</ul>';

            // Add recipe info to post content
            $content = "<h3>Ingredients</h3>$ingredients_html";
            $content .= "<h3>Instructions</h3>" . ($recipe['instructions'] ?? 'No instructions provided.');

            // Insert post
            $post_id = wp_insert_post([
                'post_title'   => $recipe['title'],
                'post_type'    => 'recipe',
                'post_status'  => 'publish',
                'post_content' => $content
            ]);

            if ($post_id && !is_wp_error($post_id)) {
                // ✅ Add custom fields
                update_post_meta($post_id, 'prep_time', $recipe['readyInMinutes']);
                update_post_meta($post_id, 'servings', $recipe['servings']);

                // ✅ Set featured image
                if (!empty($recipe['image'])) {
                    culinary_set_featured_image_from_url($recipe['image'], $post_id);
                }

                echo "<p style='color:green;'>✅ Imported: {$recipe['title']} (ID: $post_id)</p>";
            } else {
                echo "<p style='color:red;'>❌ Failed to import: {$recipe['title']}</p>";
            }
        }
        echo '<p><strong>🎉 Recipes imported successfully!</strong></p>';
    } else {
        echo '<p style="color:red;">No recipes found in the API response.</p>';
    }
}

function culinary_set_featured_image_from_url($image_url, $post_id)
{
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    // Download the image temporarily
    $tmp = download_url($image_url);

    if (is_wp_error($tmp)) return;

    $file_array = [
        'name'     => basename($image_url),
        'tmp_name' => $tmp
    ];

    $id = media_handle_sideload($file_array, $post_id);

    if (!is_wp_error($id)) {
        set_post_thumbnail($post_id, $id);
    }
}
