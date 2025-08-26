<?php
/*
Template Name: Шаблон для создания теста
*/

get_header();
?>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <form class="test_form" method="post">
            <div class="block_one_test">
                <ol>
                    <?php the_content(); ?>
                </ol>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $correct_answers_count = 0;
                $total_questions_count = 0;

                // Проходим по всем возможным вопросам (например, question_1, question_2 и т.д.)
                foreach ($_POST as $key => $value) {
                    if (strpos($key, 'question_') === 0) {
                        // Увеличиваем счетчик общего количества вопросов
                        $total_questions_count++;

                        // Проверяем правильность ответа (предполагаем, что все правильные ответы равны '1')
                        if (!empty($value) && $value === '1') {
                            $correct_answers_count++;
                        }
                    }
                }
                // Выводим результат
            ?>
                <style>
                    .test_form .button {
                        display: none;
                    }
                </style>
            <?php
                echo '<p class="block_one_text">Ваш результат: ' . $correct_answers_count . ' из ' . $total_questions_count . ' отвеченных вопросов</p>';
            }
            ?>
            <input class="button" type="submit" value="Закончить тест">
        </form>
    </div>
</div>
<?php get_footer(); ?>