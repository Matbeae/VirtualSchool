<form name="search" action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-form" itemprop="potentialAction" itemscope="" itemtype="http://schema.org/SearchAction">
    <meta itemprop="target" content="<?php echo esc_url(home_url('/')); ?>?s={query}&post_type=themes">
    <input type="text" class="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo __('Поиск по урокам', 'virtualschool'); ?>" class="input">
    <input itemprop="query-input" type="hidden" name="query">
    <input type="hidden" name="post_type" value="themes"> <!-- Добавленный параметр для поиска по типу записи "themes" -->
    <input type="submit" value="<?php echo esc_attr(__('Найти', 'virtualschool')); ?>" class="submit">
</form>