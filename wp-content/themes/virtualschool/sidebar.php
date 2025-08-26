<style>
    .search {
        width: auto;
    }
</style>
<div class="sidebar">
    <p class="sidebar_name">Фильтры</p>
    <div class="sidebar_properties">
        <p class="sidebar_properties_name">Категории</p>
        <div class="sidebar_line"></div>

        <?php
        // Получаем все термины таксономии 'disciplines'
        $terms = get_terms(array(
            'taxonomy' => 'disciplines',
            'orderby' => 'name', // Сортировка по имени
            'order'   => 'ASC',  // В порядке возрастания
            'hide_empty' => false, // Показывать даже пустые термины
        ));

        // Проверяем, есть ли термины
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                // Генерируем уникальный ID для чекбокса
                $checkbox_id = 'discipline_' . $term->term_id;
        ?>
                <div class="check">
                    <input type="checkbox" class="filter" id="<?php echo esc_attr($checkbox_id); ?>" name="filters[]" value="<?php echo esc_attr($term->term_id); ?>" <?php echo isset($_GET['filters']) && in_array($term->term_id, $_GET['filters']) ? 'checked' : ''; ?> />
                    <label for="<?php echo esc_attr($checkbox_id); ?>"><?php echo esc_html($term->name); ?></label>
                </div>
        <?php
            }
        } else {
            echo '<p>Нет доступных категорий.</p>';
        }
        ?>
    </div>

    <div class="sidebar_properties">
        <p class="sidebar_properties_name">Тип теории</p>
        <div class="sidebar_line"></div>
        <div class="check">
            <input type="checkbox" class="filter" id="official" name="filters[]" value="official" <?php echo isset($_GET['filters']) && in_array('official', $_GET['filters']) ? 'checked' : ''; ?> />
            <label for="official">Официальная</label>
        </div>
        <div class="check">
            <input type="checkbox" class="filter" id="authors" name="filters[]" value="authors" <?php echo isset($_GET['filters']) && in_array('authors', $_GET['filters']) ? 'checked' : ''; ?> />
            <label for="authors">Авторская</label>
        </div>
    </div>
    <div class="sidebar_properties">
        <p class="sidebar_properties_name">Поиск</p>
        <input class="search" type="text" id="themes-search" placeholder="Поиск" autocomplete="off" value="<?php echo isset($_GET['search']) ? esc_attr($_GET['search']) : ''; ?>">
    </div>
</div>