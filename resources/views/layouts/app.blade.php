@include('layouts.partials.header')
<!-- Toastr css -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">
            @include('layouts.partials.navbar')
            <!-- Main Sidebar Container -->
            @include('layouts.partials.aside')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                    @yield('content')
                
            </div>
            <!--end of Content Wrapper. Contains page content -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
			@if(Session::has('message'))
			var type = "{{ Session::get('alert-type', 'info') }}";
			switch(type){
				case 'info':
					toastr.info("{{ Session::get('message') }}");
					break;

				case 'warning':
					toastr.warning("{{ Session::get('message') }}");
					break;

				case 'success':
					toastr.success("{{ Session::get('message') }}");
					break;

				case 'error':
					toastr.error("{{ Session::get('message') }}");
					break;
			}
			@endif
		</script>
</body>
</html>
