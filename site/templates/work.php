<?php snippet('header') ?>

<div id="container">

<div class="inner">

<?php $projects = $page->children()->visible() ?>

	<div id="project-list">

	<?php foreach ($projects as $key => $project): ?>

	<?php 

	$title = $project->title()->html(); 
	if($project->subtitle()->isNotEmpty()):
		$title .= ' '.$project->subtitle()->html();
	endif

	?>

		<div class="project-link">
		<a href="<?= $project->url() ?>" data-title="<?= $title ?>" data-target="project">
			<div class="project-title">
				<span>
					<?php
					echo $project->title()->html();
					if($project->subtitle()->isNotEmpty()):
					echo ' <em>'.$project->subtitle()->html().'</em>';
					endif
					?>
				</span>
			</div>
			<div class="project-date">
				<?= $project->date('Y'); ?>
			</div>
		</a>
		</div>

	<?php endforeach ?>

	</div>

</div>
	
</div>

<?php snippet('footer') ?>