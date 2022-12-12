<article class="card-post-item <?php echo !has_category(array('partners', 'carreras')) ? 'maserati-article-post' : 'maserati-article-post-short'; ?>">
    <?php if (!wp_is_mobile()) : ?>
        <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        <?php else :
        $the_post_thumbnail_mobile = get_field('imagen_destacada_mobile');
        if ($the_post_thumbnail_mobile) : ?>
            <a href="<?php echo get_the_permalink(); ?>"><?php echo wp_get_attachment_image($the_post_thumbnail_mobile, 'full'); ?></a>
        <?php else : ?>
            <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        <?php endif; ?>
    <?php endif; ?>
    <div class="content-post">
        <h5 class="maserati-color--navi_blue"><?php echo get_the_title(); ?></h5>
        <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
        <a href="<?php echo get_the_permalink(); ?>"><?php _e('Leer más', 'maserati'); ?> <i class="icon-arrow-right"></i></a>
    </div>

</article>