<?php
session_start();
include "../db_con.php";
$db = new db;
$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
}  
if ($_SESSION['type_id'] == 2) {
  header("Location:  ../auth/login.php");
  exit(); 
}

if ($_SESSION['type_id'] == 3) {
header("Location:  ../auth/login.php");
exit(); 
}else {
    if (isset($_POST['submit'])) {
      $user_id  = $_POST['user_id'];
      $region_id = $_POST['region_id'];
      $psgcCode = $_POST['psgcCode'];
      $regDesc   = $_POST['regDesc '];
      $regCode   = $_POST['regCode '];
      $result = $db->updateRegion($user_id, $region_id, $psgcCode, $regDesc, $regCode);
      $message = ($result != 0) ? "Region Successfully Updated" : "Region Already Exist!";
    }
  }
?>

?>
<!DOCTYPE html>
<html lang="en">

<body>
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
    <div class="pagetitle">
      <h1>Edit Region</h1>
    </div><!-- End Page Title -->

    <section class="section">
    <?php
             $result=$db->getRegionID($_GET['region_id']);
            while($row=mysqli_fetch_object($result)){
                $regionID     	= $row->region_id;
                $psgcCode  	= $row->psgcCode ;
                $regDesc 	= $row->regDesc;
                $regCode 	= $row->regCode;
            }
        ?>
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
           
          <div class="card">
            <div class="card-body">
              
              <h5 class="card-title">Region Information</h5>

              <form class="row g-3 needs-validation" novalidate action = "#" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
              
              <div class="col-md-6 position-relative">
              <label class="form-label">Region Description<font color="red">*</font></label>
                      <input type="hidden" class="form-control" id="validationTooltip01" name="region_id"
                            value="<?php echo $regionID; ?>" required>
                      <input type="text" class="form-control" id="validationTooltip02" name="regDesc"
                            value="<?php echo $regDesc; ?>" required> 
  
              </div>

                <div class="col-md-6 position-relative">
                  <label class="form-label">Region Code<font color = "red">*</font></label>
                  <input type="text" class="form-control" id="validationTooltip01" name="regCode"
                  value = "<?php echo $regCode;?>" required>
              </div>

                 
                <div class="col-12 d-flex align-items-end justify-content-end gap-2">
                    <button type="submit" class="btn btn-warning" name="submit">Update</button>
                    <button type="reset" class="btn btn-primary">Clear</button>
                    <a href="region.php" class="btn btn-danger">Cancel</a>
                        </div>
                        
      </form><!-- End Form -->
      </div>
      </div>
      </div>
      </section>
      </main>
      <!--END MAIN-->

      <?php include '../includes/footer.php' ?>
      </body>

      </html>