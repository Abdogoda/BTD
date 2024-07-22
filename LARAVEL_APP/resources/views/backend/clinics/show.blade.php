@extends('layouts.backend.master')
@section('title') {{$clinic->name}} @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <form action="{{route('doctor.clinic_update', $clinic)}}" method="post">
  @csrf
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-1">Clinic: {{$clinic->name}}</h5>
    <p class="mb-1"><a href="{{route('doctor.clinics')}}">Clinics</a> / {{$clinic->name}}</p>
   </div>
    <div class="mt-4 row">
     <div class="col-md-6 form-group mb-4">
      <label for="name">Clinic Name <span class="text-danger">*</span></label>
      <input type="text" name="name" id="name" class="form-control" value="{{$clinic->name}}"/>
      @error('name')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-4">
      <label for="phone">Clinic Phone <span class="text-danger">*</span></label>
      <input type="text" minlength="11" maxlength="11" name="phone" id="phone" class="form-control" value="{{$clinic->phone}}"/>
      @error('phone')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-12 form-group mb-4">
      <label for="address">Clinic Address <span class="text-danger">*</span></label>
      <input type="text" name="address" id="address" class="form-control" value="{{$clinic->address}}"/>
      @error('address')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-12 form-group mb-4">
      <label for="location">Clinic Location <span class="text-danger">*</span></label>
      <input type="text" name="location" id="location" class="form-control" value="{{$clinic->location}}"/>
      @error('location')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-4">
       <label for="visiting_price">Clinic Visiting Price <span class="text-danger">*</span> <small class="text-muted">(EGP)</small></label>
       <input type="number" class="form-control" min="10" max="10000000" name="visiting_price" id="visiting_price" value="{{$clinic->visiting_price}}">
       @error('visiting_price')
        <span class="text-danger">{{ $message }}</span>
       @enderror
     </div>
     <div class="col-md-6 form-group mb-4">
       <label for="follow_up_price">Clinic FollowUp Price <small class="text-muted">(EGP)</small></label>
       <input type="number" class="form-control" min="10" max="10000000" name="follow_up_price" id="follow_up_price" value="{{$clinic->follow_up_price}}">
       @error('follow_up_price')
        <span class="text-danger">{{ $message }}</span>
       @enderror
     </div>
     <div class="form-group mb-4 d-flex gap-2 flex-wrap align-items-center">
      <button type="submit" class="btn btn-primary">Update Clinic</button>
      <a href="{{route('doctor.clinic_delete', $clinic)}}" onclick="return confirm('Sure you want to delete this clinic?')" class="btn btn-danger">Delete clinic</a>
     </div>
    </div>
  </div>
 </form>
</div>
<div class="mt-3 card">
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-1">Clinic Schedule</h5>
   </div>
    <div class="mt-4">
      <div class="table-responsive">
        <table class="table align-middle text-center">
          <thead>
            <tr>
              <th>Day</th>
              <th>Capacity</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <form action="{{route('doctor.clinic_schedule_store')}}" method="post">
                @csrf
                <input type="hidden" name="clinic_id_new" value="{{$clinic->id}}">
                <td>
                  <select name="day_new" class="form-control">
                    <option disabled selected>__Select a day__</option>
                    @foreach ($daysOfWeek as $day_of_week)
                        <option {{old('day_new') == $day_of_week ? "selected" : ""}} value="{{$day_of_week}}">{{$day_of_week}}</option>
                    @endforeach
                  </select>
                  @error('day_new')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <input type="number" min="1" max="10000" name="capacity_new" value="{{old('capacity_new') ?? 1}}" class="form-control">
                  @error('capacity_new')
                  <span class="text-danger">{{ $message }}</span>
                @enderror</td>
                <td>
                  <select name="start_time_new" class="form-control">
                    <option disabled selected>__Select a start time__</option>
                    @foreach ($startHoursOfDay as $hour_of_day)
                        <option {{\Carbon\Carbon::parse($hour_of_day)->equalTo(\Carbon\Carbon::parse(old('start_time_new'))) ? "selected" : ""}} value="{{$hour_of_day}}">{{\Carbon\Carbon::createFromFormat('H:i:s', $hour_of_day)->format('h:i A')}}</option>
                    @endforeach
                  </select>
                  @error('start_time_new')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <select name="end_time_new" class="form-control">
                    <option disabled selected>__Select a end time__</option>
                    @foreach ($endHoursOfDay as $hour_of_day)
                        <option {{\Carbon\Carbon::parse($hour_of_day)->equalTo(\Carbon\Carbon::parse(old('end_time_new'))) ? "selected" : ""}} value="{{$hour_of_day}}">{{\Carbon\Carbon::createFromFormat('H:i:s', $hour_of_day)->format('h:i A')}}</option>
                    @endforeach
                  </select>
                  @error('end_time_new')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td class="d-flex flex-wrap align-items-center justify-content-center gap-2">
                  <button type="submit" class="btn btn-success btn-sm">Add New</button>
                </td>
              </form>
            </tr>
            @forelse ($clinic->clinic_schedule as $day)
              <form action="{{route('doctor.clinic_schedule_update', $day)}}" method="post">
                @csrf
                <tr>
                  <td>
                    <select name="day" id="day" class="form-control">
                      @foreach ($daysOfWeek as $day_of_week)
                          <option {{$day->day == $day_of_week ? "selected" : ""}} value="{{$day_of_week}}">{{$day_of_week}}</option>
                      @endforeach
                    </select>
                    @error('day')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </td>
                  <td>
                    <input type="number" min="1" max="10000" name="capacity" value="{{$day->capacity}}" class="form-control">
                    @error('capacity')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror</td>
                  <td>
                    <select name="start_time" id="start_time" class="form-control">
                      @foreach ($startHoursOfDay as $hour_of_day)
                          <option {{\Carbon\Carbon::parse($hour_of_day)->equalTo(\Carbon\Carbon::parse($day->start_time)) ? "selected" : ""}} value="{{$hour_of_day}}">{{\Carbon\Carbon::createFromFormat('H:i:s', $hour_of_day)->format('h:i A')}}</option>
                      @endforeach
                    </select>
                    @error('start_time')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </td>
                  <td>
                    <select name="end_time" id="end_time" class="form-control">
                      @foreach ($endHoursOfDay as $hour_of_day)
                          <option {{\Carbon\Carbon::parse($hour_of_day)->equalTo(\Carbon\Carbon::parse($day->end_time)) ? "selected" : ""}} value="{{$hour_of_day}}">{{\Carbon\Carbon::createFromFormat('H:i:s', $hour_of_day)->format('h:i A')}}</option>
                      @endforeach
                    </select>
                    @error('end_time')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </td>
                  <td class="d-flex flex-wrap align-items-center gap-2">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    <a href="{{route('doctor.clinic', $clinic)}}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              </form>
            @empty
            <tr>
              <td colspan="5" class="text-center text-muted">There Is No Clinics Available!</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection