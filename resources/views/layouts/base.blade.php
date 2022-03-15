<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<title>Surface Media</title>	
    @include('layouts.partials.styles')
	@livewireStyles
</head>
<body class="home-page home-01 ">

	@include('layouts.partials.header')

	{{ $slot }}

	@include('layouts.partials.footer')
	
	@include('layouts.partials.scripts')
	@livewireScripts
</body>
</html>