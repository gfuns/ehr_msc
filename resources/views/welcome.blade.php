<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{asset("assets/images/favicon.PNG")}}">
	<link rel="stylesheet" href="{{asset("nkst/bootstrap/css/bootstrap.css")}}">
	<link rel="stylesheet" href="{{asset("nkst/uikit/css/uikit.css")}}">
	<link rel="stylesheet" href="{{asset("nkst/styles.css")}}">
	<title>MediStore | Your Decentralized Electronic Health Record Management Software</title>
</head>
<body>

	<div class="container">
		<div class="headline uk-text-center">
			<p style="font-size:36px"><b>MEDISTORE</b></p>
            <p style="margin-top: 20px">Your Decentralized Electronic Health Record Management Software</p>
		</div>
		<div class="wrapper">
			<div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-flex-center" uk-grid>
				<div>
					<div class="uk-card uk-card-primary uk-card-body" style="background: linear-gradient(#1e87f0, #14599e)">
						<h3 class="uk-card-title" style="text-align: center; margin-bottom:55px">PATIENTS</h3>
						
                        <p class="card-link uk-text-right">
							<a href="/onboard-patients">
								Create An Account <i uk-icon="arrow-right"></i>
							</a>
						</p>
					</div>
				</div>
				<div>
					<div class="uk-card uk-card-secondary uk-card-body" style="background: linear-gradient(#af7ac5, #6c3483)">
						<h3 class="uk-card-title" style="text-align: center">HEALTH CARE PROVIDERS</h3>
						<p class="card-link uk-text-right">
							<a href="/onboard-care-providers">
								Create An Account  <i uk-icon="arrow-right"></i>
							</a>
						</p>
					</div>
				</div>
				
			</div>
		</div>
		<div class="wrapper">
			<div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l uk-flex-center" uk-grid style="margin-top: 150px">
				<a href="/login"><center><button class="btn btn-success btn-md">&nbsp;&nbsp;LOGIN TO YOUR ACCOUNT&nbsp;&nbsp;</button></center></a>
			</div>
		</div>
	</div>

	<script src="{{asset("nkst/jquery/jquery.min.js")}}"></script>
	<script src="{{asset("nkst/bootstrap/js/bootstrap.min.js")}}"></script>
	<script src="{{asset("nkst/uikit/js/uikit.min.js")}}"></script>
	<script src="{{asset("nkst/uikit/js/uikit-icons.min.js")}}"></script>

</body>

</html>