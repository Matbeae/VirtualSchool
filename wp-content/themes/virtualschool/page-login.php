<?php /*Template Name: страница login*/?>
<?php get_header(); ?>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
    </div>
</div>

<div class="block">
    <div class="block_one">
        <div class="block_one_theory">
            <div class="block_one_login">
                <div class="block_one_registration">
                    <p>Электронная почта:</p>
                    <p><input></p>
                </div>
                <div class="block_one_registration_login">
                    <p>Пароль:</p>
                    <p><input type="password"></p>
                </div>
            </div>
            <div class="block_one_login_terms">
                <a href="virtualschool/terms/">Пользовательское соглашение</a>
                <a href="virtualschool/policy/">Политика обработки персональных данных</a>
            </div>
        </div>
        <a href="index_personroom.html" class="button">Войти</a>
    </div>
</div>
<?php get_footer(); ?>