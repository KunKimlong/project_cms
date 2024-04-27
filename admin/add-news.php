<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="newsType">
                                            <option value="Social">Social</option>
                                            <option value="Sport">Sport</option>
                                            <option value="Entertainment">Entertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="National">National</option>
                                            <option value="International">International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">(Recommed size 350px x 200px)</label>
                                        <input type="file" class="form-control" name="thumbnail">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner <span class="text-danger">(Recommed size 730px x 415px)</span></label>
                                        <input type="file" class="form-control" name="banner">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" name="btn-add-news">Submit</button>
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