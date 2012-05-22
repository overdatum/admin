<div id="main">
	<div class="page-header">
		
		<! -- Search field -->
		<div class="pull-right" id="search">
			{{ Form::open($url.'account', 'GET') }}
				{{ Form::input('text', 'q', Input::get('q'), array('placeholder' => 'Search')) }}
				<button type="submit" class="btn btn-small btn-primary"><span class="icon-white icon-search">&nbsp;</span></button>
			{{ Form::close() }}
		</div>
		
		
		<h1>{{ __('layla_admin::account.index.title') }}</h1>
	</div>

	{{ Notification::show() }}
	
	
	@if(count($accounts->results) > 0)
		<table class="table table-striped">
			<thead>
				<tr>
					<th>{{ HTML::sort_link($url.'account', 'name', __('layla_admin::account.index.table.name')) }}</th>
					<th>{{ HTML::sort_link($url.'account', 'email', __('layla_admin::account.index.table.email')) }}</th>
					<th>{{ __('layla_admin::account.index.table.roles') }}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($accounts->results as $account)
				<tr>
					<td>
						<h2>{{ $account->name }}</h2>
					</td>
					<td>
						{{ $account->email }}
					</td>
					<td>	
						@if(array_key_exists('roles', $account))
							@foreach($account->roles as $role)
								 <b> {{ $role->lang->name }} </b> - {{ $role->lang->description }}
							@endforeach
						@endif
					</td>
					<td style="text-align:right">
						{{ HTML::link($url.'account/edit/'.$account->id, '<span class="icon-pencil"></span>', array('class' => 'btn btn-small')) }}
						{{ HTML::link($url.'account/delete/'.$account->id, '<span class="icon-trash icon-white"></span>', array('class' => 'btn btn-danger')) }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pull-left">
			{{ $accounts->links() }}
		</div>
	@else
		<div class="well">
			{{ __('layla_admin::account.index.table.no_results') }}
		</div>
	@endif

	<div class="pull-right">
		{{ HTML::link($url.'account/add', '<span class="icon-white icon-plus-sign"></span> '.__('layla_admin::account.index.buttons.add'), array('class' => 'btn btn-large btn-primary')) }}
	</div>
</div>