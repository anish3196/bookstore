@extends('layout.app')
@section('title', 'Our awesome Book Store')
@section('maincontent')

<!-- BANNER -->
<section class="banner_sec">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-10 col-lg-8">
				<h1 style="color:white">{{count($genres) ?? ''}} Book Genres Available</h1>
				<div class="row">

					@foreach($genres as $genre)
					<div class="col-12 col-md-4 col-lg-4">
							<div class="banner_box">
								<i class="fa fa-book"></i>
								<h3 class="banner_box_h3">{{$genre->genre}}</h3>
							</div>
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
			<div class="career-filter flex career-div-fle">
				<form action="{{url('main/bookserach')}}" method="post" class="flex">
					@csrf
					<div class="car-sel">
						<select class="" name="title" id="title">
							<option value="" selected disabled>Select Book Title</option>
							@foreach($titles as $title)
							<option value="{{ $title->title }}" {{isset($request->title) && $request->title!='' && $request->title==$title->title ? 'selected' : ''}}>{{ $title->title }}</option>
							@endforeach
						</select>
					</div>
					<div class="car-sel">
						<select class=""  name="author" id="author">
							<option value="" selected disabled>Select Book Author</option>
							@foreach($authors as $author)
							<option value="{{ $author->author }}" {{isset($request->author) && $request->author!='' && $request->author==$author->author ? 'selected' : ''}}>{{ $author->author }}</option>
							@endforeach
						</select>
					</div>
					<div class="car-sel">
						<select class=""  name="isbn" id="isbn">

							<option value="" selected disabled>Select Isbn</option>
							@foreach($isbns as $isbn)
							<option value="{{ $isbn->isbn }}" {{isset($request->author) && $request->isbn!='' && $request->isbn==$isbn->isbn ? 'selected' : ''}}>{{ $isbn->isbn }}</option>
							@endforeach
						</select>
					</div>
					<div class="car-sel">
						<select class=""  name="genre" id="genre">

							<option value="" selected disabled>Select Gnere</option>
							@foreach($genres as $genre)
							<option value="{{ $genre->genre }}" {{isset($request->genre) && $request->genre!='' && $request->genre==$genre->genre ? 'selected' : ''}}>{{ $genre->genre }}</option>
							@endforeach
						</select>
					</div>
					<div class="car-sel">
						<select class=""  name="publisher" id="publisher">

							<option value="" selected disabled>Select publication</option>
							@foreach($publishers as $publication)
							<option value="{{ $publication->publisher }}" {{isset($request->publisher) && $request->publisher!='' && $request->publisher==$publication->publisher ? 'selected' : ''}}>{{ $publication->publisher }}</option>
							@endforeach
						</select>
					</div>
					<div class="car-sel">
						<input type="date" name="published" class="form-control" style="padding:23px"  />
					</div>
					<div class="car-sel">
						<button type="submit" type="button" class="btn btn-primary" style="margin:5px">Search</button>
						<!--<img id="searchid" src="images/search-ic.jpg" alt="" onclick="image(this)">-->
                    </div>
				</form>
			</div>
			<div class="row">

				@if($search == "yes")
				<h1> </h1>
				<h3>
				Total Books Found:{{count($books)?? ''}}
				</h3>
				<a href="{{url('/book')}}"><button type="button" class="btn btn-primary">Clear Search</button></a>
				@foreach($books as $book)

				<div class="col-12 col-md-6 col-lg-4">

					<a href="{{url('bookdetails/'.$book->id)}}">
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
				@else
				<h3>
				Total Books:{{count($books)?? ''}}
				</h3>
				@foreach($books as $book)

				<div class="col-12 col-md-6 col-lg-4">

					<a href="{{url('bookdetails/'.$book->id)}}">
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
				@endif
			</div>
		</div>

		{{$books->links()}}
	</div>

</div>
<!-- BODY -->
@endsection