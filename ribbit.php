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
  background: white url(gfx/bg.png);
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
  background: url(gfx/bg-header.png);
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
  background: url(gfx/bg-footer.png);
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
		<div class="wrapper">
			<div id="ribbits" class="panel left">
				<h1>Public Ribbits</h1>

                <?php
                $sql = "SELECT * FROM ribbit";
                $result = $db->query($sql);

                if ($result)  {

                foreach ($result as $row)  {

                ?>
				<div class="ribbitWrapper">
					<img class="avatar" src="http://i.imgur.com/JaypYsb.png">
					<span class="name"><?php
                        $username = $db->query("SELECT username FROM user WHERE id = $row[id]");
                        // $username = implode($username);
                        if ($userrow = $username->fetch_assoc()) {
                            echo $userrow['username'];
                        }  ?>
                    </span> @username
                    <span class="time"><?php echo ($row['created']);   ?></span>
					<p>
						<?php echo ($row['content']); }} ?> <a href="#">http://net.tutsplus.com/tutorials/php/ ...</a>
					</p>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="wrapper">
			Ribbit - A Twitter Clone
		</div>
	</footer>
</body>
</html>


<?php



/* copying stuff from myblog index.php file showing blog posts */



/*


    <body>
    <table border="1" class="center"> <!-- start a table -->
    <tr> <!-- first row -->
        <th>Title</th> <!-- header -->
        <th>Author</th>
        <th>Date Added</th>
        <th>Contents</th>
        <th>Tags</th>
        <th>Link to edit</th>
        <th>Delete</th>
    </tr> <!-- end first row -->
    <tr> <!-- second row -->
        <?php foreach ($result as $row)  {
        $tagshow = $db->query("SELECT * FROM tags WHERE post_id = $row[id]");  ?>
        <tr>
        <td><?php echo ($row['title']);          ?></td>
        <td><?php echo ($row['author']);         ?></td>
        <td><?php echo ($row['date']);           ?></td>
        <td><?php echo ($row['contents']);       ?></td>
        <td><?php foreach($tagshow as $tagrow) {
                echo $tagrow['tag']; } ?></td>
        <td>  <a href="edit_post.php?id=<?php echo $row['id']; ?>">View/Edit</a></td>
        <td>  <a href="index.php?id=<?php echo $row['id']; ?>">Delete</a></td>  <?php } ?>
        </tr> <?php      ?>
        <!-- end second row -->
    </table> <!-- end the table -->
    </body>
}

*/


?>