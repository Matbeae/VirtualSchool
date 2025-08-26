<? php /*Template Name: страница test результаты*/?>
<?php get_header(); ?>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_test">
            <ol>
                <li>
                    <p class="block_one_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent lectus
                        ante, tempus ut
                        porttitor ut, tristique non nulla. Curabitur varius, nulla at suscipit aliquet, eros ligula
                        pellentesque velit, at feugiat odio felis pharetra est. Suspendisse id lectus ut enim
                        ultrices molestie. Donec urna ante, facilisis at diam nec, luctus dictum est. Fusce
                        tristique, risus nec tristique fermentum, nulla nisl accumsan odio, sed luctus magna tellus
                        ac nunc. Curabitur nec tincidunt nibh. Donec sit amet gravida ligula. Etiam lacinia velit
                        ipsum, sit amet pretium eros mollis eget. Vivamus vulputate iaculis turpis et gravida.
                        Praesent faucibus dictum risus, vulputate sodales urna finibus id. Vivamus in nibh dapibus,
                        euismod sem et, consectetur ex. Vestibulum ac laoreet tellus. Nam tempor fringilla felis, ac
                        mattis elit ultricies vel. Phasellus at tortor vitae augue fermentum faucibus a eu ipsum.
                    </p>
                    <div class="block_one_answers">
                        <p>Выберите правильный ответ:</p>
                        <div class="block_one_answers_one">
                            <input type="radio" name="rb" id="rb1">
                            <label for="rb1">Lorem ipsum</label>
                        </div>
                        <div class="block_one_answers_one_result_wrong">
                            <input type="radio" name="rb" id="rb2" checked>
                            <label for="rb2">Dolor</label>
                        </div>
                    </div>
                </li>
                <div class="empty"></div>
                <li>
                    <p class="block_one_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum felis
                        ligula, ultrices et
                        massa sed, consectetur sodales odio. Phasellus consectetur vehicula rutrum. Nullam ut tellus
                        facilisis, mollis augue quis, mollis tortor. Proin ullamcorper magna sit amet dolor
                        sollicitudin, sed sagittis tellus efficitur. Donec suscipit ligula augue, sed blandit velit
                        ornare placerat. Donec egestas lorem sagittis elit pretium finibus. Vestibulum lacus metus,
                        malesuada quis ultricies sed, scelerisque non risus. Nulla velit nunc, ullamcorper vel arcu
                        id, feugiat pretium orci. Donec quis malesuada velit, in mattis sapien. Nulla ac sapien
                        dignissim, euismod purus quis, luctus urna.</p>
                    <div class="block_one_answers">
                        <p>Выберите правильные ответы:</p>
                        <div class="block_one_answers_result_right">
                            <input type="checkbox" id="one" name="scales" checked />
                            <label for="one">Lorem ipsum</label>
                        </div>
                        <div class="block_one_answers_result_right">
                            <input type="checkbox" id="two" name="scales" checked />
                            <label for="two">Dolor</label>
                        </div>
                        <div class="block_one_answers_result_right">
                            <input type="checkbox" id="three" name="scales" checked />
                            <label for="three">Sit</label>
                        </div>
                        <div class="block_one_answers_result_right">
                            <input type="checkbox" id="one" name="scales" checked />
                            <label for="one">Amet</label>
                        </div>
                    </div>
                </li>
                <div class="empty"></div>
                <li>
                    <p class="block_one_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in ipsum eu
                        purus convallis
                        pulvinar in quis risus. Aenean sit amet vehicula purus. Nulla dignissim sollicitudin quam,
                        quis sagittis est dapibus at. Phasellus ac volutpat est. Nulla vel nisi risus. Quisque
                        tincidunt leo et cursus imperdiet. Nam malesuada ligula nec nisl varius, sed tempor sem
                        facilisis. Donec molestie est aliquet lacus porttitor, vitae ultricies mauris porta.
                        Pellentesque id pharetra neque. Pellentesque eget bibendum leo. Cras bibendum interdum
                        nulla, ac rhoncus dolor mattis ut. Integer lorem nisl, congue sed sagittis sit amet, sodales
                        nec magna.</p>
                    <div class="block_one_answers">
                        <p>Выберите правильный ответ:</p>
                        <form>
                            <select id="ans" name="ans" class="block_one_answers_one_result_wrong">
                                <option selected disabled hidden></option>
                                <option value="Lorem ipsum">Lorem ipsum</option>
                                <option value="Dolor">Dolor</option>
                                <option selected value="Sit">Sit</option>
                            </select>
                        </form>
                    </div>
                </li>
                <div class="empty"></div>
                <li>
                    <p class="block_one_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis
                        nunc at dui
                        fringilla, nec scelerisque tortor lobortis. Pellentesque quis quam vehicula, elementum metus
                        non, volutpat nunc. Phasellus eu viverra enim. Donec sit amet metus id felis mollis pretium
                        sed nec diam. Nullam venenatis nisl sem, sit amet laoreet urna interdum ut. Nunc erat elit,
                        interdum eu arcu at, pellentesque finibus nisl. Quisque blandit dolor nec venenatis commodo.
                        Praesent odio tellus, malesuada nec posuere in, rutrum sed odio. Nulla turpis arcu,
                        facilisis ullamcorper odio id, tincidunt faucibus sapien. Suspendisse sagittis nec augue eu
                        porttitor. Aliquam erat volutpat. Phasellus posuere diam non porttitor condimentum. In
                        tortor ex, sollicitudin volutpat justo vestibulum, malesuada consectetur lorem. Nam aliquet
                        augue at euismod euismod. Nam quis aliquam dolor.</p>
                    <div class="block_one_answers">
                        <p>Введите правильный ответ:</p>
                        <p><input class="block_one_answers_result_right" value="Lorem"></p>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
<?php get_footer(); ?>