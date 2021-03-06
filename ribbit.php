<?php
/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 8/25/2015
 * Time: 9:40 PM
 *
 * OK, starting new project myribbit
 * Requirements
Use PHP to fulfill the following requirements
Requirement 1
Users should be able to list all ribbits from all users. The ribbits should be ordered by
most recent ribbits listed first.
Requirement 2
Users should be able to list ribbits for a specific user.
Requirement 3
Users should be able to see a list of all Ribbit user names.
Bonus
Allow the user to search through the contents of ribbits and return ribbits matching their query.
 */

$db = new mysqli("ribbit.ccoefbt2lfct.us-east-1.rds.amazonaws.com", "student", "austincoding", "ribbit");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL :(<br>";
    echo $db->connect_error;
    exit();
}

?>

<form  action="ribbit.php"
       method="POST">
    <h4>Sort Ribbits by Most Recent Post First</h4>
    <input type="submit" name="sortribbits" value="Sort Ribbits">



<h4>Show All Users</h4>
<p>
    <input type="submit" name="showusers" value="Show Users">
</p>


<h4>Show Ribbits by User</h4>
<p>
    <input type="text" name="usernamesearch"  value="Enter Username:">
    <input type="submit" name="showribbits" value="Show Ribbits">
</p>

<h4>Search Ribbits by Text</h4>
<p>
    <input type="text" name="searchtext"  value="Enter Search Text:">
    <input type="submit" name="searchribbits"  value="Search Ribbits">
</p>
</form>



<?php



/* Here is the ribbit template given   */

?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
* {
  font-family: Helvetica, Arial, sans-serif;
  color: #3f3e3d;
}
body {
  background: white url(bg.png);
  margin: 0;
  padding: 0;
}
input {
  width: 236px;
  height: 38px;
  border: 1px solid #d2d2d2;
  padding: 0 10px;
  outline: none;
  font-size: 17px;
}
input:focus {
  background: #FFFDF2;
}
input[type="submit"] {
  height: 36px;
  width: auto;
  border: 1px solid #7BC574;
  border-radius: 2px;
  color: white;
  font-size: 12px;
  font-weight: bold;
  padding: 0 20px;
  cursor: pointer;
  background: #8cd585;
  background: -moz-linear-gradient(top, #8cd585 0%, #82cd7a 23%, #55ad4c 86%, #4fa945 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #8cd585), color-stop(23%, #82cd7a), color-stop(86%, #55ad4c), color-stop(100%, #4fa945));
  background: -webkit-linear-gradient(top, #8cd585 0%, #82cd7a 23%, #55ad4c 86%, #4fa945 100%);
  background: -o-linear-gradient(top, #8cd585 0%, #82cd7a 23%, #55ad4c 86%, #4fa945 100%);
  background: -ms-linear-gradient(top, #8cd585 0%, #82cd7a 23%, #55ad4c 86%, #4fa945 100%);
  background: linear-gradient(to bottom, #8cd585 0%, #82cd7a 23%, #55ad4c 86%, #4fa945 100%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='@c1', endColorstr='@c4', GradientType=0);
}
a {
  text-decoration: none;
  color: #58b84e;
  text-shadow: #58b84e 0 0 1px;
}
a:hover {
  text-decoration: underline;
}
.wrapper {
  width: 860px;
  margin: auto;
}
header {
  background: url(bg-header.png);
  height: 85px;
  width: 100%;
}
header div.wrapper {
  padding: 11px 0;
}
header div.wrapper img {
  position: relative;
  top: 10px;
  margin: 0 15px 0 0;
}
header div.wrapper span {
  font-size: 18px;
  margin: 0 42px 0 0;
}
header div.wrapper form {
  display: inline;
}
header div.wrapper form input {
  margin: 0 0 0 14px;
}
header div.wrapper #btnLogOut {
  float: right;
  margin: 14px 0 0 0;
}
#content {
  margin-bottom: 15px;
  min-height: 560px;
}
#content div.wrapper {
  margin: 38px auto;
}
#content div.wrapper img {
  border-radius: 6px;
  float: left;
}
#content div.wrapper div.panel {
  border: 1px solid #d2d2d2;
  background: white;
  margin: 0;
  margin-bottom: 29px;
  border-radius: 6px;
  font-size: 14px;
}
#content div.wrapper div.panel.right {
  width: 303px;
  height: 313px;
  float: right;
}
#content div.wrapper div.panel.right textarea.ribbitText {
  width: 249px;
  height: 160px;
  border: 1px solid #d2d2d2;
}
#content div.wrapper div.panel.left {
  width: 533px;
  float: left;
}
#content div.wrapper div.panel.left div.ribbitWrapper {
  padding: 15px 0;
  border-bottom: 1px solid #d2d2d2;
}
#content div.wrapper div.panel.left div.ribbitWrapper:last-child {
  border: none;
}
#content div.wrapper div.panel.left div.ribbitWrapper span.name {
  font-size: 18px;
  color: #58B84E;
}
#content div.wrapper div.panel.left div.ribbitWrapper span.time {
  font-size: 12px;
  color: #CCC;
}
#content div.wrapper div.panel.left div.ribbitWrapper img.avatar {
  margin: 0 19px 0 20px;
  float: left;
}
#content div.wrapper div.panel.left div.ribbitWrapper p {
  margin: 5px 50px 0 90px;
  padding: 0;
  text-align: justify;
  line-height: 1.5;
  color: #3f3e3d;
  text-shadow: #3f3e3d 0 0 1px;
}
#content div.wrapper div.panel.left div.ribbitWrapper p span.spacing {
  padding-left: 9px;
  margin-left: 9px;
  height: 10px;
  border-left: 1px solid #d2d2d2;
}
#content div.wrapper div.panel * {
  margin: 6px 0;
}
#content div.wrapper div.panel form {
  padding: 0 23px;
}
#content div.wrapper div.panel h1 {
  border-bottom: 1px solid #d2d2d2;
  margin: 5px 0;
  font-weight: normal;
  font-size: 18px;
  padding: 13px 23px;
  height: 23px;
}
#content div.wrapper div.panel p {
  padding: 0 24px;
  margin: 18px 0;
}
footer {
  background: url(bg-footer.png);
  height: 251px;
  font-size: 14px;
  clear: both;
}
footer div.wrapper {
  padding: 15px;
}
footer div.wrapper img {
  float: right;
}

