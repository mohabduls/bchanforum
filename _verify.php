<?php
include("_header.php");

?>
<div class="d-flex container justify-content-center text-light p-4">
<?php
if(!empty($_GET['u']))
{
    $bchan_username_base64 = base64_decode($_GET['u']);
    $bchan_username = $utils->realString($conn, $bchan_username_base64);
    $query_check_user = $bchan_class->q($conn, $utils->checkUser($bchan_username));
    if(mysqli_num_rows($query_check_user) == 1)
    {
        if($bchan_class->q($conn, $utils->verifyUser($bchan_username)))
        {
            ?>
            <div class="p-3 card text-light bg-success">
                <div class="card-body">
                    <p>Your account has been Verified!</p>
                    Page will be redirect in 3 second.
                </div>
            </div>
            <script>
				var delay = 2000;
				setTimeout(function(){
				window.location.href = "/login";
				}, delay);
			</script>
            <?php
        }
        else
        {
            ?>
            <div class="p-3 card text-light bg-danger">
                <div class="card-body">
                    <p>Can't verify your Account!</p>
                    Page will be redirect in 3 second.
                </div>
            </div>
            <script>
				var delay = 2000;
				setTimeout(function(){
				window.location.href = "/login";
				}, delay);
			</script>
            <?php
        }
    }
    else
    {
        ?>
        <script>
            window.location.href = "/";
        </script>
        <?php
    }
    ?>
</div>
<?php
}
else
{
    ?>
    <script>
        window.location.href = "/";
    </script>
    <?php
}
include("_footer.php");
?>