@extends('admin.layout.index',[
	'title' => _i('Online customers'),
	'subtitle' => _i('Online customers'),
	'activePageName' => _i('Online customers'),
	'activePageUrl' => '',
	'additionalPageUrl' => route('user.create') ,
	'additionalPageName' => '',
] )

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>{{_i('Online customers')}}</h5>
					<div class="card-header-right">
						<i class="icofont icofont-rounded-down"></i>
						<i class="icofont icofont-refresh"></i>
						<i class="icofont icofont-close-circled"></i>
					</div>
				</div>
				<div class="card-block">
					<div class="dt-responsive table-responsive">
						<table id="dataTable" class="table table-bordered table-striped dataTable">
							<thead>
							<tr role="row">
								<th  > {{_i('ID')}}</th>
								<th  > {{_i('Name')}}</th>
								<th  > {{_i('Image')}}</th>
								<th  > {{_i('Email')}}</th>
								<th  > {{_i('Created At')}}</th>
								<th  > {{_i('Edit')}}</th>
								<th  > {{_i('Delete')}}</th>
							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('js')
	<script  type="text/javascript">
		$(function() {
			$('#dataTable').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('customers.online') }}',
				columns: [
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'image', name: 'image'},
					{data: 'email', name: 'email'},
					{data: 'created_at', name: 'created_at'},
					{data: 'edit', name: 'edit', orderable: false, searchable: false},
					{data: 'delete', name: 'delete', orderable: false, searchable: false}
				]
			});
		});
	</script>
@endpush
