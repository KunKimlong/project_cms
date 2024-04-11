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