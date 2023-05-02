<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Verifikasi Pendaftaran Akun ASR Furniture</title>
	<style>
		.flexbox-container {
			display: flex;
			justify-content: center;
			align-items: center;
			text-align: center;
			background-color: white;
			padding-bottom: 30px;
			box-shadow: 5px 5px 5px 0.2px rgb(104, 103, 103);
			margin-top: 20px;
		}

		.myButton {
			box-shadow: inset 0px 1px 0px 0px #00c120;
			background: linear-gradient(to bottom, #00c120 5%, #00c120 100%);
			background-color: #00c120;
			border-radius: 3px;
			border: 1px solid #00c120;
			display: inline-block;
			cursor: pointer;
			color: white;
			font-family: Arial;
			font-size: 13px;
			padding: 6px 24px;
			text-decoration: none;
			text-shadow: 0px 1px 0px #00c120;
		}

		.myButton:hover {
			background: linear-gradient(to bottom, #00c120 5%, #00c120 100%);
			background-color: #00c120;
		}

		.myButton:active {
			position: relative;
			top: 1px;
		}
	</style>
</head>

<body>
	<div class="flexbox-container">
		<div class="mt-4">
			<div class="card text-center">
				<div class="card-body">
					<h2 class="card-title">
						Verifikasi Pendaftaran Akun ASR Furniture
					</h2>
					<p class="card-text">
						Link ini akan expired setelah : <span id="countdown"></span> menit
					</p>
					<div class="text-center">
						<a href="<?= $verification_link ?>" class="myButton">Verifikasi</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var duration = 300, // 5 menit dalam detik
				display = document.getElementById("countdown");
			resumeCountdown(duration, display);
		});

		function startCountdown(duration, display) {
			var timer = duration,
				minutes,
				seconds;
			setInterval(function() {
				minutes = parseInt(timer / 60, 10);
				seconds = parseInt(timer % 60, 10);

				minutes = minutes < 10 ? "0" + minutes : minutes;
				seconds = seconds < 10 ? "0" + seconds : seconds;

				display.textContent = minutes + ":" + seconds;

				if (--timer < 0) {
					timer = duration;
					// lakukan sesuatu ketika countdown selesai
					// contohnya, redirect ke halaman lain
					// window.location.href = "https://example.com";
				}
			}, 1000);
		}

		function saveCountdownTime(timer) {
			var now = new Date().getTime(),
				countdownTime = new Date(now + timer * 1000);
			document.cookie =
				"countdown=" +
				countdownTime +
				"; expires=" +
				countdownTime.toUTCString() +
				"; path=/";
		}

		function resumeCountdown(duration, display) {
			var now = new Date().getTime(),
				countdownTime = new Date(
					document.cookie.replace(
						/(?:(?:^|.*;\s*)countdown\s*\=\s*([^;]*).*$)|^.*$/,
						"$1"
					)
				).getTime(),
				timer = Math.floor((countdownTime - now) / 1000);
			saveCountdownTime(duration);

			if (timer > 0) {
				startCountdown(timer, display);
			}
		}
	</script>
</body>

</html>