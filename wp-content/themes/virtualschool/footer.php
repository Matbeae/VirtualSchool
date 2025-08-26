<footer itemscope itemtype="http://schema.org/WPFooter">
    <div class="footer_top">
        <p class="footer_name">VirtualSchool</p>
        <section class="footer_top_support">
            <p>Служба поддержки</p>
            <ul>
                <li><a href="mailto:info@virtualschool.ru" aria-label="Написать на почту">info@virtualschool.ru</a></li>
                <li><a href="<?php echo esc_url(home_url('/policy')); ?>" class="footer_top_support_empty">Политика обработки персональных данных</a></li>
                <li><a href="<?php echo esc_url(home_url('/terms')); ?>" class="footer_top_support_empty">Пользовательское соглашение</a></li>
            </ul>
        </section>
        <?php
        if (is_active_sidebar('si-footer-social')) {
            dynamic_sidebar('si-footer-social');
        }
        ?>
    </div>
    <meta itemprop="copyrightYear" content="<?php the_time('Y'); ?>">
    <meta name="copyright" content="VirtualSchool">
    <p class="footer_copytight">Copyright &#xa9; <?php the_time('Y'); ?> ООО VirtualSchool</p>
</footer>
<?php wp_footer(); ?>
<script>
    var isMenuMoved = false;
    $('.header_tools_menu').click(function() {
        if (!isMenuMoved) {
            $('.menu').fadeOut(0, function() {
                $(this).appendTo('.header_tools_adapt').slideDown('slow');
            });
        } else {
            $('.menu').fadeOut('slow', function() {
                $(this).appendTo('.menu_block').slideDown('slow');
            });
        }
        isMenuMoved = !isMenuMoved;
    });
    document.addEventListener('DOMContentLoaded', function() {
        var personalBtn = document.querySelector('.menu li:last-child a'); // Замените '.your-menu-class' на класс вашего меню

        if (personalBtn) {
            personalBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Предотвращаем переход по ссылке по умолчанию

                // Проверяем, авторизован ли пользователь
                var isLoggedIn = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;

                if (isLoggedIn) {
                    // Получаем роль пользователя
                    var userRole = "<?php echo implode(', ', wp_get_current_user()->roles); ?>";

                    // Проверяем роль пользователя и перенаправляем на соответствующую страницу
                    if (userRole.includes('student')) {
                        // Если роль "ученик" (student), перенаправляем на страницу личного кабинета
                        window.location.href = "<?php echo home_url('virtualschool/personroom'); ?>";
                    } else if (userRole.includes('author') || userRole.includes('admin')) {
                        // Если роль "автор" (author), перенаправляем на страницу админки WordPress
                        window.location.href = "<?php echo admin_url(); ?>";
                    }
                } else {
                    // Если пользователь не авторизован, перенаправляем на страницу авторизации
                    window.location.href = "<?php echo wp_login_url(); ?>";
                }
            });
        }
    });
</script>
</body>

</html>