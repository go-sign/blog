<?php get_header(); ?>

        <section class="section">
        <div class="container">

            <?php echo gs_breadcrumb(); ?>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <div class="column">
                    <h1 class="entry-title is-spaced caption"><?php the_title(); ?></h1>
        
                    <div class="entry-meta">
                        <span class="entry-date">
                        <span class="icon is-small"><i class="fa fa-pencil"></i></span><time itemprop="datePublished" datetime="<?php the_time( 'Y-m-d' ) ;?>"><?php the_time( 'Y/m/d' ) ;?></time>
                        </span>
                        <span class="tag is-info tag-category"><?php the_category(' '); ?></span>
                        <?php the_tags( '<span class="tag is-light tag-tag">', "</span>\n<span class=\"tag is-light tag-tag\">", '</span>'); ?>
                    </div>
    
                    <div class="entry-content content">
                        <?php the_content(); ?>
                    </div>
                </div>
    
                <?php $previous_link = get_previous_post_link( $format = '前の投稿：%link' ); ?>
                <?php if ( !empty( $previous_link ) ): ?>
                <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                  <span class="pagination-previous"><?php echo $previous_link;?></span>
                </nav>
                <?php endif; ?>
                <?php $next_link = get_next_post_link( $format = '次の投稿：%link' ); ?>
                <?php if ( !empty( $next_link ) ): ?>
                <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                  <span class="pagination-next"><?php echo $next_link;?></span>
                </nav>
                <?php endif; ?>

            <?php endwhile; endif; ?>

        </div>
        </section>

<?php get_footer(); ?>
