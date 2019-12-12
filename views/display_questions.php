<?php include("../views/header.php"); ?>
<?php include("../views/logged-menu.php"); ?>

    <div class="questions-div">
        <?php
        if(isset($_SESSION['success']))
            echo "<p class='success'>Success: ".$_SESSION['success']."</p>";

        unset($_SESSION['success']);
        ?>
        <table id="questions">
            <tr>
                <th>#</th>
                <th>Question Name</th>
                <th>Question Body</th>
                <th>Question Skills</th>
                <th>Actions</th>
            </tr>
            <?php
            $i = 1;
            foreach($result as $q) { ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $q['name']; ?></td>
                    <td><?php echo $q['body']; ?></td>
                    <td><?php
                        $q['skills'] = unserialize($q['skills']);
                        foreach( $q['skills'] as $key => $sk) {
                            echo $sk;
                            if((count($q['skills']) - 1 ) != $key )
                                echo ", ";
                        }
                        ?></td>
                    <td>
                        <a href="?action=display_edit_question&id=<?php echo $q['id']; ?>">Edit</a>
                        |
                        <a href="?action=delete_question&id=<?php echo $q['id']; ?>" onclick="return confirm('Are you sure you want to delete it?');">Delete</a>
                    </td>
                </tr>
                <?php
                $i++;
            } ?>

        </table>

    </div>

<?php include("../views/footer.php"); ?>