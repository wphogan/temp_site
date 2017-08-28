<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>
<div class="container container-normal">
     
    <div class="row maincontent"><div class="col-sm-12"><?php the_breadcrumb(); ?></div></div>
    
    <div class="row maincontent lower">
    
        <div class="col-sm-8">
            
            <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
         
            <div class="post">
            
                <h2 class="page-title"><?php the_title(); ?></h2>
 
                    <div class="entry">
                
                       <?php the_content(); ?>

                       <?php get_template_part('partials/interior_pages/_cards' ); ?>
                        <?php get_template_part('partials/interior_pages/_childpages' ); ?>
                
                    </div>
                        
            </div> <!-- /post -->
         
            <?php endwhile; ?>


 
            <div class="navigation">
               <?php posts_nav_link(); ?>
            </div>
 
            <?php endif; ?>
        
        </div><!-- col-sm-8 -->
    
    <!--/div><!-- row maincontent lower -->
 
<?php get_sidebar(); ?>   
<?php get_footer(); ?>
