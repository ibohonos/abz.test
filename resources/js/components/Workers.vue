<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">Workers list</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="list-group">
									<!-- @forelse($journals as $journal) -->
										<!-- <div class="list-group-item list-group-item-action">
											<a href="{{ route('show.journal', $journal->id) }}" class="card-link">
												<img class="d-inline-flex p-2 align-self-center" src="{{ $journal->image }}" style="width: 10%;">
												<h4 class="d-inline-flex p-2 align-self-center">{{ $journal->title }}</h4>
											</a> -->
											<!-- @if(Auth::id() && Auth::user()->is_admin) -->
												<!-- <a href="{{ route('delete.journal') }}" class="d-inline-flex p-2 align-self-center float-right card-link text-danger" onclick="event.preventDefault();
																	 document.getElementById('delete-form-{{ $journal->id }}').submit();">Delete</a>
												<form id="delete-form-{{ $journal->id }}" action="{{ route('delete.journal') }}" method="POST" style="display: none;"> -->
													<!-- @csrf -->
													<!-- <input type="hidden" name="journal_id" value="{{ $journal->id }}">
												</form>
												<a href="{{ route('edit.journal', $journal->id) }}" class="d-inline-flex p-2 align-self-center float-right card-link">Edit</a> -->
											<!-- @endif -->
										<!-- </div> -->
									<!-- @empty -->
										<div class="list-group-item list-group-item-action">
											<h4 class="text-center">No results</h4>
										</div>
									<!-- @endforelse -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			// workers: {
			// 	type: Object,
			// 	required: true
			// }
		},
		data() {
			return {};
		},
		methods: {

		},
		mounted() {
			// console.log(this.workers);
		}
	}
</script>
