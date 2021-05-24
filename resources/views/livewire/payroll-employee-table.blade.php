<div>
    <div class="card border-primary">
        <div class="card-header d-flex align-items-start">
            <h3>List of Employee</h3>
        </div>
        <div class="card-body">
            <div class="form-row form-group">
                <div class="col-9">
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" id="search_employee" placeholder="Search employee...">
                </div>
                <div class="col">
                    <select wire:model="perPage" class="form-control">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($employees))
                    @foreach( $employees as $emp)
                    <tr>
                        <td>{{ $emp->name }}</td>
                        <td>{{ $emp->job->job_position }}</td>
                        <td>
                            <a href="/admin/payroll/employee/{{ $emp->id }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title="Payroll Setting"><i class="fa fa-cog"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">No data found!</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $employees->links() !!}
        </div>
    </div>
</div>