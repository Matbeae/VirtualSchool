<?php /*Template Name: страница calculators*/ ?>
<?php get_header(); ?>
<style>
    .block_one_theory {
        display: none;
    }

    .tab-links .active {
        background-color: #2651c7;
    }

    .block_one_theory.active {
        display: block;
        display: flex;
        justify-content: center;
        margin: auto;
        min-height: 470px;
        flex-grow: 1;
        justify-self: center;
    }
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }

    footer {
        flex-shrink: 0;
    }
</style>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name">
            <?php the_title(); ?>
        </p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <ul class="tab-links">
            <li class="active"><a href="#tab1">Средний балл</a></li>
            <li><a href="#tab2">Обученность</a></li>
            <li><a href="#tab3">Поступление</a></li>
        </ul>
        <div id="tab1" class="block_one_theory active">
            <h2>Средний балл</h2>
            <div class="block_calculator">
                <p>Количество пятерок</p>
                <input type="text" id="GPA-grade-5">
            </div>
            <div class="block_calculator">
                <p>Количество четверок</p>
                <input type="text" id="GPA-grade-4">
            </div>
            <div class="block_calculator">
                <p>Количество троек</p>
                <input type="text" id="GPA-grade-3">
            </div>
            <div class="block_calculator">
                <p>Количество двоек</p>
                <input type="text" id="GPA-grade-2">
            </div>
            <div class="block_calculator">
                <p>Количество учеников/оценок</p>
                <input type="text" id="GPA-students">
            </div>
            <p id="GPA-result"></p>
            <button class="button_calculator" onclick="GPA()">Посчитать</button>
            <div class="block_calculator_info" style="font-size: 10;">
                <p class="block_calculator_info_btn">Методика расчета</p>
                <p class="block_calculator_info_text" style="display: none;">Средний балл это среднеарифметическое значение оценок по определенному предмету.
                    Для расчета среднего балла используется специальная формула:
                    СрБ = (5 × А + 4 × Б + 3 × В + 2 × Г) / (А + Б + В + Г),
                    где:
                    СрБ - средний балл, А - количество пятерок (5), Б - количество четверок (4), В - количество троек (3), Г - количество двоек (2)</p>
            </div>
        </div>
        <div id="tab2" class="block_one_theory">
            <h2>Калькулятор обученности</h2>
            <div class="block_calculator">
                <p>Количество пятерок</p>
                <input type="text" id="training-grade-5">
            </div>
            <div class="block_calculator">
                <p>Количество четверок</p>
                <input type="text" id="training-grade-4">
            </div>
            <div class="block_calculator">
                <p>Количество троек</p>
                <input type="text" id="training-grade-3">
            </div>
            <div class="block_calculator">
                <p>Количество двоек</p>
                <input type="text" id="training-grade-2">
            </div>
            <div class="block_calculator">
                <p>Количество н/а</p>
                <input type="text" id="training-absence">
            </div>
            <div class="block_calculator">
                <p>Количество учеников</p>
                <input type="text" id="training-students">
            </div>
            <p id="training-result"></p>
            <button class="button_calculator" onclick="training()">Посчитать</button>
            <div class="block_calculator_info">
                <p class="block_calculator_info_btn">Методика расчета</p>
                <p class="block_calculator_info_text" style="display: none;">Обученность = (кол-во "5" + кол-во "4" * 0,64 + кол-во "3" * 0,36 + кол-во "2" * 0,16 + кол-во "н/а" * 0,08 ) / общее количество учащихся</p>
            </div>
        </div>
        <div id="tab3" class="block_one_theory">
            <h2>Калькулятор поступления в БГТУ</h2>
            <p>Выберите сдаваемый на ЕГЭ предмет</p>
            <select class="admission" name="object">
                <option value="inform">Информатика</option>
                <option value="physics">Физика</option>
            </select>
            <p>Количество баллов ЕГЭ</p>
            <input type="text" id="score">
            <p id="admission-result"></p>
            <button class="button_calculator" onclick="admission()">Посчитать</button>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
    $(".block_calculator_info_btn").click(function() {
        $(this).next(".block_calculator_info_text").slideToggle();
    });
    $('.tab-links li').click(function() {
        var tab_id = $(this).find('a').attr('href');
        $('.tab-links li').removeClass('active');
        $('.block_one_theory').removeClass('active');
        $(this).addClass('active');
        $(tab_id).addClass('active');
    });
</script>