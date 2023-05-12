@extends('layout.app')
@section('title', 'Our awesome Book Store')
@section('maincontent')

		<!-- BANNER -->
		<section class="banner_sec">
			<div class="container">
				<div class="row">
					<div class="col-12 col-md-10 col-lg-8">
					<h1>{{count($booksgenre) ?? ''}} Books Genres Available</h1>
						<div class="row">

						@foreach($booksgenre as $genre)
                                <div class="col-12 col-md-4 col-lg-4">

                                    <a href="">
                                        <div class="banner_box">
                                            <i class="fab fa-laravel"></i>
                                        <h3 class="banner_box_h3">{{$genre->genre}}</h3>
                                        </div>
                                    </a>

                                </div>
						@endforeach
                        </div>
					</div>
				</div>
			</div>
		</section>
		<!-- BANNER -->

		<!-- BODY -->
		<div class="home_body">
			<div class="container">
				<div class="latest_post">
					<div class="latest_post_top">
						<h1 class="latest_post_h1 brdr_line">Latest Books</h1>
					</div>
					<div class="row">
					@foreach($books as $book)

						<div class="col-12 col-md-6 col-lg-4">

                          <a href="/book/{{$book->id}}">
								<div class="home_card">
									<div class="home_card_top">
										<img src="/uploads/{{$book->image}}" alt="image">
									</div>
									<div class="home_card_bottom">
										<div class="home_card_bottom_text">
                                            <h2 class="home_card_h2">{{$book->title}}</h2>
											<div class="home_card_bottom_tym">
												<div class="home_card_btm_left">
												</div>
												<div class="home_card_btm_r8">
													<ul class="home_card_btm_r8_ul">
														<li><b>Book Author:</b> {{$book->author}}</li>
														<li><b>Book Genre:</b> {{$book->genre}}</li>
														<li><b>Book Isbn:</b> {{$book->isbn}}</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
						  </a>

                        </div>

						@endforeach

					</div>
				</div>

				{{$books->links()}}
			</div>

		</div>
		<!-- BODY -->
@endsection
