<?php
/**
 * Shared editorial article card. Call from inside the WordPress Loop.
 *
 * Optional args: meta (string), readmore (string).
 */
$card_meta = isset($args['meta']) ? $args['meta'] : get_the_date();
$card_readmore = isset($args['readmore']) ? $args['readmore'] : __('Read the story', 'seasons');
?>
<article <?php post_class('seasons-home-card'); ?>>
    <a class="seasons-home-card-link" href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="seasons-home-card-image"><?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?></div>
        <?php endif; ?>
        <div class="seasons-home-card-content">
            <span class="seasons-home-card-meta"><?php echo esc_html($card_meta); ?></span>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
            <span class="seasons-home-readmore"><?php echo esc_html($card_readmore); ?> &rarr;</span>
        </div>
    </a>
</article>
