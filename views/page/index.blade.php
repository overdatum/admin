<div id="main">
	<div class="page-header">
		<div class="pull-right" id="search">
			{{ Form::open($url.'account', 'GET') }}
				{{ Form::input('text', 'q', Input::get('q'), array('placeholder' => 'Search')) }}
				<button type="submit" class="btn btn-small btn-primary"><span class="icon-white icon-search">&nbsp;</span></button>
			{{ Form::close() }}		</div>
		<h1>Pages</h1>
	</div>

	{{ Notification::show() }}

	@if(count($pages->results) > 0)
		<table class="table table-striped">
			<thead>
				<tr>
					<th>{{ HTML::sort_link($url.'page', 'meta_title', 'title') }}</th>
					<th>{{ HTML::sort_link($url.'page', 'account_id', 'author') }}</th>
					<th>{{ HTML::sort_link($url.'page', 'created_at', 'created at') }}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			@foreach($pages->results as $page)
				<tr>
					<td>
						<h2>{{ $page->lang->meta_title }}</h2>
					</td>
					<td>
						{{ $page->account->name }}
					</td>
					<td>
						<!-- Date -->
							{{ date('d-m-Y', strtotime($page->created_at)) }}
						<!-- Time -->
							{{ date('G:i:s', strtotime($page->created_at)) }}
					</td>
					<td style="text-align:right">
						{{ HTML::link($url.'page/edit/'.$page->id, '<span class="icon-pencil"></span>', array('class' => 'btn btn-small')) }}
						{{ HTML::link($url.'page/delete/'.$page->id, '<span class="icon-trash icon-white"></span>', array('class' => 'btn btn-danger')) }}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pull-left">
			{{ $pages->links() }}
		</div>
	@else
		<div class="well">
			Er zijn geen pages gevonden...
		</div>
	@endif
	<div class="pull-right">
		{{ HTML::link($url.'page/add', '<span class="icon-white icon-plus-sign"></span> Add Page', array('class' => 'btn btn-large btn-primary')) }}
	</div>
</div>