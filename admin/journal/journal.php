<?php
include ("/xampp/htdocs/CustomLandingPage/admin/journal/inc/header.php");
if (empty($_SESSION['id'])) {
  // include""
  header("Location: ../../login/login.php");
}
?>
<!-- #Journal-->
<section id="intro" class="clearfix">
  <div class="container">
  <h3 style="color:#fff;">&nbsp;<b> Journal Management </b></h3>
    <div class="card-group">
          <div class="col-md-3 col-sm-5">
            <div class="card">
              <div class="card-body">
                <i class="fa fa-book fa-2x " style="color:#007bff"></i><h2 class="float-right"><?php echo get_journal($connect)->num_rows;?></h2>
                 <h5 class="card-title">All Journal</h5>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-5">
            <div class="card">
              <div class="card-body"> 
               <i class="fa fa-upload fa-2x" style="color:#007bff"></i>
                <h5 class="card-title">Recent upload</h5>     
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-5">
            <div class="card">
              <div class="card-body">
               <i class="fa fa-user-plus fa-2x" style="color:#007bff"></i><h2 class="float-right"><?php echo get_users($connect)->num_rows;?></h2>
                <h5 class="card-title">All Creator</h5>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              
              </div>
            </div>
          </div>
      </div>
    </div>
</section>
          
<br>
 <!--<header class="section-header">
      <h3>Journal Management</h3>
    </header> -->
<?php
if (isset($_GET['del'])) {
  $result = delete_journalaction($connect,$_GET['del']);
  if ($result =="1") {
    message("Journal deleted successfully!","1");
  }
}
if(isset($_FILES['files'])){
  $errors= array();
  $file_name_array = explode('.',$_FILES['files']['name']);
  $file_size =$_FILES['files']['size'];
  $file_tmp =$_FILES['files']['tmp_name'];
  $file_type=$_FILES['files']['type'];
  $file_ext=strtolower(end($file_name_array));
  
  $extensions= array("pdf","txt","docx");
  
  if(in_array($file_ext,$extensions)=== false){
     $errors[]="extension not allowed, please choose a PDF or DOCX file.";
  }
  
  if($file_size > 2097152){
     $errors[]='File size must be excately 2 MB';
  }
  
  if(empty($errors)==true)
  {
     move_uploaded_file($file_tmp,"uploads/".$_FILES['files']['name']);
     $filelocation = "uploads/".$_FILES['files']['name']."";
  }
  else{
     print_r($errors);
  }
}

if ($_SERVER['REQUEST_METHOD'] =="POST") {
  if (isset($_POST['create'])) {
    $result = create_journalaction($connect,$_POST['author'],$_POST['title'],$_POST['description'],$_SESSION['id'],$_POST['datepub'],$_POST['created'],$filelocation,"0");
    if ($result == 1) {
      message("Journal created successfully!",1);
    } else {
      message("Could not create Journal!",0);
    }
  }
}
?>

<div class="container">
<!-- Create task button -->
<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create-project">
<i  class="fa fa-plus"></i>
</button>
<a href="journal.php"><button type="button" class="btn btn-outline-primary btn-sm">
<i class="fa fa-refresh" aria-hidden="true"></i>
</button>
</a>

<br/>
<br/>



<!-- Create New Journal -->

<div class="modal fade" id="create-project" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="create-project-label" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
   <div class="modal-content">
     <form method="post" name="AddJournal" action="journal.php" enctype="multipart/form-data">
       <div class="modal-header">
         <h5 class="modal-title" id="create-project-label">Create Journal</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <div class="form-group">
           <label for="author">Select Author</label>
                <select name="author" id="Select Author" class="form-control" required>
              <option  selected>Choose...</option>
              <?php $authors = get_authors($connect); while ($author = mysqli_fetch_array($authors)) { 
                if ($author['role'] !="Administrator") {
                  ?>
                  <option value="<?php echo $author['fullname'];?>"><?php echo $author['fullname'];?></option>
                <?php }} ?>
              </select>
           <div class="form-group">
             <label for="title">Title</label>
             <input type="text" class="form-control" id="title" name="title" oninvalid="alert('Hey, enter your title')" required="required">
           </div>
           <div class="form-group">
							<label for="description">Description</label>
							<textarea class="form-control" id="description" name="description" required="required"></textarea>
					</div>
         </div>
         <div class="form-group">
           <label for="datepub">Date Published</label>
           <input type="date" class="form-control" id="datepub" name="datepub"  required="required">
         </div>
         <div class="form-group">
          <label for="files">Add (pdf, txt or docs)</label>
          <input type="file" class="form-control-file" id="files" name="files" oninvalid="alert('Hey, upload your file')" required="required">
        </div>
       </div>
       <input type="hidden" name="created" value="<?php echo date("Y-m-d"); ?>"/>
       <input type="hidden" name="create" value="create"/>
       <div class="modal-footer">
         <button class="btn btn-primary">Save</button>
         <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       </div>
     </form>
   </div>
 </div>
