<?php
/* Check if admin is login  */

if(!isAdminLoggedin()){
    header("location: ".URLROOT."admin/login");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?php echo URLROOT ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="views/style/panel.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/style/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- Adding Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

<title>Panel</title>
</head>

<body>
    <header>
        <div class="container">
            <i class="fa-brands fa-vaadin"></i>
            <h2>Admin Panel</h2>
            <a  class="logout" href="admin/logout">Sign out</a>
        </div>
        </div>
    </header>
    <main>
        <div class="container">



            <?php
            if (count($data['users']) == 0)
            {
                echo "<h2>NO DATA</h2>";
            }
            else
            {
            ?>

                <table>
                    <tr>
                        <th>Pharmacy Name</th>
                        <th>Licence ID</th>
                        <th>Email</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    foreach ($data['users'] as $users)
                    {
                    ?>
                        <tr>
                            <td><?php echo $users->ph_name ?></td>
                            <td><?php echo $users->licence ?></td>
                            <td><?php echo $users->email ?></td>
                            <td>
                                <?php
                                if ($users->active == 0)
                                { ?>
                                    <a href="Panel/activeUser/<?php echo $users->id ?>" class="conf-btn">
                                        <i class="fa-solid fa-check"></i>
                                        activate

                                    </a>
                                <?php
                                }
                                else
                                {

                                ?>
                                    <a href="Panel/deActiveUser/<?php echo $users->id ?>" class="conf-btn">
                                        <i class="fa-solid fa-check"></i>
                                        deactivate

                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a href="Panel/deleteUser/<?php echo $users->id ?>" class="del-btn">
                                    <i class="fa-solid fa-x"></i>
                                    Delete

                                </a>
                            </td>
                        </tr>


                    <?php
                    }
                    ?>
                </table>
            <?php
            }


            ?>


        </div>
    </main>
</body>

</html>