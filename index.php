    <?php
    include('connection.php');
    $data_inserted = false;
    $data_updated = false;
    $data_delete = false;

    // echo $_POST['srno_edit'];
    if (isset($_GET['delete'])) {
        $delete_sno = $_GET['delete'];
        $data_delete= true;
        $delete = "DELETE FROM `notes2` WHERE `srno` = $delete_sno";

        $run_delete =    mysqli_query($conn, $delete);

    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['srno_edit'])) {

            // updating the recode
            $sno_edit = $_POST['srno_edit'];

            $title_edit = $_POST['title_edit'];
            $link_edit = $_POST['link_edit'];
            $description_edit = $_POST['description_edit'];


            //UPDATE table_name  SET column1 = value1, column2 = value2, ...  WHERE condition;
            //         UPDATE `notes2` SET `title` = '111', `link` = '111', `description` = '111' WHERE `notes2`.`srno` = 9;
            
            $update = "UPDATE `notes2` SET  `titile`='$title_edit', `link`='$link_edit', `description` = '$description_edit' WHERE  `srno` = $sno_edit";

            $run_update = mysqli_query($conn, $update);

            if ($run_update) {
                $data_updated = true;
            }
        } else {
            // insetting the recode

            $title = $_POST['title'];
            $link = $_POST['link'];
            $description = $_POST['description'];

            $insert = "INSERT INTO `notes2` ( `titile`, `link`, `description`) VALUES ( '$title', '$link' , '$description') ";

            $run_insert = mysqli_query($conn, $insert);

            if (isset($run_insert)) {
                $data_inserted = true;
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css"> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">





    </head>

    <body>

        <!-- Edit modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
            Edit Modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLabel">Edit Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" Action="index.php">
                            <input type="hidden" name="srno_edit" id="srno_edit">
                            <div class="mb-3">
                                <label for="title_edit" class="form-label">Titile</label>
                                <input type="text" class="form-control" id="title_edit" name="title_edit" aria-describedby="emailHelp">

                            </div>
                            <div class="mb-3">
                                <label for="link_edit" class="form-label">Link</label>
                                <input type="text" class="form-control" id="link_edit" name="link_edit">
                            </div>
                            <div class="mb-3">
                                <label for="description_edit" class="form-label">description</label>
                                <input type="text" class="form-control" id="description_edit" name="description_edit">
                            </div>

                            <button type="submit" class="btn btn-primary" name="submit">UPDATE NOTE</button>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                </div>
            </div>
        </div>



        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <?php

        if ($data_inserted) {
            echo "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
                    <strong>SUCCESS !!</strong> YOUR NOTE AS BEED INSERTED SUCCESSFULLY
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }

        ?>

        <?php
        if ($data_updated) {
            echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                    <strong>UPDATE !!</strong> YOUR NOTE AS BEED UPDATE SUCCESSFULLY
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
        }

        ?>
        <?php

       
        if ($data_delete) {
            echo "<div class='alert  alert-warning alert-dismissible fade show' role='alert'>
                    <strong>UPDATE !!</strong> YOUR NOTE AS BEED UPDATE SUCCESSFULLY
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";

        }

        ?>

        <div class="container mt-5 p-3 border border-4 border-dark">
            <h1 class="bg-dark text-center text-light">ADD NOTE</h1>
            <form method="POST" Action="index.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Titile</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" id="link" name="link">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">ADD NOTE</button>
            </form>
        </div>



            <div class="container my-5 p-3">
                <H1 class="bg-dark text-center text-light">LIST</H1>


                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope='col'>SRNO</th>
                            <th scope='col'>TITLE</th>
                            <th scope='col'>LINK</th>
                            <th scope='col'>DISCRIPTION</th>
                            <th scope='col'>TSTAMP</th>
                            <th scope='col'>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $select = "select * from notes2";

                        $run_select = mysqli_query($conn, $select);
                        $sr = 0;
                        
                        while ($row = mysqli_fetch_assoc($run_select)) {
                            // echo "" . $row["srno"] . "<br>" . $row["title"] . "<br>" . $row["link"] . "<br>" . $row["tstamp"] . "";
                            $sr++;

                            echo "
                    
                        <tr>
                            <td>{$sr}</td>
                            <td>{$row["titile"]}</td>
                            <td>{$row["link"]}</td>
                            <td>{$row["description"]}</td>
                            <td>{$row["tstamp"]}</td>
                            <td>
                                <button class='edit btn btn-sm btn-primary' id='{$sr}'>Edit</button>  
                                <button class='delete btn btn-sm btn-danger' id='d{$sr}'name='delete'>Delete</button>
                                </td>
                            </tr>
               
                        ";
                        }

                        ?>

                    </tbody>
                </table>


            </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script>
            new DataTable('#example');
        </script>

        <script>
            edit = document.getElementsByClassName('edit');
            Array.from(edit).forEach((element) => {
                element.addEventListener("click", (e) => {
                    // console.log("edit", );
                    let tr = e.target.parentNode.parentNode;
                    let title = tr.getElementsByTagName("td")[1].innerText;
                    let link = tr.getElementsByTagName("td")[2].innerText;
                    let description = tr.getElementsByTagName("td")[3].innerText;
                    //console.log(title, link, description);
                    // console.log(tr.getElementsByTagName("td")[1].innerText);

                    document.getElementById('title_edit').value = title;
                    document.getElementById('link_edit').value = link;
                    document.getElementById('description_edit').value = description;
                    // link_edit.value = link;
                    // dscription_edit.value =description;
                    //console.log(document.getElementById('title_edit').value);
                    srno_edit.value = e.target.id;
                    console.log(e.target.id);
                    $('#EditModal').modal('toggle');
                });
            });
            //delete

            deletes = document.getElementsByClassName('delete');
            Array.from(deletes).forEach((element) => {
                element.addEventListener("click", (e) => {
                    // console.log("edit", );

                    let sno_delete = e.target.id.substr(1, );

                    console.log(e.target.id);
                    console.log(sno_delete);

                    if (confirm("ARE YOU SURE !, YOU WANT TO DELETE THE NOTE..")) {

                        console.log("yes!!!");
                        window.location = `index.php?delete=${sno_delete}`;

                    } else {
                        console.log("no!!!");
                    }

                    //$('#EditModal').modal('toggle');
                })
            })
        </script>
    </body>
    </html>