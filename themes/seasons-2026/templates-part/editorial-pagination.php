<?php
/** Shared pagination for editorial category archives. */
$pagination_label = isset($args['label']) ? $args['label'] : __('Posts pagination', 'seasons');
?>
<nav class="seasons-garden-pagination" aria-label="<?php echo esc_attr($pagination_label); ?>">
    <?php the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('Previous', 'seasons'),
        'next_text' => __('Next', 'seasons'),
    )); ?>
</nav>
