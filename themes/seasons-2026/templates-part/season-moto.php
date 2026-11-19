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
          'summer' => 'summer.png',
          'autumn' => 'autumn.jpg',
          'winter' => 'winter.png',
      );
      if (isset($hero_images[$season])) {
          $hero_url = get_theme_file_uri('images/' . $hero_images[$season]);
          $hero_overlay = $season === 'winter'
              ? 'linear-gradient(130deg, rgba(25, 58, 89, .43), rgba(89, 135, 166, .22))'
              : 'linear-gradient(130deg, rgba(20, 38, 32, .46), rgba(20, 38, 32, .16))';
          $archive_hero_style = 'background-image: ' . $hero_overlay . ', url("' . esc_url($hero_url) . '");';
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
<style>
/* Hero controls are defined here to avoid stale imported theme CSS. */
.moto .seasons-hero-actions {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 12px !important;
    width: auto !important;
    max-width: calc(100% - 24px);
    margin: 20px auto 0 !important;
}
.moto .seasons-hero-actions .season-selector,
.moto .seasons-hero-actions .seasons-hero-weather {
    flex: 0 0 auto !important;
    width: auto !important;
    margin: 0 !important;
}
.moto .seasons-hero-actions .season-selector-trigger,
.moto .seasons-hero-actions .seasons-hero-weather {
    box-sizing: border-box !important;
    min-height: 43px !important;
    border: 1px solid rgba(255,255,255,.45) !important;
    border-radius: 999px !important;
    background: rgba(255,255,255,.24) !important;
    color: #fff !important;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}
.moto .seasons-hero-actions .season-selector-trigger {
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 10px 17px !important;
    list-style: none !important;
    font-size: 14px !important;
    line-height: 21px !important;
    cursor: pointer;
}
.moto .seasons-hero-actions .season-selector-trigger::-webkit-details-marker { display: none; }
.moto .seasons-hero-actions .season-selector-trigger::after {
    content: "" !important;
    display: inline-block !important;
    width: 7px; height: 7px;
    border-right: 1.5px solid currentColor;
    border-bottom: 1.5px solid currentColor;
    transform: rotate(45deg) translateY(-2px);
}
.moto .seasons-hero-actions .seasons-hero-weather {
    display: inline-flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 10px 15px !important;
    white-space: nowrap !important;
}
.moto .seasons-hero-actions .seasons-hero-weather .weather[data-theme] {
    position: static !important;
    display: inline-flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 7px !important;
    width: auto !important;
    height: auto !important;
    margin: 0 !important;
    padding: 0 !important;
    border: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    line-height: 21px !important;
}
.moto .seasons-hero-weather .weather[data-theme] > i.wi,
.moto .seasons-hero-weather .weather[data-theme] .conditions,
.moto .seasons-hero-weather .weather[data-theme] .current,
.moto .seasons-hero-weather .weather[data-theme] .deg {
    position: static !important;
    display: inline-block !important;
    float: none !important;
    width: auto !important;
    height: auto !important;
    margin: 0 !important;
    padding: 0 !important;
    color: #fff !important;
    line-height: 21px !important;
    vertical-align: middle !important;
    white-space: nowrap !important;
}
.moto .seasons-hero-weather .weather[data-theme] > i.wi { font-size: 19px !important; }
.moto .seasons-hero-weather .weather[data-theme] .deg { font-size: 14px !important; font-weight: 600 !important; }
.moto .seasons-hero-actions .season-selector-menu {
    top: calc(100% + 7px);
    left: 0;
}
@media (max-width: 380px) {
    .moto .seasons-hero-actions { gap: 8px !important; }
    .moto .seasons-hero-actions .season-selector-trigger { padding: 10px 12px !important; }
    .moto .seasons-hero-actions .seasons-hero-weather { padding: 10px 12px !important; }
}
</style>
<div class="seasons-hero-actions" style="display:flex !important;flex-direction:row !important;flex-wrap:nowrap !important;align-items:center !important;justify-content:center !important;gap:12px !important;width:auto !important;margin:20px auto 0 !important;">
    <div class="season-selector">
        <details class="season-selector-details">
            <summary class="pill season-selector-trigger"><?php echo esc_html(ucfirst($season)); ?></summary>
            <nav class="pill-menu season-selector-menu text-left" aria-label="<?php esc_attr_e('Choose a season', 'seasons'); ?>">
                <?php seasons_render_taxonomy_navigation(); ?>
            </nav>
        </details>
    </div>
    <?php if (function_exists('pdsweather_display')) : ?>
        <div class="seasons-hero-weather" aria-label="<?php esc_attr_e('Current weather', 'seasons'); ?>">
            <?php echo pdsweather_display(); ?>
        </div>
    <?php endif; ?>
</div>
</div>
