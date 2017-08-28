<?php 
/**
 * Template name: Subpage Cards
 *
 * This is the template that displays all the page's child pages 
 * in cards under the main content area.
 *
 */

get_header(); ?>

<div class="container container-normal">
	 
    <div class="row maincontent"><div class="col-sm-12"><?php the_breadcrumb(); ?></div></div>
    
    <div class="row maincontent lower">
    
        <div class="col-sm-12">

            <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
         
            <div class="post">
            
                <h2 class="page-title"><?php the_title(); ?></h2>
 
                    <div class="entry">
                
                       <?php the_content(); ?>
                
                    </div>
            
                <?php get_template_part('partials/interior_pages/_childpages' ); ?>
            
            </div> <!-- /post -->
         
            <?php endwhile; ?>


 
            <div class="navigation">
               <?php posts_nav_link(); ?>
            </div>
 
            <?php endif; ?>
		
        </div><!-- col-sm-8 -->
	
    </div><!-- row maincontent lower -->
 
   
<?php get_footer(); ?>
