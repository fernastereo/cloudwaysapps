@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <div class="row mx-0">
    <div class="col-md-5 px-0">
      <div class="container py-4">
        <div class="row company-information">
          <div class="col-12 d-flex justify-content-center border-bottom pb-3 mb-1">
            <img class="logo" src="{{ asset('images/adu.png') }}" alt="">
          </div>
          <h4 class="mt-3">ADU Resource Center</h4>
          <h1>Schedule Contractor</h1>
        </div>
        <div class="row mt-3 details-information">
          <div class="col-sm-6 col-md-12">
            <i class="fas fa-clock"></i>1 hr
          </div>
          <div class="col-sm-6 col-md-12">
            <i class="fas fa-map-marker-alt"></i>Client Location
          </div>
          <div class="col-12 details-calendar">
            <i class="far fa-calendar"></i>08:00 - 09:00, Saturday, August 1, 2020
          </div>
          <div class="col-12">
            <i class="fas fa-globe-americas"></i>Pacific Time - US & Canada
          </div>
        </div>
        <div class="row calendar">

        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 meeting-information">
      <form action="" method="post">
        @csrf
        <h5>Enter Details</h5>
      </form>
    </div>
  </div>
@endsection