@extends('admin.admin')
@section('content')
<div class="container">
	<br />
	<br />
	@if($showManagers)
		<h4 class="center">Managers</h4>
	@else
		<h4 class="center">Users</h4>
	@endif
	<br />
	<br />

	{{ $users->links('admin.controls.pagination') }}
	@if( count($users) > 0 )
		<ul class="collection">
			@foreach ($users as $user)
				<li class="collection-item avatar user-row">
					@if($user->profile_picture == '')
						<img src="{{URL::asset('/img/profile_picture.png')}}" class="circle">
					@else
						<img src="{{asset('storage/'.$user->id.'/'.$user->profile_picture)}}" class="circle">
					@endif
					<span class="title">
						{{ $user->name }}
						@if($user->is_blocked)
							<i class="material-icons" style="font-size: 12px;" title="Blocked">lock</i>
						@endif
					</span>
					<p>
						{{ $user->email }}
						<br />
						Package: <strong>{{ $user->package->name }}</strong> | Max disk space: <strong>{{ $user->package->max_disk_space }}MB</strong>
					</p>
					@if(Auth::user()->id != $user->id)
						<div class="fixed-action-btn horizontal right click-to-toggle" style="bottom: 20px;">
							<a class="btn-floating btn-large" title="Menu">
								<i class="material-icons">menu</i>
							</a>
							<ul>
								<li>
									@if($user->is_blocked)
										<a class="btn-floating green lighten-1" href="{{ route('unblockUser', ['id' => $user->id]) }}" title="Unblock">
											<i class="material-icons">lock_open</i>
										</a>
									@else
										<a class="btn-floating red lighten-1" href="{{ route('blockUser', ['id' => $user->id]) }}" title="Block">
											<i class="material-icons">lock</i>
										</a>
									@endif

								</li>
								@if(Auth::user()->hasRole('ADMIN'))
									@if($showManagers)
										<li>
											<a class="btn-floating red darken-4" href="{{ route('removeManager', ['id' => $user->id]) }}" title="Remove manager">
												<i class="material-icons">star</i>
											</a>
										</li>
									@else
										<li>
											<a class="btn-floating light-blue darken-1" href="{{ route('makeManager', ['id' => $user->id]) }}" title="Make manager">
												<i class="material-icons">star</i>
											</a>
										</li>
									@endif
								@endif

								<li>
									<a href="#change_package"
									class="activate_modal btn-floating yellow darken-4 change-package-btn"
									data-user-id="{{ $user->id }}"
									data-package-id="{{ $user->package->id }}"
									title="Change package">
										<i class="material-icons">swap_vert</i>
									</a>
								</li>
							</ul>
						</div>
					@endif
				</li>
			@endforeach
		</ul>
	{{ $users->links('admin.controls.pagination') }}

    @include('admin.controls.change-package-admin')
	@else
	<p class="center">No records found</p>
	@endif
</div>
@endsection

@section('scripts')
	@parent
	<script type="text/javascript">
	$('.user-row').on('click', function(){
		$('.user-row').not(this).removeClass('active');
		$('.directory-row').not(this).removeClass('active');
		$(this).addClass('active');
	});

	$('.change-package-btn').on('click', function(){
		var userId = $(this).data('userId');
		$('#change_package_form').find('#user_id').val(userId);
	});
	</script>
@endsection
