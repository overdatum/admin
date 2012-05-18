<div id="main">
	<div class="page-header">
		<h1><?php echo __('layla_admin::account.edit.title') ?></h1>
	</div>

	<?php echo Form::open($url.'account/edit/'.$account->id, 'PUT', array('class' => 'form-horizontal')) ?>
		<?php echo Form::field('text', 'name', __('layla_admin::account.edit.form.name'), array(Input::old('name', $account->name)), array('error' => $errors->first('name'))) ?>
		<?php echo Form::field('text', 'email', __('layla_admin::account.edit.form.email'), array(Input::old('email', $account->email)), array('error' => $errors->first('email'))) ?>
		<?php echo Form::field('text', 'password', __('layla_admin::account.edit.form.password'), array(), array('error' => $errors->first('password'))) ?>
		<?php echo Form::field('select', 'role_ids[]', __('layla_admin::account.edit.form.roles'), array($roles, $active_roles, array('multiple' => 'multiple')), array('error' => $errors->first('password'))) ?>
		<?php echo Form::field('select', 'language_id', __('layla_admin::account.edit.form.language'), array($languages, array($account->language->id)), array('error' => $errors->first('language_id'))) ?>

		<?php echo Form::actions(array(Form::submit(__('layla_admin::account.edit.buttons.edit'), array('class' => 'btn btn-large btn-primary')))) ?>
	<?php echo Form::close() ?>
</div>