<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 

    function connection(){
        $connection = new mysqli('localhost','root','','db_final_project_3_5');
        return $connection;
    }

    function getLogo($status){
        $sql = "SELECT * FROM `tbl_logo` WHERE `status`='$status' ORDER BY `id` DESC LIMIT 1";
        $rs  = connection()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        echo $row['thumbnail'];
    }
    function getNews($newType){
        $sql = "SELECT * FROM `tbl_news` WHERE `news_type` = '$newType' ORDER BY `id` DESC LIMIT 3";
        $rs = connection()->query($sql);
        while($row = mysqli_fetch_assoc($rs)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="">
                            <div class="thumbnail">
                                <img src="../admin/assets/image/'.$row['thumbnail'].'" width="350px" height="200" alt="">
                            <div class="title">
                                '.$row['title'].'
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }
    // getLogo();
    