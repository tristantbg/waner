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
				<?php if($key < 2 OR $key == $images->count() - 1): ?>
				<img src="<?= resizeOnDemand($image, 1300, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<?php else: ?>
				<img class="lazy" src="<?= resizeOnDemand($image, 100) ?>" data-flickity-lazyload="<?= resizeOnDemand($image, 1300, true) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				<?php endif ?>
				<noscript>
					<img src="<?= resizeOnDemand($image, 1300) ?>" alt="<?= $title.' - © '.$site->title()->html() ?>" height="100%" width="auto" />
				</noscript>
			</div>
		</div>

	<?php endforeach ?>

	</div>

	<div id="slide-caption"></div>

	<div id="next-project">
		<?php if($page->hasNextVisible()): ?>
		<?php $next = $page->nextVisible() ?>
		<?php else: ?>
		<?php $next = $page->parent()->children()->visible()->first() ?>
		<?php endif ?>
		<?php
		$ntitle = $next->title()->html(); 
		if($next->subtitle()->isNotEmpty()):
			$ntitle .= ' '.$next->subtitle()->html();
		endif
		?>
		<a href="<?= $next->url() ?>" data-title="<?= $ntitle ?>" data-target="project">
		Next project
		</a>	
	</div>

</div>
	
</div>

<?php snippet('footer') ?>