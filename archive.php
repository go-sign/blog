<?php get_header(); ?>

        <section class="section">
        <div class="container">

            <?php echo gs_breadcrumb(); ?>

            <div class="column">
                <?php the_archive_title( '<h1 class="archive-title is-spaced caption">', '</h1>' ); ?>
            </div>

    		<?php if ( have_posts() ) : ?>
    
                <?php while ( have_posts() ) : the_post(); ?>
    
                <div class="column">
                    <h2 class="entry-title is-spaced caption"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <span class="entry-date">
                        <span class="icon is-small"><i class="fa fa-pencil"></i></span><time itemprop="datePublished" datetime="<?php the_time( 'Y-m-d' ) ;?>"><?php the_time( 'Y/m/d' ) ;?></time>
                        </span>
                        <span class="tag is-info tag-category"><?php the_category(' '); ?></span>
                        <?php the_tags( '<span class="tag is-light tag-tag">', "</span>\n<span class=\"tag is-light tag-tag\">", '</span>'); ?>
                    </div>
                    <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                    </div>
                </div>
    
                <?php endwhile; ?>
    
                <?php gs_pagenate(); ?>
    
            <?php endif; ?>

        </div>
        </section>

<?php get_footer(); ?>
