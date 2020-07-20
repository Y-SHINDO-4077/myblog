<div class="siteFooter">
  <p class="copyright">©️ 2020 Yutaro Shindo</p>
  <?php if (!is_single()): ?>
      <p><?php dynamic_sidebar('sidebar-1');?></p>
  <?php endif; ?>

  <div class="site-credit">
    <p>Powered by
      <a href="https://ja.wordpress.org/" target="_blank">Wordpress</a>
      <span>|</span>
      Theme:myblog by YS
    </p>
   </div>

</div>
</div>
<?php wp_footer(); ?>
</body>

</html>
