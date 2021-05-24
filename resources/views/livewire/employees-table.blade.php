<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>List of Employee</h3>
        <a class="btn btn-primary ml-2" href="{{ url('/employee/create') }}"><i class="far fa-plus-square mr-1"></i>New Employee</a>
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
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $employees as $emp)
                <tr>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->phonenumber }}</td>
                    <td>{{ $emp->job->job_position }}</td>
                    <td>
                        @if($emp->role == 1)
                        <span class="badge badge-success">Admin</span>
                        @else
                        <span class="badge badge-light">Non Admin</span>
                        @endif
                    </td>
                    <td>
                        <a href="/employee/{{ $emp->id }}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title="View Profile"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {!! $employees->links() !!}
    </div>
</div>