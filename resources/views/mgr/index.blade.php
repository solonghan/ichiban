@extends('mgr.layouts.master')
@section('title') Dashboard @endsection
@section('css')
<!-- <link href="assets/libs/jsvectormap/jsvectormap.min.css" rel="stylesheet" type="text/css" /> -->
<!-- <link href="assets/libs/swiper/swiper.min.css" rel="stylesheet" type="text/css" /> -->
@endsection
@section('content')
@component('mgr.components.breadcrumb')
@slot('li_1_url')  @endslot
@slot('li_1')  @endslot
@slot('title') @endslot
@endcomponent
<div class="row">
     {{-- <h5>~歡迎來到北教外校推薦系統，請點選左邊功能來進行操作~ </h5> --}}
     {{-- <a href="{{ route('mgr.home') }}"> test123</a> --}}
     <br><br>
     {{-- <h5><a href="http://127.0.0.1:8000/PDF/外審委員資料庫系統操作說明.pdf"> 外審委員資料庫系統操作說明</a></h5> --}}
     {{-- <h5><a href="https://rec-expert.ntue.edu.tw/PDF/外審委員資料庫系統操作說明.pdf" target="_blank"> 外審委員資料庫系統操作說明</a></h5> --}}
     {{-- C:\xampp\htdocs\ntue_teacher_0509\public\assets\images --}}
      {{-- {{ route('your.route.name') }} --}}
</div>
@endsection
@section('script')
<!-- apexcharts -->
<!-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script> -->
<!-- dashboard init -->
<!-- <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script> -->
<!-- <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script> -->
@endsection
