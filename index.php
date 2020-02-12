<?php
include("_header.php");

$bchan_thismonth = date("m");
$bchan_thisyear = date("y");
//lets write a code
?>
<div class="container bchan-bg-light p-2 text-dark p-t-2">
	<div id="bchan-welcome" class="d-flex justify-content-center text-light">
		<div class="p-2 text-center">
			<a href="https://bchan.my.id/" rel="follow"><img id="bchan-logo" class="bchan-logo" src="assets/bchan-logo.png" alt="bchan.my.id logo"/></a>
			<h4 class="display-4 bchan-welcome-msg">Welcome to <strong>Bchan Forum!</strong></h4>
			<p class="lead bchan-welcome-msg-lead"><strong>Bchan Forum</strong> is an anime lovers community!</p>
		</div>
	</div>
	<h5 class="bchan-font-header text-light">Chose Discussion Category Of Forum :</h5>
	<div class="text-center">
		<div class="row text-light bchan-font-header shadow-sm rounded">
			<div class="col-sm-4 mb-3">
				<a href="anime" class="text-light bchan-link">
					<div class="card bchan-card-anime">
						<div class="card-body">
							<h4 class="card-title"><strong>Anime</strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for Anime discussion.
					</div>
				</a>
			</div>
			<div class="col-sm-4 mb-3">
				<a href="#" class="text-light bchan-link">
					<div class="card bchan-card-manga">
						<div class="card-body">
							<h4 class="card-title"><strong><del>Manga (Soon!)</del></strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for manga discussion.
					</div>
				</a>
			</div>
			<div class="col-sm-4 mb-3">
				<a href="#" class="text-light bchan-link">
					<div class="card bchan-card-japanese">
						<div class="card-body">
							<h4 class="card-title"><strong><del>Japanese / Culture (Soon!)</del></strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for Japanese / Culture discussion.
					</div>
				</a>
			</div>
			<!--card 2-->
			<div class="col-sm-4 mb-3">
				<a href="#" class="text-light bchan-link">
					<div class="card bchan-card-anime">
						<div class="card-body">
							<h4 class="card-title"><strong><del>Live Action (Soon!)</del></strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for Live Action discussion.
					</div>
				</a>
			</div>
			<div class="col-sm-4 mb-3">
				<a href="#" class="text-light bchan-link">
					<div class="card bchan-card-manga">
						<div class="card-body">
							<h4 class="card-title"><strong><del>Film (Soon!)</del></strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for Film discussion.
					</div>
				</a>
			</div>
			<div class="col-sm-4 mb-3">
				<a href="#" class="text-light bchan-link">
					<div class="card bchan-card-japanese">
						<div class="card-body">
							<h4 class="card-title"><strong><del>Others (Soon!)</del></strong></h4>
						</div>
					</div>
					<div class="card-text bchan-card-content p-3 text-dark">
						This category is for out of topic discussion.
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<!--Trending Post This Month on Anime Forum-->
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
<script>
$("#bchan-logo").fadeIn(3000);
</script>
<?php

include("_footer.php");
?>