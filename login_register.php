<?php
session_start();
require('connection.php');

// Handle update customer details
if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];  // Assuming the ID is passed safely (validate it properly)
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Ensure password is hashed

    // Hash the password before updating
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to update customer details
    $query = "UPDATE register_user SET name = ?, username = ?, email = ?, password = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $full_name, $username, $email, $hashed_password, $id);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['login'] = "Login updated successfully";
            header('Location: sticky.php');
            exit(0);
        } 
        else 
        {
            $_SESSION['login'] = "Login update failed";
            header('Location: sticky.php');
            exit(0);
        }
        mysqli_stmt_close($stmt);
    } 
    else 
    {
        $_SESSION['login'] = "Failed to prepare update query";
        header('Location: sticky.php');
        exit(0);
    }
}


// Handle login
if(isset($_POST['login']))
{
  
    $query = "SELECT *FROM `register` WHERE `email` = '$_POST[email]' OR `username` = '$_POST[email]'";
    $result = mysqli_query($conn, $query);
    if($result)
    {
       if(mysqli_num_rows($result) == 1)
       {
         $result_fetch = mysqli_fetch_assoc($result);
          if($_POST['password'] == $result_fetch['password'])
          {
            #if password matched
            $_SESSION['logged_in'] == true;
            $_SESSION['username'] = $result_fetch['username'];
            header("location:sticky.php");
          }
          else
          {
            #if password in incorrect
            echo"
              <script>
                alert('Incorrect password');
                window.location.href = 'regester.php';
              </script>
            ";
          }

           if($_POST['email'] == $result_fetch['email'])
          {
            #if password matched
            $_SESSION['logged_in'] == true;
            $_SESSION['username'] = $result_fetch['username'];
            header("location:sticky.php");
          }
          else
          {
            #if email is  incorrect
            echo"
              <script>
                alert('Incorrect email');
                window.location.href = 'regester.php';
              </script>
            ";
          }
        }


       else
       {
         echo"
            <script>
              alert('Email or username not regestered');
              window.location.href = 'regester.php';
            </script>
          ";
       }
      }
  else
  {
   echo"
     <script>
      alert('cannot run query');
      window.location.href = 'regester.php';
      </script>
    ";  
  }

}

// Handle registration
if (isset($_POST['register']))
 {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username or email is already taken
    $user_exist_query = "SELECT * FROM `register` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
    $result = mysqli_query($conn,$user_exist_query);
    if($result)
    {
       if (mysqli_num_rows($result) > 0) #it will be executed if username or email already regestered
        {
            #if any user has already taken username or email
          $result_fetch = mysqli_fetch_assoc($result);
          if($result_fetch['username'] == $_POST['username'])
           {
            #error for username already regestered
              echo"
                 <script>
                      alert('$result_fetch[username] already taken');
                      window.location.href = 'regester.php';
                 </script>
                ";
            } 
            else
            {
                #error for email aready regestered
                echo"
                    <script>
                     alert('$result_fetch[email] E-mail already regestered');
                     window.location.href = 'regester.php';
                    </script>
               ";
            }
        }
        else #it will be executed if no one has taken username or email
        {
          //$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
          $query = "INSERT INTO `register`(`full_name`,`username`,`email`,`password`) VALUES ('$_POST[full_name]','$_POST[username]', '$_POST[email]', '$_POST[password]')";
          if(mysqli_query($conn,$query))
          {
            #if data inserted sucessfully
            echo"
              <script>
                alert('Regestration sucessful');
                window.location.href = 'regester.php';
              </script>
            "; 
          }
          else
          {
            #if data can nott be inserted
            echo"
                <script>
                  alert('cannot run query');
                  window.location.href = 'regester.php';
               </script>
           ";
          }
        }
    }
    else
    {
        echo"
          <script>
          alert('cannot run query');
          window.location.href = 'regester.php';
          </script>
        ";
    }
}
?>
