<?php include("../views/header.php"); ?>
<?php include("../views/logged-menu.php"); ?>

<div class="container-div">
    <h1>Edit Question:</h1>
    <form method="post" action="?action=edit_question&id=<?php echo $id; ?>">
        <div class="container">

            <?php
            if(isset($_SESSION['error']))
                echo "<p class='error'>Error: ".$_SESSION['error']."</p>";

            else if(isset($_SESSION['success']))
                echo "<p class='success'>Success: ".$_SESSION['success']."</p>";

            unset($_SESSION['error']);
            unset($_SESSION['success']);
            ?>

            <label for="qname"><b>Question Name:</b></label>
            <input type="text" placeholder="Question Name" name="qname" id="qname" value="<?php echo $question['name']; ?>" required>

            <label for="body"><b>Question Body:</b></label>
            <textarea name="body" id="body" placeholder="Body" rows="3"><?php echo $question['body']; ?></textarea>

            <label for="skills"><b>Question Skills:</b></label>
            <input type="text" placeholder="Enter Skill" name="skills" id="skills" value="<?php echo $skills; ?>" required>

            <button type="submit" name="submit">Submit</button>

        </div>
    </form>
</div>

<?php include("../views/footer.php"); ?>
