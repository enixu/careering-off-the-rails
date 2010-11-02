<form method="post" action="<?php echo $ro->gen(null); ?>" enctype="multipart/form-data">
	<table id="job_form">
		<tfoot>
			<tr>
				<td colspan="2">
					<button type="submit"><?php echo $tm->_('Preview your job', 'site.form'); ?></button>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<th><label for="job_category_id"><?php echo $tm->_('Category', 'site.form'); ?></label></th>
				<td>
					<select name="category_id" id="job_category_id">
						<?php foreach($t['categories'] as $category): ?>
							<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="job_type"><?php echo $tm->_('Type', 'site.form'); ?></label></th>
				<td>
					<ul class="radio_list">
						<li><input name="type" type="radio" value="0" id="job_type_full-time" checked="checked" /> <label for="job_type_full-time"><?php echo $tm->_('Full time'); ?></label></li>
						<li><input name="type" type="radio" value="1" id="job_type_part-time" /> <label for="job_type_part-time"><?php echo $tm->_('Part time'); ?></label></li>
						<li><input name="type" type="radio" value="2" id="job_type_freelance" /> <label for="job_type_freelance"><?php echo $tm->_('Freelance'); ?></label></li>
					</ul>
				</td>
			</tr>
			<tr>
				<th><label for="job_company"><?php echo $tm->_('Company', 'site.form'); ?></label></th>
				<td><input type="text" name="company" id="job_company" /></td>
			</tr>
			<tr>
				<th><label for="job_logo"><?php echo $tm->_('Company logo', 'site.form'); ?></label></th>
				<td><input type="file" name="logo" id="job_logo" /></td>
			</tr>
			<tr>
				<th><label for="job_url"><?php echo $tm->_('Url', 'site.form'); ?></label></th>
				<td><input type="text" name="url" id="job_url" /></td>
			</tr>
			<tr>
				<th><label for="job_position"><?php echo $tm->_('Position', 'site.form'); ?></label></th>
				<td><input type="text" name="position" id="job_position" /></td>
			</tr>
			<tr>
				<th><label for="job_location"><?php echo $tm->_('Location', 'site.form'); ?></label></th>
				<td><input type="text" name="location" id="job_location" /></td>
			</tr>
			<tr>
				<th><label for="job_description"><?php echo $tm->_('Description', 'site.form'); ?></label></th>
				<td><textarea rows="4" cols="30" name="description" id="job_description"></textarea></td>
			</tr>
			<tr>
				<th><label for="job_how_to_apply"><?php echo $tm->_('How to apply?', 'site.form'); ?></label></th>
				<td><textarea rows="4" cols="30" name="how_to_apply" id="job_how_to_apply"></textarea></td>
			</tr>
			<tr>
				<th><label for="job_is_public"><?php echo $tm->_('Public?', 'site.form'); ?></label></th>
				<td><input type="checkbox" name="is_public" checked="checked" id="job_is_public" /><br /><?php echo $tm->_('Whether the job can also be published on affiliate websites or not.', 'site.form'); ?></td>
			</tr>
			<tr>
				<th><label for="job_email"><?php echo $tm->_('Email', 'site.form'); ?></label></th>
				<td><input type="text" name="email" id="job_email" /><input type="hidden" name="job[id]" id="job_id" /></td>
			</tr>
		</tbody>
	</table>
</form>