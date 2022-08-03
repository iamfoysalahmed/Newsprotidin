<?php include "header.php"; 
 if($_SESSION['user_role'] == 0){
    header("Location: {$hostname}/admin/post.php");
 }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php 
                    include 'config.php';
                    $limit = 5;
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $offset = ($page-1) * $limit;
                    $sql = "SELECT * FROM category ORDER BY category_id Limit $offset, $limit";
                    $result = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($result) > 0){
                       $table =  '<table class="content-table">';
                       $table .= '<thead>
                                    <th>S.No.</th>
                                    <th>Category Name</th>
                                    <th>No. of Posts</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>
                                <tbody>';
                            $serial = $offset+1;
                        while($row = mysqli_fetch_assoc($result)){
                            $table .= "<tr>
                                        <td class='id'>{$serial}</td>
                                        <td>{$row["category_name"]}</td>
                                        <td>{$row["post"]}</td>
                                        <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                                        <td class='delete'><a href='delete-category.php'><i class='fa fa-trash-o'></i></a></td>
                                    </tr>";
                                    $serial++;
                        }
                        $table .= '</tbody></table>';
                        echo $table;
                    }else{
                        echo "<h3>No Results Found.</h3>";
                    }
                    $sql1 = "SELECT * FROM category";
                    $result_1 = mysqli_query($connect, $sql1) or die("Query Failed.");

                    if(mysqli_num_rows($result_1) > 0){
                        $total_record = mysqli_num_rows($result_1);
                        $total_page = ceil($total_record/$limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                            echo "<li><a href='category.php?page=".($page-1)."'>Prev</a></li>";
                        }
                        if($total_record > $limit){
                            for($i=1; $i<=$total_page; $i++){
                                if($i== $page){
                                    $cls ="btn btn-primary active";
                                }else{
                                    $cls = "btn btn-primary";
                                }
                                echo"<li><a href='category.php?page=".$i."' class='{$cls}'>$i</a></li>";
                            }
                        }
                        if($total_page > $page){
                            echo"<li> <a href='category.php?page=".($page+1)."'>Next</a></li>";
                        }
                        
                    echo"</ul>";
                    }
                    
                ?>     
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
