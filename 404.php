<?php 
    get_header(); 
?>
<main>
    <section class="page-error page-default page-<?= $post->post_name; ?>">
        <div class="container">
            <div class="page-error__content">
                <h1>404</h1>
                <p>Такой страницы не существует или она была удалена</p>
                <a href="/" class="button">На главную</a>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>