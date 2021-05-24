<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABATA_TPR - {{$teacherPayroll->reference_no}}.pdf</title>
</head>

<style>
    .center td {
        text-align: center;
    }
</style>

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
                            <b>Name:</b> {{$teacherPayroll->teacher[0]['name']}}<br>
                            <b>Phone Number:</b> {{$teacherPayroll->teacher[0]['phonenumber']}}<br>
                            <b>IC:</b> {{$teacherPayroll->teacher[0]['ic']}}<br>
                            <b>Address:</b> : <br>
                            {{$teacherPayroll->teacher[0]['houseNo']}}, {{$teacherPayroll->teacher[0]['streetName']}}<br>
                            {{$teacherPayroll->teacher[0]['city']}}, {{$teacherPayroll->teacher[0]['zipcode']}}, {{$teacherPayroll->teacher[0]['state']}}<br>
                        </td>
                        <td width="35%">
                            <b>References No:</b> {{$teacherPayroll->reference_no}}<br>
                            <b>Date: {{date_format($teacherPayroll->created_at,"d/m/Y")}}<br>
                                <b>Issued By:</b> {{$teacherPayroll->issued_by}}
                        </td>
                    </tr>
                </table>
                <br>
                <table width="100%" cellpadding="5" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Month of Salary: {{date('F', mktime(0, 0, 0, $teacherPayroll->payroll_month, 1))}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>No of Student</th>
                                            <th>Rate per Student</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="center">
                                        <tr>
                                            <td>1</td>
                                            <td>{{$teacherPayroll->no_of_student}}</td>
                                            <td>RM80</td>
                                            <td>RM{{ $teacherPayroll->no_of_student * $teacherPayroll->rate_per_student }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table border="1" width="100%" cellpadding="5" cellspacing="0">
                    <tbody>
                        <tr>
                            <th style="text-align:right;">Net Salary:</th>
                            <td>RM {{ $teacherPayroll->net_salary }}</td>
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