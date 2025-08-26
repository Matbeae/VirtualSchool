<?php /*Template Name: страница personroom*/ ?>
<?php get_header(); ?>
<style>
    .block_one {
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-end;
    }
    .block_one_theory_name {
        width: auto;
        margin-bottom: 0px;
    }
</style>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name">
            <?php the_title(); ?>
        <div class="block_one_person_edit">
            <a href="<?php echo esc_url(admin_url('profile.php')); ?>" class="edit-profile-button">Редактировать профиль</a>
        </div>
        </p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_personroom">
            <div class="block_one_person_top">
                <?php
                $current_user = wp_get_current_user();
                $user_login = $current_user->user_login;
                echo '<p>' . $user_login . '</p>';
                $user_roles = $current_user->roles;
                $roles_names = array(
                    'administrator' => 'Администратор',
                    'author_role' => 'Автор',
                    'student_role' => 'Ученик',
                );
                $user_role = array_shift($user_roles); // Получаем первую роль пользователя
                if (isset($roles_names[$user_role])) {
                    echo '<div class="block_one_person_status">' . $roles_names[$user_role] . '</div>';
                }
                ?>
            </div>
            <div class="block_one_person_top_number">
                <?php
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;

                $gender = get_user_meta($user_id, 'user_gender', true);
                $age = get_user_meta($user_id, 'user_age', true);

                $gender_map = array(
                    'male' => 'Мужской',
                    'female' => 'Женский'
                );

                // Проверяем, существует ли значение пола в массиве и выводим соответствующий текст
                if (isset($gender_map[$gender])) {
                    $gender_text = $gender_map[$gender];
                    echo '<p>Пол: ' . $gender_text . '</p>';
                }
                ?>
            </div>
            <div class="block_one_person_top_number">
                <?php echo '<p>Возраст: ' . $age . '</p>'; ?>
            </div>
            <div class="block_one_person_top_grade">
                <p>Оценки</p>
                <?php display_user_discipline_table() ?>
            </div>
            <div class="block_one_person_bottom">
                <p class="block_one_person_bottom_last">Избранные темы:</p>
                <div class="block_discipline_content_cards">
                    <?php
                    $user_id = get_current_user_id();
                    $favorites = get_user_meta($user_id, 'favorite_lessons', true);

                    if (!$favorites) {
                        echo 'У вас нет избранных уроков.';
                    } else {
                        // Группируем уроки по дисциплинам
                        $grouped_lessons = [];
                        foreach ($favorites as $lesson_id) {
                            $lesson = get_post($lesson_id);
                            $discipline = wp_get_post_terms($lesson_id, 'disciplines');
                            $discipline_name = $discipline ? $discipline[0]->name : 'Без дисциплины';

                            if (!isset($grouped_lessons[$discipline_name])) {
                                $grouped_lessons[$discipline_name] = [];
                            }
                            $grouped_lessons[$discipline_name][] = $lesson;
                        }

                        // Выводим избранные уроки, сгруппированные по дисциплинам
                        foreach ($grouped_lessons as $discipline => $lessons) {
                            echo '<h3>' . esc_html($discipline) . '</h3>';
                            echo '<ul>';

                            foreach ($lessons as $lesson) {
                                $lesson_id = $lesson->ID;
                                $is_favorite = in_array($lesson_id, $favorites) ? true : false;
                    ?>

                                <div class="block_discipline_content_card">
                                    <div class="block_discipline_content_card_up">
                                        <a href="<?php echo get_permalink($lesson_id); ?>" class="block_discipline_content_card_name"><?php echo esc_html($lesson->post_title); ?></a>

                                        <button class="add-to-favorites" data-lesson-id="<?php echo esc_attr($lesson_id); ?>" data-is-favorite="<?php echo esc_attr($is_favorite ? 'true' : 'false'); ?>">
                                            <!-- Иконка сердца -->
                                            <img class="heart-icon" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589197.png'); ?>" alt="Добавить в избранное">
                                            <img class="heart-icon favorited" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589054.png'); ?>" alt="Убрать из избранного">
                                        </button>
                                    </div>

                                    <div class="block_discipline_content_card_properties">
                                        <div class="block_discipline_content_card_time">
                                            <p>Дата добавления:</p>
                                            <p><?php echo get_the_time('Y.m.d', $lesson_id); ?></p> <!-- Дата публикации -->
                                            <p><?php echo get_the_time('H:i', $lesson_id); ?></p> <!-- Время публикации -->
                                        </div>
                                        <p class="author">Автор: <?php echo get_the_author_meta('display_name', $lesson->post_author); ?></p> <!-- Автор -->
                                    </div>

                                    <div class="descript">
                                        <p><?php echo get_the_excerpt($lesson_id); ?></p> <!-- Описание (отрывок) -->
                                    </div>
                                </div>
                    <?php
                            }
                            echo '</ul>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
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