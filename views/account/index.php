<div id="main">
	<div class="page-header">
		<div class="pull-right">
			<?php echo Form::open($url.'account', 'GET') ?>
				<?php echo Form::input('text', 'q', Input::get('q')) ?> &nbsp;
				<button type="submit" class="btn btn-small btn-primary"><i class="icon-white icon-search">&nbsp;</i></button>
			<?php echo Form::close() ?>
		</div>
		<h1><?php echo __('layla_admin::account.index.title') ?></h1>
	</div>

	<?php Notification::show() ?>

	<?php if(count($accounts->results) > 0): ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo HTML::sort_link($url.'account', 'name', __('layla_admin::account.index.table.name')) ?></th>
					<th><?php echo HTML::sort_link($url.'account', 'email', __('layla_admin::account.index.table.email')) ?></th>
					<th><?php echo __('layla_admin::account.index.table.roles') ?></th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($accounts->results as $account): ?>
				<tr>
					<td>
						<h2><?php echo $account->name ?></h2>
					</td>
					<td>
						<?php echo $account->email ?>
					</td>
					<td>
						<?php
						if(array_key_exists('roles', $account))
						{
							foreach($account->roles as $role)
							{
								echo '<b>' . $role->lang->name . '</b><br>' . $role->lang->description . '<br><br>';
							}
						}
						?>
					</td>
					<td style="text-align:right">
						<?php echo HTML::link($url.'account/edit/'.$account->id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-small')) ?>
						<?php echo HTML::link($url.'account/delete/'.$account->id, '<i class="icon-trash icon-white"></i>', array('class' => 'btn btn-danger')) ?>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
		<div class="pull-left">
			<?php echo $accounts->links() ?>
		</div>
	<?php else: ?>
		<div class="well">
			<?php echo __('layla_admin::account.index.table.no_results') ?>
		</div>
	<?php endif ?>
	<div class="pull-right">
		<?php echo HTML::link($url.'account/add', '<i class="icon-white icon-plus-sign"></i> '.__('layla_admin::account.index.buttons.add'), array('class' => 'btn btn-large btn-primary')) ?>
	</div>
</div>