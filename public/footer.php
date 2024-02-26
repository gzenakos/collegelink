
	<footer class="align-self-end bg-secondary text-white">
		<button id="scroll-to-top" class="scroll-top-trigger border rounded" style="display:none">
			<i class="fa fa-angle-up"></i>
		</button>
		<p class="text-center m-0 px-1 py-2">© Copyright CollegeLink 2020</p>
	</footer>

		<!-- <link href="https://www.collegelink.gr/wp-content/cache/autoptimize/css/autoptimize_b48c6deb9f04c4944809f82d7db0a5a8.css" type="text/css" rel="stylesheet" />
		<link href="https://www.collegelink.gr/wp-content/cache/autoptimize/css/autoptimize_827dfc3c929d13ae4138b35ca75b7689.css" type="text/css" rel="stylesheet" /> -->
		<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet"> -->
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" /> -->
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="assets/bootstrap-4.5.3/dist/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js" integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA==" crossorigin="anonymous"></script> -->

		<script src="assets/js/scripts.js?ver=<?php echo gmdate( 'ymd-Gis' ); ?>"></script>


		<?php
		switch ( basename( $_SERVER['PHP_SELF'] ) ) {
			case 'index.php':
				?>
				<script src="assets/js/index.js?ver='<?php echo gmdate( 'ymd-Gis' ); ?>'"></script>
				<?php
				break;
			case 'list.php':
				?>
				<script src="assets/js/list.js?ver='<?php echo gmdate( 'ymd-Gis' ); ?>'"></script>
				<?php
				break;
			case 'register.php':
				?>
				<script src="assets/js/register.js?ver='<?php echo gmdate( 'ymd-Gis' ); ?>'"></script>
				<?php
				break;
			case 'room.php':
				?>
				<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->
				<!-- Google Maps JavaScript API with your API key -->
				<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE_ybSSygdIcep_UlPJ76xKCAm8LdrWkg&callback=initMap" async defer></script> -->
				<script>
					(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
						key: "AIzaSyDE_ybSSygdIcep_UlPJ76xKCAm8LdrWkg",
						v: "weekly",
						// Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
						// Add other bootstrap parameters as needed, using camel case.
					});
				</script>
				<script src="assets/js/magnificpopup.js?ver='<?php echo gmdate( 'ymd-Gis' ); ?>'"></script>
				<script src="assets/js/room.js?ver='<?php echo gmdate( 'ymd-Gis' ); ?>'"></script>
				<?php
				break;
			default:

		}
		?>
	</body>
</html>
