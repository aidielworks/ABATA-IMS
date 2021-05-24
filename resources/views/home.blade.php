@extends('layout.main')

@section('title', 'ABATA | Dashboard')

@section('container')
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-graduate"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Students</span>
        <span class="info-box-number">{{ $totalStudent }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Teachers</span>
        <span class="info-box-number">{{ $totalTeacher }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas far fa-file"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Pending SP FORM</span>
        <span class="info-box-number">{{$pendingSPForm}}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1"><i class="far fa-file-alt"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Submitted SP FORM</span>
        <span class="info-box-number">{{ $spFormSubmitted }}/{{ $totalStudent * 4 }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<div class="card">
  <div class="card-header">
    <h4 class="text-center">{{ date("Y") }}'s Teachers and Students Admission</h4>
  </div>
  <div class="card-body">
    <div class="container-fluid">
      <canvas id="barChart" width="400" height="400"></canvas>
    </div>
  </div>
</div>

<script>
  var teacher = JSON.parse('{{ json_encode($tMonth) }}');
  var student = JSON.parse('{{ json_encode($sMonth) }}');
  console.log(teacher);
  console.log(student);

  var chartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
        label: 'Teacher',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: teacher
      },
      {
        label: 'Student',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: student
      },
    ]
  }
  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, chartData)
  var temp0 = chartData.datasets[0]
  var temp1 = chartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
</script>
@endsection