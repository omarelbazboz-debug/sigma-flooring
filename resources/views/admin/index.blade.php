@extends('layouts.admin')
@section('content')

<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0 font-size-18">{{trans('home.WelcomeToAdminPanel')}}</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{url('/admin')}}">{{trans('home.admin')}}</a></li>
						<li class="breadcrumb-item active">{{trans('home.dashboard')}}</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row">

		<div class="col-xl-3 col-md-6">
			<!-- card -->
			<div class="card card-h-100">
				<!-- card body -->
				<a href="{{LaravelLocalization::localizeUrl('admin/users')}}">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-12">
								<span class="text-muted mb-3 lh-1 d-block text-truncate">{{trans('home.Total Users')}}</span>
								<h2 class="mb-1">
									<span class="counter-value" data-target="{{$users}}">0</span>
								</h2>
							</div>
						</div>
					</div><!-- end card body -->
				</a>
			</div><!-- end card -->
		</div><!-- end col -->
		
		<div class="col-xl-3 col-md-6">
			<!-- card -->
			<div class="card card-h-100">
				<!-- card body -->
				<a href="{{LaravelLocalization::localizeUrl('admin/contact-us-messages')}}">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-12">
								<span class="text-muted mb-3 lh-1 d-block text-truncate">{{trans('home.Total messages')}}</span>
								<h2 class="mb-1">
									<span class="counter-value" data-target="{{$messages}}">0</span>
								</h2>
							</div>
						</div>
					</div><!-- end card body -->
				</a>
			</div><!-- end card -->
		</div><!-- end col -->
		
		<div class="col-xl-3 col-md-6">
			<!-- card -->
			<div class="card card-h-100">
				<!-- card body -->
				<a href="{{LaravelLocalization::localizeUrl('admin/services')}}">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-12">
								<span class="text-muted mb-3 lh-1 d-block text-truncate">{{trans('home.Total services')}}</span>
								<h2 class="mb-1">
									<span class="counter-value" data-target="{{$services}}">0</span>
								</h2>
							</div>
						</div>
					</div><!-- end card body -->
				</a>
			</div><!-- end card -->
		</div><!-- end col -->
		<div class="col-xl-3 col-md-6">
			<!-- card -->
			<div class="card card-h-100">
				<!-- card body -->
				<a href="{{LaravelLocalization::localizeUrl('admin/blog-items')}}">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-12">
								<span class="text-muted mb-3 lh-1 d-block text-truncate">{{trans('home.Total blogs')}}</span>
								<h2 class="mb-1">
									<span class="counter-value" data-target="{{$blogs}}">0</span>
								</h2>
							</div>
						</div>
					</div><!-- end card body -->
				</a>
			</div><!-- end card -->
		</div><!-- end col -->
	
		<div class="col-xl-3 col-md-6">
			<!-- card -->
			<div class="card card-h-100">
				<!-- card body -->
				<a href="{{LaravelLocalization::localizeUrl('admin/blog-categories')}}">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-12">
								<span class="text-muted mb-3 lh-1 d-block text-truncate">{{trans('home.Total Blog Categories')}}</span>
								<h2 class="mb-1">
									<span class="counter-value" data-target="{{$blogcat}}">0</span>
								</h2>
							</div>

						</div>
					</div><!-- end card body -->
				</a>
			</div><!-- end card -->
		</div><!-- end col -->


	</div>

</div>
@endsection
