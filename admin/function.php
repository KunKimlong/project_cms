<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

    session_start();
    function connection(){
        $connection = new mysqli('localhost','root','','db_final_project_3_5');
        return $connection;
    }
    function register(){
        if(isset($_POST['btn_register'])){
            // echo 123;
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            $profile  = $_FILES['profile']['name'];
            if(!empty($username) && !empty($email) && !empty($password) && !empty($profile)){
                $profile = date('dmy-his').'_'.$profile;
                $path    = 'assets/AdminThumbnail/'.$profile;
                move_uploaded_file($_FILES['profile']['tmp_name'],$path);
                $password = md5($password);
                $sql = "INSERT INTO `tbl_user`(`username`, `email`, `password`, `thumbail`) VALUES ('$username','$email','$password','$profile')";
                $rs  = connection()->query($sql);
                if($rs){
                    header('location:login.php');
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Created",
                                text: "Account registered",
                                icon: "success",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
                } 
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Something went wrong",
                                icon: "error",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
            }
        }
    }
    register();

    function login(){
        if(isset($_POST['btn_login'])){
            $name_email = $_POST['name_email'];
            $password   = $_POST['password'];
            
            if(!empty($name_email) && !empty($password)){
                $password = md5($password);
                $sql = "SELECT * FROM `tbl_user` WHERE (`username` = '$name_email' OR `email` = '$name_email') AND `password` = '$password'";
                $rs  = connection()->query($sql);
                $row = mysqli_fetch_assoc($rs);
                
                if($row){
                    $_SESSION['user'] = $row['id'];
                    header('location:index.php');
                }
                else{
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Username email or password are incorrect",
                                icon: "error",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Please input all fill",
                                icon: "error",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
            }
        }
    }
    login();

    function logout(){
        if(isset($_POST['btn_logout'])){
            unset($_SESSION['user']);
        }
    }
    logout();

    function addLogo(){
        if(isset($_POST['btn-add-logo'])){
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail']['name'];

            if(!empty($status) && !empty($thumbnail)){
                $thumbnail = rand(1,99999).'_'.$thumbnail;
                $path  = 'assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

                $sql = "INSERT INTO `tbl_logo`(`thumbnail`, `status`) VALUES ('$thumbnail','$status')";
                $rs  = connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "logo add successfully",
                                icon: "success",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
                }
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Something fill status and thumbnail",
                                icon: "error",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
            }

        }
    }
    addLogo();  

    function getLogo(){
        $sql = "SELECT * FROM `tbl_logo` ORDER BY `id` DESC";

        $rs  = connection()->query($sql);

        while($row = mysqli_fetch_assoc($rs)){
            echo '
            <tr>
                <td>'.$row['status'].'</td>
                <td><img src="assets/image/'.$row['thumbnail'].'" width="100"></td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href="update-logo.php?id='.$row['id'].'" class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
            ';
        }

    }
    
    function updateLogo(){
        if(isset($_POST['btn-update-logo'])){
            $param_id = $_GET['id'];
            $status = $_POST['status'];
            $thumbnail = $_FILES['thumbnail']['name'];
            if(empty($thumbnail)){
                $thumbnail = $_POST['old_thumbnail'];
            }else{
                $thumbnail = rand(1,99999).'_'.$thumbnail;
                $path  = 'assets/image/'.$thumbnail;
                move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);
            }

            if(!empty($status) && !empty($thumbnail)){
                $sql = "UPDATE `tbl_logo` SET `thumbnail` = '$thumbnail',`status`='$status' WHERE `id` = '$param_id'";
                $rs  = connection()->query($sql);
                if($rs){
                    echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "logo Update successfully",
                                icon: "success",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
                }
            }
            else{
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error",
                            text: "logo update not successfully",
                            icon: "error",
                            button: "Done",
                        });
                    })
                </script>
                ';
            }


         
        }
    }
    updateLogo();

    function deleteLogo(){
        if(isset($_POST['btn-delete-logo'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_logo` WHERE `id` = '$remove_id'";

            $rs  = connection()->query($sql);
            if($rs){
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Done",
                                text: "logo Delete successfully",
                                icon: "success",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
            }

        }
    }
    deleteLogo();

    function addNews(){
        if(isset($_POST['btn-add-news'])){
            $title = $_POST['title'];
            $newsType = $_POST['newsType'];
            $category = $_POST['category'];
            $thumbnail = $_FILES['thumbnail']['name'];
            $banner = $_FILES['banner']['name'];
            $description = $_POST['description'];

            if(!empty($thumbnail) && !empty($title) && !empty($newsType) 
                && !empty($category) && !empty($banner) && !empty($description)){

                    $thumbnail = rand(1,99999).'-'.$thumbnail;
                    $path      = 'assets/image/'.$thumbnail;
                    move_uploaded_file($_FILES['thumbnail']['tmp_name'],$path);

                    $banner = rand(1,99999).'-'.$banner;
                    $path      = 'assets/image/'.$banner;
                    move_uploaded_file($_FILES['banner']['tmp_name'],$path);

                    $userID = $_SESSION['user'];

                    $sql = "INSERT INTO `tbl_news`(`title`, `description`,`banner`, `thumbnail`, `news_type`, `category`, `viewer`, `user_id`) 
                            VALUES ('$title','$description','$banner','$thumbnail','$newsType','$category','0','$userID')";

                    $rs  = connection()->query($sql);
                    if($rs){
                        echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Done",
                                    text: "News Insert successfully",
                                    icon: "success",
                                    button: "Done",
                                });
                            })
                        </script>
                        ';
                    }

            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Please input all fill",
                                icon: "error",
                                button: "Done",
                            });
                        })
                    </script>
                    ';
            }

        }
    }
    addNews();

    function ViewNews(){
        $sql = "SELECT * FROM `tbl_news` ORDER BY `id` DESC";
        $rs  = connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
            <tr>
                <td>'.$row['title'].'</td>
                <td>'.$row['news_type'].'</td>
                <td>'.$row['category'].'</td>
                <td><img src="assets/image/'.$row['thumbnail'].'" width="150px" height="100px"/></td>
                <td><img src="assets/image/'.$row['banner'].'" width="150px" height="100px"/></td>
                <td>'.$row['user_id'].'</td>
                <td>'.$row['created_at'].'</td>
                <td width="150px">
                    <a href=""class="btn btn-primary">Update</a>
                    <button type="button" remove-id="'.$row['id'].'" class="btn btn-danger btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Remove
                    </button>
                </td>
            </tr>
            ';   
        }
    }


    function deleteNews(){
        if(isset($_POST['btn-delete-news'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM `tbl_news` WHERE `id` = '$remove_id'";
            $rs  = connection()->query($sql);
            if($rs){
                // 
            }
        }
    }
    deleteNews();