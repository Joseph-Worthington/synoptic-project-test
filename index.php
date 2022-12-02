<?php
include 'header.php';



// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }else{
//     echo "Connected Successfully";
//   }




$sql = "SELECT * FROM portfolio_images";
$result = $conn->query($sql);
echo '<div class="image-card">';
if ($result->num_rows > 0) {
  // output data of each row
  while($row =$result->fetch_assoc()):

    echo "<img style='background-color:black;' alt='".$row['alt']."' src='".$row['url']."'>";

  endwhile;
} else {
  echo "0 results";
}
echo '</div>';

?>

<h1>My TODO List</h1>
        <p>There are <?= $rowCount; ?> items in my list</p>
        <ol>
            <?php while($rowData = mysqli_fetch_array($allTasksQuery)) { ?>
                <li>
                    <strong><?= $rowData['title']; ?></strong>
                    <a href="delete_task.php?id=<?= $rowData['task_id'] ?>">delete</a>
                    <p><?= $rowData['description']; ?></p>

                    <?php
                    $imagePath = "/images/{$rowData['task_id']}.jpg";
                    if (file_exists(__DIR__ . $imagePath)) {
                        ?>
                        <img src="<?= $imagePath ?>" alt="Image for <?= $rowData['title'] ?>" />
                    <?php } ?>

                </li>
            <?php } ?>

        </ol>

        <form action='add_task.php' method='post' enctype="multipart/form-data">
            <fieldset>
                <label for='title'>Title</label>
                <input type='text' name='title' id='title' />
                <br/>
                <label for='description'>Description</label>
                <textarea name='description' id='description'></textarea>
                <br/>
                <label for='image'>Image</label>
                <input type='file' name='image' id='image' accept="image/jpeg" />

                <button type="submit">Add Task</button>
            </fieldset>
        </form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  // collect value of input field
  $data = $_REQUEST['val1'];

  if (empty($data)) {
      echo "data is empty";
  } else {
      echo $data;
  }
}



include 'footer.php';

?>