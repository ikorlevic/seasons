<?php
  $actualSeason = current_season();
  $season = $actualSeason;

  // Garden is a content category, not a seasonal skin.
  if (is_category(array('garden', 'recipes', 'home'))) {
      $season = $actualSeason;
  } elseif(is_home()) {
      $season = $actualSeason;
  } else {
        $obj = get_queried_object();
        $season = get_selected_season($obj);
  }
  // Set archive hero imagery directly so the legacy autumn CSS cannot override it.
  $archive_hero_style = '';
  if (is_tax('content_season')) {
      $hero_images = array(
          'spring' => 'spring.jpg',
          'autumn' => 'autumn.jpg',
          'winter' => 'winter.png',
      );
      if (isset($hero_images[$season])) {
          $hero_url = get_theme_file_uri('images/' . $hero_images[$season]);
          $archive_hero_style = 'background-image: linear-gradient(130deg, rgba(20, 38, 32, .46), rgba(20, 38, 32, .16)), url("' . esc_url($hero_url) . '");';
      } elseif ($season === 'summer') {
          // No summer photograph is currently committed to the theme.
          $archive_hero_style = 'background-image: linear-gradient(130deg, #247f72, #83bda2 60%, #f1d68c);';
      }
  }
?>
<div class="moto text-center d-flex jcc align-center flex-column <?php echo esc_attr($season); ?>"<?php if ($archive_hero_style) : ?> style="<?php echo esc_attr($archive_hero_style); ?>"<?php endif; ?>>
    <?php if (is_tax('content_season')) :
        $season_copy = array(
            'spring' => array('subtitle' => __('Awakening & Renewal', 'seasons'), 'description' => __('New growth, fresh ideas, and inspiration for the garden, kitchen, and home.', 'seasons')),
            'summer' => array('subtitle' => __('Abundance & Vitality', 'seasons'), 'description' => __('Long days, flourishing gardens, and the pleasures of summer living.', 'seasons')),
            'autumn' => array('subtitle' => __('Harvest & Transition', 'seasons'), 'description' => __('Gather the harvest, welcome changing colors, and prepare for cooler days.', 'seasons')),
            'winter' => array('subtitle' => __('Rest & Planning', 'seasons'), 'description' => __('A quieter season for comfort, reflection, and plans for the year ahead.', 'seasons')),
        );
        $hero_copy = isset($season_copy[$season]) ? $season_copy[$season] : null;
    ?>
        <span class="seasons-archive-hero-eyebrow"><?php esc_html_e('Explore the Season', 'seasons'); ?></span>
        <h1 class="bolder title"><?php echo esc_html(ucfirst($season)); ?></h1>
        <?php if ($hero_copy) : ?>
            <h2 class="title italic"><?php echo esc_html($hero_copy['subtitle']); ?></h2>
            <p><?php echo esc_html($hero_copy['description']); ?></p>
        <?php endif; ?>
    <?php else : ?>
        <h1 class="bolder title"><?php echo esc_html($season); ?></h1>
        <h2 class="title italic"><?php echo esc_html(season_moto($season)); ?></h2>
        <p><?php echo wp_kses_post(season_desc($season)); ?></p>
    <?php endif; ?>
<div class="weather">
    <?php echo pdsweather_display() ?>
    </div>
<div class="season-selector">
    <details class="season-selector-details">
        <summary class="pill season-selector-trigger"><?php echo esc_html(ucfirst($season)); ?></summary>
        <nav class="pill-menu season-selector-menu text-left" aria-label="<?php esc_attr_e('Choose a season', 'seasons'); ?>">
            <?php seasons_render_taxonomy_navigation(); ?>
        </nav>
    </details>
</div>
</div>
