<?php
session_start();
include "../php/config.php";
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../php/login.php');
};

if(isset($_GET['delete3'])){
  $delete_id = $_GET['delete3'];
  $delete_query = mysqli_query($conn, "DELETE FROM `product_table` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
    header("Location: ../php/admin_dashboard.php?success3=user has been deleted");
  }else{
     $em = "user could not be deleted";
     header("Location: ../php/admin_dashboard.php?error3=$em&$data");
  };
};

if(isset($_GET['delete2'])){
  $delete_id = $_GET['delete2'];
  $delete_query = mysqli_query($conn, "DELETE FROM `users_table` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
    header("Location: ../php/admin_dashboard.php?success=user has been deleted");
  }else{
     $em = "user could not be deleted";
     header("Location: ../php/admin_dashboard.php?error=$em&$data");
  };
};

if(isset($_GET['delete5'])){
  $delete_id = $_GET['delete5'];
  $delete_query = mysqli_query($conn, "DELETE FROM `login_logs` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
    header("Location: ../php/admin_dashboard.php?success=user has been deleted");
  }else{
     $em = "user could not be deleted";
     header("Location: ../php/admin_dashboard.php?error=$em&$data");
  };
};

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_query = mysqli_query($conn, "DELETE FROM `supplier_table` WHERE id = $delete_id ") or die('query failed');
  if($delete_query){
    header("Location: ../php/admin_dashboard.php?success2=the data has been succesfully deleted");
  }else{
     $em = "could not delete the data";
     header("Location: ../php/admin_dashboard.php?error2=$em&$data");
  };
};

if(isset($_POST['update_supplier'])){
  $update_id = $_POST['update_id'];
  $update_name = $_POST['update_name'];
  $update_address = $_POST['update_address'];
  $update_phone = $_POST['update_phone'];
  $update_url = $_POST['update_url'];

  $update_query = mysqli_query($conn, "UPDATE `supplier_table` SET name = '$update_name', address = '$update_address', phone = '$update_phone', url = '$update_url' WHERE id = '$update_id'");

  if($update_query){
     header("Location: ../php/admin_dashboard.php?success2=supplier updated succesfully");
  }else{
     $em = "supplier could not be updated";
     header("Location: ../php/admin_dashboard.php?error2=$em&$data");
  };
};

