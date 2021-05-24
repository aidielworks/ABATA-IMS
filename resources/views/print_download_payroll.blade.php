<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABATA_PR - {{$payroll->reference_no}}.pdf</title>
</head>

<body>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" align="center" style="font-size:18px">
                <h1>ABATA Resources</h1>
                <p>8-1, Jln Sg Rasau E 32/E, Berjaya Park, 40460 Shah Alam, Selangor</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" cellpadding="5">
                    <tr>
                        <td width="65%">
                            <b>Name:</b> {{$employee->name}}<br>
                            <b>Position:</b> {{$employee->job->job_position}}<br>
                            <b>Phone Number:</b> {{$employee->phonenumber}}<br>
                            <b>IC:</b> {{$employee->ic}}<br>
                            <b>Address:</b> : {{$employee->address}},
                            {{$employee->city}},
                            {{$employee->zipcode}},
                            {{$employee->state}},
                        </td>
                        <td width="35%">
                            <b>References No:</b> {{$payroll->reference_no}}<br>
                            <b>Date: {{date_format($payroll->created_at,"d/m/Y")}}<br>
                                <b>Issued By:</b> {{$payroll->issued_by}}
                        </td>
                    </tr>
                </table>
                <br>
                <table width="100%" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="2">
                                Month of Salary: {{$payroll->payroll_month}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Allowances Item</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    @if(empty($payroll->allowances))
                                    <tbody>
                                        @foreach($payroll->allowances as $key => $allowance)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $allowance->allowance_item }}</td>
                                            <td>{{ $allowance->allowance_amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right">
                                                <h5><b>Total</b></h5>
                                            </td>
                                            <td>{{ $payroll->total_allowances }}</td>
                                        </tr>
                                    </tfoot>
                                    @else
                                    <tr>
                                        <td colspan="3" style="text-align:right;">No allowance.</td>
                                    </tr>
                                    @endif
                                </table>
                            </td>
                            <td>
                                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Deductions Item</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    @if(empty($payroll->deductions))
                                    <tbody>
                                        @foreach($payroll->deductions as $key => $deduction)
                                        <tr>
                                            <td>1</td>
                                            <td>Call of Duty</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="text-align:right;">Total</td>
                                            <td>{{ $payroll->total_deductions }}</td>
                                        </tr>
                                    </tfoot>
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-center">No deduction.</td>
                                    </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table border="1" width="100%" cellpadding="5" cellspacing="0">
                    <tbody>
                        <tr>
                            <th style="width:50%">Basic Salary:</th>
                            <td>RM {{ $payroll->basic_salary }}</td>
                        </tr>
                        <tr>
                            <th>Tax (9.5%)</th>
                            <td>RM {{ $payroll->income_tax }}</td>
                        </tr>
                        <tr>
                            <th>Net Salary:</th>
                            <td>RM {{ $payroll->net_salary }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <div style="text-align:center;">
                    <i>This is a computer generated statement and does no need for signature.<br>
                        Discrepancy if any noted, should be intimated to H.R. department within two days.
                    </i>

                </div>
            </td>
        </tr>
    </table>
</body>

</html>