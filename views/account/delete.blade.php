<div id="main">
	<div class="page-header">
		<h1><{{ __('admin::account.delete.title') }}</h1>
	</div>
	<div class="well">
		{{ __('admin::account.delete.message', array('name' => $account->name, 'email' => $account->email)) }}
	</div>
	{{ Form::open($url.'account/delete/'.$account->id, 'DELETE') }}
		{{ Form::submit(__('admin::account.delete.buttons.delete'), array('class' => 'btn btn-large btn-danger')) }}
		{{ HTML::link($url.'account', __('admin::account.delete.buttons.cancel'), array('class' => 'btn btn-large')) }}
	{{ Form::close() }}
</div>