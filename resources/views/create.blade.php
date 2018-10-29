@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Create worker</div>

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

						<form method="post" action="{{ route('save.worker') }}">
							@csrf

							<div class="form-group">
								<label for="full_name">Full name</label>
								<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
							</div>

							<div class="form-group">
								<label for="salary">Salary</label>
								<input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" required>
							</div>

							<div class="form-group">
								<label for="position">Position</label>
								<select name="position" id="position" class="custom-select" required>
									<option selected disabled>Choose position</option>
									@foreach($positions as $position)
										<option value="{{ $position->id }}">{{ $position->title }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="boss">Boss</label>
								<select name="boss" id="boss" class="custom-select">
									<option value="0" selected>Choose Boss</option>
									@foreach($workers as $worker)
										<option value="{{ $worker->id }}">{{ $worker->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group" data-provide="datepicker">
								<label for="accepted_at">Accepted</label>
								<input type="date" class="form-control" name="accepted_at" id="accepted_at">
							</div>

							<button type="submit" class="btn btn-primary">Create</button>
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
