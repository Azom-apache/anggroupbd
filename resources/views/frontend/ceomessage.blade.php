<x-frontend-layout title="CEO Message">
  <!-- Header Section
  ================================================== -->
  <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
    <div class="sk__parallax-background-element sk__absolute sk__image-back-cover sk__parallax-fixer" style="background-position: 50% 0px; top: 0px;"></div>

    <div class="container sk__supercontainer">
      <div class="row text-center">
        <div class="col-12">
          <h1 class="h1-small">Ceo  <strong>Message</strong></h1>
          <p class="p-v2">  {!! \App\Models\ConfigDictionary::get('description') !!}</p>
        </div>
      </div>
    </div>

  </section>
</x-frontend-layout>
