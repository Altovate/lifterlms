<?php
/**
 * Twenty Twenty Theme Support.
 *
 * @package  Classes/ThemeSupport
 *
 * @since [version]
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_Twenty_Twenty class..
 *
 * @since [version]
 */
class LLMS_Twenty_Twenty {

	/**
	 * Constructor.
	 *
	 * @since [version]
	 *
	 * @return void
	 */
	public static function init() {

		// This theme doesn't have a sidebar.
		remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar', 10 );

		// Handle content wrappers.
		remove_action( 'lifterlms_before_main_content', 'lifterlms_output_content_wrapper', 10 );
		remove_action( 'lifterlms_after_main_content', 'lifterlms_output_content_wrapper_end', 10 );

		add_action( 'lifterlms_before_main_content', array( __CLASS__, 'output_content_wrapper' ), 10 );
		add_action( 'lifterlms_after_main_content', array( __CLASS__, 'output_content_wrapper_end' ), 10 );

		// Modify catalog columns when the catalog page isn't full width.
		add_filter( 'lifterlms_loop_columns', array( __CLASS__, 'loop_cols' ) );
		add_filter( 'body_class', array( __CLASS__, 'body_classes' ) );

		// Prevent meta output for LifterLMS custom Post Types.
		add_filter( 'twentytwenty_disallowed_post_types_for_meta_output', array( __CLASS__, 'hide_meta_output' ) );

		add_filter( 'twentytwenty_get_elements_array', array( __CLASS__, 'add_elements' ) );

		add_action( 'wp_head', array( __CLASS__, 'add_inline_styles' ), 100 );

	}

