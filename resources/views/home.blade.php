@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Workers</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<div class="row">
						<div class="col-md-12">
							<div class="list-group">
								@if($arr)
									@foreach($arr as $test_tree)
										{!! $test_tree !!}
									@endforeach
								@else
									<div class="list-group-item list-group-item-action">
										<h4 class="text-center">No results</h4>
									</div>
								@endif
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('styles')
	<style type="text/css">
		.level-1 {
			padding-left: 50px;
		}
		.level-2 {
			padding-left: 100px;
		}
		.level-3 {
			padding-left: 150px;
		}
		.level-4 {
			padding-left: 200px;
		}
	</style>
@endsection
