<?php 
include "includes/config.php";
include "includes/login_check.php";

if(isset($_GET['status'])){
	$sql = "UPDATE `users` SET `status` = '$_GET[status]' WHERE `user_id` = '$_GET[user_id]' ";
	$db->query($sql);

	$msg = "Status has been ".ucfirst($_GET['status']);
}

if(isset($_GET['del_id'])){
	$sql = "DELETE FROM `users`  WHERE `user_id` = '$_GET[del_id]' ";
	//$db->query($sql);

	$msg = "1 User has been Deleted";
}
include "includes/header.php";

?>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>All Users</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">
        	<?php
		        if(isset($msg)){
					print '<div class="alert alert-success alert-dismissible" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
				}
			?>

        	
        </h5>

        <div class="table-responsive text-nowrap">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php 
                    $c = 0;
                    $sql = "SELECT * FROM `users`";
                    $res = $db->query($sql);
                    while($row = $res->fetch_object()){
                        $row->qualification = substr($row->qualification, 0, 10);
                        $row->fullname = substr($row->fullname, 0, 25);
                        $c++;
                       

                        $status = ($row->status === "deactive") ? "active" : "deactive";
                        $rowClass = ($row->status === "deactive") ? "table-danger" : "";

                        echo '
                        <tr class="'.$rowClass.'">
                            <td>'.$c.'</td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>'.$row->fullname.'</strong>
                            <br>
                            '.$row->qualification.' - '.$row->age.' yr - '.$row->gender.'</td>
                            <td><input type="text" value="'.$row->email.'" style = "border:0px;"></td>
                            <td>'.$row->phone.'</td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li
                                    data-bs-toggle="tooltip"
                                    data-popup="tooltip-custom"
                                    data-bs-placement="top"
                                    class="avatar avatar-xs pull-up"
                                    title="Lilian Fuller"
                                    >
                                    <img src="../'.$row->photo.'" alt="Avatar" class="rounded-circle" />
                                    </li>  
                                </ul>
                            </td>
                            <td><span class="badge bg-label-primary me-1">'.$row->status.'</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="users.php?status='.$status.'&user_id='.$row->user_id.'" ><i class="bx bx-edit-alt me-1"></i> '.ucfirst($status).'</a>
                                        <a class="dropdown-item" href="users.php?del_id='.$row->user_id.'"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Include jQuery -->
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
    </script>
</div>

<?php 
include "includes/footer.php";
?>
