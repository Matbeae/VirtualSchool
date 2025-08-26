<?php
function add_theme_codes()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', 'all');
}
add_action('wp_enqueue_scripts', 'add_theme_codes');

if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}
add_action('after_setup_theme', 'si_setup');
function si_setup()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

$widgets = [
    'widget-social.php',
    'widget-contact.php',
    'widget-partners.php',
];
foreach ($widgets as $w) {
    require_once(__DIR__ . '/inc/' . $w);
}
function si_register()
{
    register_sidebar([
        'name' => 'Сайдбар в футере социальные иконки',
        'id' => 'si-footer-social',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_widget('si_widget_social');
    register_sidebar([
        'name' => 'Сайдбар в хэдере контакты',
        'id' => 'si-header-contact',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_widget('si_widget_contact');
    register_sidebar([
        'name' => 'Сайдбар на главной партнеры',
        'id' => 'si-front-partners',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_widget('si_widget_partner');
}
add_action('widgets_init', 'si_register');

add_action('init', 'si_register_types');
function si_register_types()
{
    register_post_type('articles', [
        'labels' => [
            'name' => 'Статьи',
            'singular_name' => 'Статьи',
            'add_new' => 'Добавить новую статью',
            'add_new_item' => 'Добавить новую статью',
            'edit_item' => 'Редактировать статью',
            'new_item' => 'Новая статья',
            'view_item' => 'Смотреть статьи',
            'search_items' => 'Искать статьи',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Статьи',
        ],
        'public' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-welcome-write-blog',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'time', 'excerpt', 'permalink', 'author', 'custom-fields', 'comments'],
        'has_archive' => true,
        'taxonomies' => ['post_tag'],
    ]);
    register_taxonomy('disciplines', ['themes'], [
        'labels' => [
            'name' => 'Дисциплины',
            'singular_name' => 'Дисциплины',
            'add_new_item' => 'Добавить дисциплину',
            'edit_item' => 'Редактировать дисциплину',
            'new_item_name' => 'Добавить дисциплину',
            'view_item' => 'Смотреть дисциплины',
            'search_items' => 'Искать дисциплину',
            'menu_name' => 'Все дисциплины',
            'all_items' => 'Все дисциплины',
            'update_item' => 'Обновить',
        ],
        'description' => '',
        'public' => true,
        'hierarchical' => true,
        'supports' => ['thumbnail'],
        'show_admin_column' => true,
        'show_in_rest' => true,
    ]);
    register_post_type('themes', [
        'labels' => [
            'name' => 'Темы',
            'singular_name' => 'Темы',
            'add_new' => 'Добавить новую тему',
            'add_new_item' => 'Добавить новую тему',
            'edit_item' => 'Редактировать тему',
            'new_item' => 'Новая тема',
            'view_item' => 'Смотреть темы',
            'search_items' => 'Искать темы',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Темы',
        ],
        'public' => true,
        'menu_position' => 22,
        'menu_icon' => 'dashicons-text',
        'hierarchical' => false,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'time', 'excerpt', 'permalink', 'author', 'custom-fields', 'comments'],
        'has_archive' => true,
    ]);
    register_post_type('directories', [
        'labels' => [
            'name' => 'Справочники',
            'singular_name' => 'Справочники',
            'add_new' => 'Добавить новый справочник',
            'add_new_item' => 'Добавить новый справочник',
            'edit_item' => 'Редактировать справочник',
            'new_item' => 'Новый справочник',
            'view_item' => 'Смотреть справочники',
            'search_items' => 'Искать справочники',
            'not_found' => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon' => '',
            'menu_name' => 'Справочники',
        ],
        'public' => true,
        'menu_position' => 22,
        'menu_icon' => 'dashicons-list-view',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'time', 'excerpt', 'permalink', 'author', 'custom-fields', 'comments'],
        'has_archive' => true,
    ]);
}
add_action('wp_enqueue_scripts', 'scripts_method');
function scripts_method()
{
    wp_enqueue_script('calculator-progress', get_template_directory_uri() . '/js/calculator-progress.js');
    wp_enqueue_script('calculator-training', get_template_directory_uri() . '/js/calculator-training.js');
    wp_enqueue_script('calculator-admission', get_template_directory_uri() . '/js/calculator-admission.js');
    wp_enqueue_script('chat', get_template_directory_uri() . '/js/chat.js');
}
function my_scripts()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', false, '3.7.1', true);
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'my_scripts');

// Добавление миниатюр для таксономии
function custom_taxonomy_thumbnail()
{
    $taxonomy = 'disciplines';

    // Показать поле для загрузки миниатюры на странице редактирования таксономии
?>
    <div class="form-field">
        <label for="term-thumbnail">Изображение</label>
        <input type="text" name="term-thumbnail" id="term-thumbnail" class="term-thumbnail-field" value="" />
        <p class="description">Загрузите изображение для этой категории.</p>
    </div>
<?php
}
add_action('disciplines_add_form_fields', 'custom_taxonomy_thumbnail', 10, 2);

// Сохранение значения миниатюры для таксономии
function save_custom_taxonomy_thumbnail($term_id)
{
    if (isset($_POST['term-thumbnail'])) {
        $thumbnail = $_POST['term-thumbnail'];
        add_term_meta($term_id, 'thumbnail', $thumbnail, true);
    }
}
add_action('created_disciplines', 'save_custom_taxonomy_thumbnail', 10, 2);
add_action('edited_disciplines', 'save_custom_taxonomy_thumbnail', 10, 2);

// Отображение миниатюр на странице администрирования
function display_custom_taxonomy_thumbnail($term)
{
    $thumbnail = get_term_meta($term->term_id, 'thumbnail', true);
?>
    <tr class="form-field">
        <th scope="row"><label for="term-thumbnail">Изображение</label></th>
        <td>
            <?php if ($thumbnail) : ?>
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($term->name); ?>" style="max-width: 100px; height: auto;" /><br />
            <?php else : ?>
                <span>Нет изображения</span><br />
            <?php endif; ?>
            <input type="text" name="term-thumbnail" id="term-thumbnail" value="<?php echo esc_attr($thumbnail); ?>" />
            <p class="description">Загрузите изображение для этой категории.</p>
        </td>
    </tr>
<?php
}
add_action('disciplines_edit_form_fields', 'display_custom_taxonomy_thumbnail', 10, 2);

// Обновление значения миниатюры для таксономии "type"
function update_custom_taxonomy_thumbnail($term_id)
{
    if (isset($_POST['term-thumbnail'])) {
        $thumbnail = $_POST['term-thumbnail'];
        update_term_meta($term_id, 'thumbnail', $thumbnail);
    }
}
add_action('edited_disciplines', 'update_custom_taxonomy_thumbnail', 10, 2);
add_action('user_register', 'custom_registration_role', 10, 1);
function custom_registration_role($user_id)
{
    if (isset($_POST['user_role'])) {
        $user_role = $_POST['user_role'];
        $user = new WP_User($user_id);

        // Проверяем выбранную роль и назначаем ее пользователю
        if ($user_role === 'student') {
            $user->set_role('student_role');
        } elseif ($user_role === 'author') {
            $user->set_role('author_role');
        }
    }
}
add_action('after_setup_theme', 'create_custom_roles');
function create_custom_roles()
{
    remove_role('author');
    remove_role('basic_contributor');
    remove_role('author_role');
    remove_role('student_role');
    add_role('student_role', 'Ученик', array(
        'read' => true,
    ));
    add_role(
        'author_role',
        'Автор',
        [
            'read'         => true,  // true разрешает эту возможность
            'edit_posts'   => true,  // true разрешает редактировать посты
            'upload_files' => true,  // может загружать файлы
        ]
    );
}

add_action('user_register', 'save_user_registration_data', 10, 1);
function save_user_registration_data($user_id)
{
    if (isset($_POST['user_gender'])) {
        update_user_meta($user_id, 'user_gender', $_POST['user_gender']);
    }
    if (isset($_POST['user_age'])) {
        update_user_meta($user_id, 'user_age', $_POST['user_age']);
    }
}
add_action('show_user_profile', 'show_extra_user_profile_fields');
add_action('edit_user_profile', 'show_extra_user_profile_fields');
function show_extra_user_profile_fields($user)
{
    $gender = get_user_meta($user->ID, 'user_gender', true);
    $age = get_user_meta($user->ID, 'user_age', true);
?>
    <table class="form-table">
        <tr>
            <th><label for="user_gender">Пол</label></th>
            <td>
                <input type="radio" name="user_gender" value="male" <?php checked($gender, 'male'); ?>> Мужской
                <input type="radio" name="user_gender" value="female" <?php checked($gender, 'female'); ?>> Женский
            </td>
        </tr>
        <tr>
            <th><label for="user_age">Возраст</label></th>
            <td>
                <input type="text" name="user_age" value="<?php echo $age ?>">
            </td>
        </tr>
    </table>
<?php
}

add_action('personal_options_update', 'save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'save_extra_user_profile_fields');
function save_extra_user_profile_fields($user_id)
{
    if (current_user_can('edit_user', $user_id)) {
        if (isset($_POST['user_gender'])) {
            update_user_meta($user_id, 'user_gender', $_POST['user_gender']);
        }
        if (isset($_POST['user_age'])) {
            update_user_meta($user_id, 'user_age', $_POST['user_age']);
        }
    }
}
function taxonomy_term_search_ajax_handler()
{
    // Получаем введенный запрос
    $query = sanitize_text_field($_POST['query']);

    // Параметры для получения термина таксономии
    $args = array(
        'taxonomy' => 'disciplines', // Таксономия
        'hide_empty' => false,          // Показать и пустые термины 
    );

    // Если запрос не пустой, добавляем параметр 'name__like' для поиска
    if (!empty($query)) {
        $args['name__like'] = $query;
    }

    $terms = get_terms($args);

    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $term_link = get_term_link($term);
            $thumbnail_url = get_term_meta($term->term_id, 'thumbnail', true);
            echo '<div class="block_education_card_disciplines" itemscope itemtype="http://schema.org/BlogPosting">
                        <a itemprop="url" href="' . esc_url($term_link) . '" class="block_education_card_img_disciplines">
                            <img class="block_education_card_img_primary" src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($term->name) . '" />
                        </a>
                        <a itemprop="headline" href="' . esc_url($term_link) . '" class="block_education_card_text">
                            ' . $term->name . '
                        </a>
                    </div>';
        }
    } else {
        echo 'Категорий не найдено';
    }

    wp_die();
}
add_action('wp_ajax_taxonomy_term_search', 'taxonomy_term_search_ajax_handler');
add_action('wp_ajax_nopriv_taxonomy_term_search', 'taxonomy_term_search_ajax_handler');

add_filter('excerpt_length', function () {
    return 20;
});

add_action('wp_ajax_search_themes', 'search_themes');
add_action('wp_ajax_nopriv_search_themes', 'search_themes');

function search_themes()
{
    $query = sanitize_text_field($_GET['query']);
    $category_slug = sanitize_text_field($_GET['category']);
    $sort_order = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'new'; // Получаем сортировку
    $author_filter_admin = isset($_GET['author_filter_admin']) && $_GET['author_filter_admin'] === 'admin';
    $author_filter_other = isset($_GET['author_filter_other']) && $_GET['author_filter_other'] === 'other';
    $admin_user_id = 1; // ID администратора

    $args = array(
        'post_type' => 'themes',
        's' => $query,
        'tax_query' => array(
            array(
                'taxonomy' => 'disciplines',
                'field' => 'slug',
                'terms' => $category_slug,
            ),
        ),
    );

    // Применение фильтров по автору
    if ($author_filter_admin && !$author_filter_other) {
        $args['author'] = $admin_user_id;
    } elseif ($author_filter_other && !$author_filter_admin) {
        $args['author__not_in'] = array($admin_user_id);
    }

    // Сортировка
    if ($sort_order === 'new') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } else {
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
    }

    // Выполнение запроса
    $search_query = new WP_Query($args);

    $results = array();
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
                'date' => get_the_date('Y.m.d'),
                'time' => get_the_time('H:i'),
                'author' => get_the_author(),
                'excerpt' => get_the_excerpt(),
            );
        }
    }
    wp_reset_postdata();

    wp_send_json($results);
}

