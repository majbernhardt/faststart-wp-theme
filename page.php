<?php 
    global $post;
    get_header(); 
?>
<main>
    <section class="page-default page-<?= $post->post_name; ?>">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>