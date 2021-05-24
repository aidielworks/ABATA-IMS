<div>

    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Teacher</label>
                <select wire:model="selectedTeacher" class="form-control @error('teacherIC') is-invalid @enderror" id="exampleFormControlSelect1">
                    <option selected>Select Teacher...</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->ic }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacherIC')
                <div class="invalid-feedback">
                    Please select teacher.
                </div>
                @enderror
            </div>
            <!-- ./form-group -->
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Summary of Submission
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Incomplete SP Form Submission</h3>
                        </div>
                        <!-- ./card-head -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Submitted SP Form</th>
                                        <th>Incompleted Submission</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($Spforms as $key => $Spform)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            {{$Spform->student->name}}
                                        </td>
                                        <td>
                                            <span @if($unapprovedSpForm !=null) class="text-danger" @endif>{{$Spform->count_spform}}</span>
                                        </td>
                                        <td>
                                            <div class="text-danger">{{ 4-$Spform->count_spform }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="text-center">
                                {!! $Spforms->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- ./card -->
                </div>
                <!-- ./col -->
                <div class="col">
                    <div class="info-box">
                        <div class="info-box-content">
                            <span class="info-box-text">Total Student</span>
                        </div>
                        <!-- /.info-box-content -->
                        <span class="info-box-icon bg-light elevation-1">{{$no_of_student}}</span>
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box">
                        <div class="info-box-content">
                            <span class="info-box-text">Submitted SP Forms</span>
                        </div>
                        <!-- /.info-box-content -->
                        <span class="info-box-icon {{($submitted_spforms < $no_of_student * 4) ? 'bg-danger' : 'bg-light'}}  elevation-1">{{$submitted_spforms}} / {{$no_of_student * 4}}</span>
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->
            </div>
            <!-- ./row -->
            @if($submitted_spforms < $no_of_student * 4)<p class="text-danger"> Incomplete submission!</p> @endif
                @if($unapprovedSpForm !=null) <p class="text-danger">There is pending SP Forms!</p> @endif
        </div>
        <!-- ./card-body -->
    </div>

    <form action="{{ url('teacher/payroll') }}" method="POST">
        @csrf
        <input type="hidden" name="teacherIC" value="{{$selectedTeacher}}">
        <input type="hidden" name="net_salary" value="{{$no_of_student * 80}}">
        <input type="hidden" name="no_of_student" value="{{ $no_of_student }}">
        <input type="hidden" name="rate_per_student" value="80">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">Payroll Details</div>
                    <div class="col-3">
                        <div class="form-inline">
                            <label for="exampleFormControlSelect1" class="mr-sm-2">Months</label>
                            <select wire:model="current_month" name="payroll_month" class="form-control">
                                @foreach($months as $key => $month)
                                @if($months[$key]['month'] == date('F'))
                                <option class="bg-secondary" value="{{ $months[$key]['month_no'] }}" selected>{{ $months[$key]['month'] }}</option>
                                @else
                                <option value="{{ $months[$key]['month_no'] }}">{{ $months[$key]['month'] }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Number of students: {{$no_of_student}}</li>
                    <li class="list-group-item">Rate per student: RM 80</li>
                    <li class="list-group-item">Total Payroll: RM {{$no_of_student * 80}}</li>
                </ul>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary" @if($submitted_spforms < $no_of_student * 4 || $unapprovedSpForm !=null) disabled @endif>Submit</button>
            </div>
        </div>
    </form>
</div>