add_filter('get_comment_author_link', 'add_user_role_to_comment_author');

function add_user_role_to_comment_author($author_link)
{
    $comment = get_comment(); // Получаем объект комментария
    $user = get_user_by('ID', $comment->user_id); // Получаем пользователя по ID

    if ($user && !empty($user->roles)) {
        $role = $user->roles[0]; // Получаем первую роль
        // Переводим роль на русский
        switch ($role) {
            case 'administrator':
                $role = 'Администратор';
                break;
            case 'author_role':
                $role = 'Учитель';
                break;
            case 'student_role':
                $role = 'Ученик';
                break;
        }

        // Возвращаем ссылку с ролью
        $author_link .= ' <span class="comment-author-role">(' . esc_html($role) . ')</span>';
    }

    return $author_link; // Возвращаем изменённую ссылку
}
function custom_user_profile_avatar_field($user)
{
    // Убедимся, что у нас есть ID пользователя
    $user_id = is_object($user) ? $user->ID : (int) $user;
    $custom_avatar_url = get_user_meta($user_id, 'custom_avatar', true);
?>
    <table class="form-table">
        <tr>
            <th><label for="custom_avatar"><?php _e("Custom Avatar URL", "your_text_domain"); ?></label></th>
            <td>
                <!-- Поле для ввода кастомного URL аватара -->
                <input type="text" name="custom_avatar" id="custom_avatar" value="<?php echo esc_attr($custom_avatar_url); ?>" class="regular-text" />
                <p class="description"><?php _e("Enter the URL for your custom avatar."); ?></p>

                <!-- Предварительный просмотр кастомного аватара, если он задан -->
                <?php if ($custom_avatar_url): ?>
                    <h4><?php _e("Preview of Custom Avatar"); ?></h4>
                    <img src="<?php echo esc_url($custom_avatar_url); ?>" alt="<?php esc_attr_e('Custom Avatar Preview'); ?>" width="96" height="96" style="border-radius:50%;" />
                <?php endif; ?>
            </td>
        </tr>
    </table>
<?php
}
add_action('user_profile_picture_description', 'custom_user_profile_avatar_field');



