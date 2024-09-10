<?php
$page_title = 'Admin Home Page';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php
$c_application_forms = count_application_forms();
$c_males = count_males();
$c_females = count_females();
$c_barangays = count_barangays();

// Fetch people per barangay data
$barangay_data = find_people_per_barangay();
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <a href="application_forms.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-primary">
          <i class="glyphicon glyphicon-list-alt"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_application_forms['total']; ?> </h2>
          <p class="text-muted">Total People</p>
        </div>
      </div>
    </div>
  </a>

  <a href="males.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-blue2">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_males['total']; ?> </h2>
          <p class="text-muted">Total Males</p>
        </div>
      </div>
    </div>
  </a>

  <a href="females.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left bg-secondary1">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_females['total']; ?> </h2>
          <p class="text-muted">Total Females</p>
        </div>
      </div>
    </div>
  </a>

  <div class="col-md-3">
    <div class="panel panel-box clearfix">
      <div class="panel-icon pull-left bg-green">
        <i class="glyphicon glyphicon-home"></i>
      </div>
      <div class="panel-value pull-right">
        <h2 class="margin-top"> <?php echo $c_barangays['total']; ?> </h2>
        <p class="text-muted">Number of Barangays</p>
      </div>
    </div>
  </div>
  </a>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js Zoom Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>

<!-- People per Barangay Chart -->
<div class="row justify-content-center">
  <div class="col-md-8 mx-auto">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>People per Barangay</span>
        </strong>
      </div>
      <div class="panel-body">
        <canvas id="barangayChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Gender Distribution Chart -->
  <div class="col-md-4 mx-auto">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Gender Distribution</span>
        </strong>
      </div>
      <div class="panel-body">
        <canvas id="genderChart"></canvas>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var ctxBarangay = document.getElementById('barangayChart').getContext('2d');
    var barangayData = <?php echo json_encode($barangay_data); ?>;
    var labelsBarangay = barangayData.map(function (item) { return item.barangay; });
    var dataBarangay = barangayData.map(function (item) { return item.total; });

    new Chart(ctxBarangay, {
      type: 'bar',
      data: {
        labels: labelsBarangay,
        datasets: [{
          label: 'Number of People',
          data: dataBarangay,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        },
        plugins: {
          zoom: {
            pan: {
              enabled: true,
              mode: 'xy'
            },
            zoom: {
              enabled: true,
              mode: 'xy'
            }
          }
        }
      }
    });

    var ctxGender = document.getElementById('genderChart').getContext('2d');
    var genderData = {
      labels: ['Males', 'Females'],
      datasets: [{
        label: 'Gender Distribution',
        data: [<?php echo $c_males['total']; ?>, <?php echo $c_females['total']; ?>],
        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
        borderWidth: 1
      }]
    };

    new Chart(ctxGender, {
      type: 'pie',
      data: genderData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                var label = context.label || '';
                if (label) {
                  label += ': ';
                }
                label += context.raw;
                return label;
              }
            }
          }
        }
      }
    });
  });
</script>
<?php include_once('layouts/footer.php'); ?>