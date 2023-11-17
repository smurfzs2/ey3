<?php
include "connection.php";

// Query to count the number of repeated department names
// $query = "SELECT count(*) FROM tbl_khenneth INNER JOIN `hr_department` ON tbl_khenneth.id=hr_department.departmentId ";

$query = "SELECT departmentName, COUNT(departmentName) AS count FROM hr_department INNER JOIN tbl_khenneth ON hr_department.departmentId=tbl_khenneth.departmentId GROUP BY departmentName";
$result= mysqli_query($con,$query);

$chartData = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $chartData[] = ['departmentName' => $row['departmentName'], 'departmentValue' => (int)$row['count'] ];
    }
} else {
    echo "0 results";
}

?>

<!-- HTML -->
<title>PIE CHART</title>
<h1 style="text-align: text-center;">PIE CHART</h1>
<div id="chartdiv"></div>

<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(
  am5percent.PieChart.new(root, {
    endAngle: 270
  })
);

// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(
  am5percent.PieSeries.new(root, {
    valueField: "departmentValue",
    categoryField: "departmentName",
    endAngle: 270
  })
);

series.states.create("hidden", {
  endAngle: -90
});

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll(<?php echo json_encode($chartData) ?>);

series.appear(1000, 100);

}); // end am5.ready()
</script>

