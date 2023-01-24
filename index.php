<!DOCTYPE html>

<html>
    <head>


        <link href="components/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Students Projects</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor03">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
        <br>


        <div class="container-fluid bg-2 text-center">
            <div class="row mt-4 m-md-2">
                <div class="d-flex justify-content-between">
                    <div class="col-sm-5">
                        <h3 align="left">Add Project</h3>
                        <hr>
                        <form id="formProject" name="formProject" >

                            <div class="form-group" align="left">
                                <label class="form-label">Student Name</label>
                                <input type="text" class="form-control" placeholder="Student Name" id="studentname" name="studentname" size="30px" required>
                            </div>
                            <div class="form-group" align="left">
                                <label class="form-label">Course</label>
                                <input type="text" class="form-control" placeholder="Course" id="course" name="course" size="30px" required>
                            </div>
                            <div class="form-group" align="left">
                                <label class="form-label">Fees</label>
                                <input type="text" class="form-control" placeholder="Fees" id="fees" name="fees" size="30px" required>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select status</option>
                                        <option value="1"> Active</option>
                                        <option value="2">DeActive</option>

                                    </select>

                                </div>
                            </div>

                            <div align="left">
                                <button type="button" id="save" class="mt-2 btn btn-primary" onclick="AddStudent()">Add</button>
                                <button type="button" id="clear" class="mt-2 btn btn-warning" onclick="Clear()">Clear</button>

                            </div>

                        </form>

                    </div>

                    <div class="col-sm-6">
                        <div class="panel-body">

                            <table id="tbl-projects" class="table table-responsive table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <script src="components/jquery/dist/jquery.js"></script>
        <script src="components/jquery/dist/jquery.min.js"></script>
        <script src="components/jquery-confirm-master/js/jquery-confirm.js"></script>
        <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="components/jquery.validate.min.js"></script>
    </body>
</html>

