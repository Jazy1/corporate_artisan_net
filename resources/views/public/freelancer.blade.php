@extends('public.layouts.parent')

@section('title', "Freelancer | CAN")

@section('banner')
	<!--Inner Home Banner Start-->
	<div class="wt-haslayout wt-innerbannerholder wt-innerbannerholdervtwo">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
				</div>
			</div>
		</div>
	</div>
	<!--Inner Home End-->
@endsection

@section('content')
	<!--Main Start-->
	<main id="wt-main" class="wt-main wt-haslayout wt-innerbgcolor">
		<!-- User Profile Start-->
		<div class="wt-main-section wt-paddingtopnull wt-haslayout">
			<div class="container">
				<div class="row">	
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 float-left">
						<div class="wt-userprofileholder">
							<span class="wt-featuredtag"><img src="{{asset("images/featured.png") }}" alt="img description" data-tipso="Plus Member" class="template-content tipso_style"></span>
							<div class="col-12 col-sm-12 col-md-12 col-lg-3 float-left">
								<div class="row">
									<div class="wt-userprofile">
										<figure>
											<img src="{{ asset($freelancer->img) }}" alt="img description">
											<div class="wt-userdropdown wt-online">
											</div>
										</figure>
										<div class="wt-title">
											<h3><i class="fa fa-check-circle"></i> Verified</h3>
											<span>5.0/5 <a class="javascript:void(0);">(860 Feedback)</a> <br>Member since {{ \Carbon\Carbon::parse($freelancer->created_at)->format('jS F Y') }} <br>
												<a href="javascript:void(0);">@ {{$freelancer->name}}</a> 
												<a href="javascript:void(0);" class="wt-reportuser">Report User</a></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-9 float-left">
								<div class="row">
									<div class="wt-proposalhead wt-userdetails">
										<h2>{{ $freelancer->name }}</h2>
										<ul class="wt-userlisting-breadcrumb wt-userlisting-breadcrumbvtwo">
											{{-- <li><span><i class="far fa-money-bill-alt"></i> $44.00 / hr</span></li> --}}
											<li><span><img src="{{asset("images/flag/img-02.png")}}" alt="img description">  United States</span></li>
											<li><a href="javascript:void(0);" class="wt-clicksave"><i class="fa fa-heart"></i> Loved by us</a></li>
										</ul>
										<div class="wt-description">
											<p>{{ $freelancer->about }}</p>
										</div>
									</div>
									<div id="wt-statistics" class="wt-statistics wt-profilecounter">
										<div class="wt-statisticcontent wt-countercolor1">
											<h3 data-from="0" data-to="{{ count($freelancer->orders()->where('status', 'pending')->get()) }}" data-speed="800" data-refresh-interval="03">{{ count($freelancer->orders()->where('status', 'pending')->get()) }}</h3>
											<h4>Ongoing <br>Projects</h4>
										</div>
										<div class="wt-statisticcontent wt-countercolor2">
											<h3 data-from="0" data-to="{{ count($freelancer->orders()->where('status', 'completed')->get()) }}" data-speed="8000" data-refresh-interval="03">{{ count($freelancer->orders()->where('status', 'pending')->get()) }}</h3>
											<h4>Completed <br>Projects</h4>
										</div>
										<div class="wt-statisticcontent wt-countercolor4">
											<h3 data-from="0" data-to="{{ count($freelancer->orders()->where('status', 'cancelled')->get()) }}" data-speed="800" data-refresh-interval="02">{{ count($freelancer->orders()->where('status', 'cancelled')->get()) }}</h3>
											<h4>Cancelled <br>Projects</h4>
										</div>
										<div class="wt-statisticcontent wt-countercolor3">
											<h3 data-from="0" data-to="{{ $currentBalance }}" data-speed="8000" data-refresh-interval="100">{{ $currentBalance }}</h3>
											{{-- <em>k</em> --}}
											<h4>Total <br>Earning</h4>
										</div>
										<div class="wt-description">
											<p>* Artisan is not resposible if someone scams you</p>
											{{-- <a href="javascript:void(0);" class="wt-btn" data-toggle="modal" data-target="#reviewermodal">Send Offer</a> --}}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- User Profile End-->

			<!-- User Listing Start-->
			<div class="container">
				<div class="row">
					<div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
						<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
							<div class="wt-usersingle">
								{{-- <div class="wt-clientfeedback">
									<div class="wt-usertitle wt-titlewithselect">
										<h2>Client Feedback</h2>
										<div class="form-group">
											<span class="wt-select">
												<select>
													<option value="Show All">Show All</option>
													<option value="One Page">One Page </option>
													<option value="Two Page">Two Page</option>
												</select>
											</span>
										</div>
									</div>
									<div class="wt-userlistinghold wt-userlistingsingle wt-bgcolor">	
										<figure class="wt-userlistingimg">
											<img src="images/client/img-01.jpg" alt="image description">
										</figure>
										<div class="wt-userlistingcontent">
											<div class="wt-contenthead">
												<div class="wt-title">
													<a href="javascript:void(0);"><i class="fa fa-check-circle"></i> Themeforest Company</a>
													<h3>Translation and Proof Reading (Multi Language)</h3>
												</div>
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="fa fa-dollar-sign"></i> Beginner</span></li>
													<li><span><img src="images/flag/img-04.png" alt="img description"> England</span></li>
													<li><span><i class="fas fa-spinner fa-spin"></i> In Progress</span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="wt-userlistinghold wt-userlistingsingle">	
										<figure class="wt-userlistingimg">
											<img src="images/client/img-02.jpg" alt="image description">
										</figure>
										<div class="wt-userlistingcontent">
											<div class="wt-contenthead">
												<div class="wt-title">
													<a href="javascript:void(0);"><i class="fa fa-check-circle"></i> Videohive Studio</a>
													<h3>Need help translating app stringlist from English to Arabic</h3>
												</div>
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i> Intermediate</span></li>
													<li><span><img src="images/flag/img-03.png" alt="img description">  Canada</span></li>
													<li><span><i class="far fa-calendar"></i> Jun 2017 - Jul 2017</span></li>
													<li><span class="wt-stars"><span></span></span></li>
												</ul>
											</div>
										</div>
										<div class="wt-description">
											<p>“ Eiusmod tempor incididunt ut labore et dolore magna quis nostrud exercitation ullamco laboris. ”</p>
										</div>
									</div>
									<div class="wt-userlistinghold wt-userlistingsingle wt-bgcolor">	
										<figure class="wt-userlistingimg">
											<img src="images/client/img-03.jpg" alt="image description">
										</figure>
										<div class="wt-userlistingcontent">
											<div class="wt-contenthead">
												<div class="wt-title">
													<a href="javascript:void(0);"><i class="fa fa-check-circle"></i> Photodune Professionals</a>
													<h3>Blog Post Writing in English Language</h3>
												</div>
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i> Professional</span></li>
													<li><span><img src="images/flag/img-02.png" alt="img description"> United States</span></li>
													<li><span><i class="far fa-calendar"></i>  Jun 2017</span></li>
													<li><span class="wt-stars"><span></span></span></li>
												</ul>
											</div>
										</div>
										<div class="wt-description">
											<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
										</div>
									</div>
									<div class="wt-btnarea">
										<a href="javascript:void(0);" class="wt-btn">Load More</a>
									</div>
								</div> --}}
								<div class="wt-craftedprojects">
									<div class="wt-usertitle">
										<h2>Orders</h2>
									</div>
									<div class="wt-projects">
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-01.jpg")}} " alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Themeforest</h3>
												<a href="javascript:void(0);">www.themeforest.net</a>
											</div>
										</div>
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-02.jpg")}}" alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Videohive</h3>
												<a href="javascript:void(0);">www.videohive.net</a>
											</div>
										</div>
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-03.jpg")}}" alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Codecanyon</h3>
												<a href="javascript:void(0);">www.codecanyon.net</a>
											</div>
										</div>
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-04.jpg")}}" alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Graphicriver</h3>
												<a href="javascript:void(0);">www.graphicriver.net</a>
											</div>
										</div>
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-05.jpg")}}" alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Photodune</h3>
												<a href="javascript:void(0);">www.photodune.net</a>
											</div>
										</div>
										<div class="wt-project">
											<figure>
												<img src="{{asset("images/projects/img-06.jpg")}}" alt="img description">
											</figure>
											<div class="wt-projectcontent">
												<h3>Audiojungle</h3>
												<a href="javascript:void(0);">www.audiojungle.net</a>
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="wt-experience">
									<div class="wt-usertitle">
										<h2>Experience</h2>
									</div>
									<div class="wt-experiencelisting-hold">
										<div class="wt-experiencelisting wt-bgcolor">
											<div class="wt-title">
												<h3>Web &amp; Apps Project Manager</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Aug 2017 - Till Now</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="wt-experiencelisting">
											<div class="wt-title">
												<h3>Sr. PHP &amp; Laravel Developer</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Jun 2017 - Jul 2018</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="wt-experiencelisting wt-bgcolor">
											<div class="wt-title">
												<h3>PHP Developer</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Apr 2016 - Jul 2017</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="divheight"></div>
									</div>
								</div> --}}
								{{-- <div class="wt-experience wt-education">
									<div class="wt-usertitle">
										<h2>Education</h2>
									</div>
									<div class="wt-experiencelisting-hold">
										<div class="wt-experiencelisting wt-bgcolor">
											<div class="wt-title">
												<h3>Web &amp; Apps Project Manager</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Aug 2017 - Till Now</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="wt-experiencelisting">
											<div class="wt-title">
												<h3>Sr. PHP &amp; Laravel Developer</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Jun 2017 - Jul 2018</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="wt-experiencelisting wt-bgcolor">
											<div class="wt-title">
												<h3>PHP Developer</h3>
											</div>
											<div class="wt-experiencecontent">
												<ul class="wt-userlisting-breadcrumb">
													<li><span><i class="far fa-building"></i> Amento Tech</span></li>
													<li><span><i class="far fa-calendar"></i> Apr 2016 - Jul 2017</span></li>
												</ul>
												<div class="wt-description">
													<p>“ Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliquaenim ad minim veniamac quis nostrud exercitation ullamco laboris. ”</p>
												</div>
											</div>
										</div>
										<div class="divheight"></div>
									</div>
								</div> --}}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
							<aside id="wt-sidebar" class="wt-sidebar">
								<div id="wt-ourskill" class="wt-widget">
									<div class="wt-widgettitle">
										<h2>My Skills</h2>
									</div>
									<div class="wt-widgetcontent wt-skillscontent">
										<div class="wt-skillholder" data-percent="90%">
											<span>PHP <em>90%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="55%">
											<span>Website Design <em>55%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="99%">
											<span>HTML 5 <em>99%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="80%">
											<span>Graphic Design <em>80%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="75%">
											<span>WordPress <em>75%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="35%">
											<span>SEO <em>35%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="40%">
											<span>My SQL <em>40%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="80%">
											<span>Content Writing <em>80%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="80%">
											<span>CSS <em>80%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										<div class="wt-skillholder" data-percent="75%">
											<span>Jquery <em>75%</em></span>
											<div class="wt-skillbarholder"><div class="wt-skillbar"></div></div>
										</div>
										{{-- <div class="wt-btnarea">
											<a href="javascript:void(0)">View More</a>
										</div> --}}
									</div>
								</div>
								{{-- <div class="wt-widget wt-widgetarticlesholder wt-articlesuser">
									<div class="wt-widgettitle">
										<h2>Awards &amp; Certifications</h2>
									</div>
									<div class="wt-widgetcontent">
										<div class="wt-particlehold">
											<figure>
												<img src="images/thumbnail/img-07.jpg" alt="image description">
											</figure>
											<div class="wt-particlecontent">
												<h3><a href="javascript:void(0);">Top PHP Excel Skills</a></h3>
												<span><i class="lnr lnr-calendar"></i> Jun 27, 2018</span>
											</div>
										</div>
										<div class="wt-particlehold">
											<figure>
												<img src="images/thumbnail/img-08.jpg" alt="image description">
											</figure>
											<div class="wt-particlecontent">
												<h3><a href="javascript:void(0);">Monster Developer Award</a></h3>
												<span><i class="lnr lnr-calendar"></i> Apr 27, 2018</span>
											</div>
										</div>
										<div class="wt-particlehold">
											<figure>
												<img src="images/thumbnail/img-09.jpg" alt="image description">
											</figure>
											<div class="wt-particlecontent">
												<h3><a href="javascript:void(0);">Best Communication 2015</a></h3>
												<span><i class="lnr lnr-calendar"></i> May 27, 2018</span>
											</div>
										</div>
										<div class="wt-particlehold">
											<figure>
												<img src="images/thumbnail/img-10.jpg" alt="image description">
											</figure>
											<div class="wt-particlecontent">
												<h3><a href="javascript:void(0);">Best Logo Design Winner</a></h3>
												<span><i class="lnr lnr-calendar"></i> Aug 27, 2018</span>
											</div>
										</div>
									</div>
								</div> --}}
								{{-- <div class="wt-proposalsr">
									<div class="tg-authorcodescan tg-authorcodescanvtwo">
										<figure class="tg-qrcodeimg">
											<img src="images/qrcode.png" alt="img description">
										</figure>
										<div class="tg-qrcodedetail">
											<span class="lnr lnr-laptop-phone"></span>
											<div class="tg-qrcodefeat">
												<h3>Scan with your <span>Smart Phone </span> To Get It Handy.</h3>
											</div>
										</div>
									</div>
								</div> --}}
								{{-- <div class="wt-widget">
									<div class="wt-widgettitle">
										<h2>Similar Freelancers</h2>
									</div>
									<div class="wt-widgetcontent">
										<div class="wt-widgettag wt-widgettagvtwo">
											<a href="javascript:void(0);">PHP Developer</a>
											<a href="javascript:void(0);">PHP</a>
											<a href="javascript:void(0);">My SQL</a>
											<a href="javascript:void(0);">Business</a>
											<a href="javascript:void(0);">Website Development</a>
											<a href="javascript:void(0);">Collaboration</a>
											<a href="javascript:void(0);">Decent</a>
										</div>
									</div>
								</div> --}}
								{{-- <div class="wt-widget wt-sharejob">
									<div class="wt-widgettitle">
										<h2>Share This User</h2>
									</div>
									<div class="wt-widgetcontent">
										<ul class="wt-socialiconssimple">
											<li class="wt-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i>Share on Facebook</a></li>
											<li class="wt-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i>Share on Twitter</a></li>
											<li class="wt-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i>Share on Linkedin</a></li>
											<li class="wt-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i>Share on Google Plus</a></li>
										</ul>
									</div>
								</div> --}}
								{{-- <div class="wt-widget wt-reportjob">
									<div class="wt-widgettitle">
										<h2>Report This User</h2>
									</div>
									<div class="wt-widgetcontent">
										<form class="wt-formtheme wt-formreport">
											<fieldset>
												<div class="form-group">
													<span class="wt-select">
														<select>
															<option value="reason">Select Reason</option>
															<option value="reason1">Reason1</option>
															<option value="reason2">Reason2</option>
															<option value="reason3">Reason3</option>
															<option value="reason4">Reason4</option>
														</select>
													</span>
												</div>
												<div class="form-group">
													<textarea class="form-control" placeholder="Description"></textarea>
												</div>
												<div class="form-group wt-btnarea">
													<a href="javascrip:void(0);" class="wt-btn">Submit</a>
												</div>
											</fieldset>
										</form>
									</div>
								</div> --}}
							</aside>
						</div>
					</div>
				</div>
			</div>
			<!-- User Listing End-->
		</div>
	</main>
	<!--Main End-->
