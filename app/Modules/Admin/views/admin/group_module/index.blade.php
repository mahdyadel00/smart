@extends('admin.layout.index',
[
	'title' => _i('Group Module'),
	'subtitle' => _i('Group Module'),
	'activePageName' => _i('Group Module'),
	'activePageUrl' => route('group_module.index'),
	'additionalPageName' =>  _i('Group Module'),
	'additionalPageUrl' => route('group_module.index')
])
@section('content')
<div class="box-body">
	<div class="row">
		<!-- @can('Create_content_modules') -->
            <div class="col-sm-12 mb-3">
                <span class="pull-left">
                    <a href="{{ route('group_module.create') }}" class="btn btn-primary create add-permissiont"
                        type="button"><span><i class="ti-plus"></i> {{ _i('create new Group Module ') }} </span></a>
                </span>
            </div>
        <!-- @endcan -->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>{{_i('group_module')}}</h5>
					<div class="card-header-right">
						<i class="icofont icofont-rounded-down"></i>
						<i class="icofont icofont-refresh"></i>
						<i class="icofont icofont-close-circled"></i>
					</div>
				</div>
				<div class="card-block">
					<div class="dt-responsive table-responsive text-center">
						<table id="slider_table" class="table table-bordered table-striped dataTable text-center">
							<thead>
								<tr role="row">
									<th>#</th>
									<th>{{ _i('title') }}</th>
									<!-- <th>{{ _i('Image Insturctions') }}</th> -->
									<th>{{ _i('Created at') }}</th>
									<th>{{ _i('Options') }}</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('js')
<script>
	var table = $('.dataTable').DataTable({
		order: [],
		processing: true,
		serverSide: true,
		ajax: '{{route('group_module.index')}}',
		columns: [
			{data: 'id', name: 'id'},
			{data: 'title', name: 'title'},
			// {data: 'image', name: 'image'},
			{data: 'created_at', name: 'created_at'},
			{data: 'options', name: 'options', orderable: true, searchable: true}
		]
	});

	


</script>
@endpush
