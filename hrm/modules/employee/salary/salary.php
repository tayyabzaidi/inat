<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
<!-- 
<head>
    <style>
        /* Add this to your CSS code */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
        }

        .modal-image-container {
            display: flex;
            flex-wrap: wrap;
            /* Allow images to wrap to a new line if they exceed the container width */
        }

        .modal-image {
            width: 10%;
            padding: 5px;
            margin-right: 10px;
            /* Add some spacing between the images */
        }

        .modal-dialog {
            height: 180%;
            max-width: 100%;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            margin-top: 5%;
            margin-bottom: 10%;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            height: 40%;
        }
    </style>
</head>
<div class="row" style="width: 80%;margin-left: 10%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Salary Slips</h3>
                <hr>
                <div class="mb-2" align="<?php echo $_right; ?>">
                    <a href="" class="btn btn-md btn-primary"> <i class="fas fa-filter"></i>Filter</a>
                </div>

                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Slip</th>
                            <th>Discrepancy Reason</th>
                            <th>View</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $recEmpData = $pdo->query(
                            'SELECT * FROM salary  WHERE employee_id= :employeeId ORDER BY `date` LIMIT 5;'
                        );
                        for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['id'] ?></td>
                                <td><?php echo $recEmpData[$i][
                                    'date'
                                ]; ?>
                                </td>
                                <td><?php
                                header("Content-Type: application/pdf");

                                // Convert the binary PDF data to a base64-encoded string
                                $pdf_base64 = base64_encode($recEmpData[$i]['slip']);

                                // Embed the base64-encoded PDF data into an HTML object tag
                                echo '<object data="data:application/pdf;base64,' . $pdf_base64 . '" type="application/pdf" width="30%" height="150px"></object>';

                                ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['discrepancy_reason'] ?></td>
                                <td>
                                    <button class="modal-button" href="#myModal2" style="background: none;">
                                        <i class="fa fa-eye <?php echo $_right; ?>"></i></button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div id="myModal2" class="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAttachmentsModalLabel">Salary Slip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo '<object data="data:application/pdf;base64,' . $pdf_base64 . '" type="application/pdf" width="80%" height="250px"></object>';
                ?>
            </div>
        </div>
    </div>
</div>


<script>
    var btn = document.querySelectorAll("button.modal-button");

    // All page modals
    var modals = document.querySelectorAll('.modal');

    // Get the <span> element that closes the modal
    var spans = document.getElementsByClassName("close");

    // When the user clicks the button, open the modal
    for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function (e) {
            e.preventDefault();
            modal = document.querySelector(e.target.getAttribute("href"));
            modal.style.display = "block";
        }
    }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function () {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target.classList.contains('modal')) {
            for (var index in modals) {
                if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
            }
        }
    }

</script>

</html> -->


<head>
    <title>Example Modal with ID</title>
    <script>
        function openModal(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('modal-title').innerHTML = response.title;
                        document.getElementById('modal-body').innerHTML = response.body;
                        document.getElementById('myModal').style.display = "block";
                    } else {
                        console.log('There was a problem with the request.');
                    }
                }
            };
            xhr.open('GET', 'get-data.php?id=' + id, true);
            xhr.send();
        }
    </script>
</head>

<body>
    <button onclick="openModal(123)">Open Modal with ID 123</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="modal-title"></h2>
            <p id="modal-body"></p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>