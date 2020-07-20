<?php get_header();?>

<div class="content">
  <div class="bread"><?php breadcrumb(); ?></div>
  <h1 class="post_title"><?php $cat = get_the_category();
if(isset($cat,$cat[0])){
  $cat_name= $cat[0]->cat_name;
  $cat_slug= $cat[0]->slug;
  echo $cat_name;
}
  ?></h1><!--タイトルの表示 -->

  <div class="grid">

    <?php if($cat):
      //print_r($cat);
    $args = array(
      "post_type"=>'post',
      "category_name"=>$cat_slug,
    );
    $category =new WP_Query($args);
    // if ( $category->have_posts() ) :
       while ( $category->have_posts() ) : $category->the_post(); ?>
       <div class="items">
         <h2><a href="<?php the_permalink(); ?> "><?php the_title();?></a></h2>              <!-- タイトルを表示する -->
         <p><?php the_time('Y-n-j'); ?> </p>             <!-- 日付を表示 -->
         <?php if(has_post_thumbnail()):
                the_post_thumbnail('medium');
              else: ?>
                <img src="https://via.placeholder.com/300" alt="">
              <?php endif; ?>

       </div>
 <?php endwhile;
   wp_reset_postdata();?>
 </div>
 <?php else: ?>
          <p>記事がありません</p>
<?php endif; ?>

                        <!-- 繰り返しの最初に戻る -->



</div>
<?php get_footer();?>
