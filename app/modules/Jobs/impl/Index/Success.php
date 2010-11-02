<div id="jobs">
	<?php foreach ($t['categories'] as $category): ?>
		<div class="category_<?php echo htmlspecialchars($category['slugname']); ?>">
			<div class="category">
				<div class="feed">
					<a href="<?php echo $ro->gen('categories.category.show.feed', array('name' => $category['slugname'])); ?>"><?php echo $tm->_('Feed'); ?></a>
				</div>
				<h1><a href="<?php echo $ro->gen('categories.category.show', array('name' => $category['slugname'])); ?>"><?php echo htmlspecialchars($category['name']); ?></a></h1>
			</div>

			<?php echo $slots['category'][$category['id']]; ?>

			<?php if (($count = $t['job_count'][$category['id']] - 10) > 0): ?>
				<div class="more_jobs">
					<?php echo $tm->_('and'); ?>
					<a href="<?php echo $ro->gen('categories.category.show', array('name' => $category['slugname'])); ?>">
						<?php echo $count; ?>
					</a>
					<?php echo $tm->_('more...'); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>