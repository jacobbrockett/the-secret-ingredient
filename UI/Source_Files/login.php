<?php
function renderLoginGroup($fieldName, $errorParam, $sessionValue): void
{ // function generalizes output of form group
    $fieldErr = isset($_GET[$errorParam]) ? $_GET[$errorParam] : null;
    $fieldValue = isset($sessionValue) ? $sessionValue : '';

    echo '<div class="form-group';

    // Check for error state
    if ($fieldErr)
    {
        if ($fieldErr == "null")
        {
            echo ' has-error" id="' . $fieldName . 'Group">';
            echo '<label class="control-label">' . ucfirst($fieldName) . ':</label>';
            echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '">';
            echo '<span class="help-block" id="' . $fieldName . 'Status">' . ucfirst($fieldName) . ' cannot be blank!</span>';
            echo '<div id="unFeedback"></div>';
        }
        elseif ($fieldErr == "invalid")
        {
            echo ' has-error" id="' . $fieldName . 'Group">';
            echo '<label class="control-label">' . ucfirst($fieldName) . ':</label>';
            echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '">';
            echo '<span class="help-block" id="' . $fieldName . 'Status">' . ucfirst($fieldName) . ' contains invalid characters!</span>';
            echo '<div id="unFeedback"></div>';
        }
        elseif ($fieldErr == "authError")
        {
            echo ' has-error" id="' . $fieldName . 'Group">';
            echo '<label class="control-label">' . ucfirst($fieldName) . ':</label>';
            echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '">';
            echo '<span class="help-block" id="' . $fieldName . 'Status">' . ucfirst($fieldName) . ' is incorrect!</span>';
            echo '<div id="unFeedback"></div>';
        }
    }
    // Success state or default state
    else
    {
        if ($fieldValue)
        {
            echo ' has-success" id="' . $fieldName . 'Group">';
            echo '<label class="control-label">' . ucfirst($fieldName) . ':</label>';
            echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '">';
            echo '<span class="help-block" id="' . $fieldName . 'Status"></span>';
            echo '<div id="unFeedback"></div>';
        }
        else
        {
            echo '" id="' . $fieldName . 'Group">';
            echo '<label class="control-label">' . ucfirst($fieldName) . ':</label>';
            echo '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '">';
            echo '<span class="help-block" id="' . $fieldName . 'Status"></span>';
            echo '<div id="unFeedback"></div>';
        }
    }
    echo '</div>';
}

session_start(); // on the server's temp location, create file that can be written to for this client
include("./helpers/page_helpers.php");

if (!isset($_POST['submit'])) // form not submitted
{
    echo '<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 id="about">Please log in to continue:</h2>
		</div>
		<div class="panel-body">';

    if(isset($_GET['error']))
    {
        if($_GET['error'] == "invalidSID")
        {
            echo "<p><strong><i>Please log in to view results!</strong></i></p>";
        }
        if($_GET['error'] == "success")
        {
            echo "<p><strong><i>You have successfully registered!</strong></i></p>";
        }
    }
    echo '<form method="post" action="">';

    // Username:
    renderLoginGroup('username', 'usernameErr', $_SESSION['username']);

    // Password:
    renderLoginGroup('password', 'passwordErr', $_SESSION['password']);

    echo '<button class="btn btn-default" type="submit" name="submit" value="submit">Submit</button>';
    echo '</form>';

    echo '</div';
    echo '</div>';
    echo '</div>';
}
else
{
    // ------------------------
    // Check Login Credentials:
    // ------------------------
    $errors=array();
    $loginRegex = "/^(?![Nn][Uu][Ll][Ll]$)[\S]{6,}$/";

    $username=$_POST['username'];
    if ($username==NULL)
    {
        $errors[]="usernameErr=null";
        $_SESSION['username'] = $username;
    }
    elseif (!preg_match($loginRegex, $username))
    {
        $errors[]="usernameErr=invalid";
        $_SESSION['username'] = $username;
    }
    else
    {
        $_SESSION['username'] = $username;
    }

    // Password:
    $password=$_POST['password'];
    if ($password==NULL)
    {
        $errors[]="passwordErr=null";
        $_SESSION['password'] = $password;
    }
    elseif (!preg_match($loginRegex, $password))
    {
        $errors[]="passwordErr=invalid";
        $_SESSION['password'] = $password;
    }
    else
    {
        $salt="CS4413fa24"; // real salts are randomized!!!!
        $hash=hash('sha256', $username.$password.$salt);

        $dblink=db_connect('contact_data');
        $sql="Select `auto_id` from `accounts` where hash='$hash'";

        $result=$dblink->query($sql) or
        die('<h2>Something went wrong with $sql<br>".$dblink->error."</h2>');

        if($result->num_rows<=0) // password did not match
        {
            $errors[]="passwordErr=authError";
        }
        $_SESSION['password'] = $password;
    }

    // --------------
    // Attempt Login:
    // --------------
    if (count($errors) > 0) // Errors
    {
        $errorString=implode("&", $errors);
        redirect("index.php?page=login&$errorString");
    }
    else // no errors
    {
        $data=$result->fetch_array(MYSQLI_ASSOC);

        $SIDsalt=microtime(); // randomized salt, i.e. time based

        $sid=hash('sha256', $hash.$SIDsalt);

        $sql="Update `accounts` set `session_id`='$sid' where `auto_id`='$data[auto_id]'";

        $dblink->query($sql) or
        die('<h2>Something went wrong with $sql<br>".$dblink->error."</h2>');

        redirect("index.php?page=browse&sid=$sid");
    }
}

?>