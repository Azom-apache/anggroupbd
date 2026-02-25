<x-frontend-layout title="Mission">
  
    <div class="bg-red-600 text-white py-16 text-center">
      <style> 
    .header-section {
        margin-top: 100px;
      background-color: #6b21a8;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 2rem;
      font-weight: bold;
    }
      </style>
      <div class="header-section">
      News & Event
      </div>
    </div>
    <br>
    <div class="container mx-auto py-16 px-8">
      <div class="row ">
      @foreach ($newsevent as $blog)
                        <div class="col-md-4">
                            <div class="card h-100" style="background-color: #d4dee7;">
                                <!-- Featured Image -->
                                <a href="/">
                                    <img src="{{ $blog->image ?? '' }}" class="card-img-top" style="height: 273px;"
                                        alt="">
                                </a>

                                <div class="card-body">
                                    <!-- Entry Date -->
                                    <div class="card-text text-muted mb-2">
                                        <i class="bi bi-calendar"></i> {{ $blog->date ?? '' }}
                                    </div>

                                    <!-- Entry Title -->
                                    <h5 class="card-title">
                                        <a href="/">
                                            {{ \Illuminate\Support\Str::words($blog->title ?? '', 7, '...') }}
                                        </a>
                                    </h5>

                                    <!-- Entry Description -->
                                    <p class="card-text">
                                        {{ \Illuminate\Support\Str::words($blog->description ?? '', 20, '...') }}
                                    </p>
                                    <a href="/"
                                        class="submit-btn">
                                        Read more
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
      </div>
    </div>
    </x-frontend-layout>