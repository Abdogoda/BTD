<form wire:submit.prevent="submit" class="appoinment-form" method="post" >
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name">Patient Name <span class="text-danger">*</span></label>
                <input wire:model="name" id="name" type="text" class="form-control">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">Patient Phone</label>
                <input wire:model="phone" id="phone" type="text" minlength="11" maxlength="11" class="form-control" >
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="age">Patient Age</label>
                <input wire:model="age" id="age" type="number" min="1" max="130" class="form-control" >
                @error('age') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="gender">Patient Gender</label>
                <select wire:model="gender" class="form-control" id="gender">
                    <option disabled selected>Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="doctor_id">Choose Doctor <span class="text-danger">*</span></label>
                <select wire:model.change="doctor_id" class="form-control" id="doctor_id">
                    <option selected disabled value="Select Doctor">Select Doctor</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->user->first_name." ".$doctor->user->last_name }}</option>
                    @endforeach
                </select>
                @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="clinic_id">Choose Clinic <span class="text-danger">*</span></label>
                <select wire:model.change="clinic_id" class="form-control" id="clinic_id">
                    <option disabled selected value="Select Clinic">Select Clinic</option>
                    @forelse($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }} ({{$clinic->visiting_price}} EGP)</option>
                    @empty
                        <option disabled>There is no clinics avaliable</option>
                    @endforelse
                </select>
                @error('clinic_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" wire:model="address" class="form-control" id="address" readonly>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="day">Appointment Day <span class="text-danger">*</span></label>
                <select wire:model.change="day" class="form-control" id="day">
                    <option disabled selected value="Select Day">Select Day</option>
                    @forelse($clinic_days as $day)
                        <option value="{{ $day->day }}">{{ ucfirst($day->day)}}</option>
                    @empty
                        <option disabled>There are no days available for this clinic</option>
                    @endforelse
                </select>
                @error('day') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="form-group">
                <label for="date">Appointment Date <span class="text-danger">*</span></label>
                <input type="text" readonly wire:model="date" class="form-control" id="date"/>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="time">Appointment Time <span class="text-danger">*</span></label>
                <select wire:model.change="time" class="form-control" id="time">
                    <option disabled selected value="Select Time">Select Time</option>
                    @forelse($clinic_day_times as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @empty
                        <option disabled>There are no times available for this clinic</option>
                    @endforelse
                </select>
                @error('time') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="number">Appointment Number <span class="text-danger">*</span></label>
                <input type="number" readonly wire:model="number" class="form-control" id="number"/>
            </div>
        </div>
    </div>
    <div class="form-group-2 mb-4">
        <label for="number">Message</label>
        <textarea wire:model="message" id="message" class="form-control" rows="6"></textarea>
        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-main btn-round-full">Make Appoinment<i class="icofont-simple-right ml-2"></i></button>
</form>