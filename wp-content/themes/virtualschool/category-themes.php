<?php /*Template Name: страница themes*/ ?>
<?php get_header(); ?>
<div class="block">
    <div class="block_discipline">
        <?php get_sidebar(); ?>
        <div class="block_discipline_content">
            <div class="block_discipline_content_width">
                <div class="block_discipline_content_name">
                    <p>Теория</p>
                    <form id="sort-form">
                        <label for="sort">Сортировка:</label>
                        <select id="sort" name="sort">
                            <option value="new" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'new' ? 'selected' : ''; ?>>Сначала новые</option>
                            <option value="old" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'old' ? 'selected' : ''; ?>>Сначала старые</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="block_discipline_content_cards" id="filtered-results">
                <?php
                $args = [
                    'post_type' => 'themes',
                    'posts_per_page' => -1,
                ];

                // Определяем порядок сортировки в зависимости от выбранного параметра
                if (isset($_GET['sort']) && $_GET['sort'] === 'old') {
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC'; // Сначала старые
                } else {
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC'; // Сначала новые
                }
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $args['s'] = sanitize_text_field($_GET['search']);
                }
                if (isset($_GET['filters']) && !empty($_GET['filters'])) {
                    $filters = $_GET['filters'];
                    $args['tax_query'] = [
                        'relation' => 'OR',
                    ];

                    foreach ($filters as $filter) {
                        if (is_numeric($filter)) {
                            // Для таксономии 'disciplines'
                            $args['tax_query'][] = [
                                'taxonomy' => 'disciplines',
                                'field' => 'id',
                                'terms' => $filter,
                                'operator' => 'IN',
                            ];
                        } elseif ($filter === 'official') {
                            $args['author'] = 1;  // ID администратора для официальной теории
                        } elseif ($filter === 'authors') {
                            $args['author__not_in'] = [1];  // Исключаем администратора, оставляем авторов
                        }
                    }
                }
                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();
                ?>
                        <div class="block_discipline_content_card">
                            <div class="block_discipline_content_card_up">
                                <a href="<?php the_permalink() ?>" class="block_discipline_content_card_name"><?php the_title(); ?></a>
                                <?php
                                $lesson_id = get_the_ID();
                                $user_id = get_current_user_id();
                                $favorites = get_user_meta($user_id, 'favorite_lessons', true);

                                // Проверяем, находится ли урок в избранном
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
                                    <p><?php the_time('Y.m.d'); ?></p>
                                    <p><?php the_time('H:i'); ?></p>
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
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const sortSelect = document.getElementById('sort');
        const filters = document.querySelectorAll('.filter');
        const searchInput = document.getElementById('themes-search');

        function updateResults() {
            const selectedSort = sortSelect.value;
            const selectedFilters = [];
            const searchQuery = searchInput.value;

            filters.forEach((filter) => {
                if (filter.checked) {
                    selectedFilters.push(filter.value);
                }
            });

            // Формируем строку параметров
            const params = new URLSearchParams(window.location.search);
            params.set('sort', selectedSort);
            params.set('search', searchQuery);

            // Добавляем все выбранные фильтры
            selectedFilters.forEach((filter) => {
                params.append('filters[]', filter);
            });

            // Отправка AJAX-запроса
            fetch("<?php echo get_permalink(); ?>?" + params.toString(), {
                    method: 'GET',
                })
                .then(response => response.text())
                .then(html => {
                    // Извлекаем только блок с контентом, чтобы обновить его
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");
                    const newContent = doc.querySelector('.block_discipline_content_cards').innerHTML;
                    document.querySelector('.block_discipline_content_cards').innerHTML = newContent;
                })
                .catch(error => console.error('Ошибка при обновлении контента:', error));
        }

        // Слушаем изменения на сортировке, фильтрах и поиске
        sortSelect.addEventListener('change', updateResults);
        filters.forEach((filter) => {
            filter.addEventListener('change', updateResults);
        });
        searchInput.addEventListener('input', updateResults);
    });
</script>