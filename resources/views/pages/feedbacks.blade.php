@extends('admin')

@section('content')

	<!-- BEGIN PAGE HEADER-->
	<h3 class="page-title">
	Feedbacks <small>reports & statistics</small>
	</h3>
	<!-- END PAGE HEADER-->

	<div class="clearfix"></div>
	

	<div class="row">
	<div class="col-md-12">
		<!-- Begin: life time stats -->
		<div class="portlet" style="overflow-x:scroll;">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-shopping-cart"></i>Feedback Report
				</div>
				<div class="actions">
					<a href="javascript:;" class="btn default yellow-stripe">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">
					New Order </span>
					</a>
					<div class="btn-group">
						<a class="btn default yellow-stripe" href="javascript:;" data-toggle="dropdown">
						<i class="fa fa-share"></i>
						<span class="hidden-480">
						Tools </span>
						<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:;">
								Export to Excel </a>
							</li>
							<li>
								<a href="javascript:;">
								Export to CSV </a>
							</li>
							<li>
								<a href="javascript:;">
								Export to XML </a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="javascript:;">
								Print Invoices </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-container">
					<div class="table-actions-wrapper">
						<span>
						</span>
						<select class="table-group-action-input form-control input-inline input-small input-sm">
							<option value="">Select...</option>
							<option value="Cancel">Cancel</option>
							<option value="Cancel">Hold</option>
							<option value="Cancel">On Hold</option>
							<option value="Close">Close</option>
						</select>
						<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
					</div>
					<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
					<thead>
					<tr>
						<th class="table-checkbox">
							<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
						</th>
						<th>
							 Date
						</th>
						<th>
							 Name
						</th>
						<th>
							 User Type
						</th>
						<th>
							 Rating
						</th>
						<th>
							 Usability
						</th>
						<th style="width:35%;">
							 Comments
						</th>
						<th>
							 IP Address
						</th>
					</tr>
					</thead>
					@foreach($feedbacks as $feed)
					<tbody>
					<tr class="odd gradeX">
						<td>
							<input type="checkbox" class="checkboxes" value="1"/>
						</td>
						<td>
							 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($feed->created_at))->diffForHumans() }}
						</td>
						<td>
							@if($feed->user->induser != null)
							{{$feed->user->induser->fname}}
							@elseif($feed->user->corpuser != null)
							{{$feed->user->corpuser->firm_name}}
							@endif
						</td>
						<td>
							 @if($feed->user->induser != null)
							 Individual
							 @elseif($feed->user->corpuser != null)
							 {{$feed->user->corpuser->firm_type}}
							 @endif
						</td>
						<td class="center">
							 {{$feed->experience}}
						</td>
						<td>
							@if($feed->usability == 'Easy')
							<span class="label label-sm label-success">
							{{$feed->usability}} </span>
							@elseif($feed->usability == 'Okay')
							<span class="label label-sm label-warning">
							{{$feed->usability}} </span>
							@elseif($feed->usability == 'Hard')
							<span class="label label-sm label-danger">
							{{$feed->usability}} </span>
							@endif
						</td>
						<td>
							{{$feed->comments}} 
						</td>
						<td>
							
						</td>
					</tr>
					</tbody>
					@endforeach
					</table>
				</div>
			</div>
		</div>
		<!-- End: life time stats -->
	</div>
</div>
<!-- END PAGE CONTENT-->
	<div class="row" style="margin: 15px -15px;">
		<div class="col-md-12 col-sm-12">
			<ul class="feeds">
				@foreach($feedbacks as $feed)
				<li>
					<div class="col1">
						<div class="cont">
							<div class="cont-col1">
								<div class="label label-sm label-danger">
									<i class="fa fa-bullhorn"></i>
								</div>
							</div>
							<div class="cont-col2">
								<div class="desc">
									
									<b>@if($feed->user->induser != null)
										{{$feed->user->induser->fname}}
										@elseif($feed->user->corpuser != null)
										{{$feed->user->corpuser->firm_name}}
										@endif
									</b> has rated  
									<b>{{$feed->experience}}</b> for his experience with Jobtip &amp; find it  
									<b>{{$feed->usability}}</b> to use
									as commented "{{$feed->comments}}"									
								</div>
							</div>
						</div>
					</div>
					<div class="col2">
						<div class="date">
							 {{ \Carbon\Carbon::createFromTimeStamp(strtotime($feed->created_at))->diffForHumans() }}
						</div>
					</div>
				</li>
				@endforeach
			</ul>		
		</div>
	</div>
		
	<div class="clearfix">
	</div>
	
@stop

@section('javascript')
@stop