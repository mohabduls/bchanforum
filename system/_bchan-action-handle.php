<?php
include("../_header.php");

if($bchan_admin == true)
{
    if(isset($_GET['control']))
    {
        switch($_GET["control"]){
            case "del":{
                $postid = $utils->realString($conn, $_GET['pid']);
                $forumtype = $utils->realString($conn, $_GET['forumtype']);

                $sql_del = $controls->delPost($forumtype, $postid);
                if($bchan_class->q($conn, $sql_del))
                {
                    ?>
                    <script>
                        if(confirm("Delete success, click ok button to continue."))
                        {
                            window.location.href = "/<?php echo $forumtype; ?>";
                        }
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        if(confirm("Delete Failed !"))
                        {
                            window.location.href = "/<?php echo $forumtype; ?>";
                        }
                    </script>
                    <?php
                }
            }
        }
    }
    else{
        header("Location: ../404");
    }
}
else{
    header("Location: ../404");
}
include("../_footer.php");
?>