<html class="no-js" lang="">
   
    <div class="blog-contain">  
        <div class="blog-title">
            <h4> <?php echo htmlspecialchars( $results['article']->title ) ?> </h4> 
            <p> <i> <?php echo date('j F Y', $results['article']->publicationDate)?> </i> </p>
        </div>
        <div class="blog-content">	
            <div class="article-content"> <?php echo $results['article']->content?>  </div>
        </div>
    
    </div>
				
</html>