if(isset($_POST['add_product'])){
  $p_name = $_POST['p_name'];
  $p_price = $_POST['p_price'];
  $p_stocks = $_POST['p_stocks'];

  $insert_query = mysqli_query($conn, "INSERT INTO `product_table`(name, price, quantity) VALUES('$p_name', '$p_price', '$p_stocks')") or die('query failed');

  if($insert_query){
    header("Location: ../php/admin_dashboard.php?success4=product added succesfully");
  }else{
     $em = "could not added the product";
     header("Location: ../php/admin_dashboard.php?error4=$em&$data");
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/css/style5.css" />
  </head>
  <body>
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
    <!-- navbar -->
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        </i>Admin Dashboard
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
          <!-- end -->
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- duplicate these li tag if you want to add or remove navlink only -->
          <!-- Start -->
          <li class="item">
            <a href="#section1" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user-check"></i>
              </span>
              <span class="navlink">User Details</span>
            </a>
          </li>
          <!-- End -->
          <li class="item">
            <a href="#section2" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-user-pin"></i>
              </span>
              <span class="navlink">Supplier Details</span>
            </a>
          </li>
          <li class="item">
            <a href="#section3" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-basket"></i>
              </span>
              <span class="navlink">Products</span>
            </a>
          </li>
          <li class="item">
            <a href="#section5" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-right-arrow-circle"></i>
              </span>
              <span class="navlink">User Session logs</span>
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

    <section id="section1" class="display-product-table">
    <div class="container">
    <div class="con">
    <table id="dataTable">
      <thead>
      <tr>
        <th>Profile Picture</th>
        <th>Full Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php
          
          $select_user = mysqli_query($conn, "SELECT * FROM `users_table`");
          if(mysqli_num_rows($select_user) > 0){
              while($row = mysqli_fetch_assoc($select_user)){
        ?>
        <tr>
            <td><img src="../upload/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
              <a href="../php/admin_dashboard.php?delete2=<?php echo $row['id']; ?>" class="delete2-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class='bx bxs-trash icon' >DELETE</i> </a>
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

    <section id="section2" class="display-product-table">
    <div class="container">
    <div class="con">
    <button class="add-btn" onclick="openModal()">+ Add New Record</button>
    <br><br>
    <?php if(isset($_GET['error2'])){ ?>
                <div class="alert2 alert-danger" role="alert2">
                <?php echo $_GET['error2']; ?>
              </div>
                <?php } ?>

                <?php if(isset($_GET['success2'])){ ?>
                <div class="alert2 alert-success" role="alert2">
                <?php echo $_GET['success2']; ?>
              </div>
                <?php } ?>
    <table id="dataTable">
      <thead>
      <tr>
        <th>Supplier Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>URL</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php
          
          $select_user = mysqli_query($conn, "SELECT * FROM `supplier_table`");
          if(mysqli_num_rows($select_user) > 0){
              while($row = mysqli_fetch_assoc($select_user)){
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['url']; ?></td>
            <td>
              <a href="../php/admin_dashboard.php?delete=<?php echo $row['id']; ?>" class="delete2-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class='bx bxs-trash icon' >DELETE</i> </a>
              <a href="../php/admin_dashboard.php?edit=<?php echo $row['id']; ?>" class="option-btn"><i class='bx bxs-edit-alt icon' >UPDATE</i> </a>
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

    <section id="section3" class="display-product-table">
      <div class="container">
      <div class="con">
    <a class="add-btn" href='#section9'>+ Add New Record</a>
    <br><br>
    <?php if(isset($_GET['error3'])){ ?>
                <div class="alert2 alert-danger" role="alert3">
                <?php echo $_GET['error3']; ?>
              </div>
                <?php } ?>

                <?php if(isset($_GET['success3'])){ ?>
                <div class="alert2 alert-success" role="alert3">
                <?php echo $_GET['success3']; ?>
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
              <a href="../php/admin_dashboard.php?delete3=<?php echo $row['id']; ?>" class="delete2-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class='bx bxs-trash icon' >DELETE</i> </a>
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

    <section id="section5" class="display-product-table">
      <div class="container">
      <div class="con">
    <table id="dataTable">
      <thead>
      <tr>
        <th>Session ID</th>
        <th>Email</th>
        <th>Ip Address</th>
        <th>Login Time</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php
          
          $select_user = mysqli_query($conn, "SELECT * FROM `login_logs`");
          if(mysqli_num_rows($select_user) > 0){
              while($row = mysqli_fetch_assoc($select_user)){
        ?>
        <tr>
            <td><?php echo $row['session_id']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['ip_address']; ?></td>
            <td><?php echo $row['login_time']; ?></td>
            <td>
              <a href="../php/admin_dashboard.php?delete5=<?php echo $row['id']; ?>" class="delete2-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class='bx bxs-trash icon' >DELETE</i> </a>
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
              <h2>Add New Supplier Record</h2>
              <form action="../php/supplier.php" method="post" enctype="multipart/form-data">

                  <label for="productid">Supplier Name:</label>
                  <input type="text" id="productid" name="supplierName" required><br>

                  <label for="productName">Address:</label>
                  <input type="text" id="productName" name="address" required><br>

                  <label for="productPrice">Phone Number:</label>
                  <input type="number" id="productPrice" name="phone_num" required><br>

                  <label for="productQuantity">URL:</label>
                  <input type="text" id="productQuantity" name="url" required><br>

                  <input type="submit" value="Submit">
                  <button type="button" onclick="closeModal()">Cancel</button>
              </form>
          </div>
      </div>
      </div>
    </section>

    <section id="section8" class="edit-form-container">
    <?php
      
      if(isset($_GET['edit'])){
          $edit_id = $_GET['edit'];
          $edit_query = mysqli_query($conn, "SELECT * FROM `supplier_table` WHERE id = $edit_id");
          if(mysqli_num_rows($edit_query) > 0){
            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
      ?>
      <form action="" method="post" enctype="multipart/form-data">

      <h1>Update Supplier Record</h1>
      
          <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>">
          <input type="text" class="box" required name="update_name" placeholder="supplier name" value="<?php echo $fetch_edit['name']; ?>">
          <input type="text" class="box" required name="update_address" placeholder="address" value="<?php echo $fetch_edit['address']; ?>">
          <input type="number" min="0" class="box" required name="update_phone" placeholder="mobile phone" value="<?php echo $fetch_edit['phone']; ?>">
          <input type="text"  class="box" required name="update_url" placeholder="url" value="<?php echo $fetch_edit['url']; ?>">
          <input type="submit" value="update" name="update_supplier" class="btn">
      </form>

      <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
          };
      ?>
    </section>

    <section id="section9">
      <div class="container">
      <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
      <?php if(isset($_GET['error4'])){ ?>
                <div class="alert2 alert-danger" role="alert4">
                <?php echo $_GET['error4']; ?>
              </div>
                <?php } ?>

                <?php if(isset($_GET['success4'])){ ?>
                <div class="alert2 alert-success" role="alert4">
                <?php echo $_GET['success4']; ?>
              </div>
                <?php } ?>
        <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
        <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
        <input type="text" name="p_stocks" placeholder="enter the product quantity" class="box" required>
        <input type="submit" value="add the product" name="add_product" class="btn">
      </form>
      </div>
    </section>

    <!-- JavaScript -->
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