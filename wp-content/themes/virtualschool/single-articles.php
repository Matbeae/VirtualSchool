<?php
/*
    Template Name: страница article
    */
?>
<?php get_header(); ?>
<div class="block">
    <div class="block_one_article_content_name">
        <p>
            <?php the_title(); ?>
        </p>
        <div class="block_one_article_content_time">
            <p>Дата добавления:</p>
            <p>
                <?php the_time('Y.m.d'); ?>
            </p>
            <p>
                <?php the_time('H:i'); ?>
            </p>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_theory">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_articles_more_name">
            <p>Смотрите также:</p>
        </div>
        <div class="block_one_articles">
            <?php
            // Получаем текущие теги статьи
            $tags = wp_get_post_tags(get_the_ID());
            if ($tags) {
                // Получаем список ID тегов
                $tag_ids = [];
                foreach ($tags as $tag) {
                    $tag_ids[] = $tag->term_id;
                }

                // Формируем запрос для вывода статей с такими же тегами
                $query = new WP_Query([
                    'post_type' => 'articles',  // Тип записи
                    'posts_per_page' => 3,      // Количество статей для вывода
                    'orderby' => 'date',        // Сортировка по дате
                    'order' => 'DESC',          // Последние статьи
                    'tag__in' => $tag_ids,      // Фильтрация по тегам
                    'post__not_in' => [get_the_ID()], // Исключаем текущую статью
                ]);

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
            ?>
                        <div class="block_one_article">
                            <?php the_post_thumbnail(array(375, 210), array('class' => 'block_one_article_img')); ?>
                            <div class="block_one_article_atributs">
                                <div class="block_one_article_atribut">
                                    <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-clock-3818205 (1).png" width="15" />
                                    <p>
                                        <?php the_time('F-j-Y'); ?>
                                    </p>
                                </div>
                                <div class="block_one_article_atribut">
                                    <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-eye-159604.png" width="20" />
                                    <p>0</p>
                                    <p>Просмотров</p>
                                </div>
                            </div>
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            <div class="block_one_article_author">
                                <a href="<?php the_permalink() ?>" class="button_small">Подробнее ></a>
                                <p>Автор:
                                    <?php the_author(); ?>
                                </p>
                            </div>
                        </div>
            <?php endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Похожие статьи не найдены.</p>';
                endif;
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>