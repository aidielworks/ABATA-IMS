<div>
    <div class="row">
        <div class="col-md-3">
            <a href="{{ url('teachers/spform/create') }}" class="btn btn-primary btn-block mb-3">New SP Form</a>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Folders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" wire:click.prevent="changeStatus(0)" class="nav-link">
                                <span style="color: #ffc107;"><i class="fas fa-clock"></i></span> Pending
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" wire:click.prevent="changeStatus(1)" class="nav-link">
                                <span style="color: #28a745;"><i class="fas fa-check"></i></span> Approved
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" wire:click.prevent="changeStatus(2)" class="nav-link">
                                <span style=" color: #dc3545;"><i class="fas fa-times-circle"></i></span> Declined
                                <span class="badge bg-danger float-right">{{ $declined }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Inbox</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <select wire:model="current_month" class="form-control mr-2" name="month">
                                @foreach($months as $key => $month)
                                @if($months[$key]['month'] == date('F'))
                                <option class="bg-secondary" value="{{ $months[$key]['month_no'] }}" selected>{{ $months[$key]['month'] }}</option>
                                @else
                                <option value="{{ $months[$key]['month_no'] }}">{{ $months[$key]['month'] }}</option>
                                @endif
                                @endforeach
                            </select>
                            <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search student IC">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>#</th>
                                <th>Student</th>
                                <th>Learning Topic</th>
                                <th>Class Date</th>
                                <th>Date Created</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach($spForms as $key => $spform)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="mailbox-name">{{ $spform->student->name }} <br> {{ $spform->student->ic }}</td>
                                    <td class="mailbox-subject"><a href="{{ url('/teachers/spform/'.$spform->id) }}">{{ \Illuminate\Support\Str::limit($spform->learning_topic, 10) }}
                                    </td>
                                    <td class="mailbox-date">
                                        {{date("d-M-Y", strtotime($spform->class_date))}} (Week {{Carbon\Carbon::parse($spform->class_date)->weekOfMonth}})
                                    </td>
                                    <td class="mailbox-date">{{ $spform->created_at->diffForHumans() }}</td>
                                    <td class="mailbox-attachment">
                                        @if( $spform->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif( $spform->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                        @else
                                        <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer p-3 d-flex justify-content-center">
                    {!! $spForms->links() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>