<?php get_header();?>

<div class="content">
  <div class="bread"><?php breadcrumb(); ?></div>
  <h1 class="post_title"><?php $postType= get_post_type_object(get_post_type());
  echo esc_html($postType->labels->name);?></h1>

<?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->
 <div class="grid">
  <?php $loop = new WP_Query(array("post_type" => "read_books"));
        if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?> <!-- 繰り返しを開始。WP_Query -->
  <div class="items">
    <h2><a href="<?php the_permalink(); ?> "><?php the_title();?></a></h2>              <!-- タイトルを表示する -->
        <p><?php the_time('Y-n-j'); ?> </p>             <!-- 日付を表示 -->
    <?php if(has_post_thumbnail()):
      the_post_thumbnail('medium');
    else: ?>
    <img src="https://via.placeholder.com/700" alt="">
    <?php endif; ?>

   <!-- <?php if(!($loop->current_post == $loop->post_count -1)): ?> --><!--最後の投稿以外は以下を実行 -->
    <!-- <hr>  -->                                      <!-- 記事毎に区切り線 -->
  <!-- <?php endif; ?> -->
  </div>
  <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->
</div>
  <?php endif; ?>

<?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
  <p>記事がありません</p>                     <!-- この内容を表示 -->
<?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->
<?php
   wp_reset_postdata();
?>                            <!-- 繰り返しの最初に戻る -->

</div>

<?php get_footer(); ?>
