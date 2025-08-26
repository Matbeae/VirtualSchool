<?php /*Template Name: страница disciplines*/ ?>
<?php get_header(); ?>
<style>
    .block_one_disciplines_name {
        display: flex;
        justify-content: space-between;
    }

    .search {
        width: 200px;
        height: 30px;
    }

    .block_one {
        align-items: flex-start;
        justify-content: flex-start;
    }

    html,
    .block {
        height: 100%;
        display: grid;
        grid-template-rows: 1fr auto;
    }
</style>
<div class="block">
    <div class="block_one">
        <div class="block_one_disciplines">
            <div class="block_one_disciplines_name">
                <p>
                    <?php the_title(); ?>
                </p>
                <input class="search" type="text" id="taxonomy-search" placeholder="Поиск">
            </div>

            <div id="search-results" class="block_education_disciplines"></div>
            <script>
                function fetchTerms(query = '') {
                    var data = {
                        action: 'taxonomy_term_search',
                        query: query
                    };

                    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
                        document.getElementById('search-results').innerHTML = response;
                    });
                }

                // Вызов функции при вводе текста в поисковую строку
                document.getElementById('taxonomy-search').addEventListener('input', function() {
                    fetchTerms(this.value);
                });

                // Вызов функции при загрузке страницы для отображения всех категорий
                document.addEventListener('DOMContentLoaded', function() {
                    fetchTerms();
                });
            </script>

        </div>
    </div>
</div>
<?php get_footer(); ?>