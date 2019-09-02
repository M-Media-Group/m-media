		{{-- Create the manifest file dynamically --}}
		<script>
		setTimeout(() => {
		  var myDynamicManifest = {
		    "name": "{{ config('app.name') }}",
		    "short_name": "{{ config('app.name') }}",
		    "description": "We make websites and handle your marketing on the French Riviera.",
		    "start_url": "{{ config('app.url') }}",
		    "background_color": "#f3f3f3",
		    "theme_color": "#eb4647",
		    "icons": [{
		      "src": "{{ config('app.url').config('blog.logo_url') }}",
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

{{-- 		<!-- STAY - Scripts -->
		<script src="{{ asset('js/manifest.js') }}" defer></script>

		<script src="{{ asset('js/vendor.js') }}" defer></script>

		<script src="{{ asset('js/app.js') }}" defer></script> --}}

   		@yield('footer_scripts')
	</body>
</html>
