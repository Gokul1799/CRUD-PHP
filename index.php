<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
 
</head>
<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><i class=""></i>CRUD</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
        </ul>
    </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">CRUD Application using PHP-OOPs, PDO-MySQL and Ajax</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">All users in database</h4>

            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Add New User</button>
                <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg">&nbsp;&nbsp;</i>Export to Excel</a>
            </div>
        </div>
        <hr class="my-1">

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">
                   
                           
                              
                               
                    

                </div>
            </div>
        </div>
    </div>    
 <!-- Add New User -->
 <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
          <form action="" method="post" id="form-data">
            <div class="form-group">
                <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            </div>

            <div class="form-group">
                <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
            </div>

            <div class="form-group">
                <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
            </div>

            <div class="form-group">
                <input type="submit" name="insert" id="insert" value="Add User" class="btn btn-danger btn-block">
            </div>

          </form>
        </div>
        
        
      </div>
    </div>
  </div>

<!-- Edit User -->
  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body mx-4">
          <form action="" method="post" id="edit-form-data">
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <input type="text" name="fname" class="form-control" id="fname" required>
            </div>

            <div class="form-group">
                <input type="text" name="lname" class="form-control" id="lname" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control" id="email" required>
            </div>

            <div class="form-group">
                <input type="tel" name="phone" class="form-control" id="phone" required>
            </div>

            <div class="form-group">
                <input type="submit" name="update" id="update" value="Update" class="btn btn-primary btn-block">
            </div>

          </form>
        </div>
        
        
      </div>
    </div>
  </div>


<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> -->

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script type="text/javascript">
    $(document).ready(function(){
       

        showAllUsers();

        function showAllUsers(){
            $.ajax({
                url: "action.php",
                type:"POST",
                data: {action:"view"},
                success:function(response){
                    
                    $("#showUser").html(response);
                    $("table").DataTable({
                        order:[0,'desc']
                    });
                }
            });
        }
    $('#insert').click(function(e){
        if($("#form-data")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: "action.php",
                type: "POST",
                data: $("#form-data").serialize()+"&action=insert",
                success:function(response){
                    console.log(response);
                    Swal.fire({
                        title: 'User Added Successfully!',
                        type: 'success',
                    })
                    $('#addModal').modal('hide');
                    $('#form-data')[0].reset();
                    showAllUsers();
                }
            });
        }

    });

    

    $("body").on("click", ".editBtn", function(e){
        e.preventDefault();
        edit_id = $(this).attr('id');
        $.ajax({
            url:"action.php",
            type: "POST",
            data: {edit_id:edit_id},
            success:function(response){
                // console.log(response);
                data = JSON.parse(response);
                console.log(data[0].id);

                // alert(data.success[0].id);
                // console.log(data);
                $('#id').val(data[0].id);
                $('#fname').val(data[0].first_name);
                $('#lname').val(data[0].last_name);
                $('#email').val(data[0].email);
                $('#phone').val(data[0].phone);
            }
        });

    });

    $('#update').click(function(e){
        if($("#edit-form-data")[0].checkValidity()){
            // alert('working');
            
            e.preventDefault();
            $.ajax({
                url:"action.php",
                type:"POST",
                data: $("#edit-form-data").serialize()+"&action=update",
                
        
                success:function(response){
                    console.log(data);
                    
                    Swal.fire({
                        title: 'User Updated Successfully!',
                        type: 'success',
                    })
                    $('#editModal').modal('hide');
                    $('#edit-form-data')[0].reset();
                    showAllUsers();
                }

            });
        }
    

    });

    $("body").on("click", ".infoBtn", function(e){
        e.preventDefault();
        info_id = $(this).attr('id');
        
        $.ajax({
            url: "action.php",
            type: "POST",
            data: {info_id:info_id},
            success:function(response){
                data=JSON.parse(response);
                Swal.fire({
                title: 'Detail Of The Selected User : ID('+data[0].id+')',
                icon: 'info',
                html:
                    '<strong>First Name &nbsp:</strong> &nbsp'+data[0].first_name+'</b><br>'+ 
                    '<strong>Last Name &nbsp:</strong> '+data[0].last_name+'</b><br>'+
                    '<strong>Email &nbsp:</strong>'+data[0].email+'</b><br>'+
                    '<strong>Phone &nbsp:</strong>'+data[0].phone+'</b><br>'
                })
                // alert(data[0].id);
                console.log(data[0].id);
            }
        });
        
    });

    $("body").on("click", ".delBtn", function(e){
        e.preventDefault();
        var tr = $(this).closest('tr');
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {del_id:del_id},
                    success:function(response){
                        Swal.fire({
                        title: 'User Deleted Successfully!',
                        type: 'success',
                    })
                    showAllUsers();
                        
                    }

                });
            }

         });

    });

    });


   



</script>
</body>
</html>