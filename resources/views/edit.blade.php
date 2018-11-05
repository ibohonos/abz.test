@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Update worker</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form method="post" action="{{ route('update.worker') }}" enctype="multipart/form-data">
							@csrf

							<div class="form-group">
								<label for="full_name">Full name</label>
								<input type="text" class="form-control" id="full_name" name="full_name" value="{{ $worker->name }}" placeholder="Enter full name" required>
							</div>

							<div class="form-group">
								<label for="avatar">Avatar</label>
								<img src="{{ $worker->avatar }}" class="img-thumbnail rounded mx-auto d-block w-25">
								<input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
							</div>

							<div class="form-group">
								<label for="salary">Salary</label>
								<input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{ $worker->salary }}" required>
							</div>

							<div class="form-group">
								<label for="position">Position</label>
								<select name="position" id="position" class="custom-select" required>
									<option disabled>Choose position</option>
									@foreach($positions as $position)
										<option value="{{ $position->id }}" @if($position->id === $worker->position->id) selected @endif>{{ $position->title }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="boss">Boss</label>
								<select name="boss" id="boss" class="custom-select">
									<option value="0">Choose Boss</option>
									@foreach($workers as $value)
										<option value="{{ $value->id }}" @if($worker->boss && $value->id === $worker->boss->id) selected @endif>{{ $value->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group" data-provide="datepicker">
								<label for="accepted_at">Accepted</label>
								<input type="date" class="form-control" name="accepted_at" id="accepted_at" value="{{ \Carbon\Carbon::parse($worker->accepted_at)->format('Y-m-d') }}">
							</div>

							<input type="hidden" name="worker_id" value="{{ $worker->id }}">
							<button type="submit" class="btn btn-primary">Update</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{{-- test --}}
@endsection
