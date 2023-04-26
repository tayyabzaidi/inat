<!DOCTYPE html>
<html lang="<?php echo $lang_code; ?>" dir="<?php echo $page_direction; ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            height: 125%;
            overflow: auto;
        }

        .img {
            margin-right: 30px
        }

        .modal-dialog {
            height: 120%;
            max-width: 80%;
            margin: 1.75rem auto;
        }



        .claim-view-images {
            border: 1px solid #f0f2f5;
            display: inline;
            margin-left: 10px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .modal-dialog {
            height: 120%;
            max-width: 80%;
            margin: 1.75rem auto;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            margin-top: 10%;
            margin-bottom: 10%;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            height: 40%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .ant-tag {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, .65);
            font-size: 14px;
            font-variant: tabular-nums;
            line-height: 1.5;
            list-style: none;
            -webkit-font-feature-settings: "tnum";
            font-feature-settings: "tnum";
            display: inline-block;
            height: 22px;
            margin-right: 8px;
            padding: 0 7px;
            font-size: 12px;
            line-height: 20px;
            white-space: nowrap;
            background: #fafafa;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            cursor: pointer;
            opacity: 1;
            -webkit-transition: all .3s cubic-bezier(.215, .61, .355, 1);
            -o-transition: all .3s cubic-bezier(.215, .61, .355, 1);
            transition: all .3s cubic-bezier(.215, .61, .355, 1);
        }
    </style>
</head>
<div class="row" style="width: 98%;margin-left: 1%;">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">

            <div class="card-body">
                <h3>Claim List</h3>



                <table class="table table-sm table-responsive-sm table-condensed table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>I.D</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->bind('employeeId', $_SESSION['empId']);
                        $recEmpData = $pdo->query(
                            'SELECT ee.*,e.info_fullname_en as `name` FROM employee_expenses ee join employees e on e.empId=ee.employee_id WHERE `employee_id`=:employeeId ORDER BY `date` LIMIT 5;'
                        );
                        ?>
                        <?php for ($i = 0; $i < count($recEmpData); $i++) { ?>
                            <tr>
                                <td><?php echo $recEmpData[$i]['unique_id']; ?>
                                </td>
                                <td><?php echo $recEmpData[$i]['date']; ?>
                                </td>
                                </td>
                                <td class="" style="text-align: left;">
                                    <?php
                                    $pdo->bind('expenseId', $recEmpData[$i]['id']);
                                    $getStatus = $pdo->query(
                                        'SELECT s.status_name from `status` s join employee_expense_status es on s.id=es.statusId where es.expenseId=:expenseId;'
                                    );
                                    $HOD = false;
                                    $AM = false;
                                    for ($j = 0; $j < count($getStatus); $j++) {
                                        if (
                                            $getStatus[$j]['status_name'] ==
                                            'HOD_approved'
                                        ) {
                                            $HOD = 'approved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'AM_approved'
                                        ) {
                                            $AM = 'approved';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'AM_disapproved'
                                        ) {
                                            $AM = 'disapprove';
                                        } elseif (
                                            $getStatus[$j]['status_name'] ==
                                            'HOD_disapproved'
                                        ) {
                                            $HOD = 'disapprove';
                                        }
                                    }
                                    ?>

                                    <div class="ant-tag " style="<?php if (
                                        $HOD == 'approved'
                                    ) {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($HOD == 'disapprove') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        HOD</div>
                                    <div class="ant-tag " style="<?php if (
                                        $AM == 'approved'
                                    ) {
                                        echo 'background-color: rgb(135, 208, 104)';
                                    } elseif ($AM == 'disapprove') {
                                        echo 'background-color: red;';
                                    } else {
                                        echo 'background-color: white';
                                    } ?>">
                                        AM</div>
                                </td>
                                <td> <?php echo $recEmpData[$i]['total_amount']; ?>
                                </td>
                                <td><button class="attachment-btn" data-id="<?php echo $recEmpData[$i]["id"] ?>"
                                        style="background: none;"><i class="fa fa-folder"></i></button></td>



                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






<script>


    $(document).ready(function () {
        // Attach a click event handler to the attachment buttons
        $(".attachment-btn").on("click", function () {
            // Get the expense ID from the data-id attribute of the button
            var expenseId = $(this).data("id");
            var __table_url = '<?php echo __AJAX_CALL_PATH__; ?>?_path=management/expense/get_attachment/get_attachment';
            $.ajax({
                url: __table_url,
                "data": {
                    "expenseId": expenseId
                },
                type: 'POST',
                dataType: "json",
                success: function (data) {
                    var images = [];
                    if (data.result === null) {
                        // Display an alert message if there are no attachments
                        alert("There are no attachments.");
                        return;
                    }
                    // Loop through the binary data and convert it to base64-encoded strings
                    for (var i = 0; i < data.result.length; i++) {
                        images.push("data:image/jpeg;base64," + (data.result[i]));
                        console.log(images[i]);
                    }
                    // Create a modal to display the images
                    var modal = $('<div id="myModal2" class="modal"></div>');

                    // Create a modal dialog
                    var dialog = $('<div class="modal-dialog" role="document"></div>');

                    // Create a modal content container
                    var content = $('<div class="modal-content"></div>');

                    // Create a modal header
                    var header = $('<div class="modal-header"></div>');

                    // Create a modal title
                    var title = $('<h5 class="modal-title" id="viewAttachmentsModalLabel">Attachments</h5>');

                    // Add the title to the header
                    header.append(title);

                    // Add the header to the content
                    content.append(header);
                    var body = $('<div class="modal-body"></div>');

                    // Create a container for the images
                    var imageContainer = $('<div class="modal-image-container"></div>');

                    // Loop through the images and create image tags
                    for (var i = 0; i < images.length; i++) {
                        var img = $('<img>').attr('class', 'img').attr('src', images[i]).attr('height', 350).attr('width', 250)
                        imageContainer.append(img);
                    }

                    // Add the image container to the body
                    body.append(imageContainer);

                    // Add the body to the content
                    content.append(body);

                    // Add the content to the dialog
                    dialog.append(content);

                    // Add the dialog to the modal
                    modal.append(dialog);

                    // Add the modal to the page and show it
                    $('body').append(modal);
                    modal.show();

                    // Attach a mouseup event handler to the modal
                    modal.on('mouseup', function (e) {
                        // If the clicked element is not inside the modal content, close the modal
                        if (!$(e.target).closest('.modal-content').length) {
                            modal.hide();
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        });
    });
</script>





<!-- 
            <script>

    function detailedExpenseInfo(expenseId, comment) {
      // Make an AJAX request to the PHP script to get the item data
      $.ajax({
        url: "getExpenseAttachment.php",
        type: "POST",
        data: {
          expenseId: expenseId,
          comment: comment
        },
        dataType: "text",
        success: function(data) {
          // Your code to view the item goes here, using the returned data
          console.log(data+'sfdasfsastassfsauhasihfdasidi');
          console.log("Success");
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.log("Error: " + error );
        }
      });
    }
  </script> -->

</html>