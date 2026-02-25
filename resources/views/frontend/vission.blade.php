<x-frontend-layout title="Mission">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .advisor-card {
            text-align: center;
            margin: 15px 0;
        }
        .advisor-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .advisor-title {
            font-weight: bold;
            color: #343a40;
        }
    </style>

<style> 
    .header-section {
      background-color: #6b21a8;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 2rem;
      font-weight: bold;
    }
      </style>
      <div class="header-section">
      Board of Advisor
      </div>
    <section class="management-team py-5">
        <div class="container">
            <!-- Page Heading -->
            <div class="row mb-4">
                <div class="col text-center">
                 
                    <p class="lead text-muted">Meet the people leading our company to success</p>
                </div>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card  text-center">
                        <img src="{{ $teams->first()->image ?? '' }}" class="card-img-top" alt="Member 1"
                            style=" height: 280px;">
                        <div class="card-body">
                            <p class="text-muted mb-1">{{ $teams->first()->designation ?? '' }}</p>
                            <h5 class="fw-bold mb-3">{{ $teams->first()->name ?? '' }}</h5>
                            <p class="card-text">{{ $teams->first()->description ?? '' }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ $teams->first()->fb_link ?? '' }}" class="btn btn-dark rounded-circle mx-1"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ $teams->first()->linking_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{{ $teams->first()->instagram_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"> <i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: 2 People -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 text-center">
                        <img src="{{ $teams->skip(1)->first()->image ?? '' }}" class="card-img-top" alt="Member 1"
                            style=" height: 280px;">
                        <div class="card-body">
                            <p class="text-muted mb-1">{{ $teams->skip(1)->first()->designation ?? '' }}</p>
                            <h5 class="fw-bold mb-3">{{ $teams->skip(1)->first()->name ?? '' }}</h5>
                            <p class="card-text">{{ $teams->skip(1)->first()->description ?? '' }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ $teams->skip(1)->first()->fb_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $teams->skip(1)->first()->linking_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{{ $teams->skip(1)->first()->instagram_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"> <i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 text-center">
                        <img src="{{ $teams->skip(2)->first()->image ?? '' }}" class="card-img-top" alt="Member 1"
                            style=" height: 280px;">
                        <div class="card-body">
                            <p class="text-muted mb-1">{{ $teams->skip(2)->first()->designation ?? '' }}</p>
                            <h5 class="fw-bold mb-3">{{ $teams->skip(2)->first()->name ?? '' }}</h5>
                            <p class="card-text">{{ $teams->skip(2)->first()->description ?? '' }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ $teams->skip(2)->first()->fb_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $teams->skip(2)->first()->linking_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="{{ $teams->skip(2)->first()->instagram_link ?? '' }}"
                                class="btn btn-dark rounded-circle mx-1"> <i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3: 3 People -->
            <div class="row mb-4">
                @foreach ($teams->skip(3) as $team)
                    <div class="col-lg-3 col-md-6 p-4">
                        <div class="card h-100 text-center">
                            <img src="{{ $team->image ?? '' }}" class="card-img-top" alt="Member 1"
                                style=" height: 280px;">
                            <div class="card-body">
                                <p class="text-muted mb-1">{{ $team->designation ?? '' }}</p>
                                <h5 class="fw-bold mb-3">{{ $team->name ?? '' }}</h5>
                                <p class="card-text">{{ $team->description ?? '' }}</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ $team->fb_link ?? '' }}" class="btn btn-dark rounded-circle mx-1 ">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $team->linking_link ?? '' }}" class="btn btn-dark rounded-circle mx-1"> <i
                                        class="fab fa-linkedin-in"></i></a>
                                <a href="{{ $team->instagram_link ?? '' }}" class="btn btn-dark rounded-circle mx-1">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
          

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-frontend-layout>