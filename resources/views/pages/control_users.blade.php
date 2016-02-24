@extends('admin')

@section('content')

<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption capitalize">
			<i class="fa  fa-ellipsis-v"></i> corporate access control
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form" style="height:300px;">
		<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;height:300px;">
			
			<div class="portlet-body">
				<div class="table-container">
					
			<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr>
					<th class="table-checkbox">
						<input type="checkbox" class="group-checkable"/>
					</th>
					<th>
						 User Id
					</th>
					<th style="width:15%">
						 Firm Name
					</th>
					<th>
						 Firm Type
					</th>
					<th>
						 Email
					</th>
					<th>
						 Subscribe
					</th>
					<th>
						 Contact View
					</th>
					<th>
						 Contact View Count
					</th>
					<th style="width:10%">
						 Post Job
					</th>
					<th>
						 Post Job Count
					</th>
					<th>
						 View Resume
					</th>
					<th>
						 View Resume Count
					</th>
				</tr>
				</thead>
				<tbody>
					@foreach($controlCorp as $cc)
					<form>
						<tr class="odd gradeX">
							<td>
								<button type="submit" class="btn btn-success">
									<i class="fa fa-save (alias)" style="color: black;font-size: 20px;">
									</i>
								</button>
							</td>
							<td>
								{{$cc->id}}
							</td>
							<td>
								{{$cc->firm_name}}
							</td>
							<td>
								@if($cc->firm_type == 'company')
								<span class="label label-sm label-success capitalize">
									{{$cc->firm_type}}
								</span>
								@else
								<span class="label label-sm label-info capitalize">
									{{$cc->firm_type}}
								</span>
								@endif
							</td>
							<td>
								{{$cc->firm_email_id}}
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="subscribe" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="subscribe" value="No">
								No </label>
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="contact_view" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="contact_view" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="post_job" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="post_job" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="view_resume" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="view_resume" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
						</tr>
					</form>
					@endforeach
				</tbody>
			</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption capitalize">
			<i class="fa  fa-ellipsis-v"></i> individual access control
		</div>
		<div class="tools">
			<a href="javascript:;" class="collapse">
			</a>
			<a href="#portlet-config" data-toggle="modal" class="config">
			</a>
			<a href="javascript:;" class="reload">
			</a>
			<a href="javascript:;" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form" style="height:300px;">
		<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;height:300px;">
			
			<div class="portlet-body">
				<div class="table-container">
					
			<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
				<thead>
				<tr>
					<th class="table-checkbox">
						<input type="checkbox" class="group-checkable"/>
					</th>
					<th>
						 User Id
					</th>
					<th>
						 Full Name
					</th>
					<th>
						 Email
					</th>
					<th>
						 Subscribe
					</th>
					<th>
						 Contact View
					</th>
					<th>
						 Contact View Count
					</th>
					<th>
						 Post Job
					</th>
					<th>
						 Post Job Count
					</th>
					<th>
						 View Resume
					</th>
					<th>
						 View Resume Count
					</th>
				</tr>
				</thead>
				<tbody>
					@foreach($controlInd as $ci)
					<form>
						<tr class="odd gradeX">
							<td>
								<button type="submit" class="btn btn-success">
									<i class="fa fa-save (alias)" style="color: black;font-size: 20px;">
									</i>
								</button>
							</td>
							<td>
								{{$ci->id}}
							</td>
							<td>
								{{$ci->fname}} {{$ci->lanme}}
							</td>
							<td>
								{{$ci->email}}
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="subscribe" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="subscribe" value="No">
								No </label>
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="contact_view" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="contact_view" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="post_job" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="post_job" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
							<td>
								<label class="uniform-inline" style="">
								<input type="radio" name="view_resume" value="Yes">
								Yes </label>
								<label class="uniform-inline" style="">
								<input type="radio" name="view_resume" value="No">
								No </label>
							</td>
							<td>
								<input type="text" class="form-control">
							</td>
						</tr>
					</form>
					@endforeach
				</tbody>
			</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
@stop
@section('javascript')

@stop