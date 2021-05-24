@extends('layout.main')

@section('title', 'ABATA | Edit Employee')

@section('container')
<div class="card border-primary">
    <div class="card-header text-white bg-primary">
        <h3>Edit Employee</h3>
    </div>
    <form method="POST" action="/employee/{{ $employee->id }}" autocomplete="off">
        @method('patch')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ali Bin Abu" value="{{ $employee->name }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="ic">IC</label>
                    <input type="text" class="form-control @error('ic') is-invalid @enderror" id="ic" name="ic" placeholder="890514085867" value="{{ $employee->ic }}" readonly>
                    @error('ic')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="phonenumber">Phone Number</label>
                    <input type="text" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber" name="phonenumber" placeholder="0123456789" value="{{ $employee->phonenumber }}">
                    @error('phonenumber')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@email.com" value="{{ $employee->email }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="position">Position</label>
                    <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" placeholder="Clerk" value="{{ $employee->position }}">
                    @error('position')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="No 4, Jalan Ampang" value="{{ $employee->address }}">
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="city">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Kuala Lumpur" value="{{ $employee->city }}">
                    @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" placeholder="12345" value="{{ $employee->zipcode }}">
                    @error('zipcode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col">
                    <vlabel for="state">State</vlabel>
                    <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                        <option selected value="{{ $employee->state }}" class="bg-success">{{ $employee->state }}</option>
                        <option value="Johor">Johor</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Malacca">Malacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select>
                    @error('state')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Bank Detail
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col">
                        <label for="bank_name">Bank</label>
                        <select id="bank_name" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror">
                            <option selected disabled>Choose...</option>
                            @foreach($banks as $bank)
                            @if($employee->bank_name == $bank->bank)
                            <option selected value="{{ $bank->bank }}" class="bg-success">{{ $bank->bank }}</option>
                            @else
                            <option value="{{ $bank->bank }}">{{ $bank->bank }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('bank_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="bank_acc_no">Account Number</label>
                        <input type="text" class="form-control @error('bank_acc_no') is-invalid @enderror" id="bank_acc_no" name="bank_acc_no" placeholder="12345" value="{{ $employee->bank_acc_no }}">
                        @error('bank_acc_no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <input class="btn btn-primary" type="submit" value="Update">
        </div>
    </form>
</div>

@endsection