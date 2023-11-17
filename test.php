<?php
include "connection.php";
// Connect to the database

// Query to retrieve the department names
$query = "SELECT departmentName FROM hr_department";
$result = mysqli_query($con, $query);

// Store the department names in an array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row["departmentName"];
}

// Close the database connection
// mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://www.amcharts.com/lib/4/core.js"></script>
  <script src="https://www.amcharts.com/lib/4/charts.js"></script>
  <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
</head>
<body>
    <div id="chartdiv"></div>
  <script>
    // Create the chart
    var chart = am4core.create("chartdiv", am4charts.XYChart);

    // Add the data to the chart
    chart.data = <?php echo json_encode($data); ?>;

    // Create the category axis
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "departmentName";

    // Create the value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create the bar series
    var barSeries = chart.series.push(new am4charts.ColumnSeries());
    barSeries.dataFields.valueY = "departmentName";
    barSeries.dataFields.categoryX = "departmentName";
  </script>
</body>
</html>
