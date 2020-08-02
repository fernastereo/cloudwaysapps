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
            <i class="far fa-calendar"></i><span id="timeSelected"></span>, <span id="dateSelected"></span>
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
          <div class="col-6 col-sm-12 col-lg-6">
            <div class="form-group">
              <label for="datePicker">Date</label>
              <input type="date" class="form-control form-control-sm" id="datePicker">
            </div>
          </div>
          <div class="col-6 col-sm-12 col-lg-6">
            <div class="form-group">
              <label for="timePicker">Time</label>
              <select class="custom-select custom-select-sm" id="timePicker" required>
                <option selected disabled value="0">Choose...</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 meeting-information">
      <form action="{{ env('ZAPIER_WEBHOOK_URL') }}" method="post">
        @csrf
        <h6>Enter Details</h6>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control form-control-sm" id="name" readonly value="{{ $organization->name }} Meeting {{ $person->name }}">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control form-control-sm" id="email" readonly value="{{ $organization->{'b9a9b40b7387cd9f7cafcc17969fae4eb695903d'} }}">
        </div>
        <div class="form-group">
          <label for="notes">Notes</label>
          <textarea class="form-control form-control-sm" id="notes" readonly rows="2">{{ $person->{'5f504213b4ac6207f8430a9c6618ad5d6dbcb233'} }}</textarea>
        </div>
        <div class="form-group">
          @foreach ($person->phone as $phone)
            @if ($phone->primary )
              @php
                  $personPhone = $phone->value;
              @endphp                 
            @endif
          @endforeach
          <label for="client-phone">Client Phone Number</label>
          <input type="text" class="form-control form-control-sm" id="client-phone" readonly value="{{ $personPhone }}">
        </div>
        <div class="form-group">
          <label for="client-address">Client Address</label>
          <input type="text" class="form-control form-control-sm" id="client-address" readonly value="{{ $person->{'35f00eb5ee0a5cec1fe2061cbc759fe72da4447c'} }}">
        </div>
        <div class="form-group">
          @foreach ($person->email as $email)
            @if ($email->primary)
              @php
                $personEmail = $email->value;
              @endphp 
            @endif
          @endforeach
          <label for="client-email">Client Email</label>
          <input type="text" class="form-control form-control-sm" id="client-email" readonly value="{{ $personEmail }}">
        </div>
        <div class="form-group">
          <label for="person-id">Pipedrive Person ID</label>
          <input type="text" class="form-control form-control-sm" id="person-id" readonly value="{{ $person->id }}">
        </div>
        <div class="form-group">
          <label for="organization-id">Pipedrive Organization ID</label>
          <input type="text" class="form-control form-control-sm" id="organization-id" readonly value="{{ $organization->id }}">
        </div>
        <h6>ADU Resource Center Representative</h6>
        <div class="col-sm-10">
          @foreach ($users as $user)
            <div class="form-check-{{ $user->id }}">
              <input class="form-check-input" type="radio" name="optionRadio" id="optionRadio-{{ $user->id }}">
              <label class="form-check-label" for="optionRadio-{{ $user->id }}">
                {{ $user->email }}
              </label>
            </div>
          @endforeach
        </div>
        <div class="col-sm-12 mt-5">
          <button id="schedule" type="submit" class="btn btn-primary">Schedule Event</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
  <script>
    const currentDate = new Date();
    const datePicker = document.getElementById('datePicker');
    const timePicker = document.getElementById('timePicker');
    const dateSelected = document.getElementById('dateSelected');
    const timeSelected = document.getElementById('timeSelected');  
    timeSelected.innerText = moment(currentDate).format('hh:mm');
    dateSelected.innerText = moment(currentDate).format('MMMM Do YYYY');
    
    //Fill time picker
    let key = 1;
    for (let index = 8; index < 19; index++) {
      let timeOption = `${index}:00`;
      let option = new Option(timeOption, key++);
      timePicker.add(option);
      timeOption = `${index}:30`;
      option = new Option(timeOption, key++);
      timePicker.add(option);
    }
    
    datePicker.addEventListener('change', (e) => { dateSelected.innerText = moment(e.target.value).format('MMMM Do YYYY') });
    timePicker.addEventListener('change', (e) => { timeSelected.innerText = e.target[e.target.value].innerText });
  </script>
@endsection