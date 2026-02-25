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
        Mefac Turing Process
      </div>
    </div>
<br>
    <div class="container mx-auto py-16 px-8">
    {!! \App\Models\ConfigDictionary::get('mechineauto') !!}
    </div>
</x-frontend-layout>