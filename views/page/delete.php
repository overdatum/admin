<div id="main">
	<div class="page-header">
		<h1>Are you sure?</h1>
	</div>
	<div class="well">
		You are about to delete the page "<?php echo $page->lang->meta_title ?>". <b>If you do, there is no turning back!</b>
	</div>
	<?php echo Form::open($url.'page/delete/'.$page->id, 'DELETE') ?>
		<?php echo Form::actions(array(Form::submit('Delete Page', array('class' => 'btn btn-large btn-danger')), ' &nbsp; '.HTML::link($url.'page', 'Nope, I changed my mind', array('class' => 'btn btn-large')))) ?>
	<?php echo Form::close() ?>
</div>