@if(count($notifications) > 0)
<div class="alert-messages">
		@foreach($notifications as $notification)
		<div class="alert alert-{{ $notification['type'] }}">
			@if(isset($notification['close']) && $notification['close'] == true) 
				<a class="close">×</a>
			@endif
		{{ $notification['message'] }}
		</div>
		@endforeach
</div>
@endif