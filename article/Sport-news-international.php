<?php include('header.php'); ?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            SPORT NEWS
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <?php getNewsByNewType('Sport','international') ?>
            </div>
            <div class="row pagination">
                <div class="col-12">
                    <ul>
                        <?php pagination('Sport','international'); ?>
                    </ul>   
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>