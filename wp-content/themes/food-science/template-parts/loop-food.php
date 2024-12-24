<div class="foodCard">
  <a href="<?php the_permalink(); ?>">
    <?php if (get_field('recommend')): ?>
      <span class="foodCard_label">オススメ</span>
    <?php endif; ?>
    <div class="foodCard_pic">
      <?php my_display_thumbnail(); ?>
    </div>
    <div class="foodCard_body">
      <h4 class="foodCard_title"><?php the_title(); ?></h4>
      <p class="foodCard_price">¥<?php the_field('price');  ?></p>
    </div>
  </a>
</div>