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
                        <a href="news-detail.php?id='.$row['id'].'">
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

    function newDetail(){
        $id = $_GET['id'];
        $rs = connection()->query("SELECT * FROM `tbl_news` WHERE `id` = '$id'");
        $row = mysqli_fetch_assoc($rs);
        echo '
        <div class="main-news">
            <div class="thumbnail">
                <img src="../admin/assets/image/'.$row['banner'].'" width="730px" height="415px">
            </div>
            <div class="detail">
                <h3 class="title">'.$row['title'].'</h3>
                <div class="date">'.$row['created_at'].'</div>
                <div class="description">
                    '.$row['description'].'
                </div>
            </div>
        </div>
        ';
        $newViewer =  $row['viewer']+1;

        $sqlUpdate = "UPDATE `tbl_news` SET `viewer` = '$newViewer' WHERE `id` = '$id'";
        $rsUpdate  = connection()->query($sqlUpdate);

    }
    

    function tredingNews(){
        $sql = "SELECT * FROM `tbl_news` ORDER BY `viewer` DESC LIMIT 1";
        $rs  = connection()->query($sql);
        $row = mysqli_fetch_assoc($rs);
        echo '
            <figure>
                <a href="news-detail.php?id='.$row['id'].'">
                    <div class="thumbnail">
                    <img src="../admin/assets/image/'.$row['banner'].'" width="730px" height="415px">
                        <div class="title">
                        '.$row['title'].'
                        </div>
                    </div>
                </a>
            </figure>
        ';
    }