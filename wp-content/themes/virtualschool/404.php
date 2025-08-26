<? php /*Template Name: страница 404*/?>
<?php get_header(); ?>
<div class="Error">
    <h2><?php echo __('Ошибка!'); ?></h2>
    <p><?php echo __('Похоже, что такой страницы не существует, вернитесь на главную страницу, перейдя по ссылке снизу'); ?></p>
    <a href="http://localhost/virtualschool/">На главную</a>
    <img src="<?php echo get_template_directory_uri() ?> /images/kote.svg"/>
</div>
<?php get_footer(); ?>
