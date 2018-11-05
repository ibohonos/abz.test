<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header">Workers list</div>

					<div class="card-body">

						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control form-control-lg" v-model="query_term" placeholder="Please enter search query">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group col">
									<select class="form-control form-control-lg" v-model="search_as">
										<option value="name">Name</option>
										<option value="salary">Salary</option>
										<option value="accepted_at">Accepted</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-md-8">
								<label for="sortBy">Sort By</label>
								<select class="form-control" id="sortBy" v-model="sort_by">
									<option value="name">Name</option>
									<option value="salary">Salary</option>
									<option value="accepted_at">Accepted</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="orderBy">Order By</label>
								<select class="form-control" id="orderBy" v-model="order_by">
									<option value="asc">Asc</option>
									<option value="desc">Desc</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="list-group">
									<div v-if="workers.length > 0" class="list-group-item list-group-item-action" v-for="worker in workers">
										<a :href="'/worker/' + worker.id" class="card-link">
											<img class="d-inline-flex pl-2 align-self-center" :src="worker.avatar" style="width: 10%;">
											<div class="d-inline-flex pl-2 align-self-center flex-column">
												<h4>{{ worker.name }}</h4>
												<h6>{{ worker.salary }}</h6>
												<h6>{{ worker.position.title }}</h6>
											</div>
										</a>
										<a href="/delete" class="d-inline-flex p-2 align-self-center float-right card-link text-danger" :onclick="'event.preventDefault();document.getElementById(\'delete-form-' + worker.id + '\').submit();'">Delete</a>
										<form :id="'delete-form-' + worker.id" action="/delete" method="POST" style="display: none;">
											<input type="hidden" name="_token" :value="csrf_token">
											<input type="hidden" name="worker_id" :value="worker.id">
										</form>
										<a :href="'edit' + worker.id" class="d-inline-flex p-2 align-self-center float-right card-link">Edit</a>
									</div>
									<div v-else class="list-group-item list-group-item-action">
										<h4 class="text-center">No results</h4>
									</div>
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
		data() {
			return {
				workers: {},
				csrf_token: window.token,
				query_term: "",
				search_as: "name",
				sort_by: "name",
				order_by: "asc"
			};
		},
		watch: {
			query_term() {
				this.debouncedGetAllWorkers();
			},
			search_as() {
				this.debouncedGetAllWorkers();
			},
			sort_by() {
				this.debouncedGetAllWorkers();
			},
			order_by() {
				this.debouncedGetAllWorkers();
			}
		},
		created() {
			this.debouncedGetAllWorkers = _.debounce(this.getList, 500)
		},
		methods: {
			getList() {
				axios.get('/api/list-workers', {
					params: {
						query_term: this.query_term,
						search_as: this.search_as,
						sort_by: this.sort_by,
						order_by: this.order_by
					}
				}).then(resp => {
						this.workers = resp.data.data.workers;
					});
			},
		},
		mounted() {
			this.getList();
		}
	}
</script>
