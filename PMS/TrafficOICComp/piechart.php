<?php
$connect = mysqli_connect("localhost", "root", "", "policedep");
$query = "SELECT fine_cate, count(*) as number FROM spot_fine_tbl GROUP BY fine_cate";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pie Chart About All Fines</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Gender', 'Number'],
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo "['" . $row["fine_cate"] . "', " . $row["number"] . "],";
                }
                ?>
            ]);
            var options = {
                title: 'Percentage of Fine Category',
                //is3D:true,  
                is3D: true,
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <br /><br />
    <div style="width:900px;">
        <h3 align="center">Pie Chart About All Fines</h3>
        <br />
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
</body>

</html>