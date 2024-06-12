<?php
include('config/database.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id='$id'";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];

    $sql = "UPDATE books SET title='$title', author='$author' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" type="text/css" href="css/add_update.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <form method="POST" action="edit_book.php?id=<?php echo $id; ?>" class="book-form">
            <h2>Edit Book</h2>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>
            </div>
            <button type="submit" class="btn">Update Book</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
