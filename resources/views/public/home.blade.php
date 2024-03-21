@extends('public.layouts.parent')

@section('title', "Corporate Artisan Network")

@section('banner')
	<div class="wt-haslayout wt-bannerholder">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-5">
					<div class="wt-bannerimages">
						<figure class="wt-bannermanimg" data-tilt>
							<img src="images/bannerimg/img-01.png" alt="img description">
							<img src="images/bannerimg/img-02.png" class="wt-bannermanimgone" alt="img description">
							<img src="images/bannerimg/img-03.png" class="wt-bannermanimgtwo" alt="img description">
						</figure>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
					<div class="wt-bannercontent">
						<div class="wt-bannerhead">
							<div class="wt-title">
								<h1><span>Find the right artisan</span> for any job, Online</h1>
							</div>
							<div class="wt-description">
								<p>Artisan connects businesses with freelancers offering digital services in 30+ categories.</p>
							</div>
						</div>
						<form action="{{route("public.search")}}" class="wt-formtheme wt-formbanner">
							<fieldset>
								<div class="form-group">
									<input type="text" name="query" class="form-control" placeholder="Search for your artisan..." required>
									<div class="wt-formoptions">
										{{-- <div class="wt-dropdown">
											<span>In: <em class="selected-search-type">Freelancers </em><i class="lnr lnr-chevron-down"></i></span>
										</div> --}}
										{{-- <div class="wt-radioholder">
											<span class="wt-radio">
												<input id="wt-freelancers" data-title="Freelancers" type="radio" name="searchtype" value="freelancer" checked>
												<label for="wt-freelancers">Freelancers</label>
											</span>
											<span class="wt-radio">
												<input id="wt-jobs"  data-title="Jobs" type="radio" name="searchtype" value="job">
												<label for="wt-jobs">Jobs</label>
											</span>
											<span class="wt-radio">
												<input id="wt-company"  data-title="Companies" type="radio" name="searchtype" value="job">
												<label for="wt-company">Companies</label>
											</span>
										</div>  --}}
										<button type="submit" class="wt-searchbtn">
											<i class="lnr lnr-magnifier"></i>
										</button>
									</div>
								</div>
							</fieldset>

							{{-- <script>
								document.getElementById('query').addEventListener('input', function() {
									var query = this.value.trim();
									if (query.length > 0) {
										// Make an AJAX request to your Laravel backend
										fetchSearchSuggestions(query);
									} else {
										// Clear the search suggestions box if the query is empty
										document.querySelector('.search-suggestions').innerHTML = '';
									}
								});
							
								function fetchSearchSuggestions(query) {
									// Make an AJAX request to your Laravel backend
									fetch('{{route("public.search.suggestions")}}', {
										method: 'POST',
										headers: {
											'Content-Type': 'application/json',
											'X-CSRF-TOKEN': '{{ csrf_token() }}'
										},
										body: JSON.stringify({ query: query })
									})
									.then(response => response.json())
									.then(data => {
										// Populate the search suggestions box with the returned suggestions
										var suggestionsHTML = data.map(item => 
							
										`
										
										<span class="wt-radio">
											<input id="wt-${item.id}" data-title="${item.title}" type="radio" name="searchtype" value="${item.title}">
											<label for="wt-${item.id}">${item.title}</label>
										</span>
										
										`).join('');
										document.querySelector('.search-suggestions').innerHTML = suggestionsHTML;
									})
									.catch(error => {
										console.error('Error:', error);
									});
								}
							
								document.querySelector('.search-suggestions').addEventListener('click', function(event) {
									// Check if the clicked element is an input element
									if (event.target.tagName === 'INPUT') {
										// Get the title of the clicked suggestion
										var title = event.target.getAttribute('data-title');
										
										// Update the value of the search box with the title of the clicked suggestion
										document.getElementById('query').value = title;
									}
								});
							</script> --}}
						</form>
						<div class="wt-videoholder">
							<div class="wt-videoshow">
								<a data-rel="prettyPhoto[video]" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i class="fa fa-play"></i></a>
							</div>
							<div class="wt-videocontent">
								<span>See For Yourself!<em>How it works </em></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<main id="wt-main" class="wt-main wt-haslayout">

		<!--Categories Start-->
			<section class="wt-haslayout wt-main-section">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
							<div class="wt-sectionhead wt-textcenter">
								<div class="wt-sectiontitle">
									<h2>Explore Categories</h2>
									<span>Gigs by categories</span>
								</div>
							</div>
						</div>
						<div class="wt-categoryexpl">

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure>
										<img src="images/categories/img-01.png" alt="image description">
									</figure>
									<div class="wt-cattitle">
										<h3>
											<a href="{{ route('public.search', ['category' => $categories[9]->id]) }} ">{{ $categories[9]->name }}</a>
										</h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[9]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[9]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-08.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[13]->id]) }}">{{ $categories[13]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[13]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[13]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-02.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[18]->id]) }}">{{ $categories[18]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[18]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[18]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-03.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[20]->id]) }}">{{ $categories[20]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[20]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[20]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-04.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[17]->id]) }}">{{ $categories[17]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[17]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[17]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-05.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[1]->id]) }}">{{ $categories[1]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[1]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[1]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-06.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[2]->id]) }}">{{ $categories[2]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[2]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[2]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-3 col-lg-3 float-left">
								<div class="wt-categorycontent">
									<figure><img src="images/categories/img-07.png" alt="image description"></figure>
									<div class="wt-cattitle">
										<h3><a href="{{ route('public.search', ['category' => $categories[21]->id]) }}">{{ $categories[21]->name }}</a></h3>
									</div>
									<div class="wt-categoryslidup">
										<p>{{ $categories[21]->description }}</p>
										<a href="{{ route('public.search', ['category' => $categories[21]->id]) }}">Explore <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
								{{-- <div class="wt-btnarea">
									<a href="javascript:void(0)" class="wt-btn">View All</a>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</section>
		<!--Categories End-->

		<!--Signup Start-->
			{{-- <section class="wt-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="wt-signupholder">
								<div class="col-12 col-sm-12 col-md-12 col-lg-6 pull-right">
									<div class="wt-signupcontent">
										<div class="wt-title">
											<h2><span>Signup as</span>Worktern Pro</h2>
										</div>
										<div class="wt-description">
											<p>Consectetur adipisicing elit amissed dotem eiusmod tempor incuntes utneai labore etdolore.</p>
										</div>
										<div class="wt-btnarea">
											<a href="javascript:void(0);" class="wt-btn wt-btnvtwo">Join Now</a>
											<a href="javascript:void(0);" class="wt-btn">What’s new</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> --}}
		<!--Signup End-->

		<!--Join Company Info Start-->
			<section class="wt-haslayout wt-main-section wt-paddingnull wt-companyinfohold">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
							<div class="wt-companydetails">
								<div class="wt-companycontent">
									<div class="wt-companyinfotitle">
										<h2>Start As Company</h2>
									</div>
									<div class="wt-description">
										<p>Empower your business with Corporate Artisan Network. Access a diverse pool of skilled freelancers, foster innovation, and elevate your projects to new heights!</p>
									</div>
									<div class="wt-btnarea">
										<a href="{{ route("companies.create") }}" class="wt-btn">Join Now</a>
									</div>
								</div>
								<div class="wt-companycontent">
									<div class="wt-companyinfotitle">
										<h2>Start As Freelancer</h2>
									</div>
									<div class="wt-description">
										<p>Join Corporate Artisan Network: Unleash your freelance potential! Connect with opportunities, showcase your skills, and thrive in a dynamic professional ecosystem.</p>
									</div>
									<div class="wt-btnarea">
										<a href="{{ route("freelancers.create") }}" class="wt-btn">Join Now</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!--Join Company Info End-->

		

		<!--Limitless Experience Start-->
			{{-- <section class="wt-haslayout wt-main-section">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
							<figure class="wt-mobileimg">
								<img src="images/mobile-img.png" alt="img description">
							</figure>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 float-left">
							<div class="wt-experienceholder">
								<div class="wt-sectionhead">
									<div class="wt-sectiontitle">
										<h2>Explore Categories</h2>
										<span>Professional by categories</span>
									</div>
									<div class="wt-description">
										<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eu fugiat nulla pariatur lokaim urianewce.</p>
										<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumed perspiciatis.</p>
									</div>
									<ul class="wt-appicon">
										<li>
											<a href="javascript:void(0)">
												<figure><img src="images/app-icon/img-01.png" alt="img description"></figure>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)">
												<figure><img src="images/app-icon/img-02.png" alt="img description"></figure>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> --}}
		<!--Limitless Experience End-->

		<!--Skills Start-->
			{{-- <section class="wt-haslayaout wt-main-section wt-footeraboutus">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="wt-widgetskills">
								<div class="wt-fwidgettitle">
									<h3>By Skills</h3>
								</div>
								<ul class="wt-fwidgetcontent">
									<li><a href="javascript:void(0);">Software Engineer</a></li>
									<li><a href="javascript:void(0);">Technical Writer</a></li>
									<li><a href="javascript:void(0);">UI Designer</a></li>
									<li><a href="javascript:void(0);">UX Designer</a></li>
									<li><a href="javascript:void(0);">Virtual Assistant</a></li>
									<li><a href="javascript:void(0);">Web Designer</a></li>
									<li><a href="javascript:void(0);">Wordpress Developer</a></li>
									<li><a href="javascript:void(0);">Content Writer</a></li>
									<li class="wt-viewmore"><a href="javascript:void(0);">+ View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="wt-widgetskill">
								<div class="wt-fwidgettitle">
									<h3>Skills In US</h3>
								</div>
								<ul class="wt-fwidgetcontent">
									<li><a href="javascript:void(0);">HTML Developers in US</a></li>
									<li><a href="javascript:void(0);">HTML5 Developers in US</a></li>
									<li><a href="javascript:void(0);">JavaScript Developers in US</a></li>
									<li><a href="javascript:void(0);">Microsoft Word Experts in US</a></li>
									<li><a href="javascript:void(0);">PowerPoint Experts in US</a></li>
									<li><a href="javascript:void(0);">Social Media Marketers in US</a></li>
									<li><a href="javascript:void(0);">WordPress Developers in US</a></li>
									<li><a href="javascript:void(0);">Writers in US</a></li>
									<li class="wt-viewmore"><a href="javascript:void(0);">+ View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="wt-footercol wt-widgetcategories">
								<div class="wt-fwidgettitle">
									<h3>By Categories</h3>
								</div>
								<ul class="wt-fwidgetcontent">
									<li><a href="javascript:void(0);">Graphics &amp; Design</a></li>
									<li><a href="javascript:void(0);">Digital Marketing</a></li>
									<li><a href="javascript:void(0);">Writing &amp; Translation</a></li>
									<li><a href="javascript:void(0);">Video &amp; Animation</a></li>
									<li><a href="javascript:void(0);">Music &amp; Audio</a></li>
									<li><a href="javascript:void(0);">Programming &amp; Tech</a></li>
									<li><a href="javascript:void(0);">Business</a></li>
									<li><a href="javascript:void(0);">Fun &amp; Lifestyle</a></li>
									<li class="wt-viewmore"><a href="javascript:void(0);">+ View All</a></li>
								</ul>
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-3 col-lg-3">
							<div class="wt-widgetbylocation">
								<div class="wt-fwidgettitle">
									<h3>By Location</h3>
								</div>
								<ul class="wt-fwidgetcontent">
									<li><a href="javascript:void(0);">Switzerland</a></li>
									<li><a href="javascript:void(0);">Canada</a></li>
									<li><a href="javascript:void(0);">Germany</a></li>
									<li><a href="javascript:void(0);">United Kingdom</a></li>
									<li><a href="javascript:void(0);">Japan</a></li>
									<li><a href="javascript:void(0);">Sweden</a></li>
									<li><a href="javascript:void(0);">Australia</a></li>
									<li><a href="javascript:void(0);">United States</a></li>
									<li class="wt-viewmore"><a href="javascript:void(0);">+ View All</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section> --}}
		<!--Skills Start End-->
	</main>
@endsection