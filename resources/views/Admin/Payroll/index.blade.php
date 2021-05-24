@extends('layout.main')

@section('title', 'ABATA | Payroll Dashboard')
@section('container')
<h4>NEXT MONTH</h4>
<div class="info-box row align-items-center">
    <div class="col text-center">
        <h2 class="description-header text-success">{{ $employee }}</h2>
        <span class="description-text">EMPLOYEE</span>
    </div>
    <!-- /.col -->
    <div class="col text-center border-left">
        <h2 class="description-header text-danger">RM{{ $totalSalary }}</h2>
        <span class="description-text">TOTAL PAYROLL COST</span>
    </div>
    <!-- /.col -->
    <div class="col text-center border-left">
        <h2 class="description-header">RM{{ $company_income_tax }}</h2>
        <span class="description-text">TOTAL TAX(EPF/SOCSO)</span>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<hr>
<livewire:payroll-table>

    @endsection