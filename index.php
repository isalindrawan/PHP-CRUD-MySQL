<?php

    $host_name = 'localhost';
    $db_name = 'php-crud-mysqli';
    $username = 'root';
    $password = '';

    $mysqli = mysqli_connect($host_name, $username, $password, $db_name);

    $result = mysqli_query($mysqli, "SELECT * FROM contacts");

    if(isset($_GET['id'])) {

        $edit = mysqli_query($mysqli, "SELECT * FROM contacts WHERE id = " . $_GET['id']);
        $data = mysqli_fetch_array($edit);
    
    }
    
    if(isset($_GET['delete'])) {

        $edit = mysqli_query($mysqli, "DELETE FROM contacts WHERE id = " . $_GET['delete']);
        header('Location: index.php');

    }

    if (isset($_POST['submit'])) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];

        mysqli_query($mysqli, "INSERT INTO contacts VALUES('NULL','$first_name', '$last_name', '$address', '$mobile')");

        header("Refresh:0");
    
    }
    
    elseif(isset($_POST['update'])) {

        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];

        mysqli_query($mysqli, "UPDATE contacts SET first_name = '$first_name', last_name = '$last_name', address = '$address', mobile = '$mobile' WHERE id = '$id'");

        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>php crud with mysql</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <style>
        body {

            background-color: #F2F2F2;
        }
    </style>
  </head>
  <body>

    <div class="container mx-auto h-100 bg-white justify-content-center mt-5">
    <h2 class="text-center pt-3">CONTACT APPS USING PHP MYSQL</h2>
      <div class="row py-3">
        <div class="col-lg-3 mb-3">
          <div class="container">
            <form method="post">
              <div class="form-group">
                <input
                  type="hidden"
                  class="form-control"
                  name="id"
                  value="<?php if(isset($_GET['id'])) echo $_GET['id']?>"
                />
              </div>
              <div class="form-group">
                <label for="">First Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="first_name"
                  placeholder=""
                  value="<?php if(isset($data)) echo $data['first_name']?>"
                />
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  name="last_name"
                  placeholder=""
                  value="<?php if(isset($data)) echo $data['last_name']?>"
                />
              </div>

              <div class="form-group">
                <label for="">Address</label>
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  id=""
                  aria-describedby="helpId"
                  placeholder=""
                  value="<?php if(isset($data)) echo $data['address']?>"
                />
              </div>

              <div class="form-group">
                <label for="">Mobile</label>
                <input
                  type="text"
                  class="form-control"
                  name="mobile"
                  placeholder=""
                  value="<?php if(isset($data)) echo $data['mobile']?>"
                />
              </div>
              <?php if(isset($data)):?>
              <button type="update" name="update" class="btn btn-primary">
                Update
              </button>
              <?php else:?>
              <button type="submit" name="submit" class="btn btn-primary">
                Submit
              </button>
              <?php endif;?>
            </form>
          </div>
        </div>

        <div class="col-lg-9">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while($row = mysqli_fetch_array($result)):
        ?>
              <tr>
                <td scope="row">
                  <?php echo $row['first_name'] . " " . $row['last_name']?>
                </td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['mobile']?></td>
                <td class="d-flex">
                  <form class="mr-2" action="<?php $_PHP_SELF?>" method="get">
                    <input
                      type="hidden"
                      name="id"
                      value="<?php echo $row['id']?>"
                    /><button
                      type="submit"
                      class="btn btn-primary btn-sm"
                    >
                      Edit
                    </button>
                  </form>
                  <form action="<?php $_PHP_SELF?>" method="get">
                    <input
                      type="hidden"
                      name="delete"
                      value="<?php echo $row['id']?>"
                    /><button
                      type="submit"
                      class="btn btn-danger btn-sm"
                    >
                      Delete
                    </button>
                  </form>
                </td>
              </tr>

              <?php endwhile;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
