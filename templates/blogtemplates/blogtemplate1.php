<html class="no-js" lang="">


   
    <div class="blog-contain">           
		    
  
        <div class="blog-date">
            <p><?php echo date('j F Y', $results['articles'][0]->publicationDate)?></p>
         </div>
               
        <a href="blog.php?action=viewArticle&amp;articleId=<?php echo $results['articles'][0]->id?>">        
            <div class="blog-image-mask-feature">
                <div class="blog-article-big" style="background-image:url(/pcms/resources/fullsize/<?php echo htmlspecialchars( $results['articles'][0]->articleImage )?>)">
                </div>
            </div>

            <div class="blog-feature-overaly">
                    <div class="blog-feature-discrip">
                        <h3><?php echo htmlspecialchars( $results['articles'][0]->title )?></h3>
                        <p><?php echo htmlspecialchars( $results['articles'][0]->summary )?></p>
                    </div>

            </div>
        </a>
      
        

        
<?php   $i=0;
        foreach ( $results['articles'] as $article ) { 
                    
            if ($i>0){
        
        ?>	
        

                
            <div class="blog-article-contain">             
                <div class="blog-date">
                    <p><?php echo date('j F Y', $article->publicationDate)?></p>
                </div>
                
                <a href="blog.php?action=viewArticle&amp;articleId=<?php echo $article->id?>"> 
                <div class="blog-image-mask">
                    <div class="blog-article-small" style="background-image:url(/pcms/resources/fullsize/<?php echo htmlspecialchars( $article->articleImage )?>)">
                    </div>
                </div>
                
                <div class="blog-article-overaly">
                    <div class="blog-article-discrip">
                        <h3><?php echo htmlspecialchars( $article->title )?>  </h3>
                        <p> <?php echo htmlspecialchars( $article->summary )?></p>
                    </div>
                </div>
                </a>
            </div>
               

<?php 
        }
        $i++;
       
            } ?>	
    </div>
				
</html>



