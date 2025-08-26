<?php /*Template Name: страница главная*/ ?>
<?php get_header(); ?>
<style>
    .active {
        width: 100%;
        height: 500px;
        background-size: cover;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        border-bottom: 2px solid #7e92c8;
        margin-top: 50px;
        filter: blur(0px);
        padding-bottom: 10px;
        transition: 0.42s all ease-in-out;
    }
</style>
<div class="slider" itemscope itemtype="http://schema.org/ItemList">
    <div class="slides-container">
        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="slide1" class="slide active">
            <div class="head_img_top" itemscope itemtype="http://schema.org/ImageObject">
                <h1 itemprop="name">Цифровой образовательный ресурс</h1>
                <img src="http://localhost/virtualschool/wp-content/uploads/2023/12/Online-Learning-Education-PNG-Transparent-Image-1.png" itemprop="contentUrl" width="470" />
            </div>
            <?php get_search_form(); ?>
        </div>
        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="slide2" class="slide">
            <h2>Новинка!</h2>
            <h1>Попробуйте наши онлайн калькуляторы</h1>
            <a href="virtualschool/calculators/" class="button">Подробнее</a>
        </div>
        <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" id="slide3" class="slide">
            <h2>Вам есть чем поделиться?</h2>
            <h2>Загрузка собственной теории, создание тестов и многое другое</h2>
            <div class="head_img_top" itemscope itemtype="http://schema.org/ImageObject">
                <img src="http://localhost/virtualschool/wp-content/uploads/2023/12/564-5643617_stacked-books-png-transparent-background-books-png-clipart.png" itemprop="contentUrl" width="170" />
                <h1>ЕЩЕ НЕ ЗАРЕГИСТРИРОВАНЫ?</h1>
            </div>
            <a href="virtualschool/registration/" class="button">ВПЕРЕД</a>
        </div>
    </div>
    <div class="arrows">
        <span class="prev">&lt;</span>
        <span class="next">&gt;</span>
    </div>
