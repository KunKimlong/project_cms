<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php

    
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
