<div id="main">
	<div class="page-header">
		<h1><?php echo __('layla_admin::account.add.title') ?></h1>
	</div>
	<?php echo Form::open($url.'account/add', 'POST', array('class' => 'form-horizontal')) ?>
		<?php echo Form::field('text', 'name', __('layla_admin::account.add.form.name'), array(Input::old('name')), array('error' => $errors->first('name'))) ?>
		<?php echo Form::field('text', 'email', __('layla_admin::account.add.form.email'), array(Input::old('email')), array('error' => $errors->first('email'))) ?>
		<?php echo Form::field('password', 'password', __('layla_admin::account.add.form.password'), array(), array('error' => $errors->first('password'))) ?>
		<?php echo Form::field('select', 'role_ids[]', __('layla_admin::account.add.form.roles'), array($roles, array(), array('multiple' => 'multiple')), array('error' => $errors->first('role_ids'))) ?>
		<?php echo Form::field('select', 'language_id', __('layla_admin::account.add.form.language'), array($languages, array()), array('error' => $errors->first('language_id'))) ?>

		<?php echo Form::actions(array(Form::submit(__('layla_admin::account.add.buttons.add'), array('class' => 'btn btn-large btn-primary')))) ?>
	<?php echo Form::close() ?>
</div>