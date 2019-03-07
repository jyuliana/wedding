<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs');?>
 <div class="container">
	<div class="row">
		<div class="col-md-3 wedding_3">
			<h2><?php echo wp_get_document_title(); ?></h2>
			<img class=""src="<?php echo get_template_directory_uri()?>/images/roza.gif" alt="First slide">
		</div>
		<div class="col-md-9">
		 <h1>CHRISTINE USTIN</h1>
		   <!-- <img class="d-block w-100" src="<?php echo get_template_directory_uri()?>/images/xl.jpg" alt="First slide"> -->
		   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			 <ol class="carousel-indicators">
			   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			   <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			 </ol>
			 <div class="carousel-inner">
			   <div class="carousel-item active">
				 <img class="d-block w-100" src="<?php echo get_template_directory_uri()?>/images/xl.jpg" alt="First slide">
			   </div>
			   <div class="carousel-item">
				 <img class="d-block w-100" src="<?php echo get_template_directory_uri()?>/images/14279893.gif" alt="Second slide">
			   </div>
			   <div class="carousel-item">
				 <img class="d-block w-100" src="<?php echo get_template_directory_uri()?>/images/xl.gif" alt="Third slide">
			   </div>
			 </div>
			 <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			   <span class="sr-only">Previous</span>
			 </a>
			 <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			   <span class="carousel-control-next-icon" aria-hidden="true"></span>
			   <span class="sr-only">Next</span>
			 </a>
		   </div>
		</div>
	</div>
	<div class="row middle">
		<div class="col-md-6">
		   <div class="row">
			  <div class="col-md-12">
				 <div class="row">
					<div class="col-md-5">
					   </div>
					<div class="col-md-7">
					   <p></p>
					</div>
				 </div>
			  </div>
			  <div class="col-md-5 story_5">
				 <img class=""src="<?php echo get_template_directory_uri()?>/images/13682914905.jpg" alt="First slide">
			  </div>
			  <div class="col-md-7">
				 <p>Украшение свадебного стола фото Когда все приготовления к свадьбе закончены – куплено платье, костюм жениха, заказан букет, бутоньерка, приглашены гости – важно не забыть о значительном элементе торжества: праздничном столе..</p>
			  </div>
			  <div class="col-md-12">
				 <P>Впечатление о свадьбе складывается из различных деталей. Это и сама церемония, и образы жениха и невесты, и угощения, и, конечно, сам банкетный зал. Гости, как правило, большую часть времени все же проводят за столами или рядом с ними. Они не могут не оценить их убранство и стиль. Поэтому жених и невеста стараются заранее продумать необычное украшение свадебного стола, чтобы произвести впечатление на гостей.
					Как украсить стол на свадьбу своими руками: рекомендации
					Часто молодые предпочитают нанимать специалистов для украшения столов и всего зала в целом.<P>
			 </div>  
		   </div>
		</div>
		<div class="col-md-6">
		  <div class="row wedding_top">
			  <div class="col-md-7">
				 <h2>WEDDING PARTY</h2>
			  </div>
			  <div class="col-md-5">
				 <p><p>
			  </div>
		   </div>
		   <div class="row wedding_middle">   
			  <div class="col-md-4 wedding_4">
				 <img class=""src="<?php echo get_template_directory_uri()?>/images/3-2147736077.jpg" alt="First slide">
			  </div>
			  <div class="col-md-8">
				 <p>День святого валентина или День всех влюблённых — праздник, который отмечается 14 февраля во многих странах мира.<p>
					По традиции 14 февраля в день святого Валентина влюбленные обмениваются «валентинками».
			  </div>
		   </div>
		   <div class="row">
			  <div class="col-md-4 wedding_8">
				 <img class=""src="<?php echo get_template_directory_uri()?>/images/buket.jpg" alt="First slide">
			  </div>
			  <div class="col-md-8">
				 <p>Свадебный букет, букет невесты — это традиционный флористический аксессуар, дополняющий свадебное платье.<p>
					Правильно подобранный букет – это важнейший элемент образа невесты, подчеркивающий ее индивидуальность.
			  </div>
		   </div> 
		</div>
	</div>
	<div class="row">
		<?php if( have_posts() ): ?>
			<?php while( have_posts() ): the_post(); ?>
				<div class="col-md-4">
				   <div class="row">
					  <div class="col-md-3 events">
						 <?php the_post_thumbnail(array( 50, 100)); ?>
					  </div>
					  <div class="col-md-9">
						 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>						 
					  </div>
				   </div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>


       