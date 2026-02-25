<x-frontend-layout title="Clients">
    <style>
        .search-member-title {
          font-size: 32px;
          font-weight: bold;
          text-align: center;
          margin-top: 20px;
        }
        .company-card {
          border: 1px solid #ddd;
          border-radius: 8px;
          margin-bottom: 20px;
          padding: 15px;
        }
        .company-logo {
          width: 80px;
          height: 80px;
          object-fit: contain;
        }
        .btn-more-details {
          color: red;
          border: 1px solid red;
          border-radius: 20px;
        }
        .alphabet-nav a {
          margin-right: 10px;
          text-decoration: none;
        }
        .header-section {
            background-color: #6b21a8;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 2rem;
            font-weight: bold;
            }
            
        .profile-photo {
          width: 150px;
          height: 150px;
          object-fit: cover;
          border-radius: 50%;
        }
      </style>
      <div class="header-section">
        Member List
      </div>
    <div class="container">
        <h1 class="search-member-title">SEARCH MEMBER</h1>
    
        <!-- Search Bar -->
        <div class="row my-4">
          <div class="col-md-8 mx-auto">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Company Name">
              <button class="btn btn-success">Search</button>
            </div>
          </div>
        </div>
    
        <!-- Alphabet Navigation -->
        <div class="text-center alphabet-nav mb-4">
          <a href="#">A</a> | <a href="#">B</a> | <a href="#">C</a> | <a href="#">D</a> | <a href="#">E</a> |
          <a href="#">F</a> | <a href="#">G</a> | <a href="#">H</a>
        </div>
    
        <!-- Advance Search Button -->
        <div class="d-flex justify-content-center mb-3">
          <button class="btn btn-secondary">Advance Search</button>
        </div>
    
        <!-- Company List -->
        @foreach ($members as $product) 
        <div class="company-card row align-items-center">
          <div class="col-2">
          <img src="{{ $product->avatar ?? '' }}" alt="Product Image" class="profile-photo w-full h-48  mb-4">
          </div>
          <div class="col-8">
            <h4>{{$product->name}}</h4>
            <p><strong>{{$product->designation}}</strong> </p>
            <p>{{$product->email}}</p>
          </div>
          <div class="col-2 text-end">
            <button class="btn btn-more-details">More Details</button>
          </div>
        </div>
        @endforeach
    
      </div>
     
</x-frontend-layout>
