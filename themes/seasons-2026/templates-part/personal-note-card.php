<?php
/**
 * Shared personal note card, used by the homepage and main category pages.
 * Call from inside the WordPress Loop.
 */
$note_label = get_post_meta(get_the_ID(), '_seasons_note_label', true);
$note_tone = get_post_meta(get_the_ID(), '_seasons_note_tone', true);
if (!in_array($note_tone, array('green', 'teal', 'blue', 'orange'), true)) {
    $note_tone = 'green';
}
?>
<article class="seasons-garden-note">
    <?php if ($note_label) : ?>
        <span class="seasons-garden-note-label seasons-garden-note-<?php echo esc_attr($note_tone); ?>"><?php echo esc_html($note_label); ?></span>
    <?php endif; ?>
    <h3><?php the_title(); ?></h3>
    <div class="seasons-garden-note-body"><?php echo wpautop(esc_html(wp_strip_all_tags(get_the_content()))); ?></div>
</article>
