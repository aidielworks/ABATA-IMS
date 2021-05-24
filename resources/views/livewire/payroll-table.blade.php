<div>
    <div class="card">
        <div class="card-header">
            <h3>List of Payroll <a href="{{ url('/admin/payroll/create') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-plus-circle"></i> Create Payroll</a></h3>
        </div>
        <div class="card-body">
            <div class="form-row form-group">
                <div class="col-7">
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search employee ic ...">
                </div>
                <div class="col">
                    <div class="form-group">
                        <select wire:model="status" class="form-control">
                            <option selected disabled>Status...</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <select wire:model="perPage" class="form-control">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th>Reference No</th>
                        <th>Employee</th>
                        <th>Net Salary (RM)</th>
                        <th>Month of Salary</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payrolls as $key => $payroll)
                    <tr>
                        <td>{{ $payroll->reference_no }}</td>
                        <td>
                            @foreach($payroll->employee as $emp)
                            {{$emp->name}} | {{$emp->ic}}
                            @endforeach
                        </td>
                        <td>{{ $payroll->net_salary }}</td>
                        <td>{{ $payroll->payroll_month }}</td>
                        <td>
                            @if($payroll->status == 'Pending')
                            <span class="badge badge-pill badge-warning">{{$payroll->status}}</span>
                            @else
                            <span class="badge badge-pill badge-success">{{$payroll->status}}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('admin/payroll/'.$payroll->id.'/'.$emp->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View Payroll"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $payrolls->links() !!}
        </div>
    </div>
</div>