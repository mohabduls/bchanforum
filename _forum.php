<?php
include("_header.php");
$bchan_user = $_SESSION['bchan_user'];
if(isset($_GET['f']))
{
    $forum_type = $_GET['f'];
    switch($forum_type)
    {
        case "anime":
            {
                include("_forum1.php");
            }
        break;
        case "manga":
            {
                include("_forum2.php");
            }
        break;
        case "japanese":
            {
                include("_forum3.php");
            }
        break;
        case "liveaction":
            {
                include("_forum1.php");
            }
        break;
        case "film":
            {
                include("_forum2.php");
            }
        break;
        case "others":
            {
                include("_forum3.php");
            }
        break;
    }
}
?>

<?php

include("_footer.php");
?>