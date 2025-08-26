<?php /*Template Name: страница discipline*/ ?>
<?php get_header(); ?>
<style>
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

    .button_small {
        border: none;
        display: block;
        margin: auto;
        margin-top: 25px;
    }

    .search {
        min-width: 100px;
        max-width: 170px;
    }
</style>
<div class="block">
    <div class="block_discipline">
        <div class="sidebar">
            <p class="sidebar_name">Фильтры</p>
            <form method="get" action="">
                <div class="sidebar_properties">
                    <p class="sidebar_properties_name">Тип теории</p>
                    <div class="sidebar_line"></div>
                    <div class="check">
                        <input type="checkbox" id="official" name="author_filter_admin" value="admin" <?php checked(isset($_GET['author_filter_admin'])); ?> />
                        <label for="official">Официальная</label>
                    </div>
                    <div class="check">
                        <input type="checkbox" id="authors" name="author_filter_other" value="other" <?php checked(isset($_GET['author_filter_other'])); ?> />
                        <label for="authors">Авторская</label>
                    </div>
                    <input type="hidden" name="sort" value="<?php echo isset($_GET['sort']) ? esc_attr($_GET['sort']) : 'new'; ?>" />
                    <input class="button_small" type="submit" value="Применить">
                </div>
            </form>
            <div class="sidebar_properties">
                <p class="sidebar_properties_name">Поиск</p>
                <input class="search" type="text" id="themes-search" placeholder="Поиск" autocomplete="off">
            </div>
        </div>
        <div class="block_discipline_content">
            <div class="block_discipline_content_width">
                <div class="block_discipline_content_name">
                    <p>
                        <?php single_term_title(); ?>
                    </p>
                    <form method="get">
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
                $taxonomy = get_queried_object();
                $category_name = $taxonomy->slug;
                $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'new';
                $filter_admin = isset($_GET['author_filter_admin']);
                $filter_other = isset($_GET['author_filter_other']);
                $args = array(
                    'post_type' => 'themes',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'disciplines',
                            'field' => 'slug',
                            'terms' => $category_name,
                        ),
                    ),
                );
                if ($sort_order === 'new') {
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                } else {
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                }
                if ($filter_admin && !$filter_other) {
                    // Только администратор
                    $args['author'] = 1; // ID администратора
                } elseif ($filter_other && !$filter_admin) {
                    // Только другие пользователи
                    $args['author__not_in'] = array(1); // Исключаем администратора
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
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);

        // Восстанавливаем состояние чекбоксов
        const officialCheckbox = document.getElementById('official');
        const authorsCheckbox = document.getElementById('authors');

        if (urlParams.has('author_filter_admin')) {
            officialCheckbox.checked = true;
        }
        if (urlParams.has('author_filter_other')) {
            authorsCheckbox.checked = true;
        }

        // Сортировка
        const sortSelect = document.getElementById('sort');
        const currentSort = urlParams.get('sort') || 'new';
        sortSelect.value = currentSort; // Устанавливаем текущее значение сортировки

        // Обработчик сортировки
        sortSelect.addEventListener('change', function() {
            const selectedSort = sortSelect.value;
            const currentUrl = new URL(window.location.href);

            // Устанавливаем параметры сортировки и сохраняем другие параметры
            currentUrl.searchParams.set('sort', selectedSort);
            window.location.href = currentUrl.toString();
        });
    });

    document.getElementById('themes-search').addEventListener('input', function() {
        const searchQuery = this.value;
        const categorySlug = '<?php echo $category_name; ?>';

        // Проверяем состояние чекбоксов для авторов
        const authorFilterAdmin = document.getElementById('official').checked ? 'admin' : '';
        const authorFilterOther = document.getElementById('authors').checked ? 'other' : '';

        // Получаем выбранный параметр сортировки
        const sortSelect = document.getElementById('sort');
        const selectedSort = sortSelect.value;

        const url = new URL('<?php echo admin_url("admin-ajax.php"); ?>');
        url.searchParams.set('action', 'search_themes');
        url.searchParams.set('query', searchQuery);
        url.searchParams.set('category', categorySlug);
        if (authorFilterAdmin) url.searchParams.set('author_filter_admin', authorFilterAdmin);
        if (authorFilterOther) url.searchParams.set('author_filter_other', authorFilterOther);
        url.searchParams.set('sort', selectedSort); // Передача параметра сортировки

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const resultsContainer = document.querySelector('.block_discipline_content_cards');
                resultsContainer.innerHTML = '';

                data.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'block_discipline_content_card';
                    card.innerHTML = `
                    <a href="${item.link}" class="block_discipline_content_card_name">${item.title}</a>
                    <div class="block_discipline_content_card_properties">
                        <div class="block_discipline_content_card_time">
                            <p>Дата добавления:</p>
                            <p>${item.date}</p>
                            <p>${item.time}</p>
                        </div>
                        <p class="author">Автор: ${item.author}</p>
                    </div>
                    <div class="descript">
                        <p>${item.excerpt}</p>
                    </div>
                `;
                    resultsContainer.appendChild(card);
                });
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