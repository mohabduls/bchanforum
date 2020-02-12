<?php
include("_header.php");

$list_page = array("privacy-policy","disclaimer","about-us");

if(isset($_GET['page']))
{
    
    $page = $_GET['page'];
    if(!in_array($page, $list_page))
    {
        header("Location: /404");
    }

    if($page == "privacy-policy")
    {
        $title_page = "Privacy Policy";
    }
    elseif($page == "disclaimer")
    {
        $title_page = "Disclaimer";
    }
    elseif($page == "about-us")
    {
        $title_page = "About Us";
    }
    ?>
    <div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
        <div class="clearfix">
            <div class="float-left">
                <h2 class="bchan-discussion-list"><b><?php echo $title_page; ?></b></h2>
            </div>
            <div class="float-right">
                <h2 class="bchan-discussion-list"><strong>Bchan Forum</strong></h2>
            </div>
        </div>
    </div>
    <div class="container justify-content-center text-dark">
        <div class="card">
            <div class="card-body">
                <?php

                switch($page)
                {
                    case "privacy-policy":{
                        include("page/privacy-policy.html");
                    }
                    break;
                    case "disclaimer":{
                        include("page/disclaimer.html");
                    }
                    break;
                    case "about-us":{
                        include("page/about-us.html");
                    }
                    break;
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
else{
    header("Location: /404");
}
?>
<?php
include("_footer.php");
?>