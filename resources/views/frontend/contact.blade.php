
    <x-frontend-layout title="Contact">
    
 
        <!-- Header Section
        ================================================== -->
        <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
          <div class="sk__parallax-background-element sk__absolute sk__image-back-cover sk__parallax-fixer" style="background-position: 50% 0px; top: 0px;"></div>
  
          <div class="container sk__supercontainer">
            <div class="row text-center">
              <div class="col-12">
                <h1 class="h1-small">Contact  <strong></strong></h1>
                </div>
            </div>
          </div>
  
        </section>
  
  
        <!-- Contact Section
        ================================================== -->
        <section id="contact-us" class="sk__contact-us sk__py-m sk__parallax-background-section" style="opacity: 1;">
          <div class="sk__parallax-background-element sk__absolute sk__image-back-cover" style="background-position: 50% 391.5px; top: -450px;"></div>
          <div class="sk__tint sk__absolute"></div>
          <div class="container sk__supercontainer">
            <div class="row sk__contact-info">
              <!-- Contact Info -->
              <div class="col-12 col-md-6 d-flex text-center text-sm-start mb-4 mb-md-0">
                <div class="sk__contact-left">
                  <h5>Our office <strong>info</strong></h5>
                  <p class="p-v2"><span>{{ \App\Models\ConfigDictionary::get('address') }} </span><span> </span><span>{{ \App\Models\ConfigDictionary::get('phone') }} </span><span>{{ \App\Models\ConfigDictionary::get('email') }}</span></p>
                </div>
              </div>
              <div class="col-12 col-md-6 d-flex">
                <!-- Footer Social Icons Menu -->
                <section class="footer-socials-section text-center text-sm-start">
                  <h5>Follow Us &amp; Stay Informed</h5>
                  <div class="footer-socials-inner">
                    <div class="footer-socials">
                      <a class="social-icons" href="https://www.facebook.com/" target="_blank"><span><span class="icon-facebook1"></span></span></a>
                      <a class="social-icons" href="https://www.facebook.com/" target="_blank"><span><span class="icon-twitter1"></span></span></a>
                      <a class="social-icons" href="https://www.facebook.com/" target="_blank"><span><span class="icon-behance1"></span></span></a>
                      <a class="social-icons" href="https://www.facebook.com/" target="_blank"><span><span class="icon-dribbble1"></span></span></a>
                    </div>
                  </div>
                </section>
              </div>
            </div>
            <div class="row">
              <!-- Contact Form -->
              <div class="col-12 sk__contact-form-col d-flex justify-content-end">
                <div class="sk__contact-right text-center text-sm-start">
                  <h5>Send us a <strong>Message</strong></h5>
  
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
        <!-- /.sk__contact-us -->
  
     
  </x-frontend-layout>
  
