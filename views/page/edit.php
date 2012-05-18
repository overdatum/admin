<div id="main">
	<div class="page-header">
		<h1>Edit page "<?php echo $page->lang->menu ?>"</h1>
	</div>
	<?php echo Form::open($url.'page/add', 'POST', array('class' => 'form-horizontal')) ?>
		<?php echo Form::field('checkbox', 'online', 'Online', array(1, Input::old('online'), array('checked' => 'checked'))) ?>
		<?php echo Form::field('checkbox', 'hidden', 'Hidden', array(Input::old('hidden'))) ?>
		<?php echo Form::field('checkbox', 'homepage', 'Homepage', array(Input::old('homepage'))) ?>
		<?php echo Form::field('select', 'layout_id', 'Layout', array($layouts)) ?>
		
		<?php echo Form::actions(array(Form::submit('Add Page', array('class' => 'btn btn-large btn-primary')))) ?>
	<?php echo Form::close() ?>
</div>