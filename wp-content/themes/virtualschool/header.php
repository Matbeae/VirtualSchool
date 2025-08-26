<!DOCTYPE html>
<html>

<head>
    <title>
        <?php bloginfo('name'); ?>
        <?php wp_title(); ?>
    </title>
    <?php
    if (is_front_page()) {
        echo '<meta name="description" content="' . esc_attr(bloginfo('description')) . '" />';
    } elseif (is_category()) {
        echo '<meta name="description" content="' . esc_html(category_description()) . '" />';
    } elseif (is_single()) {
        echo '<meta name="description" content="' . esc_attr(the_excerpt()) . '" />';
    } elseif (is_tax()) {
        $term = get_queried_object();
        echo '<meta name="description" content="' . esc_html($term->description) . '" />';
    }
    ?>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="header_contacts">
            <?php if (is_active_sidebar('si-header-contact')) : ?>
                <?php dynamic_sidebar('si-header-contact'); ?>
            <?php endif; ?>
        </div>
        <nav>
            <div class="header_tools">
                <div itemscope itemtype="http://schema.org/Organization" class="header_tools_logo">
                    <a itemprop="url" href="<?php echo esc_url(home_url('/')); ?>" class="header_tools_icon" aria-label="Перейти на главную страницу">
                        <p itemprop="name"><?php the_custom_logo(); ?></p>
                    </a>
                </div>
                <?php
                wp_nav_menu(
                    array(
                        'menu_class' => 'menu',
                        'container_class' => 'menu_block',
                    )
                );
                ?>
                <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-menu-1828859.png" height="40" width="40" class="header_tools_menu" />
            </div>
            <div class="header_tools_adapt"></div>
        </nav>
    </header>