<?php $this->load->view("adminviews/header"); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <h2>Add Blog</h2>

    <form enctype="multipart/form-data" method="post" action="<?= base_url().'AdminController/addblog_post' ?>">

        <div class="form-group">
            <input type="text" class="form-control" name="blog_title" id="" placeholder="Title">
        </div>
        <div class="form-group">
            <textarea name="desc" class="form-control" placeholder="Blog Desc" id=""></textarea>
        </div>

        <div class="form-group">
            <input class="form-control" type="file" name="file" id="" placeholder="Title">
        </div>

        <button type="submit" class="btn btn-primary">Add Blog</button>

    </form>


</main>
</div>
</div>
<script type="text/javascript">
<?php
if (isset($_SESSION['inserted'])) {
     if ($_SESSION['inserted'] == "yes") {
         echo "alert('Data Inserted Scussfully');";
     }else
     {
         echo "alert('Data Not Inserted');";
     }
   
}
?>

</script>
<!-- CKEDITOR CODE -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
						CKEDITOR.replace( 'desc' );
				</script>

<!--CKEDITOR CODE ENDS HERE

<?php $this->load->view('adminviews/footer') ?>