@endsection


	<!-- Popup Start-->
	{{-- <div class="modal fade wt-offerpopup" tabindex="-1" role="dialog" id="reviewermodal">
		<div class="modal-dialog" role="document">
			<div class="wt-modalcontent modal-content">
				<div class="wt-popuptitle">
					<h2>Send a Project Offer</h2>
					<a href="javascript%3bvoid(0)%3b.html" class="wt-closebtn close"><i class="fa fa-close" data-dismiss="modal" aria-label="Close"></i></a>
				</div>
				<div class="modal-body">
					<div class="wt-projectdropdown-hold">
						<div class="wt-projectdropdown">
							<div class="wt-projectselect">
								<figure><img src="images/thumbnail/img-07.jpg" alt="img description"></figure>
								<div class="wt-projectselect-content">
									<h3>Project Title Here</h3>
									<span><i class="lnr lnr-calendar-full"></i> Project Deadline: May 27, 2019</span>
								</div>
							</div>
						</div>
						<div class="wt-projectdropdown-option">
							<div class="wt-projectselect">
								<figure><img src="images/thumbnail/img-07.jpg" alt="img description"></figure>
								<div class="wt-projectselect-content">
									<h3>Project Title Here</h3>
									<span><i class="lnr lnr-calendar-full"></i> Project Deadline: May 27, 2019</span>
								</div>
							</div>
						</div>
					</div>
					<form class="wt-formtheme wt-formpopup">
						<fieldset>
							<div class="form-group">
								<textarea class="form-control" placeholder="Add Description*"></textarea>
							</div>
							<div class="form-group wt-btnarea">
								<a href="javascript:void(0);" class="wt-btn">Send offer</a>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div> --}}
	<!-- Popup End-->
	