<div class="category">
	<div class="feed">
		<a href="<?php echo $ro->gen('categories.category.show.feed', array('name' => $t['category']['slugname'])); ?>"><?php echo $tm->_('Feed'); ?></a>
	</div>
	<h1><?php echo $t['category']['name']; ?></h1>
</div>

<?php echo $slots['jobs']; ?>

<?php if ($t['page_prev'] > 1 || $t['page_next'] > 1): ?>
	<div class="pagination">
		<a href="<?php echo $ro->gen('categories.category.show', array('page' => 1)); ?>">
			<img src="/images/first.png" alt="First page" />
		</a>

		<a href="<?php echo $ro->gen('categories.category.show', array('page' => $t['page_prev'])); ?>">
			<img src="/images/previous.png" alt="Previous page" title="Previous page" />
		</a>

		<?php for($page = 1; $page <= $t['page_last']; $page++): ?>
			<?php if ($page == $t['page']): ?>
				<?php echo $page; ?>
			<?php else: ?>
				<a href="<?php echo $ro->gen('categories.category.show', array('page' => $page)); ?>"><?php echo $page; ?></a>
			<?php endif; ?>
		<?php endfor; ?>

		<a href="<?php echo $ro->gen('categories.category.show', array('page' => $t['page_next'])); ?>">
			<img src="/images/next.png" alt="Next page" title="Next page" />
		</a>

		<a href="<?php echo $ro->gen('categories.category.show', array('page' => $t['page_last'])); ?>">
			<img src="/images/last.png" alt="Last page" title="Last page" />
		</a>
	</div>
<?php endif; ?>

<div class="pagination_desc">
	<?php if($t['job_count'] == 0): ?>
		<?php echo $tm->_('No job in this category'); ?>
	<?php elseif($t['job_count'] == 1): ?>
		<?php echo $tm->_('One job in this category'); ?>
	<?php else: ?>
		<?php echo $tm->_('%s jobs in this category', null, null, array('<strong>'.$t['job_count'].'</strong>')); ?>
	<?php endif; ?>

	<?php if ($t['page_prev'] > 1 || $t['page_next'] > 1): ?>
		- page <strong><?php echo $t['page'] ?>/<?php echo $t['page_last']; ?></strong>
	<?php endif; ?>
</div>