function save_custom_user_profile_fields($user_id)
{
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'custom_avatar', sanitize_text_field($_POST['custom_avatar']));
    }
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');

function custom_get_avatar($avatar, $id_or_email, $size, $default, $alt)
{
    $user_id = '';

    // Определяем ID пользователя
    if (is_numeric($id_or_email)) {
        $user_id = (int) $id_or_email;
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user_id = $id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        $user_id = $user ? $user->ID : null;
    }

    // Проверяем наличие кастомного аватара
    if ($user_id) {
        $custom_avatar_url = get_user_meta($user_id, 'custom_avatar', true);

        // Если кастомный аватар задан, возвращаем его HTML
        if ($custom_avatar_url) {
            return '<img src="' . esc_url($custom_avatar_url) . '" alt="' . esc_attr($alt) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" />';
        }
    }

    // Если кастомный аватар не найден, возвращаем стандартный аватар
    return $avatar;
}
add_filter('get_avatar', 'custom_get_avatar', 10, 5);

function track_post_views($post_id)
{
    if (!is_single()) return;

    $views = get_post_meta($post_id, 'post_views_count', true);
    $views = $views ? $views + 1 : 1;
    update_post_meta($post_id, 'post_views_count', $views);
}
add_action('wp_head', function () {
    if (is_single()) {
        global $post;
        track_post_views($post->ID);
    }
});

