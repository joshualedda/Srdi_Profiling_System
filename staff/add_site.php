<?php
session_start();
include "../db_con.php";
$db = new db;
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
} 
if ($_SESSION['type_id'] == 1) {
  header("Location:  ../auth/login.php");
  exit(); 
}

if ($_SESSION['type_id'] == 3) {
header("Location:  ../auth/login.php");
exit(); 
}else {
  if (isset($_POST['submit'])) {
    // Get data from the form
    $user_id = $_POST['user_id'];
    $location = $_POST['location'];
    $producer_name = $_POST['producer_name'];
    $topography = $_POST['topography'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $address = $_POST['address'];
    $land = $_POST['land'];
    $tenancy = $_POST['tenancy'];
    $area = $_POST['area'];
    $crops = $_POST['crops'];
    $share = $_POST['share'];
    $irrigation = $_POST['irrigation'];
    $water = $_POST['water'];
    $source = $_POST['source'];
    $soil = $_POST['soil'];
    $market = $_POST['market'];
    $distance = $_POST['distance'];
    $land_area = $_POST['land_area'];
    $agency = $_POST['agency'];
    $charge = $_POST['charge'];
    $adopters = $_POST['adopters'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $date = $_POST['date'];

    // Add the site to the database without checking for existing sites with the same name
    $result = $db->addSite($user_id, $location, $producer_name, $topography, $region, $province, $municipality, $barangay, $address, $land, $tenancy, $area, $crops, $share, $irrigation, $water, $source, $soil, $market, $distance, $land_area, $agency, $charge, $adopters, $status, $remarks, $name, $position, $date);

    if ($result != 0) {
      $message = "Site Successfully Added!";
    } else {
      $message = "Failed to add site.";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php include '../includes/header.php' ?>
<?php include '../includes/sidebar.php' ?>
 

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Project Site</h1>
            </div>
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
      ?><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Project Site Information</h5>

             <!-- Custom Styled Validation with Tooltips -->
             <form class="row g-3 needs-validation" novalidate action = "#" enctype="multipart/form-data" method="POST">
             <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            
                <div class="col-md-12 position-relative">
                  <label class="form-label">Project Site Location<font color = "red">*</font></label>
                  <input type="text" class="form-control" id="validationTooltip01" name = "location" required autofocus="autofocus">
                  <div class="invalid-tooltip">
                    The Project Site Location field is required.
                  </div>
                </div>

                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

                <div class="col-md-12 position-relative">
    <label class="form-label">Producer Name  <?php echo $user_id ?>
      <font color="red">*</font></label>
    <select name="producer_name" class="form-select" id="validationCustom04" required>
        <option selected>Select Producer Name</option>
        <?php
        $resultType = $db->getProducersActive();
        while ($row = mysqli_fetch_array($resultType)) {
            $cocoon_id = $row['cocoon_id'];
            $name = $row['name'];
            $selected = ($cocoon_id == $cocoon) ? 'selected' : '';
            echo '<option value="' . $name . '" ' . $selected . '>' . $name . '</option>';
        }
        ?>
    </select>
</div>



                
                <div class="col-md-12 position-relative">
                  <label class="form-label">Topography<font color = "red">*</font></label>
                  <select class="form-select" aria-label="Default select example" name = "topography" id="validationTooltip03" required>
                      <option selected>Select Topography</option>
                <?php
                      $resultType=$db->getTopographyActive();
                      while($row=mysqli_fetch_array($resultType)){
                        echo '<option value="'.$row['topography_id'].'">' . $row['topography_name'] . '</option>';
                      }
                      ?>
                      </select>
                  <div class="invalid-tooltip">
                    The Beekeeper Name field is required.
                  </div>
                </div>

                  
                  <form class="row g-3 needs-validation" novalidate action = "#" enctype="multipart/form-data" method="POST">
                <div class="col-md-3 position-relative">
                  <label class="form-label">Region<font color = "red">*</font></label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name = "region" id="region" required >
                      <option value="" selected disabled>Select Region</option>
                      <?php
                      $regionResult=$db->getRegion();
                      while($row=mysqli_fetch_array($regionResult)){
                        echo ucwords('<option value="'.$row['regCode'].'">' . $row['regDesc'] . '</option>');
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 position-relative">
                  <label class="form-label">Province<font color = "red">*</font></label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name = "province" id="province" required >
                      <option value="" selected disabled>Select Province</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 position-relative">
                  <label class="form-label">City/Municipality<font color = "red">*</font></label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name = "municipality" id="city" required>
                      <option value="" selected disabled>Select City</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 position-relative">
                  <label class="form-label">Barangay<font color = "red">*</font></label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" name = "barangay" id="barangay" >
                      <option value="" selected disabled>Select Barangay</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-12 position-relative">
                  <label class="form-label">Address (Zip Code/Street no.)</label>
                  <input type="text" class="form-control" id="validationTooltip01" name = "address" required>
                  <div class="invalid-tooltip">
                    The Address field is required.
                  </div>
                </div>

  
                
                <div class="col-md-3 ">
                <div class="col-md-12">
                    <label for="validationCustom04" name = "land" class="form-label fw-bold">Land Types</label>
                </div>
                <?php
                $resultType = $db->getLandActive();
                while ($row = mysqli_fetch_array($resultType)) {
                    echo '<div class="form-check form-check-inline col-md-6 ">';
                    echo '<input class="form-check-input" type="checkbox" id="' . $row['land_id'] . '" value="' . $row['land_name'] . '">';
                    echo '<label class="form-check-label" for="' . $row['land_id'] . '">' . $row['land_name'] . '</label>';
                    echo '</div>';
                }
                ?>
            </div>
           


                            
            <div class="col-md-3 ">
                <div class="col-md-12">
                    <label for="validationCustom04" name ="tenancy" class="form-label fw-bold">Tenancy</label>
                </div>
                <?php
                $resultType = $db->getTenancyActive();
                while ($row = mysqli_fetch_array($resultType)) {
                    echo '<div class="form-check form-check-inline col-md-6 ">';
                    echo '<input class="form-check-input" type="checkbox" id="' . $row['tenancy_id'] . '" value="' . $row['tenancy_name'] . '">';
                    echo '<label class="form-check-label" for="' . $row['tenancy_id'] . '">' . $row['tenancy_name'] . '</label>';
                    echo '</div>';
                }
                ?>
            </div>

                <div class="col-md-2 mb-3">
                  <label for="validationCustom01" class="form-label fw-bold">Area (Ha)</label>
                  <input type="text" class="form-control" id="validationCustom01" >
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
              
                <div class="col-md-2 mb-3">
                  <label for="validationCustom02" class="form-label fw-bold">Crops Grown</label>
                  <input type="text" class="form-control" id="validationCustom02" >
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>

                <div class="col-md-2 mb-3">
                  <label for="validationCustom03" class="form-label fw-bold">%Share</label>
                  <input type="text" name ="share" class="form-control" id="validationCustom03" >
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                </div>
              
            <div class="col-md-4">
              <label for="validationCustom04" class="form-label">Availability of reliable irrigation:<font color="red">*</font></label>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="available" value="Available">
                <label class="form-check-label" for="available">Available</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="not_available" value="Not Available">
                <label class="form-check-label" for="not_available">Not Available</label>
              </div>
            </div>
            <!-- End of Availability of reliable irrigation -->

            <!-- Water source -->
            <div class="col-md-4">
              <label for="validationCustom04" name ="water" class="form-label">Water source:<font color="red">*</font></label>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="irrigated" value="Irrigated">
                <label class="form-check-label" for="irrigated">Irrigated</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rainfed" value="Rainfed">
                <label class="form-check-label" for="rainfed">Rainfed</label>
              </div>
            </div>

            <div class="col-md-4">
              <label for="validationCustom04" name="source" class="form-label">If irrigated, source of irrigation:<font color="red">*</font></label>
            </div>
            <div class="col-md-8">
              <div class="row">
                <?php
                $resultType = $db->getIrrigationActive();
                while ($row = mysqli_fetch_array($resultType)) {
                  echo '<div class="form-check col-md-3">';
                  echo '<input class="form-check-input" type="checkbox" id="' . $row['irrigation_id'] . '" value="' . $row['irrigation_name'] . '">';
                  echo '<label class="form-check-label" for="' . $row['irrigation_id'] . '">' . $row['irrigation_name'] . '</label>';
                  echo '</div>';
                }
                ?>
              </div>
            </div>
            <!-- End of Source of Irrigation -->

            <!-- Soil Type -->
            <div class="col-md-4">
              <label for="validationCustom04" name="soil" class="form-label">Soil Type:<font color="red">*</font></label>
            </div>
            <div class="col-md-8">
              <div class="row">
                <?php
                $resultType = $db->getSoilActive();
                while ($row = mysqli_fetch_array($resultType)) {
                  echo '<div class="form-check col-md-3">';
                  echo '<input class="form-check-input" type="checkbox" id="' . $row['soil_id'] . '" value="' . $row['soil_name'] . '">';
                  echo '<label class="form-check-label" for="' . $row['soil_id'] . '">' . $row['soil_name'] . '</label>';
                  echo '</div>';
                }
                ?>
              </div>
            </div>

            <div class="col-md-6">
              <label for="validationCustom04" name="market" class="form-label">Accessibility to farm to market road:<font color = "red">*</font></label>
            </div>

            <div class="col-md-3">
            <input class="form-check-input" type="checkbox" id="accessible" value="Accessible">
            <label class="form-check-label" for="accessible">Accessible</label>
            </div>

            <div class="col-md-3">
            <input class="form-check-input" type="checkbox" id="Not Accessible" value="Not Accessible">
            <label class="form-check-label" for="not accessible">Not Accessible</label>
            </div>


            <div class="col-md-12 mt-6" style="margin-left: -25px;">    
              <div class="form-check form-check-inline">
                <label for="nameInput" name="distance" class="mr-2">Distance from the main road<font color = "red">*</font></label>
                <div class="d-inline-flex">
                  <input type="text" class="form-control mr-2 w-75 mx-1 my-1" id="nameInput" >
                  <span class="form-text-inline mt-2" style="margin-left: 5px;">meters</span>
                </div>
              </div>
            </div>

            <div class="col-md-12 mt-6" style="margin-left: -25px;">    
              <div class="form-check form- check-inline">
                <label for="nameInput" name="land_area" class="mr-2">Available land area for planting mulberry<font color = "red">*</font></label>
                <div class="d-inline-flex align-items-center">
                  <input type="text" class="form-control mr-2 w-75 mx-1 my-1" id="nameInput" 
                  <span class="form-text-inline mt-2 my-3" style="vertical-align: middle;">ha</span>
                </div>
              </div>
            </div>



                <div class="col-md-12 position-relative">
                  <label class="form-label">Funding Agency<font color = "red">*</font></label>
                  <input type="text" name="agency" class="form-control" id="validationTooltip01" >
                  <div class="invalid-tooltip">
                    The Funding Agency field is required.
                  </div>
                </div>

                
                <div class="col-md-12 position-relative">
                  <label class="form-label">Project in-charge<font color = "red">*</font></label>
                  <input type="text" class="form-control" id="validationTooltip01" name = "charge" >
                  <div class="invalid-tooltip">
                    The Project In-Charge field is required.
                  </div>
                </div>

                <div class="col-md-6 position-relative">
                  <label class="form-label">Site Adopters<font color = "red">*</font></label>
                  <input type="text" class="form-control" id="validationTooltip01" name = "adopters" >
                  <div class="invalid-tooltip">
                    The Project In-Charge field is required.
                  </div>
                </div>

                <div class="col-md-6 position-relative">
                  <label class="form-label">Site Status<font color = "red">*</font></label>
                  <div class="col-sm-12">
                    <select class="form-select" aria-label="Default select example" id="validationTooltip03" name = "status" >
                      <option value="" selected disabled>Select Status</option>
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                    <div class="invalid-tooltip">
                      The Active field is required.
                    </div>
                  </div> 
            </div>

            <!-- remarks -->
            <div class="col-md-12">
              <label for="validationCustom04" name="remarks" class="form-label">Remarks<font color = "red">*</font></label>
              <textarea class="form-control" id="validationCustom05"></textarea>
              <div class="invalid-feedback">
                Error
              </div>
            </div>

            <div class="row mt-5">
            <div class="col-md-12">
              <label for="validationCustom04" class="form-label">Herewith the Monitoring and Evaluation Team, declares to have visited the proposed location for mulberry plantation field and found the site reasonably suited for mulberry leaf production and silkworm rearing/cocoon production.</label>
            </div>
            <div class="row mt-3">
              <div class="col-md-3 ">
                <label for="validationCustom04" name="name" class="form-label">Name<font color = "red">*</font></label>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Select Name</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>

              <div class="col-md-3 ">
                <label for="validationCustom04" name="position" class="form-label">Position<font color = "red">*</font></label>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Select Position</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>

              </div>


              <div class="col-md-3 ">
                <label for="validationCustom04" name="date" class="form-label">Date<font color = "red">*</font></label>
                <input type="text" class="form-control" id="validationCustom05" >

              </div>

            </div>
            <!-- ends -->



                <div class="col-12 d-flex align-items-end justify-content-end gap-2">
                    <button type="submit" class="btn btn-warning" name="submit">Save</button>
                  <button type="reset" class="btn btn-primary">Clear</button>
                  <a href="add_projectsite.php" class="btn btn-danger">Cancel</a>
                </div>  
</div>
</section>
  </main>
  
  <?php include '../includes/footer.php' ?>

<script>
$(document).ready(function(){
  $("#region").on('change',function(){
    var regionId = $(this).val();
    if(regionId){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'regionId='+regionId,
                success:function(html){
                    $('#province').html(html);
                    $('#city').html('<option value="">Select City</option>'); 
                }
            }); 
        }
  });

  $('#province').on('change', function(){ 
        var provinceId = $(this).val();
        if(provinceId){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'provinceId='+provinceId,
                success:function(html){
                    $('#city').html(html);
                    $('#barangay').html('<option value="">Select Barangay</option>');
                }
            }); 
        }else{
            $('#barangay').html('<option value="">Select Barangay</option>'); 
        }
    });

  $('#city').on('change', function(){
        var cityId = $(this).val();
        if(cityId){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'cityId='+cityId,
                success:function(html){
                    $('#barangay').html(html);
                }
            }); 
        }
    });
});
</script>
  </body>
  </html>