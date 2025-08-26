<?php /*Template Name: страница authorteory*/ ?>
<?php get_header(); ?>
<div class="block">
    <div class="block_discipline">
        <div class="sidebar">
            <p class="sidebar_name">Фильтры</p>
            <div class="sidebar_properties">
                <p class="sidebar_properties_name">Категории</p>
                <div class="sidebar_line"></div>
                <?php
                $taxonomy = 'disciplines';
                $terms = get_terms(
                    array(
                        'taxonomy' => $taxonomy,
                        'hide_empty' => false,
                    )
                );
                // Получаем выбранные дисциплины из URL
                $selected_terms = isset($_GET['disciplines']) ? explode(',', $_GET['disciplines']) : [];
                foreach ($terms as $term) :
                    $is_checked = in_array($term->term_id, $selected_terms) ? 'checked' : '';
                ?>
                    <div class="check">
                        <input type="checkbox" id="discipline-<?php echo $term->term_id; ?>"
                            name="disciplines[]" value="<?php echo $term->term_id; ?>"
                            <?php echo $is_checked; ?> />
                        <label for="discipline-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="block_discipline_content">
            <div class="block_discipline_content_width">
                <div class="block_discipline_content_name">
                    <p><?php the_title(); ?></p>
                    <form>
                        <label for="sort">Сортировка:</label>
                        <select id="sort" name="sort">
                            <option value="new" <?php selected('new', isset($_GET['sort']) ? $_GET['sort'] : ''); ?>>Сначала новые</option>
                            <option value="old" <?php selected('old', isset($_GET['sort']) ? $_GET['sort'] : ''); ?>>Сначала старые</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="block_discipline_content_cards">
                <?php
                // Получаем выбранные дисциплины из URL
                $selected_terms = isset($_GET['disciplines']) ? explode(',', $_GET['disciplines']) : [];

                // Параметры запроса
                $author_ids = get_users(array('role' => 'author_role', 'fields' => 'ID'));
                $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'new';
                $args = array(
                    'post_type' => 'themes',
                    'posts_per_page' => -1,
                    'author__in' => $author_ids,
                );
                if ($selected_terms) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'disciplines',
                            'field' => 'id',
                            'terms' => $selected_terms,
                            'operator' => 'IN',
                        ),
                    );
                }
                if ($sort_order === 'new') {
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                } else {
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                }

                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post(); ?>
                        <div class="block_discipline_content_card">
                            <div class="block_discipline_content_card_up">
                                <a href="<?php the_permalink() ?>" class="block_discipline_content_card_name">
                                    <?php the_title(); ?>
                                </a>
                                <?php
                                $lesson_id = get_the_ID();
                                $user_id = get_current_user_id();
                                $favorites = get_user_meta($user_id, 'favorite_lessons', true);

                                if (!is_array($favorites)) {
                                    $favorites = array();  // Если нет массива, создаём пустой массив
                                }

                                $is_favorite = in_array($lesson_id, $favorites) ? true : false;

                                ?>

                                <button class="add-to-favorites" data-lesson-id="<?php echo esc_attr($lesson_id); ?>" data-is-favorite="<?php echo esc_attr($is_favorite ? 'true' : 'false'); ?>">
                                    <!-- Иконка сердца -->
                                    <img class="heart-icon" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589197.png'); ?>" alt="Добавить в избранное">
                                    <img class="heart-icon favorited" src="<?php echo esc_url(get_template_directory_uri() . '/images/free-icon-heart-2589054.png'); ?>" alt="Убрать из избранного">
                                </button>
                            </div>
                            <div class="block_discipline_content_card_properties">
                                <div class="block_discipline_content_card_time">
                                    <p>Дата добавления:</p>
                                    <p>
                                        <?php the_time('Y.m.d'); ?>
                                    </p>
                                    <p>
                                        <?php the_time('H:i'); ?>
                                    </p>
                                </div>
                                <p class="author">Автор: <?php the_author(); ?></p>
                            </div>
                            <div class="descript">
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                <?php endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    const checkboxes = document.querySelectorAll('input[name="disciplines[]"]');
    const sortSelect = document.getElementById('sort');

    // Слушаем изменения в чекбоксах и сортировке
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });

    sortSelect.addEventListener('change', function() {
        updateFilters();
    });

    // Функция для обновления фильтров
    function updateFilters() {
        const selectedDisciplines = [];
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedDisciplines.push(checkbox.value);
            }
        });

        const selectedSort = sortSelect.value;
        const currentUrl = new URL(window.location.href);

        // Обновляем параметры фильтрации и сортировки
        currentUrl.searchParams.set('sort', selectedSort);
        if (selectedDisciplines.length > 0) {
            currentUrl.searchParams.set('disciplines', selectedDisciplines.join(','));
        } else {
            currentUrl.searchParams.delete('disciplines');
        }

        // Перенаправляем на новый URL
        window.location.href = currentUrl.toString();
    }
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