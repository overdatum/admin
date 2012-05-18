<div id="main">
	<div class="page-header">
		<h1><?php echo __('layla_admin::account.delete.title') ?></h1>
	</div>
	<div class="well">
		<?php echo __('layla_admin::account.delete.message', array('name' => $account->name, 'email' => $account->email)) ?>
	</div>
	<?php echo Form::open($url.'account/delete/'.$account->id, 'DELETE') ?>
		<?php echo Form::actions(array(
			Form::submit(__('layla_admin::account.delete.buttons.delete'), array('class' => 'btn btn-large btn-danger')), ' &nbsp; '.
			HTML::link($url.'account', __('layla_admin::account.delete.buttons.cancel'), array('class' => 'btn btn-large'))
		)) ?>
	<?php echo Form::close() ?>
</div>