<?php
session_start();
include_once('../includes/connection.php');
if ((!isset($_SESSION['loggedin'])) and (!isset($_SESSION['admin'])) ){
    header ('Location: ../index.php');
                  } 
if (isset($_POST['title'],$_POST['content'])){
    $title=$_POST['title'];
    $content=nl2br($_POST['content']);
    if (empty ($title)or empty($content)){
        $error="All fields are required";
    }

else {
    $query=$pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?) ');
    $query->bindValue(1, $title);
    $query->bindValue(2, $content);
    $query->bindValue(3, time());

    $query->execute();
    header('Location: ../index.php');
}

   
    
}

?>

<html>
	


<h4>Add Article</h4>
<?php if (isset($error)){?>
        <small style="color:#aa000-;"><?php echo $error;?>
        <br /><br />
        <?php } ?>
<form action="add.php"method='POST' autocomlete='off'>
<input type="text" name="title" placeholder="Title"/><br /><br />
<textarea name="content" cols="50" rows="15"placeholder="Content"></textarea><br /><br />
<input type="submit" value="Add Article"/>
</form>


	</body>
</html>