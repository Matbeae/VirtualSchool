<?php /*Template Name: страница registration*/ ?>
<?php get_header(); ?>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <form class="registration" action="<?php echo wp_registration_url(); ?>" method="post" onsubmit="return validateForm()">
            <div class="block_one_theory">
                <div class="block_one_registration_block">
                    <div class="block_one_registration">
                        <p>
                            <label for="user_login">Логин:
                                <input type="text" name="user_login" id="user_login" class="input" value="" size="20">
                            </label>
                        </p>
                        <p class="login_num" style="font-size: 19px;"></p>
                        <p>
                            <label for="user_age">Возраст:</label>
                            <input type="text" name="user_age" id="user_age">
                        </p>
                    </div>
                    <div class="block_one_registration_block">
                        <div class="block_one_registration">
                            <p><label for="user_gender">Пол:</label></p>
                            <div class="block_one_registration_sex">
                                <div class="block_one_registration_sex_answer">
                                    <input type="radio" name="user_gender" value="male" id="user_gender_male">
                                    <label for="user_gender_male">Мужской</label>
                                </div>
                                <div class="block_one_registration_sex_answer">
                                    <input type="radio" name="user_gender" value="female" id="user_gender_female">
                                    <label for="user_gender_female">Женский</label>
                                </div>
                            </div>
                        </div>
                        <div class="block_one_registration">
                            <p><label for="role">Роль на портале:</label></p>
                            <div class="block_one_registration_sex">
                                <div class="block_one_registration_sex_answer">
                                    <input type="radio" name="user_role" value="student" id="student_role">
                                    <label for="student_role">Ученик</label>
                                </div>
                                <div class="block_one_registration_sex_answer">
                                    <input type="radio" name="user_role" value="author" id="author_role">
                                    <label for="author_role">Автор</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block_one_registration_block">
                        <div class="block_one_registration">
                            <p>
                                <label for="user_email">Электронная почта:
                                    <input type="email" name="user_email" id="user_email" class="input">
                                </label>
                            </p>
                            <p class="email_num" style="font-size: 19px;">Символов: 0</p>
                        </div>
                        <div class="block_one_registration">
                            <p><label for="user_pass">Пароль:
                                    <input type="password" name="user_pass" id="user_pass" class="input" onchange="arg(this)">
                                </label></p>
                        </div>
                    </div>
                    <div class="block_one_registration_block">
                        <a href="<?php echo wp_login_url(); ?>">Уже имеете аккаунт?</a>
                    </div>
                    <div class="block_one_registration">
                        <div class="block_one_registration_terms">
                            <input type="checkbox" id="terms" name="scales" />
                            <label for="terms">Согласен(-на) с <a href="virtualschool/terms/">условиями использования
                                    портала</a> и <a href="virtualschool/policy/">политикой обработки персональных
                                    данных.</a></label>
                        </div>
                    </div>
                </div>
                <?php wp_nonce_field('register', 'register_nonce'); ?>
                <input class="button" type="submit" value="Зарегистрироваться" id="register" />
            </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>
<script>
    function arg(fld) {
        x = fld.value;
        if (x.length < 4) {
            alert("Пароль слишком короткий");
            fld.focus();
            fld.select();
        }
    }
    $("#user_email").blur(function() {
        var email = $(this).val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            $(".email_num").text("E-mail введен неверно");
        }
    });

    function validateForm() {
        var checkbox = document.getElementById('terms');
        if (!checkbox.checked) {
            alert('Пожалуйста, подтвердите согласие с условиями использования');
            return false; // Предотвращаем отправку формы, если чекбокс не отмечен
        }
        // В случае, если чекбокс отмечен, отправляем форму
        return true;
    }
</script>