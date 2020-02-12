<?php
include("_header.php");

?>
<dic class="contailer-fluid p-2">
<div class="container-fluid bchan-bg-light p-2 text-dark p-t-2">
	<div id="bchan-welcome" class="d-flex justify-content-center text-light">
		<div class="p-2 text-center">
			<a href="https://bchan.my.id/" rel="follow"><img id="bchan-logo" class="bchan-logo" src="assets/bchan-logo.png" alt="bchan.my.id logo"/></a>
			<h4 class="display-4 bchan-welcome-msg">List of <strong>Anime</strong></h4>
			<p class="lead bchan-welcome-msg-lead">Anime database on <strong>Bchan Forum</strong></p>
            <form class="form-group mt-2 mb-2" action="/list">
                <input class="form-control bchan-anime-search p-2 text-light" name="q" placeholder="Type anime here...">
            </form>
		</div>
	</div>
	<h5 class="bchan-font-header text-light">Click to see Anime Details</h5>
	<div class="text-center">
		<div class="row text-light bchan-font-header shadow-sm rounded">
            <?php
            for($i = 0; $i < 100; $i++)
            {
            ?>
                <div class="col-sm-3 mb-3">
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
            <?php
            }
            ?>
		</div>
	</div>
</div>
</div>
<?php
include("_footer.php");
?>