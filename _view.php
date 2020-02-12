<?php
$forum_type = $utils->realString($conn, $_GET['ft']);
$discussion_id = $utils->realString($conn, $_GET['did']);
$bchan_hits = $utils->getHits($forum_type, $discussion_id);

$bchan_admin = $controls->areYouAdmin();

if(!empty($bchan_hits))
{
    $bchan_hitsquery = $bchan_hits;
}
else
{
    header("Location: /");
}
?>
<div class="container">
<?php
if(isset($_GET['did']) AND isset($_GET['ft']))
{
    $query_get_hits = $bchan_class->q($conn, $bchan_hitsquery);
    $fetch_hits = mysqli_fetch_assoc($query_get_hits);
    $bchan_current_hits = $fetch_hits['bchan_hits']+1;
    if(mysqli_num_rows($query_get_hits) == 0)
    {
        
    }
    else
    {
        //Update Hits Discussion
        if(!$bchan_class->q($conn, $utils->addHits($forum_type, $discussion_id, $bchan_current_hits)))
        {
            ?>
            <div class="container p-2 bg-warning">
                Something wrong while update hits !<br/>
                <?php echo mysqli_error($conn); ?>
            </div>
            <?php
        }

        $query_discussion = $bchan_class->q($conn, $utils->forumType($forum_type, $discussion_id));
        $bchan_discussion = mysqli_fetch_assoc($query_discussion);
        if(mysqli_num_rows($query_discussion) == 1)
        {
            $dis_owner = $bchan_discussion['bchan_discussion_owner'];
            $dis_title = $bchan_discussion['bchan_discussion_title'];
            $dis_content = $bchan_discussion['bchan_discussion_content'];
            $dis_tag = $bchan_discussion['bchan_discussion_tag'];
            $dis_date = $bchan_discussion['bchan_discussion_date'];
            $dis_id = $bchan_discussion['forum_id'];

            $sql_hits = "UPDATE bchan_user";
            ?>
            <div class="mb-2 card">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="bchan-font-header bchan-title-header"><strong><?php echo htmlentities($dis_title); ?></strong></h1>
                            <?php echo $dis_content; ?>
                        </div>
                        <div class="float-right">
                            <a href="#" class="float-right text-dark"><strong><?php echo $dis_tag; ?></strong></a><br/>
                            <span class="float-right bchan-text-owner">by <a href="profile?u=<?php echo $dis_owner; ?>"><strong><?php echo $dis_owner; ?></strong></a></span><br/>
                            <span class="float-right text-secondary">on <strong><?php echo $dis_date; ?></strong></span><br/>
                            Viewed by <strong><?php echo $bchan_current_hits; ?></strong> Bchan Users
                            <?php

                            if($bchan_admin == true)
                            {
                                ?>
                                    <span class="float-right text-secondary"><a href="/bchan-action-handle?control=del&pid=<?php echo $dis_id; ?>&forumtype=<?php echo $forum_type; ?>"><strong>DELETE</strong></a></span></span>
                                <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
                <div id="disqus_thread"></div>
                    <script>

                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://bacodchan.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            <?php
        }
        else
        {
            ?>
            <div class="bg-danger p-2">
                <p class="text-white">Thread are not found or deleted by Bachan Moderator!</p>
            </div>
            <?php
        }
    }
    
    
}
else
{

}

?>
</div>