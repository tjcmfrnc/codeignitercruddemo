<!DOCTYPE html>
<html lang="en">
<head>
<title>My Pets</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
</head>
<body>
<div class="container"><br/><br/>
    <div class="row">
        <div class="col-lg-10">
            <h2>List of My Pets</h2>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Add New Pet
            </button>
        </div>
    </div>
 
    <table class="table table-bordered table-striped" id="MyPetTable">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Address</th>
                <th width="280px">Action</th>
            </tr>
        </thead>  
        <tbody>
       <?php
        foreach($MyPet_detail as $row){
        ?>
        <tr id="<?php echo $row['id']; ?>">
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['species']; ?></td>
            <td><?php echo $row['breed']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
            <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit">Edit</a>
            <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add New Pet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMyPet" name="addMyPet" action="<?php echo site_url('MyPet/store');?>" method="post">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="txtName">Name:</label>
                        <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="txtName">
                    </div>
                    <div class="form-group">
                        <label for="txtSpecies">Species:</label>
                        <input type="text" class="form-control" id="txtSpecies" placeholder="Enter Species" name="txtSpecies">
                    </div>
                    <div class="form-group">
                        <label for="txtBreed">Breed:</label>
                        <input type="text" class="form-control" id="txtBreed" placeholder="Enter Breed" name="txtSBreed">
                    </div>
                    <div class="form-group">
                        <label for="txtAddress">Address:</label>
                        <textarea class="form-control" id="txtAddress" name="txtAddress" rows="10" placeholder="Enter Address"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            </div>
        </div>
    </div>
 
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Update My Pet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateMyPet" name="updateMyPet" action="<?php echo site_url('MyPet/update');?>" method="post">
            <div class="modal-body">
                <input type="hidden" name="hdnMyPetId" id="hdnMyPetId"/>
                <div class="form-group">
                    <label for="txtName">Name:</label>
                    <input type="text" class="form-control" id="txtName" placeholder="Name" name="txtName">
                </div>
                <div class="form-group">
                    <label for="txtSpecies">Species:</label>
                    <input type="text" class="form-control" id="txtSpecies" placeholder="Species" name="txtSpecies">
                </div>
                <div class="form-group">
                    <label for="txtBreed">Breed:</label>
                    <input type="text" class="form-control" id="txtBreed" placeholder="Breed" name="txtBreed">
                </div>
                <div class="form-group">
                    <label for="txtAddress">Address:</label>
                    <textarea class="form-control" id="txtAddress" name="txtAddress" rows="10" placeholder="Address"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
            </div>
        </div>
    </div>
 
</div>
 
<script>
$(document).ready(function () {
    $('#MyPetTable').DataTable();
 
    $("#addMyPet").validate({
        rules: {
            txtName: "required",
            txtSpecies: "required",
            txtBreed: "required",
            txtAddress: "required"
        },
        messages: {
        },
           
        submitHandler: function(form) {
            var form_action = $("#addMyPet").attr("action");
            $.ajax({
                data: $('#addMyPet').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var myPet = '<tr id="'+res.data.id+'">';
                    myPet += '<td>' + res.data.id + '</td>';
                    myPet += '<td>' + res.data.name + '</td>';
                    myPet += '<td>' + res.data.species + '</td>';
                    myPet += '<td>' + res.data.breed + '</td>';
                    myPet += '<td>' + res.data.address + '</td>';
                    myPet += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                    myPet += '</tr>';            
                    $('#MyPetTable tbody').prepend(myPet);
                    $('#addMyPet')[0].reset();
                    $('#addModal').modal('hide');
                },
                    error: function (data) {
                }
            });
        }
    });
 
    $('body').on('click', '.btnEdit', function () {
        var MyPet_id = $(this).attr('data-id');
        $.ajax({
            url: 'MyPet/edit/'+MyPet_id,
            type: "GET",
            dataType: 'json',
            success: function (res) {
                $('#updateModal').modal('show');
                $('#updateMyPet #hdnMyPetId').val(res.data.id); 
                $('#updateMyPet #txtName').val(res.data.name);
                $('#updateMyPet #txtSpecies').val(res.data.species);
                $('#updateMyPet #txtBreed').val(res.data.breed);
                $('#updateMyPet #txtAddress').val(res.data.address);
            },
                error: function (data) {
            }
        });
    });
     
    $("#updateMyPet").validate({
        rules: {
            txtName: "required",
            txtSpecies: "required",
            txtBreed: "required",
            txtAddress: "required"
        },
            messages: {
        },
        submitHandler: function(form) {
            var form_action = $("#updateMyPet").attr("action");
            $.ajax({
                data: $('#updateMyPet').serialize(),
                url: form_action,
                type: "POST",
                dataType: 'json',
                success: function (res) {
                    var MyPet = '<td>' + res.data.id + '</td>';
                    MyPet += '<td>' + res.data.name + '</td>';
                    MyPet += '<td>' + res.data.species + '</td>';
                    MyPet += '<td>' + res.data.breed + '</td>';
                    MyPet += '<td>' + res.data.address + '</td>';
                    MyPet += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Edit</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
                    $('#MyPetTable tbody #'+ res.data.id).html(MyPet);
                    $('#updateMyPet')[0].reset();
                    $('#updateModal').modal('hide');
                },
                    error: function (data) {
                }
            });
        }
    }); 
 
    $('body').on('click', '.btnDelete', function () {
        var MyPet_id = $(this).attr('data-id');
        $.get('MyPet/delete/'+MyPet_id, function (data) {
            $('#MyPetTable tbody #'+ MyPet_id).remove();
        })
    });  
});   
</script>
</body>
</html>
