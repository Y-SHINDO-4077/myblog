<?php get_header();?>

<div class="single_content">

<article>
<?php if ( have_posts() ) : ?>                  <!-- 記事があるかどうかを確認する -->

  <?php //$loop = new WP_Query(array("post_type" => "read_books"));
        if(have_posts()) : while(have_posts()) : the_post(); ?> <!-- 繰り返しを開始。WP_Query -->
    <div class="post_type_name"><?php echo esc_html(get_post_type_object(get_post_type())->label);?>
    >
    <?php $terms = get_the_terms($post->ID,'genre');
    foreach($terms as $term){
      echo '<a href="'.get_term_link($term->slug,'genre').'">'.$term->name.'</a>';
    }
    ?></div><!--投稿タイプ名、タクソノミー -->
    <h2><?php the_title();?></h2>              <!-- タイトルを表示する -->
    <div class="date"><?php the_time('Y-n-j'); ?></div>              <!-- 日付を表示 -->
    <?php if(has_post_thumbnail()):
      the_post_thumbnail('category-medium');
    else: ?>
    <img src="https://via.placeholder.com/450" alt="">
  <?php endif; ?>
  <div class="content-single"><?php the_content();?></div>
  <hr class="content-single">
   <div class="content-single info">書誌情報</div>
   <table>
     <?php $repeat_group =SCF::get('read_books_data');
     //var_dump($repeat_group);
       foreach($repeat_group as $fields):?>

       <tr>
       <td class="tit">著者 </td>
       <td><?php echo $fields['author']; ?></td>
     </tr>
      <tr>
        <td class="tit">出版社</td>
      　<td><?php echo $fields['published']; ?></td>
      </tr>
      <tr>
        <td class="tit">出版年</dt>
        <td><?php echo $fields['published_year']; ?></td>
      </tr>


    <?php endforeach;?><!--Smart Custom Fieldsを用いたカスタムフィールドの表示 -->
  </table>

  <?php endwhile; ?>                            <!-- 繰り返しの最初に戻る -->
  <?php the_posts_navigation(); ?>

<?php else : ?>                                 <!-- 記事がなかった場合の記述 -->
  <p>記事がありませんでした</p>                     <!-- この内容を表示 -->
<?php endif; ?>                                 <!-- 記事があるかどうかを確認を終了 -->

<?php endif; ?>
</article>
<?php
get_sidebar();
get_footer(); ?>