</style>
</head>
<body>
	<header>
		<div class="wrapper">
			<img src="http://i.imgur.com/uBz81Ns.png">
			<span>Twitter Clone</span>
		</div>
	</header>
	<div id="content">



        <?php

        // This section is for showing all ribbits, sorted by most recent first
        // --------------------------------------------------------------------
        if (isset($_POST['sortribbits']))   {
        ?>

        <div class="wrapper">
			<div id="ribbits" class="panel left">
				<h1>Public Ribbits</h1>



                <?php

                $sql = "SELECT * FROM ribbit ORDER BY created DESC";
                $result = $db->query($sql);

                if ($result)  {

                foreach ($result as $row)  {

                ?>
				<div class="ribbitWrapper">
					<img class="avatar" <?php
                        $userpic = $db->query("SELECT profile_pic_url FROM profile WHERE id = $row[user_id]");
                        if ($userpicrow = $userpic->fetch_assoc()) {
                            $profilepic = $userpicrow['profile_pic_url'];
                            ?>
                            src = "<?php echo $profilepic   ?>" ><?php
                         }  ?>
					<span class="name"><?php
                        $username = $db->query("SELECT username FROM user WHERE id = $row[user_id]");
                        if ($usernamerow = $username->fetch_assoc()) {
                            echo $usernamerow['username'];
                        }  ?>
                    </span>
                        <?php
                        $useremail = $db->query("SELECT email FROM user WHERE id = $row[user_id]");
                        if ($useremailrow = $useremail->fetch_assoc())  {
                            echo $useremailrow['email'];
                        }   ?>
                    <span class="time"><?php echo ($row['created']);   ?></span>
					<p>
						<?php echo ($row['content']); } } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
    <?php  }



    // Add section here for showing all users
    // --------------------------------------

        if (isset($_POST['showusers']))  {
            $sql = "SELECT * FROM user";
            $result = $db->query($sql);
            $sql2 = "SELECT * FROM profile";
            $result2 = $db->query($sql2);

            if ($result && $result2)  {



            ?>
        <table border="1" class="center"> <!-- start a table -->
        All Ribbit Users
        <tr> <!-- first row -->
            <th>User Name</th> <!-- header -->
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr> <!-- end first row -->
        <tr> <!-- second row -->
        <?php foreach ($result as $row)  {    ?>
                <td><?php echo ($row['username']);               ?></td>
                <td><?php
                $userid = $db->query("SELECT user_id FROM profile WHERE id = $row[id]");
                if ($useridrow = $userid->fetch_assoc()) {
                    echo $useridrow['user_id'];
                    $fixuser = $useridrow['user_id'];
                }  ?></td>
                <td><?php
                    $userfirst = $db->query("SELECT first_name FROM profile WHERE (id = '$fixuser')");
                    if ($userfirstrow = $userfirst->fetch_assoc()) {
                        echo $userfirstrow['first_name'];
                    }  ?></td>
                <td><?php
                    $userlast = $db->query("SELECT last_name FROM profile WHERE (id = '$fixuser')");
                    if ($userlastrow = $userlast->fetch_assoc()) {
                        echo $userlastrow['last_name'];
                    }  ?></td>
        </tr><?php  }  }  }   ?>
        <!-- end second row -->
        </table> <!-- end the table -->






