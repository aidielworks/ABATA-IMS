<div>
    <form action="{{ url('admin/payroll') }}" method="post">
        @csrf
        <input type="hidden" name="employee_ic" value="{{$employee->ic}}">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-inline">
                    <label class="mr-2">Month of Salary</label>
                    <select class="form-control" name="month">
                        @foreach($months as $key => $month)
                        @if($months[$key]['month'] == date('F',strtotime('+1 month')))
                        <option class="bg-secondary" value="{{ $months[$key]['month_no'] }}" selected>{{ $months[$key]['month'] }}</option>
                        @else
                        <option value="{{ $months[$key]['month_no'] }}">{{ $months[$key]['month'] }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Allowances
                            </div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Allowances</th>
                                            <th colspan="2">Amount (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allowances as $index => $allowance)
                                        <tr>
                                            <td><input class="form-control @if($errors->has('allowances.'.$index.'.item'))is-invalid @endif" type="text" name="allowances[{{$index}}][item]" wire:model="allowances.{{$index}}.item" value="{{ $allowance['item'] }}">
                                            </td>
                                            <td><input class="form-control @if($errors->has('allowances.'.$index.'.amount'))is-invalid @endif" type="number" name="allowances[{{$index}}][amount]" wire:model="allowances.{{$index}}.amount" value="{{ $allowance['amount'] }}"></td>
                                            <td><a href="#" wire:click.prevent="removeAllowances({{$index}})">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-muted">
                                <button class="btn btn-secondary" wire:click.prevent="addAllowances">+ Add Item</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Deductions
                            </div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Deductions</th>
                                            <th colspan="2">Amount (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deductions as $index => $deduction)
                                        <tr>
                                            <td><input class="form-control @error('deductions.*.item') is-invalid @enderror" type="text" name="deductions[{{$index}}][item]" wire:model="deductions.{{$index}}.item"></td>
                                            <td><input class="form-control @error('deductions.*.amount') is-invalid @enderror" type="number" name="deductions[{{$index}}][amount]" wire:model="deductions.{{$index}}.amount"></td>
                                            <td><a href="#" wire:click.prevent="removeDeductions({{$index}})">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-muted">
                                <button class="btn btn-secondary" wire:click.prevent="addDeductions">+ Add Item</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Summary
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Basic Salary (RM)
                            </div>
                            <div class="col-3">
                                {{$employee->job->basic_salary}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                Total Allowances (RM)
                            </div>
                            <div class="col-3">
                                {{$total_allowances}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                Total Deductions (RM)
                            </div>
                            <div class="col-3">
                                {{$total_deductions}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-right">EPF/SOCSO (9.5%)</div>
                            <div class="col-3">{{$income_tax}}</div>
                        </div>
                        <div class="row">
                            <div class="col text-right"><b>NET SALARY (RM)</b></div>
                            <div class="col-3">{{$net_salary}}</div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="basic_salary" value="{{$employee->job->basic_salary}}">
                <input type="hidden" name="total_allowances" value="{{$total_allowances}}">
                <input type="hidden" name="total_deductions" value="{{$total_deductions}}">
                <input type="hidden" name="income_tax" value="{{$income_tax}}">
                <input type="hidden" name="net_salary" value="{{$net_salary}}">
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary" @if($errors->any()) disabled @endif>Submit</button>
            </div>
        </div>
    </form>
</div>