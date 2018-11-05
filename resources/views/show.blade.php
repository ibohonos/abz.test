@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<div class="row">
						<div class="col-md-12">
							<div class="list-group-item d-flex flex-column">
								<img class="p-2 align-self-center" src="{{ $worker->avatar }}" style="height: 200px;">
								<h1 class="p-2 align-self-center">{{ $worker->name }}</h1>
								<p>Position: <b>{{ $worker->position->title }}</b></p>
								<p>Salary: <b>{{ $worker->salary }}</b></p>
								@if($worker->boss)
									<p>Boss: <a href="{{ route('show.worker', $worker->boss->id) }}"><b>{{ $worker->boss->name }}</b></a></p>
								@endif
								@if($worker->subjects)
									<p>Subjects:
										@foreach($worker->subjects as $subject)
											<a href="{{ route('show.worker', $subject->id) }}"><b>{{ $subject->name }} </b></a>
										@endforeach
									</p>
								@endif
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>
</div>
@endsection

