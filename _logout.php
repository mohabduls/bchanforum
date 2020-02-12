<?php
include("_header.php");
?>
<div class="d-flex justify-content-center bg-light text-dark">
	<div class="jumbotron jumbotron-fluid bg-light p-2 mb-2 mt-2">
        <?php
        if(empty($_SESSION['bchan_user']))
        {
            ?>
            <script>
                window.location.href = "/login";
            </script>
            <?php
        }
        else
        {
            if(isset($_GET['user']))
            {
                switch ($_GET['user']) 
                {
                    case 'logout':
                    {
                        session_destroy();
                        ?>
                        You are loged out, This page will redirect to homepage in 3 second.
                        <script>
                            var delay = 3000;
                            setTimeout(function(){
                                window.location.href = "/login";
                            }, delay);
                        </script>
                        <?php
                        break;
                    }				
                }
            }
        }
        ?>
    </div>
</div>
<?php
include("_footer.php");