function quiz_block_localize_script()
{
    wp_localize_script('quiz-checker', 'wpApiSettings', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'user_id'  => get_current_user_id(), // Получаем ID текущего пользователя
    ]);
}

add_action('wp_enqueue_scripts', 'quiz_block_localize_script');

function handle_update_user_test_results()
{
    // Проверка данных для безопасности
    if (!isset($_POST['user_id']) || !isset($_POST['test_id']) || !isset($_POST['score']) || !isset($_POST['grade'])) {
        wp_send_json_error(['message' => 'Неверные данные']);
    }

    $user_id = intval($_POST['user_id']);
    $test_id = intval($_POST['test_id']);
    $score = intval($_POST['score']);
    $grade = intval($_POST['grade']);

    // Получаем текущие результаты пользователя
    $user_tests = get_user_meta($user_id, 'user_tests_results', true);

    if (empty($user_tests)) {
        $user_tests = [];
    }

    // Проверка, был ли уже пройден этот тест
    foreach ($user_tests as $test) {
        if ($test['test_id'] == $test_id) {
            wp_send_json_error(['message' => 'Этот тест уже был пройден.']);
        }
    }

    // Сохраняем новый результат
    $user_tests[] = [
        'test_id' => $test_id,
        'score' => $score,
        'grade' => $grade,
        'date' => current_time('mysql'),
    ];

    // Обновляем мета-данные пользователя с результатами
    update_user_meta($user_id, 'user_tests_results', $user_tests);

    wp_send_json_success(['message' => 'Результаты теста обновлены']);
}

add_action('wp_ajax_update_user_test_results', 'handle_update_user_test_results');

