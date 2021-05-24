@extends('layout.mainTeacher')

@section('title', 'ABATA Teacher | Profile')

@section('container')
<div class="accordion" id="accordionExample">
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-editprofile-tab" data-toggle="pill" href="#v-pills-editprofile" role="tab" aria-controls="v-pills-editprofile" aria-selected="true">Edit Profile</a>
                <a class="nav-link" id="v-pills-changepassword-tab" data-toggle="pill" href="#v-pills-changepassword" role="tab" aria-controls="v-pills-changepassword" aria-selected="false">Change Password</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-editprofile" role="tabpanel" aria-labelledby="v-pills-editprofile-tab">
                    <div class="card border-success">
                        <div class="card-header text-white bg-success">
                            <h3>Edit Teacher</h3>
                        </div>
                        <form method="POST" action="/teachers/{{ $teacher[0]['id'] }}" autocomplete="off">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header text-white bg-success">
                                        Teacher Details
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-center align-items-end">
                                            <div class="col-md-2">
                                                <img src="{{ url('/images/profile_picture/teacher/'. Session::get('image')) }}" class="card-img-top" alt="...">
                                                @if($errors->has('image'))
                                                <span class="text-danger">Error when uploading</span>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <a href="#" class="btn btn-secondary" style="border-radius: 15px !important;" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fas fa-camera" data-toggle="tooltip" data-placement="top" title="Change profile picture"></i>
                                                </a>
                                                @if(Session::get('image') != 'default.jpg')
                                                <a href="{{ url('teachers/setting/removeImage/'.Session::get('id')).'/'.Session::get('image') }}" class="btn btn-secondary" style="border-radius: 15px !important;" data-toggle="tooltip" data-placement="top" title="Remove profile picture">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ali Bin Abu" value="{{ $teacher[0]['name'] }}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="ic">IC</label>
                                                <input type="text" class="form-control @error('ic') is-invalid @enderror" id="ic" name="ic" placeholder="890514085867" value="{{ $teacher[0]['ic'] }}" readonly>
                                                @error('ic')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="phonenumber">Phone Number</label>
                                                <input type="text" class="form-control @error('phonenumber') is-invalid @enderror" id="phonenumber" name="phonenumber" placeholder="0123456789" value="{{ $teacher[0]['phonenumber'] }}">
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
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@email.com" value="{{ $teacher[0]['email'] }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--Address-->
                                <div class="card">
                                    <div class="card-header text-white bg-success">
                                        Address Details
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="email">House No/Appartment/Condominium</label>
                                                <input type="text" class="form-control @error('houseNo') is-invalid @enderror" id="houseNo" name="houseNo" placeholder="No 19" value="{{ $teacher[0]['houseNo'] }}">
                                                @error('houseNo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="streetName">Street Name</label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="streetName" name="streetName" placeholder="Jalan Ampang" value="{{ $teacher[0]['streetName'] }}">
                                                @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Kuala Lumpur" value="{{ $teacher[0]['city'] }}">
                                                @error('city')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="zipcode">Zipcode</label>
                                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" name="zipcode" placeholder="12345" value="{{ $teacher[0]['zipcode'] }}">
                                                @error('zipcode')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label for="state">State</label>
                                                <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                                                    <option selected value="{{ $teacher[0]['state'] }}" class="bg-success">{{ $teacher[0]['state'] }}</option>
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
                                </div>
                                <!--Address-->
                                <div class="card-footer text-right">
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-changepassword" role="tabpanel" aria-labelledby="v-pills-changepassword-tab">
                    <div class="card">
                        <form method="POST" action="/teachers/setting/{{ session()->get('id') }}">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="currentPassword">Current password</label>
                                    <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" name="currentPassword" placeholder="...">
                                    @error('currentPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword">
                                    @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="retypePassword">Retype New Password</label>
                                    <input type="password" class="form-control @error('retypePassword') is-invalid @enderror" id="retypePassword" name="retypePassword">
                                    @error('retypePassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input class="btn btn-primary" type="submit" name="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('teachers/setting/upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" class="form-control-file" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="flashDataTab" data-flashdata-type="{{ session('status-tab') }}"></div>


<script>
    $(document).ready(function() {
        const flashData = $('.flashDataTab').data('flashdata-type');
        if (flashData == 'profile') {
            $('#v-pills-editprofile-tab').tab('show')
        }
        if (flashData == 'password') {
            $('#v-pills-changepassword-tab').tab('show')
        }
    });
</script>
@endsection