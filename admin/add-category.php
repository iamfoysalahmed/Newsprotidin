<?php include "header.php"; 
 if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
 }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
  <?php 
    if(isset($_POST['save'])){
        include 'config.php';
        $category = mysqli_escape_string($connect, $_POST['cat']);
        $sql = "SELECT category_name FROM category where category_name = '{$category}'";
        $result = mysqli_query($connect, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "<P style ='color:red; text-align:center; margin:10px 0;'>Category already exists.</P>";
        }else{
            $sql = "INSERT into category(category_name) VALUES ('{$category}')";

            if(mysqli_query($connect, $sql)){
                header("Location: {$hostname}/admin/category.php");
            }else{
                echo "<P style ='color:red; text-align:center; margin:10px 0;'>Query failed.</P>";
            }
        }
    }
    mysqli_close($connect);

  ?>



<?php include "footer.php"; ?>
