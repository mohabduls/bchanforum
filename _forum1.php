<?php
include("_header.php");
date_default_timezone_set("Asia/Jakarta");
$current_time = date("l, d F Y, h:i:s A");
$forum_name = "Anime";
$bchan_thismonth = date("m");
$bchan_thisyear = date("y");

?>
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="text-light bchan-forum-header">
            Welcome to <b><?php echo $forum_name; ?></b> Forum!
        </div>
        <div class="float-right">
            <?php
            if(!empty($_SESSION['bchan_user']))
            {
                ?>
                <button class="btn btn-sm bchan-btn-background" data-toggle="collapse" data-target="#makeDiscussion">Make a Discussion</button>
                <?php
            }
            else
            {
                ?>
                <p>You are currently not Loged in.<br/>
                If you don't have a Bachan account, you can try to <a class="text-light" href="/signup"><strong>Sign up</strong></a>.</p>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
if(!empty($_SESSION['bchan_user']))
{
    ?>
    <?php
    if(isset($_POST['bchan_submit_discussion']))
    {
        $discussion_title = $utils->realString($conn, $_POST['bchan_discussion_title']);
        $discussion_owner = $utils->realString($conn, $_SESSION['bchan_user']);
        $discussion_tag = $utils->realString($conn, $_POST['bchan_tag']);
        $discussion_description = $utils->filterHTML($utils->realString($conn, $_POST['bchan_description']));

        
        
        //check available tag for security reason
        $sql_check_tag = "SELECT * FROM bchan_tag WHERE bchan_tag='$discussion_tag'";
        $sql_save_discussion = "INSERT INTO bchan_forum1 (bchan_discussion_owner, bchan_discussion_title, bchan_discussion_content, bchan_discussion_tag, bchan_discussion_date, bchan_discussion_month, bchan_discussion_year) VALUES ('$discussion_owner', '$discussion_title', '$discussion_description', '$discussion_tag', '$current_time', '$bchan_thismonth', '$bchan_thisyear')";
        $query_check_tag = $bchan_class->q($conn, $sql_check_tag);
        if(mysqli_num_rows($query_check_tag) == 1)
        {
            ?>
            <div class="container bchan-form text-center border border-0 rounded">
                <?php
                if($bchan_class->q($conn, $sql_save_discussion))
                {
                    header("Refresh: 2; URL=/anime");
                    ?>
                    <div class="bg-success p-2">
                        <p class="text-white">Your discussion has been posted!</p>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="bg-danger p-2">
                        <p class="text-white">Something wrong! : <?php echo mysqli_error($conn); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
    ?>
    <div class="container bg-light p-2">
        <div id="makeDiscussion" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <form class="form-group bchan-form" aaction="/user" method="POST">
                    <label for="bchan_discussion_title">Title</label>
                    <input type="text" name="bchan_discussion_title" class="form-control" required="true">

                    <label for="bchan_tag">Tag</label>
                    <select name="bchan_tag" class="form-control">
                    <?php
                    //Get All Tag From Database
                    $sql_get_tag = "SELECT * FROM bchan_tag";
                    $query_get_tag = $bchan_class->q($conn, $sql_get_tag);
                    while($bchan_list_tag = mysqli_fetch_assoc($query_get_tag))
                    {
                        $tag = $bchan_list_tag["bchan_tag"];
                        ?>
                        <option><?php echo $tag ?></option>
                        <?php

                    }
                    ?>
                    </select>

                    <label for="bchan_description">Description</label>
                    <textarea id="bchan_description" class="form-control bchan-editor" name="bchan_description" placeholder="You can write a description like Asking some Name of the Anime, Sharing the anime, Give a Recomendation, Or share Info about Anime"></textarea>
                    <div class="clearfix">
                        <div class="float-left mt-2">
                            <div>
                                Before making a Discussion, Please read this
                                <strong><a href"#" class="btn btn-sm btn-info text-light" data-toggle="modal" data-target="#rulesModal">Rules</a></strong>
                            </div>
                        </div>
                        <div class="float-right mt-2">
                            <input type="submit" name="bchan_submit_discussion" class="btn btn-sm bchan-btn-background" value="Submit Discussion">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
else
{

}
if(isset($_GET['did']) AND isset($_GET['ft']))
{
    include("_view.php");
}
?>

<!--Trending Post This Month-->
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h2 class="bchan-discussion-list"><b>Trending Discussion on This Month</b></h2>
        </div>
        <div class="float-right">
            <h2 class="bchan-discussion-list"><a href="#" class="text-light"><strong>#TRENDING</strong></a></h2>
        </div>
    </div>
</div>
<div class="container justify-content-center text-dark">
<?php
$sql_get_post_recomendation = "SELECT * FROM bchan_forum1 WHERE bchan_discussion_month='$bchan_thismonth' AND bchan_discussion_year='$bchan_thisyear' ORDER BY bchan_hits DESC LIMIT 5";
$query_get_post = $bchan_class->q($conn, $sql_get_post_recomendation);
if(mysqli_num_rows($query_get_post) == 0)
{
    ?>
    <div class="text-dark text-center p-1">
        <h4 class="bchan-font-header">This forum currently not have any discussion yet.</h4>
    </div>
    <?php
}
else
{
    
    ?>
    <div class="row mb-2 mt-1">
        <?php
        while($bchan_discussion = mysqli_fetch_assoc($query_get_post))
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_title']));
            $dis_content = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_content']));
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            //Discussion ID
            $dis_id = $bchan_discussion['forum_id'];

            //Limit Title
            if(strlen($dis_title) > 70)
            {
                $titleCut = substr($dis_title, 0, 70);
                $endTitle = strrpos($dis_title, " ");

                $dis_title = $endTitle ? substr($titleCut, 0, $endTitle) : substr($titleCut, 0);
                $dis_title .= "...";
            }

            //Limit Discussion Content
            if(strlen($dis_content) > 150)
            {
                $disCut = substr($dis_content, 0, 150);
                $endContent = strrpos($dis_content, " ");

                $dis_content = $endContent ? substr($disCut, 0, $endContent) : substr($disCut, 0);
                $dis_content .= "...";
            }

            ?>
            <div class="col-sm-12 card">
                <div class="card-body p-2">
                    <div class="p-1">
                        <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="text-dark"><strong><?php echo $dis_title; ?></strong></a>
                        <br/>
                        <?php echo htmlspecialchars($dis_content); ?>
                    </div>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="/more?forumtype=anime&discussion=RECOMENDATION" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span>
                            <br/>
                            <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="float-right text-info">Read more..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>

<!--RECOMENDATION-->
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h2 class="bchan-discussion-list"><b>Recomendation Post</b></h2>
        </div>
        <div class="float-right">
            <h2 class="bchan-discussion-list"><a href="/more?forumtype=anime&discussion=RECOMENDATION" class="text-light"><strong>#RECOMENDATION</strong></a></h2>
        </div>
    </div>
</div>
<div class="container justify-content-center text-dark">
<?php
$sql_get_post_recomendation = "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#RECOMENDATION' ORDER BY forum_id DESC LIMIT 5";
$query_get_post = $bchan_class->q($conn, $sql_get_post_recomendation);
if(mysqli_num_rows($query_get_post) == 0)
{
    ?>
    <div class="text-dark text-center p-1">
        <h4 class="bchan-font-header">This forum currently not have any discussion yet.</h4>
    </div>
    <?php
}
else
{
    
    ?>
    <div class="row mb-2 mt-1">
        <?php
        while($bchan_discussion = mysqli_fetch_assoc($query_get_post))
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_title']));
            $dis_content = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_content']));
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            //Discussion ID
            $dis_id = $bchan_discussion['forum_id'];

            //Limit Title
            if(strlen($dis_title) > 70)
            {
                $titleCut = substr($dis_title, 0, 70);
                $endTitle = strrpos($dis_title, " ");

                $dis_title = $endTitle ? substr($titleCut, 0, $endTitle) : substr($titleCut, 0);
                $dis_title .= "...";
            }

            //Limit Discussion Content
            if(strlen($dis_content) > 150)
            {
                $disCut = substr($dis_content, 0, 150);
                $endContent = strrpos($dis_content, " ");

                $dis_content = $endContent ? substr($disCut, 0, $endContent) : substr($disCut, 0);
                $dis_content .= "...";
            }

            ?>
            <div class="col-sm-12 card">
                <div class="card-body p-2">
                    <div class="p-1">
                        <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="text-dark"><strong><?php echo $dis_title; ?></strong></a>
                        <br/>
                        <?php echo htmlspecialchars($dis_content); ?>
                    </div>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="/more?forumtype=anime&discussion=RECOMENDATION" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span>
                            <br/>
                            <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="float-right text-info">Read more..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>

<!--ASk-->
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h2 class="bchan-discussion-list"><b>People who asking some question.</b></h2>
        </div>
        <div class="float-right">
        <h2 class="bchan-discussion-list"><a href="/more?forumtype=anime&discussion=ASK" class="text-light"><strong>#ASK</strong></a></h2>
        </div>
    </div>
</div>
<div class="container justify-content-center text-dark">
<?php
$sql_get_post_ask = "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#ASK' ORDER BY forum_id DESC LIMIT 5";
$query_get_post = $bchan_class->q($conn, $sql_get_post_ask);
if(mysqli_num_rows($query_get_post) == 0)
{
    ?>
    <div class="text-dark text-center p-1">
        <h4 class="bchan-font-header">This forum currently not have any discussion yet.</h4>
    </div>
    <?php
}
else
{
    
    ?>
    <div class="row mb-2 mt-1">
        <?php
        while($bchan_discussion = mysqli_fetch_assoc($query_get_post))
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_title']));
            $dis_content = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_content']));
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            //Discussion ID
            $dis_id = $bchan_discussion['forum_id'];

            //Limit Title
            if(strlen($dis_title) > 70)
            {
                $titleCut = substr($dis_title, 0, 70);
                $endTitle = strrpos($dis_title, " ");

                $dis_title = $endTitle ? substr($titleCut, 0, $endTitle) : substr($titleCut, 0);
                $dis_title .= "...";
            }

            //Limit Discussion Content
            if(strlen($dis_content) > 150)
            {
                $disCut = substr($dis_content, 0, 150);
                $endContent = strrpos($dis_content, " ");

                $dis_content = $endContent ? substr($disCut, 0, $endContent) : substr($disCut, 0);
                $dis_content .= "...";
            }

            ?>
            <div class="col-sm-12 card">
                <div class="card-body p-2">
                    <div class="p-1">
                        <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="text-dark"><strong><?php echo $dis_title; ?></strong></a>
                        <br/>
                        <?php echo htmlspecialchars($dis_content); ?>
                    </div>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="/more?forumtype=anime&discussion=ASK" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span>
                            <br/>
                            <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="float-right text-info">Read more..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>

<!--INFO-->
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h2 class="bchan-discussion-list"><b>People who give some Info about Anime.</b></h2>
        </div>
        <div class="float-right">
        <h2 class="bchan-discussion-list"><a href="/more?forumtype=anime&discussion=INFO" class="text-light"><strong>#INFO</strong></a></h2>
        </div>
    </div>
</div>
<div class="container justify-content-center text-dark">
<?php
$sql_get_post_ask = "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#INFO' ORDER BY forum_id DESC LIMIT 5";
$query_get_post = $bchan_class->q($conn, $sql_get_post_ask);
if(mysqli_num_rows($query_get_post) == 0)
{
    ?>
    <div class="text-dark text-center p-1">
        <h4 class="bchan-font-header">This forum currently not have any discussion yet.</h4>
    </div>
    <?php
}
else
{
    
    ?>
    <div class="row mb-2 mt-1">
        <?php
        while($bchan_discussion = mysqli_fetch_assoc($query_get_post))
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_title']));
            $dis_content = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_content']));
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            //Discussion ID
            $dis_id = $bchan_discussion['forum_id'];

            //Limit Title
            if(strlen($dis_title) > 70)
            {
                $titleCut = substr($dis_title, 0, 70);
                $endTitle = strrpos($dis_title, " ");

                $dis_title = $endTitle ? substr($titleCut, 0, $endTitle) : substr($titleCut, 0);
                $dis_title .= "...";
            }

            //Limit Discussion Content
            if(strlen($dis_content) > 150)
            {
                $disCut = substr($dis_content, 0, 150);
                $endContent = strrpos($dis_content, " ");

                $dis_content = $endContent ? substr($disCut, 0, $endContent) : substr($disCut, 0);
                $dis_content .= "...";
            }

            ?>
            <div class="col-sm-12 card">
                <div class="card-body p-2">
                    <div class="p-1">
                        <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="text-dark"><strong><?php echo $dis_title; ?></strong></a>
                        <br/>
                        <?php echo htmlspecialchars($dis_content); ?>
                    </div>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="/more?forumtype=anime&discussion=INFO" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span>
                            <br/>
                            <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="float-right text-info">Read more..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>

<!--SHARE-->
<div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
    <div class="clearfix">
        <div class="float-left">
            <h2 class="bchan-discussion-list"><b>People who have Share an Anime or something.</b></h2>
        </div>
        <div class="float-right">
        <h2 class="bchan-discussion-list"><a href="/more?forumtype=anime&discussion=SHARE" class="text-light"><strong>#SHARE</strong></a></h2>
        </div>
    </div>
</div>
<div class="container justify-content-center text-dark">
<?php
$sql_get_post_ask = "SELECT * FROM bchan_forum1 WHERE bchan_discussion_tag='#SHARE' ORDER BY forum_id DESC LIMIT 5";
$query_get_post = $bchan_class->q($conn, $sql_get_post_ask);
if(mysqli_num_rows($query_get_post) == 0)
{
    ?>
    <div class="text-dark text-center p-1">
        <h4 class="bchan-font-header">This forum currently not have any discussion yet.</h4>
    </div>
    <?php
}
else
{
    
    ?>
    <div class="row mb-2 mt-1">
        <?php
        while($bchan_discussion = mysqli_fetch_assoc($query_get_post))
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_title']));
            $dis_content = strip_tags($utils->filterHTML($bchan_discussion['bchan_discussion_content']));
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            //Discussion ID
            $dis_id = $bchan_discussion['forum_id'];

            //Limit Title
            if(strlen($dis_title) > 70)
            {
                $titleCut = substr($dis_title, 0, 70);
                $endTitle = strrpos($dis_title, " ");

                $dis_title = $endTitle ? substr($titleCut, 0, $endTitle) : substr($titleCut, 0);
                $dis_title .= "...";
            }

            //Limit Discussion Content
            if(strlen($dis_content) > 150)
            {
                $disCut = substr($dis_content, 0, 150);
                $endContent = strrpos($dis_content, " ");

                $dis_content = $endContent ? substr($disCut, 0, $endContent) : substr($disCut, 0);
                $dis_content .= "...";
            }

            ?>
            <div class="col-sm-12 card">
                <div class="card-body p-2">
                    <div class="p-1">
                        <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="text-dark"><strong><?php echo $dis_title; ?></strong></a>
                        <br/>
                        <?php echo htmlspecialchars($dis_content); ?>
                    </div>
                    <div class="clearfix">
                        <div class="float-right">
                            <a href="/more?forumtype=anime&discussion=SHARE" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span>
                            <br/>
                            <a href="/anime?did=<?php echo $dis_id; ?>&ft=anime" class="float-right text-info">Read more..</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
</div>
<?php
include("_rules.php");
include("_footer.php");
?>