</div>


<!--Journal-->
<div class="table-responsive-lg">
 <table id="journal" class="table table-hover">
   <thead>
     <tr>
       <th scope="col" class="d-none">Default Sort Fixer</th>
       <th scope="col">ID</th>
       <th scope="col">Author</th>
       <th scope="col">Title</th>
       <th scope="col">Creator</th>
       <th scope="col">Date Published</th>
       <th scope="col">Created</th>
       <th scope="col" align="center">Option</th>
     </tr>
   </thead>
   <tbody>
     <?php
     $result = get_journal($connect);
     if ($result->num_rows>0) {
     while ($data = mysqli_fetch_array($result)) {
      // include""
       ?>
       <tr>
         <td scope="row" class="d-none"><?php echo date("Y-m-d",strtotime($data['datepub']));?></td>
         <td><?php echo $data['id']?></td>
         <td><a href="action.php?id=<?php echo $data['id']?>&ref=journal"><?php echo $data['author']?></a></td>
         <td><?php echo $data['title']?></a></td>
         <td><?php
         $user = get_user_data($connect,$data['creator']);
         echo $user['name'];
         ?> 
       </td>
       <td><?php echo date("Y-m-d",strtotime($data['datepub']));?></td>
       <td><?php echo date("Y-m-d",strtotime($data['created']));?></td>
       <td align="center"><div class="dropdown">
         <button class="btn btn-light btn-sm" type="button" id="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu" aria-labelledby="option">
           <a class="dropdown-item" href="./api/action.php?id=<?php echo $data['id']?>">View</a>
           <a class="dropdown-item" href="./api/action.php?edit=<?php echo $data['id']?>">Edit</a>
           <?php if ($_SESSION['role']=="Administrator") {?><a class="dropdown-item" href="#<?php echo $data['id'];?>" data-toggle="modal" data-target="#delete-<?php echo $data['id'];?>">Delete</a><?php } ?>
         </div>
       </div>
     </td>
   </tr>

     <!-- Delete Popup -->
 <div style="margin-top: 200px;width: 30%;margin-left: 35%;margin-right: 35%;" class="modal fade" id="delete-<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="deleteLabel">Delete Journal</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         Are you sure you want to delete?
       </div>
       <div class="modal-footer">
         <a href="?del=<?php echo $data['id'];?>"><button type="button" class="btn btn-danger">Yes</button></a>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       </div>
     </div>
   </div>
 </div>
   <?php
 }
}
 ?>
</tbody>
</table>
</div>
</div>

<script src="assets/datatables.min.js"></script>
<script>
 $(function() {
   $('#journal').DataTable();
   $(function() {
     var table = $('#example').DataTable({
       "columnDefs": [{
         "visible": false,
         "targets": 2
       }],
       "ordering": false,
       "displayLength": 25,
       "drawCallback": function(settings) {
         var api = this.api();
         var rows = api.rows({
           page: 'current'
         }).nodes();
         var last = null;
         api.column(2, {
           page: 'current'
         }).data().each(function(group, i) {
           if (last !== group) {
             $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
             last = group;
           }
         });
       }
     });
           // Order by the grouping
           $('#example tbody').on('click', 'tr.group', function() {
             var currentOrder = table.order()[0];
             if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
               table.order([2, 'desc']).draw();
             } else {
               table.order([2, 'asc']).draw();
             }
           });
       });
 });
 $('#example23').DataTable({
   dom: 'Bfrtip',
   buttons: [
   'copy', 'csv', 'excel', 'pdf', 'print'
   ]
 });
 $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
</script>



    
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>AURESPOR</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <b>Phone:</b> +1 5589 55488 55<br>
              <b>Email:</b> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form>
          </div>

        </div>
      </div>
      
    </div>


