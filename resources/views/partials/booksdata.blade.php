@extends('layout.app')
@section('title','anish')
@section('maincontent')
<!-- BANNER -->
<div class="blog_banner" style="background: url('/img/banner.jpg') no-repeat center center;">
</div>
<!-- BANNER -->
    <!-- BODY -->
		<div class="blog_post_sec_all">
			<div class="container">
				<div class="row">
					<div class="cl-12 col-md-12 col-lg-9">
						<div class="blog_post_left">
							<div class="blog_post_sec">
								<div class="blog_post_top">
									<ul class="blog_post_top_ul">
									Book Author Name : <li>
                                                    {{ $bookdetail->author ?? ''}}
                                                </li>

												Book Publish Date:<li>{{ $bookdetail->published ?? ''}}</li>
									</ul>
								</div>
								<div class="blog_post">
                                <h1 class="blog_post_h1">anish</h1>
									<div class="post_author_sec">
										<div class="post_author_left">
											<div class="post_author_img">
												<img src="{{url('/uploads/'.$bookdetail->image)}}" alt="image">
											</div>
											<div class="post_author_info">
                                            <h4 class="post_author_title">{{ $bookdetail->title ?? ''}}</h4>
												<P>{{ $bookdetail->description ?? ''}}</P>
											</div>
										</div>
										<div class="post_author_r8">
											<i class="fas fa-share-alt"></i>
										</div>
									</div>
									<div class="riview_post">
										<ul class="riview_post_ul">
											<li><i class=""></i>Book Isbn: {{ $bookdetail->isbn ?? ''}}</li>
											<li><i class=""></i>Book Publisher:{{ $bookdetail->publisher ?? ''}}</li>
										</ul>
									</div>
								</div>
							</div>



						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- BODY -->
@endsection