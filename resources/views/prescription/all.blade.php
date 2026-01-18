@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                  Appointments({{$patients->count()}})
                </div>

                {{-- <form action="{{ route('patient') }}" method="GET">
                @csrf
                  <div class="card-header">                  
                    Filter:
                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker"
                         data-target="#datepicker" name="date">
                      </div>
                      <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                    </div>                 
                  </div>
                </form> --}}

                <div class="card-body">
                    <table class="table table-striped" >
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Photo</th>
                          <th scope="col">Date</th>
                          <th scope="col">User</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Gender</th>
                          <th scope="col">Time</th>
                          <th scope="col">Doctor</th>
                          <th scope="col">Status</th>
                          <th scope="col">Prescription</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($patients as $key=>$patient)
                        <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td><img src="/profile/{{$patient->user->image}}" width="80" style="border-radius: 50%;"></td>
                          <td></td>
                          <td>{{$patient->user->name}}</td>
                          <td>{{$patient->user->email}}</td>
                          <td>{{$patient->user->phone_number}}</td>
                          <td>{{$patient->user->gender}}</td>
                          <td>{{$patient->time}}</td>
                          <td>{{$patient->doctor->name}}</td>
                          <td>
                            @if($patient->status == 1)
                              checked
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('prescription.show',[$patient->user_id, $patient->date]) }}" class="btn btn-secondary">View Prescription</a>
                          </td>
                        </tr>
                        @empty
                        <td>There are no appointments today</td>
                        @endforelse
                       
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
