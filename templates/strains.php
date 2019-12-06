<?php
/**
 * Template Name: Strains Page
 * 
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

get_header();
?>

<section id="content" class="full-width">
<?php while ( have_posts() ) : ?>
  <?php the_post(); ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
    <?php avada_singular_featured_image(); ?>
    <div class="post-content">
      <?php the_content(); ?>
      
      <!-- Strains -->
      <div class="strain_row">
      <?php
        $strainargs = array('post_type' => 'strain');
        $strains_query = new WP_Query($strainargs);

        if ($strains_query->have_posts()) :
        while ($strains_query->have_posts()) : 
        $strains_query->the_post(); 
      ?>
        
        <div class="strain_box">
          <div class="strain_img" style="background-image: url('<?php the_field('fv_strain_img'); ?>')"></div>
          <div class="strain_name">
            <span class="<?php the_field('fv_strain_type'); ?>">
              <?php echo ucfirst(get_field('fv_strain_type')); ?>
            </span><br>
            <h2><?php the_title(); ?></h2>
          </div>
          <div class="strain_info">
            <?php the_field('fv_strain_desc'); ?>
          </div>
          <div class="strain_chem">
            <div class="terps">
              <?php
                if( have_rows('fv_strain_terps') ):
                  echo '<span>Terpenes</span><ul>';
                    while ( have_rows('fv_strain_terps') ) : the_row();
                      echo '<li>';
                      the_sub_field('fv_terpene');
                      echo '</li>';
                    endwhile;
                  echo '</ul>';
                endif;
              ?>
            </div>
            <div class="effects">
              <?php
                if( have_rows('fv_strain_effects') ):
                  echo '<span>Effects</span><ul>';
                    while ( have_rows('fv_strain_effects') ) : the_row();
                      echo '<li>';
                      the_sub_field('fv_effect');
                      echo '</li>';
                    endwhile;
                  echo '</ul>';
                endif;
              ?>
            </div>
          </div>

        </div>
        
      <?php 
        endwhile; endif; wp_reset_postdata(); 
      ?>
      </div>
      <!-- End Strains -->

      </div>
		</div>
	<?php endwhile; ?>
</section>
<?php get_footer(); ?>