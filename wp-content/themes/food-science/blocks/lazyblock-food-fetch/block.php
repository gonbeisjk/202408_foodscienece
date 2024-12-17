<div style="border: 1px solid #ccc; padding: 10px; width: fit-content;">
  <?php
  $food_id = $attributes['id'];
  $food = get_post($food_id);
  // var_dump($food);
  ?>
  <a href="<?= get_permalink($food); ?>">
    <h2><?= get_the_title($food_id); ?></h2>
    <p><?= get_field('price', $food_id); ?>円</p>
    <?= $food->post_content; ?>
    <?php
    $thumbnail = get_the_post_thumbnail($food);
    if (!empty($thumbnail)):
    ?>
      <?= $thumbnail; ?>
    <?php else: ?>
      <img src="<?= get_template_directory_uri(); ?>/assets/img/common/noimage.png" alt="">
    <?php endif; ?>
  </a>
</div>