	/**
	 * Generate inline CSS using colors from the TwenyTwenty Theme settings.
	 *
	 * @since [version]
	 *
	 * @return void
	 */
	public static function add_inline_styles() {

		$accent = sanitize_hex_color( twentytwenty_get_color_for_area( 'content', 'accent' ) );
		?>
		<style id="llms-twentytweny-style">
		.llms-access-plan.featured .llms-access-plan-content,
		.llms-access-plan.featured .llms-access-plan-footer {
			border-left-color: <?php echo $accent; ?>;
			border-right-color: <?php echo $accent; ?>;
		}
		.llms-access-plan.featured .llms-access-plan-footer {
			border-bottom-color: <?php echo $accent; ?>;
		}
		.llms-form-field.type-radio input[type=radio]:checked+label:before {
			background-image: -webkit-radial-gradient(center,ellipse,<?php echo $accent; ?> 0,<?php echo $accent; ?> 40%,#fafafa 45%);
			background-image: radial-gradient(ellipse at center,<?php echo $accent; ?> 0,<?php echo $accent; ?> 40%,#fafafa 45%);
		}

		.llms-checkout-section {
			padding-bottom: 0;
			padding-top: 0;
		}

		.llms-access-plan .llms-access-plan-title {
			margin-top: 0;
		}

		.llms-donut svg path {
			stroke: <?php echo $accent; ?>;
		}

		.llms-notification,
		.llms-instructor-info .llms-instructors .llms-author {
			border-top-color: <?php echo $accent; ?>;
		}
		</style>
		<?php

	}

	/**
	 * Add LifterLMS Elments to the array of Twenty Twenty elements.
	 *
	 * This is used to automatically generate inline CSS via the Twenty Twenty Theme.
	 *
	 * @since [version]
	 *
	 * @param array $elements Multidimensional array of CSS selectors.
	 * @return array
	 */
	public static function add_elements( $elements ) {

		// Accent Background.
		$elements['content']['accent']['background'] = array_merge(
			$elements['content']['accent']['background'],
			array(

				// Buttons.
				'.llms-button-primary',
				'.llms-button-primary:hover',
				'.llms-button-primary.clicked',
				'.llms-button-primary:focus',
				'.llms-button-primary:active',
				'.llms-button-action',
				'.llms-button-action:hover',
				'.llms-button-action.clicked',
				'.llms-button-action:focus',
				'.llms-button-action:active',

				// Pricing Tables.
				'.llms-access-plan-title',
				'.llms-access-plan .stamp',
				'.llms-access-plan.featured .llms-access-plan-featured',

				// Checkout.
				'.llms-checkout-wrapper .llms-form-heading',

				// Notices.
				'.llms-notice',

				// Progress Bar.
				'.llms-progress .progress-bar-complete',

				// My Grades.
				'.llms-sd-widgets .llms-sd-widget .llms-sd-widget-title',

				// Instructor.
				'.llms-instructor-info .llms-instructors .llms-author .avatar',

				// Quizzes.
				'.llms-question-wrapper ol.llms-question-choices li.llms-choice input:checked + .llms-marker',

			)
		);

		// Accent Border Color.
		$elements['content']['accent']['border-color'] = array_merge(
			$elements['content']['accent']['border-color'],
			array(

				// Checkout.
				'.llms-checkout-section',
				'.llms-checkout-wrapper form.llms-login',

				// Notices.
				'.llms-notice',

				// Instructor.
				'.llms-instructor-info .llms-instructors .llms-author .avatar',

			)
		);

		// Accent Color.
		$elements['content']['accent']['color'] = array_merge(
			$elements['content']['accent']['color'],
			array(

				// Pricing Tables.
				'.llms-access-plan-restrictions a',
				'.llms-access-plan-restrictions a:hover',

				// Loop.
				'.llms-loop-item-content .llms-loop-title:hover',

				// Donuts.
				'.llms-donut',

				// Checks on Syllabus.
				'.llms-lesson-preview.is-free .llms-lesson-complete',
				'.llms-lesson-preview.is-complete .llms-lesson-complete',

			)
		);

		// Background Text Color.
		$elements['content']['background']['color'] = array_merge(
			$elements['content']['background']['color'],
			array(

				// Buttons.
				'.llms-button-primary',
				'.llms-button-primary:hover',
				'.llms-button-primary.clicked',
				'.llms-button-primary:focus',
				'.llms-button-primary:active',
				'.llms-button-action',
				'.llms-button-action:hover',
				'.llms-button-action.clicked',
				'.llms-button-action:focus',
				'.llms-button-action:active',

				// Pricing Tables.
				'.llms-access-plan-title',
				'.llms-access-plan .stamp',
				'.llms-access-plan.featured .llms-access-plan-featured',

				// Checkout.
				'.llms-checkout-wrapper .llms-form-heading',

				// Notices.
				'.llms-notice',
				'.llms-notice a',

				// My Grades.
				'.llms-sd-widgets .llms-sd-widget .llms-sd-widget-title',

			)
		);

		// Background Background Color.
		$elements['content']['background']['background'] = array_merge(
			$elements['content']['background']['background'],
			array(

				'.llms-checkout',

			)
		);

		// Text Color.
		$elements['content']['text']['color'] = array_merge(
			$elements['content']['text']['color'],
			array(

				'.llms-notice.llms-debug',
				'.llms-notice.llms-debug a',

			)
		);

		return $elements;

	}

	/**
	 * Add Twenty Twenty's full-width template body class on catalogs where the page is set to use the Full Width template.
	 *
	 * @since [version]
	 *
	 * @param string[] $classes Array of body classes.
	 * @return string[]
	 */
	public static function body_classes( $classes ) {

		$page_id = self::get_archive_page_id();
		if ( $page_id && self::is_archive_page_full_width( $page_id ) ) {
			$classes[] = 'template-full-width';
		}

		return $classes;

	}

	/**
	 * Retrieve the page ID of a a catalog page.
	 *
	 * @since [version]
	 *
	 * @return int|false
	 */
	protected static function get_archive_page_id() {

		$page_id = false;

		if ( is_courses() ) {
			$page_id = llms_get_page_id( 'courses' );
		} elseif ( is_memberships() ) {
			$page_id = llms_get_page_id( 'memberships' );
		}

		return $page_id;

	}

	/**
	 * Get the twenty twenty theme's "width" class for use in wrapper elements.
	 *
	 * If the "Full Width" template is utilized, there's no class, otherwise the class `thin` is used.
	 *
	 * @since [version]
	 *
	 * @return string
	 */
	protected static function get_page_template_class() {

		$template_class = 'thin';
		$page_id        = self::get_archive_page_id();

		if ( $page_id ) {
			$template_class = self::is_archive_page_full_width( $page_id ) ? '' : 'thin';
		} else {
			$template_class = is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin';
		}

		return $template_class;

	}

	/**
	 * Prevent theme meta information from being output on LifterLMS Custom Post Types.
	 *
	 * @since [version]
	 *
	 * @param string[] $post_types Array of post type names.
	 * @return string[]
	 */
	public static function hide_meta_output( $post_types ) {

		return array_merge( $post_types, array( 'course', 'llms_membership', 'lesson', 'llms_quiz' ) );

	}

	/**
	 * Determine if the catalog page is utilizing the twenty twenty full-width page template.
	 *
	 * @since [version]
	 *
	 * @param int $page_id WP_Post ID of the catalog page.
	 * @return bool
	 */
	protected static function is_archive_page_full_width( $page_id ) {

		return 'templates/template-full-width.php' === get_page_template_slug( $page_id );

	}

	/**
	 * Modify the number of catalog columns.
	 *
	 * If the default template is used, drop to a single column.
	 *
	 * @since [version]
	 *
	 * @param int $cols Number of columns.
	 * @return int
	 */
	public static function loop_cols( $cols ) {

		if ( 'thin' === self::get_page_template_class() ) {
			return 1;
		}

		return $cols;

	}

	/**
	 * Output the opening wrapper for the content description element in the theme's header.
	 *
	 * @since [version]
	 *
	 * @return void
	 */
	public static function output_archive_description_wrapper() {
		echo '<div class="archive-subtitle section-inner thin max-percentage intro-text">';
	}

	/**
	 * Output the closing wrapper for the content description element in the theme's header.
	 *
	 * @since [version]
	 *
	 * @return void
	 */
	public static function output_archive_description_wrapper_end() {
		echo '</div><!-- .archive-subtitle -->';
	}

	/**
	 * Output Twenty Twenty theme wrapper openers
	 *
	 * @since 3.31.0
	 *
	 * @return void
	 */
	public static function output_content_wrapper() {

		$show_title = apply_filters( 'lifterlms_show_page_title', true );
		$has_desc   = has_action( 'lifterlms_archive_description' );

		if ( $has_desc ) {
			add_action( 'lifterlms_archive_description', array( __CLASS__, 'output_archive_description_wrapper' ), -1 );
			add_action( 'lifterlms_archive_description', array( __CLASS__, 'output_archive_description_wrapper_end' ), 99999999 );
		}

		if ( $show_title ) {
			add_filter( 'lifterlms_show_page_title', '__return_false' );
		}

		?>
		<main id="site-content" role="main">'

			<?php if ( $show_title || $has_desc ) : ?>
				<header class="archive-header has-text-align-center header-footer-group">

					<div class="archive-header-inner section-inner medium">
						<?php if ( $show_title ) : ?>
							<h1 class="archive-title"><?php lifterlms_page_title(); ?></h1>
						<?php endif; ?>
			<?php endif; ?>
		<?php

		// If there's no description, output the end wrapper now.
		if ( $show_title && ! $has_desc ) {
			self::output_content_wrapper_part_two();
		} else {
			// Otherwise output the wrapper after the end wrapper for the description wrapper div.
			add_action( 'lifterlms_archive_description', array( __CLASS__, 'output_content_wrapper_part_two' ), 99999999 );
		}

	}

	/**
	 * Outputs header closing wrappers and inner element opening wrappers for the theme wrappers.
	 *
	 * @since [version]
	 *
	 * @return void
	 */
	public static function output_content_wrapper_part_two() {

		?>
			</div><!-- .archive-header-inner -->
		</header><!-- .archive-header -->
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="post-inner section-inner <?php echo self::get_page_template_class(); ?> ">
				<div class="entry-content">
		<?php
	}

	/**
	 * Output Twenty Twenty theme wrapper closers
	 *
	 * @since 3.31.0
	 *
	 * @return void
	 */
	public static function output_content_wrapper_end() {
		?>
					</div><!-- .entry-content -->
				</div><!-- .post-inner -->
			</article><!-- .post -->
		</main><!-- #site-content -->
		<?php
	}

}

return LLMS_Twenty_Twenty::init();
