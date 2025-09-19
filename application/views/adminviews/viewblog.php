<?php $this->load->view("adminviews/header"); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <h2>View Blog</h2>

<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Sr No</th>
              <th>Title</th>
              <th>Desc</th>
              <th>Image</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if ($result) {
$counter = 1;
foreach ($result as $key => $value) {
               echo "<tr>
              <td>".$counter."</td>
              <td>".$value['blog_title']."</td>
              <td>".$value['blog_desc']."</td>
              <td><img src='".base_url() .$value['blog_img']."' class='img-fluid' width='100'</td>

              
              <td><a class=\"btn btn-info\" href='".base_url() . 'AdminController/editblog/'.$value['blogid']."'>Edit</a></td>
              <td><a class=\"btn delete btn-danger\" href='#.' data-id='".$value['blogid']."'>Delete</a></td></td>

            </tr>";  
            $counter++;
            }

              
            }
            else
            {
                echo "<tr><td colspan='6'>No Records found</td></tr>";
            }
            
            ?>
            
           
            
          </tbody>
        </table>
      </div>

</main>
</div>
</div>
<?php $this->load->view('adminviews/footer') ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- This script is for when the user clicks the delete Button -->
<script type="text/javascript">
$(".delete").click(function()
{
  
  var delete_id = $(this).attr('data-id');
  var bool = confirm('Are you sure you want to delete this blog?');
  if (bool) {
   // alert("Move to delete function");

   //using ajax to delete data from database[]
   $.ajax({
url:'<?=base_url().'AdminController/deleteblog/'?>',
type:'post',
data:{'delete_id': delete_id},
success: function(response){
console.log(response);
if(response == "deleted")
{
  location.reload();
}
else if (response == "notdeleted")
{
alert("Something went wrong")
}

}
   });
  }else
  {
    alert("Your blog is safe");
  }
});

<?php

if(isset($_SESSION['updated']))
{
if($_SESSION['updated'] == "yes")
{
echo 'alert("Data has been updated");';
}else if($_SESSION['updated']=="no")
{
echo 'alert("Something went wrong and data not updated");';
}
}

?>

</script>