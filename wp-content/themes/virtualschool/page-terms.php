<?php /*Template Name: страница terms*/ ?>
<?php get_header(); ?>
<div class="block">
    <div class="block_one">
        <p class="block_one_theory_name"><?php the_title(); ?></p>
    </div>
</div>
<div class="empty"></div>
<div class="block">
    <div class="block_one">
        <div class="block_one_theory">
            <p class="block_one_theory_text">
                <?php
                the_content();
                ?></p>
        </div>
    </div>
</div>
<?php get_footer(); ?>