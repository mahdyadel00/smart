	<div class="modal fade modal_create " id="langedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		{{--    <div class="modal fade modal_create " id="langedit" role="dialog" aria-labelledby="exampleModalLabel" >--}}
		<div class="modal-dialog" role="document">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="header"> {{_i('Trans To')}} : </h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form  action="{{route('site.admin.permissions.storeTranslation')}}" method="post" class="form-horizontal"  id="lang_submit" data-parsley-validate="">
							{{method_field('post')}}
							{{csrf_field()}}

							<input type="hidden" name="id" id="id_data" value="">
							<input type="hidden" name="lang_id_data" id="lang_id_data" value="" >

							<div class="box-body">
								<div class="form-group row">
									<label for="" class="col-sm-2 control-label "> {{_i('Title')}} </label>
									<div class="col-md-10">
										<input type="text"  placeholder="{{_i('Permission Title')}}" name="title"  value="" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required="" id="titletrans" >
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">{{_i('Close')}}</button>

								<button type="submit" class="btn btn-primary" >
									{{_i('Save')}}
								</button>
							</div>
							<!-- /.box-footer -->
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