<script>
                                    var createOrEdit = true;
                                    var project_id = null;
                                    get_all();

                                    function AddStudent()
                                    {
                                        if ($("#formProject").valid()) {
                                            var url = '';
                                            var data = '';
                                            var method = '';
                                            if (createOrEdit == true)
                                            {
                                                url = 'addProject.php';
                                                data = $('#formProject').serialize();
                                                method = 'POST';
                                            } else
                                            {
                                                url = 'updateProject.php';
                                                data = $('#formProject').serialize() + "&project_id=" + project_id;
                                                method = 'POST';
                                            }
                                            $.ajax({
                                                type: method,
                                                url: url,
                                                dataType: 'JSON',
                                                data: data,
                                                beforeSend: function () {
//                                                    $('#save').prop('disabled', true);
                                                    $('#save').html('');
                                                    $('#save').append('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i>Saving</i>');
                                                },

                                                success: function (data)
                                                {
                                                    $('#formProject')[0].reset();
//                                                    $('#save').prop('disabled', true);
                                                    $('#save').html('');
                                                    $('#save').append('Add');
                                                    var msg;
                                                    get_all();
                                                    if (createOrEdit)
                                                    {
                                                        msg = "Course Created";
                                                    } else
                                                    {
                                                        msg = "Course Updated";
                                                    }
                                                    alert(msg);
//                                                    $.alert({
//                                                        title: 'Success!',
//                                                        content: msg,
//                                                        type: 'green',
//                                                        boxWidth: '400px',
//                                                        theme: 'light',
//                                                        useBootstrap: false,
//                                                        autoClose: 'ok|2000'
//                                                    });
                                                    createOrEdit = true;
                                                },
                                                error: function (xhr, status, error) {
                                                    alert(xhr);
                                                    console.log(xhr.responseText);
                                                    $.alert({
                                                        title: 'Fail!',
                                                        type: 'red',
                                                        autoClose: 'ok|2000'

                                                    });
                                                    $('#save').prop('disabled', false);
                                                    $('#save').html('');
                                                    $('#save').append('Save');
                                                }

                                            });
                                        }
                                    }


                                    function get_all()
                                    {
                                        $('#tbl-projects').dataTable().fnDestroy();
                                        $.ajax({

                                            url: "allProject.php",
                                            type: "GET",
                                            dataType: "JSON",

                                            success: function (data)
                                            {

                                                $('#tbl-projects').html(data);

                                                $('#tbl-projects').dataTable({
                                                    "aaData": data,
                                                    "scrollX": true,
                                                    "aoColumns": [
                                                        {"sTitle": "StudentName", "mData": "name"},
                                                        {"sTitle": "Course", "mData": "course"},
                                                        {"sTitle": "Fees", "mData": "fees"},
                                                        {
                                                            "sTitle": "Status", "mData": "status", "render": function (mData, type, row, meta) {
                                                                if (mData == 1) {
                                                                    return '<span class="label label-info">Active</span>';
                                                                } else if (mData == 2) {
                                                                    return '<span class="label label-warning">Deactive</span>';
                                                                }
                                                            }
                                                        },
                                                        {
                                                            "sTitle": "Edit",
                                                            "mData": "id",
                                                            "render": function (mData, type, row, meta) {
                                                                return '<button class="btn btn-xs btn-success" onclick="get_project_details(' + mData + ')">Edit</button>';
                                                            }
                                                        },
                                                        {
                                                            "sTitle": "Delete",
                                                            "mData": "id",
                                                            "render": function (mData, type, row, meta) {
                                                                return '<button class="btn btn-xs btn-primary" onclick="RemoveProject(' + mData + ')">Delete</button>';
                                                            }
                                                        }
                                                    ]
                                                });

                                            },

                                            error: function (xhr, status, error) {
                                                alert(xhr);
                                                console.log(xhr.responseText);

                                                $.alert({
                                                    title: 'Fail!',
                                                    //            content: xhr.responseJSON.errors.product_code + '<br>' + xhr.responseJSON.msg,
                                                    type: 'red',
                                                    autoClose: 'ok|2000'

                                                });
                                                $('#save').prop('disabled', false);
                                                $('#save').html('');
                                                $('#save').append('Save');
                                            }





                                        });

                                    }

                                    function get_project_details(id) {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'projectDetail.php',
                                            dataType: 'JSON',
                                            data: {project_id: id},
                                            success: function (data) {
                                                $("html, body").animate({scrollTop: 0}, "slow");
                                                createOrEdit = false
                                                console.log(data);

                                                project_id = data.id
                                                $('#studentname').val(data.name);
                                                $('#course').val(data.course);
                                                $('#fees').val(data.fees);
                                                $('#status').val(data.status);
//                                                $('#formProject').modal('show');
                                            },
                                            error: function (xhr, status, error) {
                                                alert(xhr);
                                                console.log(xhr.responseText);

                                                $.alert({
                                                    title: 'Fail!',
                                                    type: 'red',
                                                    autoClose: 'ok|2000'

                                                });
                                            }

                                        });
                                    }

                                    function RemoveProject(id) {
                                        $.confirm({
                                            theme: 'supervan',
                                            autoClose: 'ok|2000',
                                            buttons: {
                                                Delete: function () {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'deleteProject.php',
                                                        dataType: 'JSON',
                                                        data: {project_id: id},
                                                        success: function (data) {
                                                            get_all();
                                                        },
                                                        error: function (xhr, status, error) {
                                                            alert(xhr);
                                                            console.log(xhr.responseText);
                                                            $.alert({
                                                                title: 'Fail!',
                                                                type: 'red',
                                                                autoClose: 'ok|2000'
                                                            });
                                                        }
                                                    });
                                                },
                                                Cancel: function () {

                                                }
                                            }
                                        });
                                    }
                                    function Clear() {
                                        $('#formProject')[0].reset();

                                        createOrEdit = true;
                                        get_all();
                                    }

</script>