<?php
session_start();
include("connections.php");

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = mysqli_query($connections, "SELECT * FROM db_users WHERE email='$email'");
    if ($query) {
        $my_info = mysqli_fetch_assoc($query);
        if ($my_info) {
            $username = $my_info['username'];
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d');


    $insertQuery = mysqli_query($connections, "INSERT INTO post (username,title, content, date) VALUES ('$username','$title', '$content', '$date')");

    if ($insertQuery) {
    } else {
    }
}

$postsQuery = mysqli_query($connections, "SELECT * FROM post WHERE username='$username'");
$posts = mysqli_fetch_all($postsQuery, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="nav">
        <div class="logo">
            <header>MiniBlog</header>
        </div>

        <div class="right-links">
            <?php if (isset($username)) {
                echo "Hi, " . $username . "!";
            } ?>
            <a href="#">Home</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>

    <?php foreach ($posts as $post) {
        if ($post['username'] === $username) { ?>
    <div class="container">
        <div class="post-header">
            <?php echo $post['title']; ?>
        </div>
        <div class="post-content"><?php echo $post['content']; ?></div>
        <div class="post-date">Date: <?php echo $post['date']; ?></div>
        <div class="post-footer">
            <button class="delete-btn" name="btnDel">Delete</button>
            <button class="edit-btn" name="btnedit">Edit</button>
        </div>
    </div>
    <?php }
    } ?>

    <div class="container">
        <button class="Cbtn" id="newPostBtn">Create New Post</button>
    </div>
    <div class="modal" id="modal">
        <div class="modal-content">
            <div class="modal-header">Create a Post</div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="modal-input">
                    <label for="title">Enter Title:</label>
                    <input type="text" id="title" name="title" placeholder="Enter Title">
                </div>
                <div class="modal-input">
                    <label for="content">Enter Content:</label>
                    <input type="text" id="content" name="content" placeholder="Enter Content">
                </div>
                <div class="modal-input">
                    <input type="submit" value="Post">
                </div>
            </form>
        </div>
    </div>

    <script>
    const modal = document.getElementById('modal');
    const newPostBtn = document.getElementById('newPostBtn');

    newPostBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    </script>
</body>

</html>