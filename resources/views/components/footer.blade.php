		{{-- Create the manifest file dynamically --}}
		<script>
		setTimeout(() => {
		  var myDynamicManifest = {
		    "name": "{{ config('app.name') }}",
		    "short_name": "{{ config('app.name') }}",
		    "description": "We make websites and handle marketing for entrepreneurs, artists, and small businesses.",
		    "start_url": "{{ config('app.url') }}",
		    "background_color": "#f3f3f3",
		    "theme_color": "#eb4647",
		    "icons": [{
		      "src": "{{ config('app.url').config('blog.favicon_url') }}",
		      "sizes": "256x256",
		      "type": "image/png"
		    }]
		  }
		  const stringManifest = JSON.stringify(myDynamicManifest);
		  const blob = new Blob([stringManifest], {type: 'application/javascript'});
		  const manifestURL = URL.createObjectURL(blob);
		  document.querySelector('#manifest').setAttribute('href', manifestURL);
		}
		, 1);
		</script>


		<!-- STAY - Scripts -->
		<script src="https://js.stripe.com/v3/"></script>

{{-- 		<script src="{{ mix('js/manifest.js') }}"></script>
 --}}
{{-- 		<script src="{{ mix('js/vendor.js') }}"></script>
 --}}
		<script src="{{ mix('js/app.js') }}"></script>

   		@yield('footer_scripts')
	</body>
</html>