// Функция для получения средней оценки по дисциплине
function get_user_average_score($user_id, $discipline_id)
{
    // Получаем все результаты для дисциплины
    $user_results = get_user_meta($user_id, 'discipline_results', true);

    // Если нет результатов, возвращаем 0
    if (empty($user_results[$discipline_id])) {
        return 0;
    }

    // Получаем все оценки за тесты
    $scores = array_values($user_results[$discipline_id]);

    // Вычисляем среднее
    $average_score = array_sum($scores) / count($scores);

    return round($average_score, 2);
}
// Функция для отображения таблицы с дисциплинами и результатами пользователя
function display_user_discipline_table()
{
    $user_id = get_current_user_id();
    $user_tests = get_user_meta($user_id, 'user_tests_results', true);

    if (!empty($user_tests)) {
        // Группируем результаты по дисциплинам
        $discipline_grades = [];

        foreach ($user_tests as $test) {
            // Получаем название дисциплины (таксономия 'disciplines')
            $discipline = get_the_terms($test['test_id'], 'disciplines');
            $discipline_name = !empty($discipline) ? $discipline[0]->name : 'Неизвестная дисциплина';

            // Инициализируем дисциплину, если еще не добавлена
            if (!isset($discipline_grades[$discipline_name])) {
                $discipline_grades[$discipline_name] = [
                    'total_score' => 0,
                    'total_tests' => 0,
                ];
            }

            // Добавляем баллы для дисциплины
            $discipline_grades[$discipline_name]['total_score'] += $test['grade'];
            $discipline_grades[$discipline_name]['total_tests']++;
        }

        // Отображаем таблицу
        echo '<div class="user-statistics-table">';
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Дисциплина</th>';
        echo '<th>Средняя оценка</th>';
        echo '<th>Количество тестов</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($discipline_grades as $discipline_name => $data) {
            $average_grade = round($data['total_score'] / $data['total_tests'], 2);
            echo '<tr>';
            echo '<td>' . esc_html($discipline_name) . '</td>';
            echo '<td>' . esc_html($average_grade) . '</td>';
            echo '<td>' . esc_html($data['total_tests']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p>Вы еще не прошли тесты.</p>';
    }
}
// Функция для добавления или удаления урока из избранного
function toggle_favorite_lesson()
{
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'Пользователь не авторизован']);
    }

    $user_id = get_current_user_id();
    $lesson_id = intval($_POST['lesson_id']);
    $favorites = get_user_meta($user_id, 'favorite_lessons', true);

    // Если избранных уроков нет, создаем пустой массив
    if (!$favorites) {
        $favorites = [];
    }

    // Проверяем, находится ли урок в избранном
    if (in_array($lesson_id, $favorites)) {
        // Убираем из избранного
        $favorites = array_diff($favorites, [$lesson_id]);
        update_user_meta($user_id, 'favorite_lessons', $favorites);
        wp_send_json_success(['message' => 'Урок удален из избранного', 'is_favorite' => false]);
    } else {
        // Добавляем в избранное
        $favorites[] = $lesson_id;
        update_user_meta($user_id, 'favorite_lessons', $favorites);
        wp_send_json_success(['message' => 'Урок добавлен в избранное', 'is_favorite' => true]);
    }
}

add_action('wp_ajax_toggle_favorite_lesson', 'toggle_favorite_lesson');
// Убедитесь, что мета-данные для счетчика уже добавлены при создании таксономии
function add_view_count_meta($term_id)
{
    // Используем get_term_meta() для проверки существования мета-данных
    $view_count = get_term_meta($term_id, 'view_count', true);

    // Если мета-данные не существуют (пустое значение), добавляем их
    if (empty($view_count)) {
        add_term_meta($term_id, 'view_count', 0, true);
    }
}
add_action('created_term', 'add_view_count_meta', 10, 1);
add_action('edited_term', 'add_view_count_meta', 10, 1);
// Увеличиваем счетчик просмотров дисциплины
function increase_term_view_count()
{
    if (is_tax('disciplines')) {
        $term = get_queried_object();
        if ($term && isset($term->term_id)) {
            // Получаем текущий счетчик
            $view_count = (int) get_term_meta($term->term_id, 'view_count', true);
            // Увеличиваем счетчик на 1
            update_term_meta($term->term_id, 'view_count', $view_count + 1);
        }
    }
}
add_action('template_redirect', 'increase_term_view_count');
function modify_menu_for_logged_in_user($items, $args)
{
    // Проверяем, авторизован ли пользователь
    if (!is_user_logged_in()) {
        // Заменяем текст "Личный кабинет" на "Вход"
        $items = str_replace('Личный кабинет', 'Вход', $items);
    }
    return $items;
}

add_filter('wp_nav_menu_items', 'modify_menu_for_logged_in_user', 10, 2);
function track_unique_visitors() {
    if (!isset($_COOKIE['has_visited'])) {
        // Устанавливаем cookie на 1 год
        setcookie('has_visited', 'true', time() + 365*24*60*60, '/'); 
        
        // Получаем текущее количество посетителей из базы данных
        $visitor_count = get_option('unique_visitor_count', 0);
        
        // Увеличиваем счетчик на 1
        $visitor_count++;
        
        // Обновляем счетчик в базе данных
        update_option('unique_visitor_count', $visitor_count);
    }
}
add_action('wp', 'track_unique_visitors');
add_filter( 'show_admin_bar', '__return_false' );