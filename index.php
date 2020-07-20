<?php get_header(); ?>
  <div class="tab_box is_show" id="summary">
    <div class="contents">

    <h1 class="post_title"> New Post </h1>

    <?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->
     <div class="grid">

      <?php while ( have_posts() ) : the_post(); ?> <!-- 繰り返しを開始。記事がある場合は、その中から一つめを取得 -->
        <div class="items">
        <h2><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>              <!-- タイトルを表示する -->
        <?php the_time('Y-n-j'); ?>   <!-- 日付を表示 -->
      <div class="img">
        <?php if(has_post_thumbnail()){
          the_post_thumbnail('medium');
        }else{ ?>
        <img src="https://via.placeholder.com/300" alt="" class="img_top-vw">
        <?php } ?>
        </div>
       </div>
        <!-- <hr>         -->                       <!-- 記事毎に区切り線 -->
      <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->
     </div>
    <?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
      <p>記事がありません</p>                     <!-- この内容を表示 -->
    <?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->

<h1 class="post_title">読んだ本</h1>
<div class="grid">
    <?php $loop = new WP_Query(array("post_type" => "read_books"));
      if($loop->have_posts()) : while($loop->have_posts()) : $loop->the_post(); ?> <!-- 繰り返しを開始。WP_Query -->
    <div class="items">
     <a href="<?php the_permalink(); ?> ">
       <?php if(has_post_thumbnail()):
          the_post_thumbnail('medium');
        else: ?>
       <img src="https://via.placeholder.com/700" alt="">
     <?php endif; ?>
     </a>
    </div>
   <?php endwhile;?>
   <?php wp_reset_postdata();?>                            <!-- 繰り返しの最初に戻る -->
   <?php endif; ?>

 </div>


    </div>
   </div>

<?php
get_footer(); ?>
