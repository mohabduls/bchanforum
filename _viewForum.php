<?php
include("_header.php");

$bchan_discussionType = $utils->realString($conn, $_GET['discussion']);
$bchan_forumType = $utils->realString($conn, $_GET['forumtype']);

if($utils->checkForumType($bchan_forumType) == false)
{
    header("Location: /");
}

$bchan_pages = 10;
$bchan_sql_count = $utils->countDiscussion($bchan_forumType, $bchan_discussionType);
$total_discussion = $utils->totalDiscussion($bchan_forumType, $bchan_discussionType);

$bchan_total_discussion = $bchan_class->q($conn, $bchan_sql_count);

$bchan_result_count = mysqli_fetch_assoc($bchan_total_discussion);
$bchan_result = $bchan_result_count['bchan_total'];
echo $bchan_result;

if(!empty($_GET['forumtype']))
{
   
    if($bchan_result == "0")
    {
        $zero = true;
    }
    else
    {
        $zero = false;
    }

    //Count total of discussion
    $count_discussion = $bchan_class->q($conn, $bchan_sql_count);
    $bchan_total_post = mysqli_num_rows($count_discussion);

    $page = isset($_GET['p']) ? (int)$_GET['p'] : 0;
    $start = ($page > 1) ? ($page * $bchan_pages) - $bchan_pages : 0;

    $pages = ceil($bchan_total_post/$bchan_pages);

    $total_pages = ceil($bchan_result/$bchan_pages);
    $total_number = 3;

    $start_number = ($page > $total_number)? $page - $total_number : 1; 
    $end_number = ($page < ($total_pages - $total_number))? $page + $total_number : $total_pages;


    ?>
    <div class="container mt-1 p-2 text-light bchan-font-header">
        <!--SHARE-->
        <div class="container mt-1 p-2 text-light bchan-font-header bchan-head-list-discussion">
            <div class="clearfix">
                <div class="float-left">
                    <h2 class="bchan-discussion-list">More about <b>#<?php echo $bchan_discussionType; ?></b></h2>
                </div>
                <div class="float-right">
                    <h2 class="bchan-discussion-list"><b><?php echo $bchan_discussionType; ?></b></h2>
                </div>
            </div>
        </div>
        <div class="container justify-content-center text-dark">
        <?php
        $query_get_post = $bchan_class->q($conn, $utils->moreDiscussion($bchan_forumType, $utils->realString($conn, $bchan_discussionType), $start, $bchan_pages));
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
                                    <a href="/more?forumtype=anime&discussion=<?php echo $bchan_discussionType; ?>" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
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
                <div class="p-1 container">
                    <ul class="pagination justify-content-center">
                        <?php
                        if($page == 1)
                        {
                            ?>
                            <li class="page-item disable"><a class="page-link" href="#">First</a></li>
                            <?php
                        }
                        else
                        {
                            $link_prev = ($page > 1) ? $page - 1 : 1;
                            
                            ?>
                            <li class="page-item"><a class="page-link" href="?forumtype=anime&discussion=<?php echo $bchan_discussionType; ?>&p=1">First</a></li>
                            <?php
                        }
                        
                        for($i = $start_number; $i <= $end_number; $i++)
                        {
                        ?>
                            <li class="page-item"><a class="page-link" href="?forumtype=anime&discussion=<?php echo $bchan_discussionType; ?>&p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }
                        if($page == $total_pages)
                        {
                            ?>
                            <li class="page-item disable"><a class="page-link" href="#">Last</a></li>
                            <?php
                        }
                        else
                        {
                            $bchan_next = ($page < $total_pages) ? $page + 1 : $total_pages;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?forumtype=anime&discussion=<?php echo $bchan_discussionType; ?>&p=<?php echo $bchan_next; ?>">Next</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?forumtype=anime&discussion=<?php echo $bchan_discussionType; ?>&p=<?php echo $total_pages; ?>">Last</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    <?php 
}
else
{
    header("Location: /notfound");
}
include("_footer.php");
?>