<?php
session_start();
include "../php/config.php";
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../php/login.php');
};

if(isset($_POST['update_product'])){
  $update_id = $_POST['update_id'];
  $update_price = $_POST['update_price'];
  $update_quantity = $_POST['update_quantity'];

  $update_query = mysqli_query($conn, "UPDATE `product_table` SET name = '$update_name', price = '$update_price', quantity = '$update_quantity' WHERE id = '$update_id'");

  if($update_query){
     header("Location: ../php/employee_dashboard.php?success=supplier updated succesfully");
  }else{
     $em = "supplier could not be updated";
     header("Location: ../php/employee_dashboard.php?error=$em&$data");
  };
};

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Guest Dashboard</title>
    <link rel="stylesheet" href="/css/style_2.css" />
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        </i>Guest Dashboard
      </div>
      <div class="search_bar">
        <input type="text" placeholder="Search" />
      </div>
      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
      </div>
    </nav>
    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
          <!-- start -->
          <li class="item">
            <a href="#section0" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
            </a>
          </li>
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- duplicate these li tag if you want to add or remove navlink only -->
          <!-- Start -->
          <li class="item">
            <a href="#section1" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user-circle"></i>
              </span>
              <span class="navlink">My Profile</span>
            </a>
          </li>
          <!-- End -->
          <li class="item">
            <a href="#section3" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-basket"></i>
              </span>
              <span class="navlink">Product</span>
            </a>
          </li>
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>
          <li class="item">
            <a href="../php/logout.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-log-out"></i>
              </span>
              <span class="navlink">Logout</span>
            </a>
          </li>
        </ul>
        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-right-arrow' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-left-arrow'></i>
          </div>
        </div>
      </div>
    </nav>

    <!-- Section -->

    <section id="section0"><div class="container"></div></section>

    <section id="section1">
      <div class="container">
        <div class="profile">
        <?php

            $select = mysqli_query($conn, "SELECT * FROM `users_table` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select) > 0){
                $fetch = mysqli_fetch_assoc($select);

                if($fetch['image'] == ''){
                  echo '<img src="../images/default-avatar.png" alt="Default Avatar">';
              }else{
                  echo '<img src="../upload/'.$fetch['image'].'">';
              }

              echo '<h3>'.$fetch['name'].'</h3>';
            }
            
          ?>
          <button onclick="window.location.href='#section2'"  class="btn">Update Profile</button>
        </div>
      </div>
    </section>

    <section id="section2">
      <div class="update-profile">
      <?php
          $select = mysqli_query($conn, "SELECT * FROM `users_table` WHERE id = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
          }
      ?>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
        <?php
          if($fetch['image'] == ''){
              echo '<img src="../images/default-avatar.png">';
          }else{
              echo '<img src="../upload/'.$fetch['image'].'">';
          }
          if(isset($message)){
              foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
              }
          }
        ?>
        <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
          </div>
            <?php } ?>

            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
          </div>
            <?php } ?>
          <div class="flex">
              <div class="inputBox">
                <span>Full Name :</span>
                <input type="text" name="update_name" placeholder="enter previous fullname" value="<?php echo $fetch['name']; ?>" class="box">
                <span>Address :</span>
                <input type="text" name="update_address" placeholder="enter previous address" value="<?php echo $fetch['address']; ?>"  class="box">
                <span>Phone Number :</span>
                <input type="number" name="update_phone_num" placeholder="enter previous phone number" value="<?php echo $fetch['phone_number']; ?>"  class="box">
                <span>Update Profile Pic :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
              </div>
              <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="update_email" placeholder="enter previous email" value="<?php echo $fetch['email']; ?>"  class="box">
                <span>Old Password :</span>
                <input type="password" name="old_pass" placeholder="enter old password" class="box">
                <span>New Password :</span>
                <input type="password" name="new_pass" placeholder="enter new password" class="box">
                <span>Confirm Password :</span>
                <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
              </div>
          </div>
            <input type="submit" value="update profile" name="update_profile" class="btn">
        </form>

      </div>
    </section>

    <section id="section3" class="display-product-table">
    <div class="container">
    <div class="con">
    <button class="add-btn" onclick="openModal()">+ Add New Product</button>
    <br><br>
    <?php if(isset($_GET['error'])){ ?>
                <div class="alert2 alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
              </div>
                <?php } ?>

                <?php if(isset($_GET['success'])){ ?>
                <div class="alert2 alert-success" role="alert">
                <?php echo $_GET['success']; ?>
              </div>
                <?php } ?>
    <table id="dataTable">
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Price</th>
        <th>Quantithty</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php
          
          $select_user = mysqli_query($conn, "SELECT * FROM `product_table`");
          if(mysqli_num_rows($select_user) > 0){
              while($row = mysqli_fetch_assoc($select_user)){
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
              <a href="../php/employee_dashboard.php?edit=<?php echo $row['id']; ?>" class="option-btn"><i class='bx bxs-edit-alt icon' >UPDATE</i> </a>
            </td>
        </tr>
        <?php
            };    
            }
         ?>
      </tbody>
      </table>
      </div>
      </div>
    </section>

    <section id="section7">
      <div class="container">
      <div id="modal" class="modal">
          <div class="modal-content">
              <h2>Add New Product</h2>
              <form action="../php/product.php" method="post" enctype="multipart/form-data">

                  <label for="productid">Product Name:</label>
                  <input type="text" id="productid" name="productName" required><br>

                  <label for="productName">Price</label>
                  <input type="number" id="productName" name="price" required><br>

                  <label for="productPrice">Quantity</label>
                  <input type="number" id="productPrice" name="quantity" required><br>

                  <input type="submit" value="Submit">
                  <button type="button" onclick="closeModal()">Cancel</button>
              </form>
          </div>
      </div>
      </div>
    </section>

    <section id="section4" class="edit-form-container">
    <?php
      
      if(isset($_GET['edit'])){
          $edit_id = $_GET['edit'];
          $edit_query = mysqli_query($conn, "SELECT * FROM `product_table` WHERE id = $edit_id");
          if(mysqli_num_rows($edit_query) > 0){
            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
      ?>
      <form action="" method="post" enctype="multipart/form-data">

      <h1>Update Product</h1>
      
          <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
          <input type="text" class="box" required name="update_name" placeholder="product name" value="<?php echo $fetch_edit['name']; ?>">
          <input type="number" class="box" required name="update_price" placeholder="price" value="<?php echo $fetch_edit['price']; ?>">
          <input type="number" min="0" class="box" required name="update_quantity" placeholder="quantity" value="<?php echo $fetch_edit['quantity']; ?>">
          <input type="submit" value="update" name="update_product" class="btn">
      </form>

      <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
          };
      ?>
    </section>
    <!-- JavaScript -->
    <script src="/js/script2.js"></script>
    <script src="/js/script2.js"></script>
    <script>
        var modal = document.getElementById("modal");

        // Function to open the modal form
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal form
        function closeModal() {
            modal.style.display = "none";
        }
    </script>
  </body>
</html>
