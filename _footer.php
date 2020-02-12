</div>
<footer id="sticky-footer" class="bchan-bg-foot text-light text-50">
	<div class="row text-center p-2 py-4">
		<div class="col-sm m-2">
			<h5>About us</h5>
			<a class="text-light" href="/"><strong>Bchan (Bacod Chan)</strong></a> is an Anime forum website, you can share something related to Japan. Recommend a content, ask questions, and provide information to the entire contents of the forum.
		</div>
		<div class="col-sm m-2 bchan-foot-row-border">
			<h5>Social Media</h5>
			We don't have any social media yet, keep follow <strong>Bchan Forum</strong> for Update Notice !
		</div>
		<div class="col-sm m-2 bchan-foot-row-border">
			<h5>Create an Account</h5>
			To post content, you need a <strong>Bachan</strong> account. immediately create a Bchan account on the <a href="/signup" class="text-light"><strong>Sign Up</strong></a> page!
		</div>
	</div>
    <div class="container-fluid p-3 text-center bchan-bg-copyright">
    	<small>Copyright &copy; 2020 <a href="/" class="text-light"><strong>Bchan Forum</strong></a> All Right Reserved - <a href="/about-us" class="text-light"><strong>About Bchan</strong></a></small> - <small><a href="/privacy-policy" class="text-light"><strong>Privacy Policy</strong></a></small> - <small><a href="/disclaimer" class="text-light"><strong>Disclaimer</strong></a></small> - <small><a href="tel:+62-882-2265-3664" class="text-light"><strong>Contact: +6288222653664</strong></a></small>
    </div>
</footer>

<?php
if($bchan_admin == true)
{
	include("_modaladd-anime.php");
}
?>

<!--jQuery-->
<script>
CKEDITOR.replace( 'bchan_description',{
	filebrowserUploadUrl: 'system/bchan_upload.php',
    filebrowserUploadMethod: 'form'
} );
</script>
<script id="dsq-count-scr" src="//bacodchan.disqus.com/count.js" async></script>
</body>
</html>