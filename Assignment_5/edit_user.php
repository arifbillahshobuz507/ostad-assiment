<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $jsonFile = 'users.json';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];

            $userData = json_decode(file_get_contents($jsonFile), true);
            if (isset($userData[$email]) && $email !== $_SESSION['email']) {
                if (isset($_POST['delete'])) {
                    // Remove the user
                    unset($userData[$email]);
                    echo "User with email $email has been deleted.";
                } elseif (isset($_POST['new_role'])) {
                    $newRole = $_POST['new_role'];
                    // Update the user's role
                    $userData[$email]['role'] = $newRole;
                    echo "Role for $email has been updated to $newRole.";
                }
                file_put_contents($jsonFile, json_encode($userData, JSON_PRETTY_PRINT));
            } else {
                echo "User with email $email does not exist or cannot be modified.";
            }
        }
    }

    echo "<h1>Hi Mr. Admin</h1>";
    echo '<table border="1">
        <tr>
            <th>Email</th>
            <th>Username</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>';

        $userData = json_decode(file_get_contents($jsonFile), true);

        foreach ($userData as $email => $user) {
            if ($email !== $_SESSION['email']) {
                echo '<tr>
                    <td>' . $email . '</td>
                    <td>' . $user['username'] . '</td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="email" value="' . $email . '">
                            <select name="new_role">
                                <option value="user" ' . ($user['role'] === 'user' ? 'selected' : '') . '>User</option>
                                <option value="manager" ' . ($user['role'] === 'manager' ? 'selected' : '') . '>Manager</option>
                            </select>
                            <input type="submit" value="Update Role">
                        </form>
                    </td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="email" value="' . $email . '">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>';
            }
        }

    echo '</table>';
} else {
    echo "You don't have permission to view or change user roles.";
}
?>

<?php include('header.php'); ?>
<a href="admin_page.php" class="btn btn-primary mt-3">Admin Home Page</a>
<a href="logout.php" class="btn btn-danger mt-3">Logout</a>
<?php include('footer.php'); ?>
