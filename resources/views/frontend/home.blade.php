<x-frontend-layout title="Home">

    <!-- Hero Section / Hero Slider
				================================================== -->
    <section class="sk__hero-section">
        <!-- Carousel -->
        <div id="sk__hero-carousel-slider" class="carousel slide dark-shade-1-bg" data-bs-ride="carousel">

            <!-- Hero Dots Navigation Bootstrap 5 -->
            <div class="carousel-indicators">
                @foreach ($sliders as $index => $slider)
                <button type="button" data-bs-target="#sk__hero-carousel-slider" data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                @foreach ($sliders as $index => $slider)
                <div
                    class="carousel-item zooming {{ $index == 0 ? 'active' : '' }} hero-slide-1 sk__hero-slider-item sk__image-back-cover">
                    <section class="sk__parallax-background-section sk__hero-item-theme-style">

                        <!-- Parallax background -->
                        <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"
                            style="background-image: url('{{ $slider->image ? asset($slider->image) : asset('images/default.jpg') }}');">
                        </div>
                        <div class="flex-helper-div"></div>

                        <!-- Main hero heading -->
                        <div class="hero-h1-box">
                            <div class="cover-text-wrapper">
                                <h1 class="hero-h1 animated-element phase-1 text-center text-md-start text-white">
                                    {{ $slider->title ?? 'Default Title' }}
                                </h1>
                              
                            </div>
                            <p><b> {{ $slider->description ?? 'a&ggroup' }}<b><p>
                            
                        </div>
                      
                        <!-- Bottom Left box -->
                        <div class="hero-box-bottom-left text-center text-sm-start">
                            
                            {{-- <a class="btn btn-outline-light animated-element phase-1 mb-4"
                                href="{{ $slider->link ?? '#' }}" role="button">
                                OPEN PROJECT
                            </a> --}}

                            {{-- <div class="cover-text-wrapper">
                                <h3 class="animated-element phase-1 text-center text-sm-start text-white">
                                    {{ $slider->subtitle ?? 'Default Subtitle' }}
                                </h3>
                            </div>

                            <div class="cover-text-wrapper">
                                <p class="hero-box-p animated-element phase-1 text-center text-sm-start text-white">
                                    {{ $slider->description ?? '' }}
                                </p>
                            </div> --}}
                        </div>

                        <!-- Bottom Right Box -->
                        <div class="hero-box-bottom-right text-center text-sm-start">
                            <div class="cover-text-wrapper">
                                <span class="big-abbreviated-heading animated-element phase-2 text-white"
                                    style="font-size: 41px;">A&G GROUP</span>
                            </div>
                            <div class="cover-text-wrapper">
                                <p class="animated-element phase-2 text-white">Follow the white rabbit Neo,
                                    and you’ll end up in anggroupbd</p>
                            </div>
                            <div class="cover-text-wrapper">
                                <h4 class="animated-element phase-2 text-white">anggroupbd.com</h4>
                            </div>
                        </div>

                    </section>
                </div>
                @endforeach
            </div>

            <!-- Arrows Bootstrap 5 -->
            <button class="carousel-control-prev" type="button" data-bs-target="#sk__hero-carousel-slider"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sk__hero-carousel-slider"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
        <!-- /#sk__hero-carousel-slider -->
    </section>

    <!-- /.sk__hero-section -->

    <section
        class="sk__parallax-background-section sk__parallax-fixer-section sk__parallax-fixer-ignore-height overflow-hidden"
        style="max-height: 0;">
        <div class="sk__parallax-background-element"></div>
    </section>



    <!-- Parallax Rings Section (massive step forward)
				================================================== -->
    <section class="sk__rings-section sk__image-back-cover dark-shade-1-bg overflow-hidden">

        <!-- parallax area -->
        <div id="sk__parallax-layers-1" class="container sk__full-height position-relative hue-rotator duration-2s">
            <!-- gradient ring 1 -->
            <div data-depth="1.20" class="sk__absolute">
                <div class="sk__flex-center ring-l-container sk__absolute">
                    <div class="ring-l sk__gradient-back-v1 dark-shade-1-bg-after"></div>
                </div>
            </div>
            <!-- gradient ring 2 -->
            <div data-depth="1.10" class="sk__absolute">
                <div class="sk__flex-center ring-m-container sk__absolute">
                    <div class="ring-m sk__gradient-back-v1 dark-shade-1-bg-after"></div>
                </div>
            </div>
            <!-- gradient ring 3 -->
            <div data-depth="0.90" class="sk__absolute">
                <div class="sk__flex-center ring-s-container sk__absolute">
                    <div class="ring-s sk__gradient-back-v1 dark-shade-1-bg-after"></div>
                </div>
            </div>
            <!-- white rectangle deco 1 -->
            <div data-depth="1.00" class="sk__absolute">
                <div class="sk__flex-center sk__absolute">
                    <div class="sk__rectangles">
                        <div class="sk__rectangle-white-1 sk__absolute"></div>
                    </div>
                </div>
            </div>
            <!-- white rectangle deco 2 -->
            <div data-depth="0.90" class="sk__absolute">
                <div class="sk__flex-center sk__absolute">
                    <div class="sk__rectangles">
                        <div class="sk__rectangle-white-2 sk__absolute"></div>
                    </div>
                </div>
            </div>
            <!-- black rectangle deco -->
            <div data-depth="0.75" class="sk__absolute">
                <div class="sk__flex-center sk__absolute">
                    <div class="sk__rectangles">
                        <div class="sk__rectangle-black sk__absolute"></div>
                    </div>
                </div>
            </div>
            <!-- heading & subheading Shadows -->
            <div data-depth="0.65" class="sk__absolute">
                <div class="sk__flex-center sk__absolute px-15px">
                    <div class="flex-child">
                        <h1 class="shadowed super-heading text-center">A massive step forward.</h1>
                        <h2 class="shadowed h2-small text-center">focus on your goals and exectute
                            creativity infused massive leap in design to reach it</h2>
                    </div>
                </div>
            </div>
            <!-- heading & subheading -->
            <div data-depth="0.65" class="sk__absolute">
                <div class="sk__flex-center sk__absolute px-15px">
                    <div class="flex-child text-center">
                        <h1 class="super-heading sk__clipped-text sk__gradient-back-v1">A massive step
                            forward.</h1>
                        <h2 class="h2-small">focus on your goals and exectute creativity infused massive
                            leap in design to reach it</h2>
                    </div>
                </div>
            </div>

        </div>
        <!-- /#sk__parallax-layers-1 -->

    </section>
    <!-- /.sk__rings-section -->


    <!-- Numbers Section (Animated Counters)
				================================================== -->
    {{-- <section class="sk__numbers-section dark-shade-3-bg sk__solid-menu-bar">
        <div class="container-fluid">
            <div class="row sk__numbers-row text-center">
                <div class="col-6 col-sm-4 col-md counters-wrap sk__flex-center">
                    <div class="flex-child">
                        <span class="sk__counter" data-gsap-counter-number="157">0</span>
                        <p>Clients</p>
                        <span class="numbers-deco sk__absolute"></span>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md counters-wrap sk__flex-center">
                    <div class="flex-child">
                        <span class="sk__counter" data-gsap-counter-number="3918">0</span>
                        <p>Projects</p>
                        <span class="numbers-deco sk__absolute"></span>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md counters-wrap sk__flex-center">
                    <div class="flex-child">
                        <span class="sk__counter" data-gsap-counter-number="19">0</span>
                        <p>Awards</p>
                        <span class="numbers-deco sk__absolute"></span>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md counters-wrap sk__flex-center">
                    <div class="flex-child">
                        <span class="sk__counter" data-gsap-counter-number="484">0</span>
                        <p>Partners</p>
                        <span class="numbers-deco sk__absolute"></span>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md counters-wrap sk__flex-center">
                    <div class="flex-child">
                        <span class="sk__counter" data-gsap-counter-number="73">0</span>
                        <p>Apps Developed</p>
                        <span class="numbers-deco sk__absolute"></span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- /.sk__numbers-section -->


    <!-- About Us Section
				================================================== -->
    <section id="about-us" class="sk__about-us-section sk__py-xl">
        <div class="container sk__supercontainer">
            <div class="row">
                <div class="col-12 col-lg-6 sk__rectangles-left about-left text-center text-sm-start">
                    <!-- parallax area -->
                    <div id="sk__parallax-layers-about" class="sk__rectangles-left-parallax-layers">
                        <!-- white rectangle deco 1 -->
                        <div data-depth="1.30" class="sk__absolute">
                            <div class="sk__flex-center sk__absolute">
                                <div class="sk__rectangles">
                                    <div class="sk__rectangle-white-1 sk__absolute"></div>
                                </div>
                            </div>
                        </div>
                        <!-- white rectangle deco 2 -->
                        <div data-depth="0.70" class="sk__absolute">
                            <div class="sk__flex-center sk__absolute">
                                <div class="sk__rectangles">
                                    <div class="sk__rectangle-white-2 sk__absolute"></div>
                                </div>
                            </div>
                        </div>
                        <!-- black rectangle deco -->
                        <div data-depth="1.00" class="sk__absolute">
                            <div class="sk__flex-center sk__absolute">
                                <div class="sk__rectangles">
                                    <div class="sk__rectangle-black sk__absolute"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 class="super-heading sk__clipped-text sk__gradient-back-v1 mb-sm-1">Company History<span
                            class="heading-deco">.-></span></h1>
                    
                    <p>{!! \App\Models\ConfigDictionary::get('about_us') !!}</p>
                </div>
                <div class="col-12 col-lg-6 about-right">   
                    <div class="about-right-image-wrap mt-4 mt-lg-0 mb-4 mb-lg-0">
                        <div class="about-right-image-subwrap sk__absolute">
                            <div class="about-right-image sk__absolute sk__image-back-cover"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row mt-2">
                <div class="col">
                    <span class="divider"></span>
                </div>
            </div>
        </div>


        <!-- Partners Section
					================================================== -->
        <div class="sk__partners-section">
            <div class="container sk__supercontainer">
                <div class="row">
                    <div class="col text-center text-sm-start">
                        <h4 class="h4-dark h4-shadow">Partners.</h4>
                        <span class="fat-divider dark-shade-4-bg"></span>
                    </div>
                </div>
                <div class="row sk__partners m-0 d-flex justify-content-center">
                    @foreach ($partners as $sis)
                    <div class="col-xs-4 col-sm-2">
                        <div class="">
                            <img src="{{ $sis->image ??'' }}">
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
        <!-- /.sk__partners-section -->

    </section>
    <!-- /.sk__about-us-section -->


  


    <!-- Portfolio Section
				================================================== -->
    <section class="sk__portfolio-section sk__py-l dark-shade-2-bg sk__solid-menu-bar">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col sk__heading-spacer-l">
                    <h1 class="h1-small trigger-portfolio-thumbs-entrance">Products</h1>
                </div>
            </div>
            <div class="row">
                <div class="col sk__portfolio-thumbs px-sm-3 px-md-5">
                    <div class="sk__portfolio-wrapper text-center">
                        @foreach($categorys as $cat)
                        <div class="sk__portfolio-item">
                         
                            <a href="{{ route('product2', ['id' => $cat->id]) }}" class="sk__portfolio-thumblink">
                                <div class="sk__pt-link-icon">
                                    <div class="sk__pt-link-icon-ovr-1"></div>
                                    <div class="sk__pt-link-icon-ovr-2"></div>
                                </div>
                               <div class="sk__portfolio-thumblink-image sk__image-back-cover"
                                    style="background-image: url('{{ $cat->image }}'); width: 100% !important; height: 100% !important; background-size:contain; background-color: white;">
                                </div>

                                <div class="portfolio-thumb-info" style="background-color: white; color: black;">
                                    <h6>{{$cat->name_en}}</h6>
                                   
                                    <p>View {{ $cat->name ?? 'Product' }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.sk__portfolio-section -->

    <section id="demo-select" class="demo-select sk__pt-l sk__pb-s sk__solid-menu-bar">
        <div class="container sk__supercontainer">
            <div class="row text-center">
                <div class="col sk__heading-spacer-l">
                    {{-- <div class="cover-text-wrapper">
                        <div class="fancy-gradient-text-box reveal-onscroll" style="transform: translate(0px, 0px); opacity: 1;">
                           <h1 class="super-heading sk__gradient-fancy-text mb-2 mb-sm-0 mb-xxl-2">News And Events</h1> 
                            <span class="super-heading sk__gradient-fancy-text-back mb-2 mb-sm-0 mb-xxl-2"></span>
                       
                        </div>
                        </div>
                    </div> --}}
                    <div class="sk__reveal-all-wrapped-text">
                        <div class="cover-text-wrapper">
                            <h2 class="h2-super" style="transform: translate(0px, 0px); opacity: 1;">News And Events</h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row sk__imageboxes">
                @foreach($blogs as $blog)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a class="sk__imagebox" target="_blank" href="#" style="transform: translate(0px, 0px); opacity: 1;">
                       
                        <div class="sk__imagebox-img-wrap">
                            <img class="sk__imagebox-img" src="{{ $blog->image }}" alt="Screenshot of the demo website">
                        </div>
                        <div class="sk__imagebox-text-wrap">
                            <p>{{ $blog->date }}</p>
                            <h5>{{ $blog->title }}</h5>
                            <p style="font-weight: 500;" class="line-clamp-3">{{ $blog->description }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
  
	

    <div class="dark-shade-2-bg featured-project-padder"></div>


    <!-- Features Section
				================================================== -->
  


    <!-- Laptop Section  upp
				================================================== -->
                <section class="py-5 bg-dark text-white">
                    <div class="container-fluid">
                        <div class="row text-center mb-4">
                            <div class="col">
                                <h2 class=""><b>Upcoming Product</b></h2>
                            </div>
                        </div>
                
                        <div class="row justify-content-center">
                            @foreach($products->filter(fn($item) => $item->discount_type == 1) as $cat)

                                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                    <div class="card h-100 text-center shadow-sm">
                                        <a href="{{ route('singleProduct', ['id' => $cat->id]) }}">
                                            <div class="card-img-top bg-cover" style="background-image: url('{{ $cat->image }}'); height: 250px; background-size: cover; background-position: center;"></div>
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $cat->name_en }}</h6>
                                                <p class="card-text text-muted">View Project</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                
    <!-- /.sk__laptop-section -->



    <!-- Services Section
				================================================== -->
    <section id="services"
        class="sk__services-section sk__parallax-background-section dark-shade-5-border sk__solid-menu-bar">
        <div class="sk__parallax-background-element sk__absolute sk__image-back-cover sk__services-background">
        </div>
        <div class="container sk__py-l">
            <div class="row text-center">
                <div class="col sk__heading-spacer-l">
                    <div class="cover-text-wrapper">
                        <h1 class="super-heading sk__clipped-text sk__gradient-back-v1 animated-element">
                            Sister Concerns</h1>
                    </div>
                </div>
            </div>
            <div class="row sk__iconboxes-wrapper text-center sk__flex-center-x">
                <style> .profile-photo {
                    width: 125px;
                    height: 110px;
                    object-fit: cover;
                    border-radius: 50%;
                }</style>
                @foreach ($clients as $sis)
                    
              
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="sk__iconbox">
                        <a class="sk__iconbox-icon-link" href="{{ route('sister', ['id' => $sis->id]) }}">
                            <img src="{{ $sis->image }}" alt=" Photo" class="profile-photo">
                        </a>
                        <a class="sk__iconbox-text-link gradient-links-bright" href="{{ route('sister', ['id' => $sis->id]) }}">
                            <h5>{{ $sis->name }}</h5>
                        </a>
                        <p>{{ $sis->designation }}</p>
                    </div>
                </div>
                @endforeach
               
                {{-- <div class="col-12 col-sm-6 col-lg-4">
                    <div class="sk__iconbox">
                        <a class="sk__iconbox-icon-link" href="page-service-item.html">
                            <span class="sk__flex-center sk__iconbox-icon"><span
                                    class="icon-cube sk__gradient-fancy-text"></span></span>
                            <span class="sk__iconbox-icon-dash"></span>
                        </a>
                        <a class="sk__iconbox-text-link gradient-links-bright" href="page-service-item.html">
                            <h5>Parallax Effects</h5>
                        </a>
                        <p>Awesome and 100% Unique Parallax Effects created specifically for this theme</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="sk__iconbox">
                        <a class="sk__iconbox-icon-link" href="page-service-item.html">
                            <span class="sk__flex-center sk__iconbox-icon"><span
                                    class="icon-pen2 sk__gradient-fancy-text"></span></span>
                            <span class="sk__iconbox-icon-dash"></span>
                        </a>
                        <a class="sk__iconbox-text-link gradient-links-bright" href="page-service-item.html">
                            <h5>In-depth Documentation</h5>
                        </a>
                        <p>The documentation will guide you to creating an amazing and comprehensive website
                        </p>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- /.sk__services-section -->





    <!-- Skills Section
				================================================== -->
    <section id="skills" class="sk__skills sk__py-m">

        <div class="sk__partners-section">
            <div class="container sk__supercontainer">
                <div class="row">
                    <div class="col text-center text-sm-start">
                        <h4 class="h4-dark h4-shadow">Certificate.</h4>
                        <span class="fat-divider dark-shade-4-bg"></span>
                    </div>
                </div>
                <div class="row sk__partners m-0 d-flex justify-content-center">
                    @foreach ($certificates as $sis)
                    <div class="col-xs-4 col-sm-2">
                        <div class="">
                            <img src="{{ $sis->image ??'' }}">
                        </div>
                    </div>
                    @endforeach
                   
                </div>
            </div>
        </div>

    </section>
    <!-- /.sk__skills -->




    <!-- CTA Section (Warp CTA)
				================================================== -->
    <section class="sk__cta-warp position-relative sk__image-back-cover">
        <div class="container sk__powercontainer">
            <div class="row">
                <div class="col text-center">
                    <div class="sk__warped-text-wrapper sk__flex-center">
                        <span class="sk__warped-text" style="
                        color: white;
                    ">A&G GROUP</span>
                    </div>
                    <h3><strong style="
                        letter-spacing: 3px !important;
                    ">We envision to sustain and grow as a diversified global conglomerate</strong></h3>

                </div>
            </div>
        </div>
    </section>


    <!-- Contact Us Section
				================================================== -->
    <section id="contact-us" class="sk__contact-us sk__py-m sk__parallax-background-section sk__flex-center-y">
        <div class="sk__parallax-background-element sk__absolute sk__image-back-cover"></div>
        <div class="sk__tint sk__absolute"></div>
        <div class="container sk__powercontainer">
            <!-- Section Header -->
            <div class="row sk__contact-info sk__inner-header text-center">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <h1 class="h1-small">Let's Start Creating</h1>
                    <p class="p-v2">Want to start a project of this caliber but don't know where to start?
                        Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh
                        elementum imperdiet.</p>
                </div>
            </div>
            <div class="row">
                <!-- Contact Form -->
                <div class="col-12 col-lg-10 offset-0 offset-lg-1 sk__contact-form-col d-flex justify-content-end">
                    <div class="sk__contact-right text-center text-sm-start">

                        <!-- Preview Only Static Form -->
                        <form action="{{ route('contact.submit') }}" method="POST" class="sk__form sk__contact-form">
                  @csrf

                  <div class="form-group">
                      <input type="text" name="the_name" placeholder="Name*" required tabindex="1">
                  </div>
                  <div class="form-group">
                      <input type="email" name="the_email" placeholder="Email*" required tabindex="2">
                  </div>
                  <div class="form-group">
                      <textarea name="the_message" placeholder="Message*" required tabindex="3"></textarea>
                  </div>

                  <button type="submit" tabindex="4">Submit</button>
              </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <a id="button"><i class="fas fa-chevron-up"></i></a>



</x-frontend-layout>