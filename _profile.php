<?php
include("_header.php"); //Header 

?>
<div class="d-flex container justify-content-center text-dark p-4">

<?php
$bchan_user = $_GET['u'];

$realUser = $utils->realString($conn, $bchan_user);

$sql_view_user = "SELECT * FROM bchan_user WHERE bchan_username='$realUser'";

$query_user = $bchan_class->q($conn, $sql_view_user);

$fetch_user = mysqli_fetch_assoc($query_user);

if(!empty($realUser))
{
    if(mysqli_num_rows($query_user) == 1)
    {
        $bchan_name = $fetch_user['bchan_name'];
        $bchan_username = $fetch_user['bchan_username'];
        $bchan_bio = $fetch_user['bchan_bio'];
        ?>
        <div class="p-1">
            <div class="bchan-box-profile p-2 round card mt-4">
                <div class="card-body shadow shadow-sm text-dark">
                    <h4 class="bchan-profile mt-3 bchan-user-info-header text-white p-2">
                        <strong>
                            <?php echo $bchan_username; ?>
                        </strong>
                    </h4>
                    <div class="p-2">
                        Name : <?php echo $bchan_name; ?><br/>
                        Username : <?php echo $bchan_username; ?><br/>
                    </div>
                    <h5 class="mt-3 bchan-user-info-header text-white p-2">
                        <strong>Bio</strong>
                    </h5>
                    <div class="container p-2">
                        <?php echo $bchan_bio; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    else
    {
        ?>
        <div class=" container p-1 bg-danger text-light mt-5 mb-5 p-4">
            Profile with username <?php echo strip_tags($bchan_user); ?> not found !
        </div>
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
include("_footer.php");
?>