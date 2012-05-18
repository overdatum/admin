<div class="row">
	<div class="span12">
		<div class="page-header">
			<h1><?php echo __('layla_admin::auth.login.title') ?></h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="span12">
		<?php echo Form::open($url.'auth/login', 'PUT', array('class' => 'form-horizontal')) ?>
			<?php echo Form::field('text', 'email', __('layla_admin::auth.login.form.email'), array(Input::old('email')), array('error' => $errors->first('email'))) ?>
			<?php echo Form::field('password', 'password', __('layla_admin::auth.login.form.password'), array(), array('error' => $errors->first('password'))) ?>
			<?php echo Form::actions(array(Form::submit(__('layla_admin::auth.login.buttons.login'), array('class' => 'btn-large btn-primary')))) ?>
		<?php echo Form::close() ?>
	</div>
</div>