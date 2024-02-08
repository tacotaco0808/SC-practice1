<?php get_header(); ?>
<main <?php post_class('mycontainer'); ?>>
    <?php the_content(); ?>
</main>
<?php if (have_posts()) : while (have_posts()) :
        the_post(); ?>
        <div class="mypostlist mycontainer">
            <?php
            $myposts = get_posts(array(
                'posts_per_page' => '4',
                'post__not_in' => array(get_the_ID()),
                'category__in' => wp_get_post_categories(get_the_ID()),
                'orderby' => 'date'
            ));
            ?>
            <?php if ($myposts) :
                foreach ($myposts as $post) :
                    setup_postdata($post); ?>

                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <figure>
                                    <?php the_post_thumbnail(); ?>
                                </figure>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_content(); ?></p>
                        </a>
                    </article>

            <?php endforeach;
                wp_reset_postdata();
            endif; ?>
        </div>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>