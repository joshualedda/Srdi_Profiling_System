<?php
session_start();
include "../db_con.php";
$db = new db;
if(!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
} else {
  if (isset($_POST['submit'])) {
    $tenancy_id = $_POST['tenancy_id'];
    $tenancy_name = $_POST['tenancy_name'];
    $tenancy_status   = $_POST['tenancy_status'];
    $result = $db->updateTenancy($tenancy_id, $tenancy_name, $tenancy_status);
    $message = ($result != 0) ? "Tenancy Status Successfully Updated" : "Tenancy Status Already Exist!";
  }
}
?>

<!DOCTYPE html>
<?php include '../includes/header.php' ?>
<?php include '../includes/sidebar.php' ?>
<main id="main" class="main">

<?php
    if (isset($message)) {
        if ($result != 0) {
            echo '<div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">';
            echo '<i class="fa-sharp fa-solid fa-circle-check"></i>';
        } else {
            echo '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">';
            echo '<i class="fa-regular fa-circle-xmark"></i>';
        }
        echo $message;
        echo '</div>';
    }
    ?>

    <section class="section"> 
        <?php
             $result=$db->getTenancyID($_GET['tenancy_id']);
            while($row=mysqli_fetch_object($result)){
                $tenancyID     	= $row->tenancy_id;
                $tenancy_name   	= $row->tenancy_name;
                $tenancy_status 	= $row->tenancy_status;
            }
        ?>
         <div class="pagetitle">
            <h1>Edit Tenancy Status Information</h1>
        </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tenancy Status Information</h5>
                                <form class="row g-3 needs-validation" novalidate action="" enctype="multipart/form-data" method="POST">
                                    <div class="col-md-6 position-relative">
                                        <label class="form-label">Tenancy Status<font color="red">*</font></label>
                                        
                                         <input type="hidden" class="form-control" id="validationTooltip01" name="tenancy_id"
                                         value = "<?php echo $tenancyID;?>" required>
                                         <input type="text" class="form-control" id="validationTooltip01" name="tenancy_name"
                                        value = "<?php echo $tenancy_name;?>" required>
                                        <div class="invalid-tooltip">
                                            The Tenancy Status field is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label class="form-label">Status<font color="red">*</font></label>
                                        <div class="col-sm-12">
                                            <select class="form-select" aria-label="Default select example" id="validationTooltip03" name="tenancy_status" required>
                                            <?php
                                                if($tenancy_status == 'Active'){
                                                    echo '<option value="Active" selected>' . $tenancy_status . '</option>';
                                                    echo '<option value="Inactive">Inactive</option>';
                                                }else{
                                                    echo '<option value="Active">Active</option>';
                                                    echo '<option value="Inactive" selected>' . $tenancy_status . '</option>';
                                                }
                                            ?>
                                            </select>
                                            <div class="invalid-tooltip">
                                                The Status field is required.
                                            </div>
                                        </div>
                                    </div>

                    

                                    
                                    <div class="col-12 d-flex align-items-end justify-content-end gap-2">
                                        <button type="submit" class="btn btn-warning" name="submit">Update</button>
                                        <button type="reset" class="btn btn-primary">Clear</button>
                                        <a href="tenancy.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</main>

    
<?php include '../includes/footer.php' ?>
</body>

</html>