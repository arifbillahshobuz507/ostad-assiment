        <?php
        include('header.php');
        ?>
    
    <div class="container mt-5 ">
        <div class="row"  >
            <h1 class="text-center" >Hello, Admin</h1>
            <h1 class="text-center mb-5" >Here you can see all the users in your server</h1>
            <?php
        include('footer.php');
        ?>
            <?php
            session_start();
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                $jsonFile = 'users.json';
                $userData = json_decode(file_get_contents($jsonFile), true);
                $adminEmail = $_SESSION['email'];
                echo '<table border="1">
                    <tr>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>';
            
                foreach ($userData as $email => $user) {
                    echo '<tr>
                        <td>' . $email . '</td>
                        <td>' . $user['username'] . '</td>
                        <td>' . $user['role'] . '</td>
                    </tr>';
                }
            
                echo '</table>';
            } else {
                echo "You don't have permission to view all users.";
            }
                
                
            ?>
        
        

        
        <a href="edit_user.php" class="btn btn-primary mt-5" ><h3> Update ROLE DELETE NEW REGISTER click here </h3></a>
        
        
        </div>
    </div>

    <?php include('header.php'); ?>
    <div class="container d-flex justify-content-center mt-3">
    <a href="logout.php">
      <button class="btn btn-danger">Logout</button>
    </a>
  </div>
    <?php include('footer.php'); ?>