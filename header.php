<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <!-- <title><-?php if(get_field('pagetitle')) { the_field('pagetitle'); } else { the_title(); }?></title>
        <meta name="description" content="<-?php the_field('description'); ?>"> 
        <meta name="keywords" content="<-?php the_field('keywords'); ?>"> -->
        <link rel="canonical" href="<?php echo home_url();?>" />
        <?php include('template-parts/favicons.php'); ?>
        <meta name="author" content="https://github.com/majbernhardt">
        <!-- Критические стили -->
        <style>

        </style>
        <?php the_field('metrica', 'option'); ?>
        <?php wp_head(); ?>
    </head>
<body>
    <header>

    </header>