<?php
// ---------------------------------------
// This section is for showing only ribbits by selected user name
if (isset($_POST['showribbits']))   {
    $usersearch = $_POST['usernamesearch'];
    ?>

        <div class="wrapper">
			<div id="ribbits" class="panel left">
				<h1>Public Ribbits</h1>



                <?php

    // Need to get id from table user given username that has been selected

    $sqlid = "SELECT id FROM user WHERE username = '$usersearch'";
    $resultid = $db->query($sqlid);
        if ($resultidrow = $resultid->fetch_assoc()) {
            // echo $resultidrow['id'];
            $resultid = $resultidrow['id'];
    }

    // Now get user_id from table profile given id

    $sqluserid = "SELECT user_id FROM profile WHERE id = '$resultid'";
    $resultuserid = $db->query($sqluserid);
        if ($resultuseridrow = $resultuserid->fetch_assoc()) {
            $resultuserid = $resultuseridrow['user_id'];
        }
    

    // Now get all ribbits from table ribbit given user_id

    $sql = "SELECT * FROM ribbit WHERE user_id = '$resultuserid' ORDER BY created DESC";
    $result = $db->query($sql);

    if ($result)  {

        foreach ($result as $row)  {

            ?>
            <div class="ribbitWrapper">
            <img class="avatar" <?php
            $userpic = $db->query("SELECT profile_pic_url FROM profile WHERE id = $row[user_id]");
            if ($userpicrow = $userpic->fetch_assoc()) {
                $profilepic = $userpicrow['profile_pic_url'];
                ?>
                src = "<?php echo $profilepic   ?>" ><?php
            }  ?>
            <span class="name"><?php
                $username = $db->query("SELECT username FROM user WHERE id = $row[user_id]");
                if ($usernamerow = $username->fetch_assoc()) {
                    echo $usernamerow['username'];
                }  ?>
                    </span>
            <?php
            $useremail = $db->query("SELECT email FROM user WHERE id = $row[user_id]");
            if ($useremailrow = $useremail->fetch_assoc())  {
                echo $useremailrow['email'];
            }   ?>
            <span class="time"><?php echo ($row['created']);   ?></span>
            <p>
            <?php echo ($row['content']); } } ?>
					</p>
				</div>
			</div>
		</div>
	</div>
    <?php  }


    ?>




	<footer>
		<div class="wrapper">
			Ribbit - A Twitter Clone
		</div>
	</footer>
</body>
</html>





