<?php /*Template Name: страница articles*/ ?>
<?php get_header(); ?>

<div class="block">
    <div class="block_discipline">
        <div class="block_discipline_content_width">
            <div class="block_discipline_content_name">
                <p><?php the_title(); ?></p>
                <form>
                    <label for="sort">Сортировка:</label>
                    <select id="sort" name="sort">
                        <option value="new" <?php selected('new', isset($_GET['sort']) ? $_GET['sort'] : ''); ?>>Сначала новые</option>
                        <option value="old" <?php selected('old', isset($_GET['sort']) ? $_GET['sort'] : ''); ?>>Сначала старые</option>
                        <option value="popul" <?php selected('popul', isset($_GET['sort']) ? $_GET['sort'] : ''); ?>>Популярные</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="block_article">
        <div id="blockonearticlesid" class="block_one_articles">
            <?php
            // Получаем параметр сортировки из URL
            $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'new';

            // Настраиваем параметры WP_Query
            $args = [
                'post_type' => 'articles',
                'posts_per_page' => -1,
            ];

            if ($sort_order === 'new') {
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
            } elseif ($sort_order === 'old') {
                $args['orderby'] = 'date';
                $args['order'] = 'ASC';
            } elseif ($sort_order === 'popul') {
                $args['meta_key'] = 'post_views_count'; // Указываем мета-ключ для просмотров
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
            }

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="block_one_article">
                        <?php the_post_thumbnail(array(375, 210), ['class' => 'block_one_article_img']); ?>
                        <div class="block_one_article_atributs">
                            <div class="block_one_article_atribut">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-clock-3818205 (1).png" width="15" />
                                <p><?php the_time('F-j-Y'); ?></p>
                            </div>
                            <div class="block_one_article_atribut">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-eye-159604.png" width="20" />
                                <p><?php echo get_post_meta(get_the_ID(), 'post_views_count', true) ?: '0'; ?></p>
                                <p>Просмотров</p>
                            </div>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                        <div class="block_one_article_author">
                            <a href="<?php the_permalink(); ?>" class="button_small">Подробнее ></a>
                            <p>Автор: <?php the_author(); ?></p>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

<script>
    document.getElementById('sort').addEventListener('change', function() {
        const selectedSort = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('sort', selectedSort);
        window.location.href = currentUrl.toString();
    });
</script>
