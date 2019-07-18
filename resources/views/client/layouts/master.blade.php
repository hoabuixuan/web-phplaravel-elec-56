<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Electro Store Ecommerce | @yeild('title')</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>
	<!-- //Meta tag Keywords -->
    <base href="{{asset('')}}">
    <title>@yield('title')</title>
	<!-- Custom-Files -->
	<link href="asset/client/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="asset/client/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="asset/client/css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="asset/client/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="asset/client/css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->
    <link rel="stylesheet" href="asset/admin/css/toastr.css">
	<!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web fonts -->

</head>

<body>
	<!-- top-header -->
	@include('client.layouts.header-top')

	<!-- Button trigger modal(select-location) -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="select-city">
			<h3>
				<i class="fas fa-map-marker"></i> Please Select Your Location</h3>
			<select class="list_of_cities">
				<optgroup label="Popular Cities">
					<option selected style="display:none;color:#eee;">Select City</option>
					<option>Birmingham</option>
					<option>Anchorage</option>
					<option>Phoenix</option>
					<option>Little Rock</option>
					<option>Los Angeles</option>
					<option>Denver</option>
					<option>Bridgeport</option>
					<option>Wilmington</option>
					<option>Jacksonville</option>
					<option>Atlanta</option>
					<option>Honolulu</option>
					<option>Boise</option>
					<option>Chicago</option>
					<option>Indianapolis</option>
				</optgroup>
				<optgroup label="Alabama">
					<option>Birmingham</option>
					<option>Montgomery</option>
					<option>Mobile</option>
					<option>Huntsville</option>
					<option>Tuscaloosa</option>
				</optgroup>
			</select>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //shop locator (popup) -->

	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('client.login')}}" method="post">
                        @csrf
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng nhập">
                        </div>
                        <div class="right-w3l">
							<a href="{{route('login.social','facebook')}}" class="form-control btn btn-primary">Đăng nhập với facebook</a>
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" name="remember" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Nhớ mật khẩu?</label>
							</div>
						</div>
						<p class="text-center dont-do mt-3">Bạn chưa có tài khoản?
							<a href="#" data-toggle="modal" data-target="#register">
								Đăng ký ngay</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="Route [register] not defined" method="post">
						<div class="form-group">
							<label class="col-form-label">Họ và tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ và tên ..." name="name" required="">
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{$erros->first(name)}}
                                </div>
                            @endif
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email ..." name="email" required="">
                            @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                {{$erros->first(email)}}
                            </div>
                        @endif

						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu ..." name="password" id="password1" required="">
                            @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                {{$erros->first(password)}}
                            </div>
                        @endif

						</div>
						<div class="form-group">
							<label class="col-form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="confirm_Password" id="password2" required="">
                            @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                {{$erros->first(confirm_Password)}}
                            </div>
                        @endif

						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control register" value="Register">
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing2">
								<label class="custom-control-label" for="customControlAutosizing2">Đồng ý với <a href="">điều khoản </a>của chúng tôi</label>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->

	<!-- header-bottom-->
	@include('client.layouts.header-bottom')
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->
	@include('client.layouts.menu')
	<!-- //navigation -->

    <!-- banner -->
	@yield('slide')
	<!-- //banner -->

	<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			@yield('content')
		</div>
	</div>
	<!-- //top products -->

	<!-- middle section -->

	<!-- middle section -->

	<!-- footer -->
    @include('client.layouts.footer')

	<!-- js-files -->
	<!-- jquery -->
	<script src="asset/client/js/jquery-2.2.3.min.js"></script>
	<!-- //jquery -->
	<!-- popup modal (for location)-->
	<script src="asset/client/js/jquery.magnific-popup.js"></script>
	<!-- cart-js -->
	<script src="asset/client/js/minicart.js"></script>
	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- scroll seller -->
	<script src="asset/client/js/scroll.js"></script>
	<!-- //scroll seller -->

	<!-- smoothscroll -->
	<script src="asset/client/js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="asset/client/js/move-top.js"></script>
	<script src="asset/client/js/easing.js"></script>
	<!-- for bootstrap working -->
	<script src="asset/client/js/bootstrap.js"></script>
	<script src="asset/client/js/custom.js"></script>
    <script src="asset/admin/js/toastr.min.js"></script>
    @if(session('success'))
        <script>
            messageSuccess('{{session('success')}}');
        </script>
    @endif
    @if(session('error'))
        <script>
            messageError('{{session('error')}}');
        </script>
    @endif
	<!-- //for bootstrap working -->
	<!-- //js-files -->
</body>

</html>
