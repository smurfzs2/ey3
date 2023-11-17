<?php
include "connection.php";
// Query to count the number of repeated department names
// $query = "SELECT count(*) FROM tbl_khenneth INNER JOIN `hr_department` ON tbl_khenneth.id=hr_department.departmentId ";
$query = "SELECT departmentName, COUNT(departmentName) AS count FROM hr_department INNER JOIN tbl_khenneth ON hr_department.departmentId=tbl_khenneth.id GROUP BY departmentName";
$result = mysqli_query($con, $query);

$chartData = array();
if ($result->num_rows > 0) 
{
    // output data of each row
    while ($row = $result->fetch_assoc()) 
    {
        $chartData[] = ['departmentName' => $row['departmentName'], 'count' => (int)$row['count']];
    }
} 
else 
{
    echo "0 results";
}

//set the response content type as JSON
// header('Content-type: application/json');
//output the return value of json encode using the echo function.
echo json_encode($chartData);

?>



<!-- HTML -->
<div id="chartdiv"></div>

<!-- <?php
        $sql = "SELECT * FROM hr_department ";
        $result = mysqli_query($con, $sql);

        if ($res = $result->num_rows > 0) {
        ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Department Name</th>
            </tr>
          </thead>
          <tbody>
        <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
              <th scope="row"><?php echo ++$i; ?></th>
             
              <td><?php echo $row["departmentName"]; ?></td>
            </tr>
          <?php
            }

            ?>
            </tbody>
        </table>
            <?php


        }

            ?> -->

<!-- Styles -->
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
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
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
        });

        xRenderer.grid.template.setAll({
            location: 1
        })

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "departmentName",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })
        }));


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Series 1",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "departmentValue",
            sequencedInterpolation: true,
            categoryXField: "departmentName",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
        }));

        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeOpacity: 0
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        // put the data in chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/data/#Setting_data

        var data = <?php echo json_encode($chartData); ?>;

        xAxis.data.setAll(data);
        yAxis.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>