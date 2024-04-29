<?php 
    include('sidebar.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tbl_news` WHERE `id` = '$id'";
    $rs  = connection()->query($sql);
    $row = mysqli_fetch_assoc($rs);

?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" value="<?php echo $row['title'] ?>" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="newsType">
                                            <option value="Social" <?php echo ($row['news_type'] == 'Social') ? 'selected':'' ?>>Social</option>
                                            <option value="Sport"  <?php echo ($row['news_type'] == 'Sport') ? 'selected':'' ?>>Sport</option>
                                            <option value="Entertainment"  <?php echo ($row['news_type'] == 'Entertainment') ? 'selected':'' ?>>Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="National"  <?php echo ($row['category'] == 'National') ? 'selected':'' ?>>National</option>
                                            <option value="International"  <?php echo ($row['category'] == 'International') ? 'selected':'' ?>>International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">(Recommed size 350px x 200px)</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                        <img src="assets/image/<?php echo $row['thumbnail'] ?>" alt="" width="200px" height="150px">
                                        <input type="text" name="old_thumbnail" value="<?php echo $row['thumbnail'] ?>" id="">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner <span class="text-danger">(Recommed size 730px x 415px)</span></label>
                                        <input type="file" class="form-control" name="banner">
                                        <img src="assets/image/<?php echo $row['banner'] ?>" alt="" width="200px" height="150px">
                                        <input type="text" name="old_banner" value="<?php echo $row['banner'] ?>" id="">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning" name="btn-update-news">Update</button>
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