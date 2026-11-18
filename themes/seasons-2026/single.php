<?php
/**
 * Editorial single post template.
 */
get_header();
?>
<main id="main-content" class="seasons-post-page">
    <div class="seasons-post-shell">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('seasons-post-article'); ?>>
                <header class="seasons-post-header">
                    <?php
                    $post_categories = get_the_category();
                    if (!empty($post_categories)) :
                        $primary_category = $post_categories[0];
                    ?>
                        <div class="seasons-post-category"><a href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>"><?php echo esc_html($primary_category->name); ?></a></div>
                    <?php endif; ?>
                    <h1><?php the_title(); ?></h1>
                    <div class="seasons-post-meta"><time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time></div>
                    <?php if (has_excerpt()) : ?>
                        <p class="seasons-post-summary"><?php echo esc_html(get_the_excerpt()); ?></p>
                    <?php endif; ?>
                </header>
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="seasons-post-featured">
                        <?php the_post_thumbnail('full', array('loading' => 'eager', 'fetchpriority' => 'high')); ?>
                        <?php $image_caption = get_the_post_thumbnail_caption(); if ($image_caption) : ?>
                            <figcaption><?php echo esc_html($image_caption); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                <?php endif; ?>
                <div class="seasons-post-body">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </div>
                <?php if (function_exists('have_rows') && have_rows('gallery')) : ?>
                    <section class="seasons-post-gallery" aria-label="<?php esc_attr_e('Post gallery', 'seasons'); ?>">
                        <h2><?php esc_html_e('Gallery', 'seasons'); ?></h2>
                        <ul>
                            <?php while (have_rows('gallery')) : the_row();
                                $gallery_link = get_sub_field('post');
                                $gallery_image = get_sub_field('thumbnail');
                                if (empty($gallery_image) || empty($gallery_image['url'])) { continue; }
                            ?>
                                <li>
                                    <?php if (!empty($gallery_link['url'])) : ?>
                                        <a href="<?php echo esc_url($gallery_link['url']); ?>"<?php echo !empty($gallery_link['target']) ? ' target="' . esc_attr($gallery_link['target']) . '" rel="noopener noreferrer"' : ''; ?>>
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url($gallery_image['url']); ?>" alt="<?php echo esc_attr($gallery_image['alt'] ?? ''); ?>" loading="lazy" />
                                    <?php if (!empty($gallery_link['title'])) : ?><p><?php echo esc_html($gallery_link['title']); ?></p><?php elseif (!empty($gallery_image['alt'])) : ?><p><?php echo esc_html($gallery_image['alt']); ?></p><?php endif; ?>
                                    <?php if (!empty($gallery_link['url'])) : ?></a><?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </section>
                <?php endif; ?>
            </article>
            <?php if (comments_open() || get_comments_number()) : ?>
                <section class="seasons-post-comments"><?php comments_template(); ?></section>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
