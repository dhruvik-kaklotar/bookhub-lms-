<?php
    
    include 'inc/config.php';
    if (isset($_GET["bookid"])) {
        $id = $_GET["bookid"];
        mysqli_query($conn, "DELETE FROM issuedbook WHERE bookid='$bookid'");

        ?>
        <script type="text/javascript">
            window.location="allissuedbook.php";
        </script>
        <?php
    }



?>