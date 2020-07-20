<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package do\'s_template
 */

get_header();
?>

	<main id="primary" class="site-main">
    <div class="bread"><?php breadcrumb(); ?></div>
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( '検索結果: %s', 'myblog' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
<div class="grid">

				<?php while ( have_posts() ) : the_post(); ?> <!-- 繰り返しを開始。記事がある場合は、その中から一つめを取得 -->
		<div class="items">
			    <h2><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>              <!-- タイトルを表示する -->
			    <?php the_time('Y年n月j日'); ?>              <!-- 日付を表示 -->
			    <?php if(has_post_thumbnail()):
			      the_post_thumbnail('category-medium');
			    else:?>
			    <img src="https://via.placeholder.com/300" alt="">
			  <?php endif; ?>
         <p style="text-align:right;"><?php the_time('Y-n-j'); ?> </p>             <!-- 日付を表示 -->

   </div>
		<?php	endwhile; ?>
 </div>
		<?php else :?>
     <p>記事がありません</p>

<?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