</div>
<div class="block">
    <div class="block_one">
        <div class="block_moretime" itemscope itemtype="http://schema.org/ImageObject">
            <img src="<?php echo get_template_directory_uri() ?> /images/gamepad_PNG74.png" itemprop="contentUrl" width="460" />
            <div class="block_moretime_text">
                <p class="block_moretime_text_top">ХОЧЕШЬ <i>БОЛЬШЕ</i> ВРЕМЕНИ НА ЛЮБИМЫЕ ЗАНЯТИЯ?</p>
                <p class="block_moretime_text_bottom">VirtualSchool - тренажер, с которым ты быстро подготовишься к
                    контрольной или экзамену.</p>
            </div>
        </div>
        <a href="virtualschool/registration/" class="button">ЗАРЕГИСТРИРОВАТЬСЯ</a>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <p class="block_one_text_top">ОГРОМНОЕ КОЛИЧЕСТВО ОБУЧАЮЩЕГО МАТЕРИАЛА</p>
        <p class="block_one_text_bottom">АВТОРСКАЯ ТЕОРИЯ ОТ УЧИТЕЛЕЙ И ПРЕПОДАВАТЕЛЕЙ СО ВСЕГО МИРА</p>
        <div class="block_education" itemscope itemtype="http://schema.org/Blog">
            <?php
            $taxonomy = 'disciplines';
            $terms = get_terms(
                array(
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                    'number' => 16,
                )
            );
            foreach ($terms as $term) {
                $term_link = get_term_link($term);
                $thumbnail_url = get_term_meta($term->term_id, 'thumbnail', true);
            ?>
                <div class="block_education_card" itemscope itemtype="http://schema.org/BlogPosting">
                    <a itemprop="url" href="<?php echo $term_link ?>" class="block_education_card_img">
                        <img class="block_education_card_img_primary" src="<?php echo $thumbnail_url ?>" />
                        <div class="block_education_card_properties">
                            <div class="block_education_card_properties_col">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-catalog-5014330.png" width="25" />
                                <p>
                                    <?php echo $term->count; ?>
                                </p>
                            </div>
                            <div class="block_education_card_properties_col">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-view-709612.png" width="25" />
                                <p>
                                    <?php
                                    $view_count = get_term_meta($term->term_id, 'view_count', true);
                                    echo $view_count ? $view_count : 0; // Если счетчик не найден, показываем 0
                                    ?>
                                </p>
                            </div>
                        </div>
                    </a>
                    <a itemprop="headline" href="<?php echo $term_link ?>" class="block_education_card_text">
                        <?php echo $term->name; ?>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <a href="virtualschool/lessons/" class="button">ВСЯ ТЕОРИЯ</a>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_articles_text">
            <h2>Статьи</h2>
            <p>Узнайте свежие новости из образовательного мира</p>
        </div>
        <div class="block_one_articles" itemscope itemtype="http://schema.org/Blog">
            <?php
            $query = new WP_Query([
                'post_type' => 'articles',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
            ]);
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
            ?>
                    <div class="block_one_article" itemscope itemtype="http://schema.org/BlogPosting">
                        <?php the_post_thumbnail(array(375, 210), array('class' => 'block_one_article_img')); ?>
                        <div class="block_one_article_atributs">
                            <div class="block_one_article_atribut">
                                <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-clock-3818205 (1).png" width="15" />
                                <p itemprop="datePublished">
                                    <?php the_time('F-j-Y'); ?>
                                </p>
                            </div>
                            <div class="block_one_article_atribut">
                                <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-eye-159604.png" width="20" />
                                <p>0</p>
                                <p>Просмотров</p>
                            </div>
                        </div>
                        <h3 itemprop="headline">
                            <?php the_title(); ?>
                        </h3>
                        <p itemprop="description">
                            <?php the_excerpt(); ?>
                        </p>
                        <div class="block_one_article_author">

                            <a href="<?php the_permalink() ?>" class="button_small">Подробнее ></a>
                            <p itemprop="author">Автор:
                                <?php the_author(); ?>
                            </p>
                        </div>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one" itemscope itemtype="http://schema.org/Blog">
        <h3 class="block_one_directorys_text" itemprop="description">СПРАВОЧНИКИ</h3>
        <div class="block_one_directorys">
            <?php
            $query = new WP_Query([
                'post_type' => 'directories',
                'posts_per_page' => 6,
                'orderby' => 'date',
                'order' => 'ASC',
            ]);
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
            ?>
                    <div class="block_one_directorys_block" itemprop="blogPosts">
                        <a href="<?php the_permalink() ?>" itemprop="image">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <p itemprop="headline">
                            <?php the_title(); ?>
                        </p>
                    </div>
            <?php endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="block_one">
    <div class="block_one_metrics">
        <div class="block_one_metrics_content">
            <?php

            $args = array(
                'role' => 'student_role',
                'fields' => 'ID',
            );

            $students_query = new WP_User_Query($args);
            $students_count = $students_query->get_total(); // Количество пользователей с ролью student_role
            ?>

            <div class="block_one_metric">
                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-students-3379882.png" width="48" onclick="articlesimg1()" id="picture1" />
                <p id="picturetext1">Наши ученики</p>
                <p class="block_one_metric_number"><?php echo $students_count; ?></p>
            </div>

            <?php
            // Получаем количество уникальных посетителей из базы данных
            $unique_visitors = get_option('unique_visitor_count', 0);
            ?>

            <div class="block_one_metric">
                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-user-3864799.png" width="48" onclick="articlesimg2()" id="picture2" />
                <p id="picturetext2">Количество посетителей</p>
                <p class="block_one_metric_number"><?php echo $unique_visitors; ?></p>
            </div>

            <?php
            $args = array(
                'role' => 'author_role',
                'fields' => 'ID',
            );

            $author_query = new WP_User_Query($args);
            $author_count = $author_query->get_total(); // Количество пользователей с ролью student_role
            ?>
            <div class="block_one_metric">
                <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-teacher-1995413.png" width="48" onclick="articlesimg3()" id="picture3" />
                <p id="picturetext3">Наши учителя</p>
                <p class="block_one_metric_number"><?php echo $author_count; ?></p>
            </div>
            <?php
            // Получаем количество записей типа 'themes'
            $post_count = wp_count_posts('themes')->publish; // Получаем количество опубликованных записей
            ?>

            <div class="block_one_metric">
                <img src="<?php echo get_template_directory_uri(); ?>/images/free-icon-topics-8776658.png" width="48" onclick="articlesimg4()" id="picture4" />
                <p id="picturetext4">Количество тем</p>
                <p class="block_one_metric_number"><?php echo $post_count; ?></p>
            </div>

        </div>
    </div>
</div>
<div class="block">
    <div class="block_one">
        <div class="block_one_sponsors_name">
            <h3>Наши партнеры</h3>
            <p>sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
        </div>
        <div class="block_one_sponsors">
            <?php
            if (is_active_sidebar('si-front-partners')) {
                dynamic_sidebar('si-front-partners');
            }
            ?>
        </div>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_contacts">
            <h3>Контакты</h3>
            <p>Расположение офиса на карте:</p>
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A471d902da183874ed523388edde0e5ee09d3987ab0a3c9067b9bbb98680f8d8b&amp;width=707&amp;height=372&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;

    function articlesimg1() {
        if (flag1) {
            document.getElementById("picturetext1").style.color = '#b9b73b';
            document.getElementById("picture1").style.background = '#b9b79b';
            flag1 = false;
        } else {
            document.getElementById("picturetext1").style.color = 'black';
            document.getElementById("picture1").style.background = '#b9b73b';
            flag1 = true;
        }
    }

    function articlesimg2() {
        if (flag2) {
            document.getElementById("picturetext2").style.color = '#b9b73b';
            document.getElementById("picture2").style.background = '#b9b79b';
            flag2 = false;
        } else {
            document.getElementById("picturetext2").style.color = 'black';
            document.getElementById("picture2").style.background = '#b9b73b';
            flag2 = true;
        }
    }

    function articlesimg3() {
        if (flag3) {
            document.getElementById("picturetext3").style.color = '#b9b73b';
            document.getElementById("picture3").style.background = '#b9b79b';
            flag3 = false;
        } else {
            document.getElementById("picturetext3").style.color = 'black';
            document.getElementById("picture3").style.background = '#b9b73b';
            flag3 = true;
        }
    }

    function articlesimg4() {
        if (flag4) {
            document.getElementById("picturetext4").style.color = '#b9b73b';
            document.getElementById("picture4").style.background = '#b9b79b';
            flag4 = false;
        } else {
            document.getElementById("picturetext4").style.color = 'black';
            document.getElementById("picture4").style.background = '#b9b73b';
            flag4 = true;
        }
    }
    $(document).ready(function() {
        var slides = $('.slide');
        var currentIndex = 0;
        var slideCount = slides.length;

        function showSlide(index) {
            $('.slides-container').css('transform', 'translateX(' + (-index * 100) + '%)');
            slides.removeClass('active');
            slides.eq(index).addClass('active');
        }

        $('.next').click(function() {
            currentIndex = (currentIndex + 1) % slideCount;
            showSlide(currentIndex);
        });

        $('.prev').click(function() {
            currentIndex = (currentIndex - 1 + slideCount) % slideCount;
            showSlide(currentIndex);
        });
    });
</script>