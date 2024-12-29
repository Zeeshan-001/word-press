<?php
/* Template Name: fictional-university-theme */
get_header(); 

$search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$sort_order = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'desc'; 

// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Query args
$args = array(
    'paged' => get_query_var('paged', 1),
    'post_type' => 'post',
    'posts_per_page' => 2,
    's' => $search_query,
    'orderby' => 'date',
    'order' => $sort_order,
);

$custom_query = new WP_Query($args);
?>

<!-- Form -->
<div class="custom-posts-container">
    <form method="get" class="filter-form">
        <input type="text" name="search" placeholder="Beiträge durchsuchen..." value="<?php echo esc_attr($search_query); ?>">
        <select name="sort">
            <option value="desc" <?php selected($sort_order, 'desc'); ?>>Neueste zuerst</option>
            <option value="asc" <?php selected($sort_order, 'asc'); ?>>Älteste zuerst</option>
        </select>
        <button type="submit">Bestätigen </button>
    </form>

    <!-- Posts Loop -->
    <?php if ($custom_query->have_posts()) : ?>
        <div class="posts-grid">
            <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                <div class="post-card">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="post-meta"><?php echo get_the_date(); ?></p>
                    <p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $custom_query->max_num_pages,
            ));
            ?>
        </div>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <?php wp_reset_postdata();  ?>
</div>

<?php get_footer();  ?>
