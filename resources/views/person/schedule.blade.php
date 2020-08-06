@extends('layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <div class="row mx-0">
    <div class="col-md-5 px-0">
      <div class="container">
        <div class="row company-information">
          <div class="row col-12 border-bottom pb-3 mb-1">
            <div class="col-6 col-md-12 col-xl-6 d-flex justify-content-center align-items-center px-0">
              <img class="logo-adu" src="{{ asset('images/adu.png') }}" alt="">
            </div>
            <div class="col-6 col-md-12 col-xl-6 d-flex justify-content-center align-items-center px-0">
              <img class="logo-express mt-md-3" src="{{ asset('images/express.png') }}" alt="">
            </div>
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
      <form action="{{ env('ZAPIER_WEBHOOK_URL') }}" method="post" id="form-data" name="form-data">
      {{-- <form action="{{ route('person.store') }}" method="post"> --}}
          @csrf
        <h6>Enter Details</h6>
        <input id="hidden-full-name" type="hidden" name="client_full_name" value="{{ $person->name }}">
        <input id="hidden-date" type="hidden" name="date_selected" value="">
        <input id="hidden-end-time" type="hidden" name="end-time" value="">
        <input id="hidden-time" type="hidden" value="">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control form-control-sm" id="name" name="name" readonly value="{{ $organization->name }} Meeting {{ $person->name }}">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control form-control-sm" id="email" name="email" readonly value="{{ $organization->{'b9a9b40b7387cd9f7cafcc17969fae4eb695903d'} }}">
        </div>
        <div class="form-group">
          <label for="notes">Notes</label>
          <textarea class="form-control form-control-sm" id="notes" name="notes" readonly rows="2">{{ $person->{'5f504213b4ac6207f8430a9c6618ad5d6dbcb233'} }}</textarea>
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
          <input type="text" class="form-control form-control-sm" id="client-phone" name="client_phone" readonly value="{{ $personPhone }}">
        </div>
        <div class="form-group">
          <label for="client-address">Client Address</label>
          <input type="text" class="form-control form-control-sm" id="client-address" name="client_address" readonly value="{{ $person->{'35f00eb5ee0a5cec1fe2061cbc759fe72da4447c'} }}">
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
          <input type="text" class="form-control form-control-sm" id="client-email" name="client_email" readonly value="{{ $personEmail }}">
        </div>
        <div class="form-group">
          <label for="person-id">Pipedrive Person ID</label>
          <input type="text" class="form-control form-control-sm" id="person-id" name="pipedrive_person_id" readonly value="{{ $person->id }}">
        </div>
        <div class="form-group">
          <label for="organization-id">Pipedrive Organization ID</label>
          <input type="text" class="form-control form-control-sm" id="organization-id" name="pipedrive_organization_id" readonly value="{{ $organization->id }}">
        </div>
        
        <div class="form-group">
          <label for="user-id"><h6>ADU Resource Center Representative</h6></label>
          <select id="user-id" class="form-control form-control-sm" name="pipedrive_user_id">
            <option value="">Choose one...</option>
            @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->email }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="pipline">Pipeline</label>
          <select id="pipline" class="form-control form-control-sm" name="pipeline">
            <option value="">Choose one...</option>
            <option value="14">ADU</option>
            <option value="21">Hardscape</option>
          </select>
        </div>
        <div class="col-sm-12 mt-5">
          <button id="schedule" class="btn btn-primary">Schedule Event</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('js/manageDateTime.js') }}"></script>
  <script>
    let url = '{{ env('ZAPIER_WEBHOOK_URL') }}';

    const btnSchedule = document.getElementById('schedule');
    btnSchedule.addEventListener('click', (e) => {
      e.preventDefault();
      var data = new FormData(document.getElementById("form-data"));
      let personId = data.get('pipedrive_person_id');
      
      fetch(url, {
        method : "POST",
        data
      })
      .then(
          response => response.json() 
      )
      .then(
          response => {
            if (response.status === 'success') {
              Swal.fire({
                title: 'Meeting Scheduled!',
                icon: 'success',
                confirmButtonText: 'Close',
                onClose: () => window.location.replace('{{ env('REDIRECT_AFTER_SUBMISION') }}' + personId)
              });
            }
          }
      )
      .catch( error => {
        Swal.fire({
          title: 'Error!',
          text: error,
          icon: 'error',
          confirmButtonText: 'Close'
        })
      });
    });
    
  </script>
@endsection