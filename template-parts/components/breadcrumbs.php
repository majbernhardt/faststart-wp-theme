<!-- Rank Math Breadcrumbs -->
<?php if( !is_front_page()) : ?>
<section class="breadcrumbs-wrap">
    <div class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </div>
</section>
<?php endif; ?>