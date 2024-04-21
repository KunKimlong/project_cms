<?php 
    include('sidebar.php');
    $param_id = $_GET['id'];
    $rs = connection()->query("SELECT * FROM `tbl_logo` WHERE `id` = '$param_id'");
    $row = mysqli_fetch_assoc($rs);

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Header" <?php echo ($row['status'] == "Header") ? 'Selected':'' ?>>Header</option>
                                            <option value="Footer" <?php echo ($row['status'] == "Footer") ? 'Selected':'' ?>>Footer</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">Recommend size(216px X 50)</span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                        <img class="mt-3" src="assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="150px">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-logo" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>