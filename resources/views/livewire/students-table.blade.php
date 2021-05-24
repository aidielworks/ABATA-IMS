<div class="card border-primary">
    <div class="card-header d-flex align-items-start">
        <h3>List of Students</h3>
        <a class="btn btn-primary ml-2" href="{{ url('/student/create') }}"><i class="far fa-plus-square mr-1"></i>New Student</a>
    </div>
    <div class="card-body">
        <div class="form-row form-group">
            <div class="col-9">
                <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search student...">
            </div>
            <div class="col">
                <select wire:model="perPage" class="form-control">
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $students as $stud)
                <tr>
                    <td>{{ $stud->name }}</td>
                    <td>{{ $stud->phonenumber }}</td>
                    <td>
                        <a href="/student/{{ $stud->id }}" class="btn btn-outline-primary btn-sm"><i class="far fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {!! $students->links() !!}
    </div>
</div>