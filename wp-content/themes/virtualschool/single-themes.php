<?php /*Template Name: страница theory*/ ?>
<?php get_header(); ?>
<style>
    .add-to-favorites {
        margin-bottom: -115px;
    }

    .heart-icon {
        width: 34px;
        height: 34px;
    }
</style>
<div class="block">
    <div class="block_one_re">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
        <?php
        $lesson_id = get_the_ID();
        $user_id = get_current_user_id();
        $favorites = get_user_meta($user_id, 'favorite_lessons', true);

        if (!is_array($favorites)) {
            $favorites = array(); // Если нет, то инициализируем как пустой массив
        }

        // Проверяем, находится ли урок в избранном
        $is_favorite = in_array($lesson_id, $favorites) ? true : false;
        ?>

        <button class="add-to-favorites" data-lesson-id="<?php echo esc_attr($lesson_id); ?>" data-is-favorite="<?php echo esc_attr($is_favorite ? 'true' : 'false'); ?>">
            <!-- Иконка сердца -->
            <img class="heart-icon" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589197.png'); ?>" alt="Добавить в избранное">
            <img class="heart-icon favorited" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589054.png'); ?>" alt="Убрать из избранного">
        </button>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_theory">
            <?php the_content(); ?>
            <?php $file_link = get_post_meta(get_the_ID(), 'file_from_author', true);
            if ($file_link) {
            ?>
                <div class="file_download">
                    <div class="file_download_column">
                        <p>Автор оставил для Вас подарок!</p>
                        <button class="button_small" style="background-color: #585898; border: none;" id="startTimer">Начать загрузку</button>
                        <p id="countdown"></p>
                        <?php
                        echo '<a class="button_small" id="downloadLink" style="display: none;" href="' . $file_link . '">Скачать файл</a>';
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php $test_link = get_post_meta(get_the_ID(), 'lesson_test_link', true);
        if ($test_link) {
            echo '<a class="button" href="' . $test_link . '">Пройти тест</a>';
        }
        ?>
        <div class="author_signature">
            <?php echo get_avatar(get_post_field('post_author', get_the_ID()), 32); ?>
            <p>Автор: <?php echo get_the_author_meta('display_name', get_post_field('post_author', get_the_ID())); ?></p>
            <p>Опубликовано: <?php echo get_the_date('j F Y, H:i'); ?></p>
        </div>
        <div class="comments_block">
            <?php
            // Если комментарии разрешены или уже есть комментарии, выводим секцию комментариев.
            if (comments_open() || get_comments_number()) :
            ?>
                <div class="empty"></div>
            <?php
                comments_template();
            endif;
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    $(document).ready(function() {
        $("#startTimer").on("click", function() {
            var count = 7;
            var counter = setInterval(timer, 1000);

            function timer() {
                count = count - 1;
                if (count <= 0) {
                    clearInterval(counter);
                    $("#countdown").fadeOut('slow').hide();
                    $("#startTimer").fadeOut('slow').hide();
                    $("#downloadLink").fadeIn('slow').show();
                    return;
                }
                $("#countdown").text("Осталось времени: " + count + " секунд");
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.add-to-favorites');

        buttons.forEach((button) => {
            const lessonId = button.getAttribute('data-lesson-id');
            const heartIcon = button.querySelectorAll('.heart-icon');
            let isFavorite = localStorage.getItem('favorite_lesson_' + lessonId) === 'true'; // Получаем состояние из localStorage

            // Обновляем иконки на основе состояния
            if (isFavorite) {
                heartIcon[1].style.display = 'block'; // Показываем красное сердце
                heartIcon[0].style.display = 'none'; // Скрываем пустое сердце
            } else {
                heartIcon[1].style.display = 'none'; // Скрываем красное сердце
                heartIcon[0].style.display = 'block'; // Показываем пустое сердце
            }

            // Обработчик клика на кнопку
            button.addEventListener('click', () => {
                // Изменяем состояние кнопки
                if (isFavorite) {
                    heartIcon[1].style.display = 'none';
                    heartIcon[0].style.display = 'block';
                    isFavorite = false;
                    localStorage.setItem('favorite_lesson_' + lessonId, 'false'); // Сохраняем в localStorage
                } else {
                    heartIcon[1].style.display = 'block';
                    heartIcon[0].style.display = 'none';
                    isFavorite = true;
                    localStorage.setItem('favorite_lesson_' + lessonId, 'true'); // Сохраняем в localStorage
                }

                // Отправляем запрос на сервер для обновления состояния избранного
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=toggle_favorite_lesson&lesson_id=${lessonId}`,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert(data.message); // Ошибка на сервере
                        }
                    })
                    .catch(error => console.error('Ошибка:', error));
            });
        });
    });
</script>