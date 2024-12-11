<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>

      <?php
      $menu_terms = get_terms([
        'taxonomy' => 'menu',
      ]);
      ?>
      <?php if (!empty($menu_terms)): ?>
        <?php foreach ($menu_terms as $menu): ?>
          <section class="section_body">
            <h3 class="heading heading-secondary">
              <a href="<?= get_term_link($menu); ?>"><?= $menu->name; ?></a><span><?= strtoupper($menu->slug); ?></span>
            </h3>
            <ul class="foodList">
              <?php
              $args = [
                'post_type' => 'food', //「food」投稿タイプ限定
                'posts_per_page' => -1, //全件取得
                // ↓タクソノミーに関する条件指定
                'tax_query' => [
                  'relation' => 'AND',
                  // 条件1
                  [
                    'taxonomy' => 'menu',
                    'field' => 'slug',
                    'terms' => $menu->slug,
                  ],
                  // 条件2, 3, ...があった場合
                  // [], [], ...
                ],
              ];
              $the_query = new WP_Query($args);
              ?>
              <?php if ($the_query->have_posts()): ?>
                <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <li class="foodList_item">
                    <?php get_template_part('template-parts/loop', 'food'); ?>
                  </li>
              <?php endwhile;
                wp_reset_postdata();
              endif; ?>

            </ul>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>