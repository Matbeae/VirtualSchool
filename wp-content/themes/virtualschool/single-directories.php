<?php /*Template Name: страница directory*/ ?>
<?php get_header(); ?>
<style>
    /* Стилизация декоративных "radio-кнопок" */
    .radio-option {
        display: block;
        margin-bottom: 5px;
        cursor: pointer;
        width: 100%;
    }

    .radio-option a {
        text-decoration: none;
        color: black;
        display: inline-block;
        width: 100%;
        padding: 5px;
    }

    /* Стилизация внешнего вида для выбранных элементов */
    .radio-option.selected {
        background-color: #7e92c8;
        border-radius: 2px;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }

    .block {
        flex: 1;
    }

    footer {
        flex-shrink: 0;
    }
</style>
<div class="block">
    <div class="block_discipline">
        <div class="sidebar">
            <div class="sidebar_properties">
                <?php
                $query = new WP_Query([
                    'post_type' => 'directories',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                ]);
                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                ?>
                        <div class="block_one_answers_one">
                            <div class="radio-option" id="<?php the_title(); ?>">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <div class="block_discipline_content">
            <div class="block_discipline_content_width">
                <div class="block_discipline_content_name">
                    <p class="title"><?php the_title(); ?></p>
                </div>
            </div>
            <div class="block_discipline_content_cards">
                <div class="block_one_theory">
                    <table>
                        <tr>
                            <td class="block_one_theory_text">
                                <?php the_content(); ?>
                            </td>
                            <td class="block_one_directory_img" valign="top">
                                <?php the_post_thumbnail(array(250, 250)); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Получаем заголовок страницы
        const pageTitle = document.querySelector('p.title'); // Замените селектор на подходящий для вашей темы

        if (pageTitle) {
            const pageTitleText = pageTitle.innerText || pageTitle.textContent;

            // Находим все элементы с классом .radio-option
            const radioOptions = document.querySelectorAll('.sidebar .radio-option');

            // Проходимся по всем элементам .radio-option
            radioOptions.forEach(function(option) {
                // Получаем ID элемента из его атрибута id
                const optionId = option.getAttribute('id');

                // Сравниваем ID с заголовком страницы
                if (optionId === pageTitleText) {
                    option.classList.add('selected'); // Добавляем класс, если найдено совпадение
                }
            });
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const options = document.querySelectorAll('.sidebar_properties .radio-option');

        options.forEach(function(option) {
            option.addEventListener('click', function() {
                const selected = document.querySelector('.sidebar_properties .radio-option.selected');
                if (selected) {
                    selected.classList.remove('selected');
                }
                this.classList.add('selected');
            });
        });
    });
</script>