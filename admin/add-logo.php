<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Website Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Header">Header</option>
                                            <option value="Footer">Footer</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>Thumbnail <span class="text-danger">Recommend size(216px X 50)</span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-add-logo" class="btn btn-primary">Submit</button>
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