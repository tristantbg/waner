<?php snippet('header') ?>

<?php $images = $page->medias()->toStructure() ?>
<?php 

$title = $page->title()->html(); 
if($page->subtitle()->isNotEmpty()):
	$title .= ' '.$page->subtitle()->html();
endif

?>

<div id="container">

<div class="inner project">
	
	<div id="project-title"><p><?= $page->title()->html() ?><br><?= $page->subtitle()->html() ?></p></div>

	<div id="slider">

	<?php foreach ($images as $key => $image): ?>

		<?php $image = $image->toFile(); ?>

		<div class="cell" data-caption="<?= $image->caption()->html() ?>">
			<div class="content">
				<img class="lazy" src="<?= resizeOnDemand($image, 100) ?>" data-flickity-lazyload="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<noscript>
					<img src="<?= resizeOnDemand($image, 1700, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>

	<div id="slide-caption"></div>

</div>
	
</div>

<?php snippet('footer') ?>