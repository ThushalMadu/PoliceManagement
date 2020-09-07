<?php
include("php/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/datatable/datatable.css" rel="stylesheet" />
</head>

<body>
    <div class="panel panel-default">
        <div class="panel-heading">
            Manage Branch
        </div>
        <div class="panel-body">
            <div class="table-sorting table-responsive">

                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Branch</th>
                            <th>Address</th>
                            <th>Detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select fine_name,fine_id,price from fine ";
                        $q = $conn->query($sql);
                        $i = 1;
                        while ($r = $q->fetch_assoc()) {
                            echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $r['fine_name'] . '</td>
                                            <td>' . $r['fine_id'] . '</td>
                                            <td>' . $r['price'] . '</td>
											<td>
											<a href="branch.php?action=edit&id=' . $r['fine_id'] . '" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="branch.php?action=delete&id=' . $r['fine_id'] . '" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a> </td>
                                        </tr>';
                            $i++;
                        }
                        ?>



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/dataTable/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tSortable22').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": true
            });

        });
    </script>
</body>

</html>