$(function () {
	var canvas = document.getElementById("scratch");
	var ctx = canvas.getContext("2d");
	var lastX;
	var lastY;
	var mouseX;
	var mouseY;
	var canvasOffset = $("#scratch").offset();
	var offsetX = canvasOffset.left;
	var offsetY = canvasOffset.top;
	var isMouseDown = false;


	//@khadkamhn
	$('body,html').bind('selectstart', function () { return false })
	// var centerX = canvas.width / 2;
	// var centerY = canvas.height / 2;
	var generate = function () {
		ctx.globalCompositeOperation = "source-over";

		// Menggambar persegi panjang
		var squareWidth = window.innerWidth * 1.8;  // Lebar persegi panjang 80% dari lebar layar
		var squareHeight = window.innerHeight * 2.8;  // Tinggi persegi panjang 80% dari tinggi layar
		var squareX = (canvas.width - squareWidth) / 2;  // Pusatkan secara horizontal
		var squareY = (canvas.height - squareHeight) / 2;  // Pusatkan secara vertikal
		// Membuat gradasi abu-abu dari kanan ke kiri
		var gradientGray = ctx.createLinearGradient(squareX + squareWidth, squareY, squareX, squareY);
		gradientGray.addColorStop(0.30, "#827f7f");  // Warna terang pada akhir gradasi abu-abu
		gradientGray.addColorStop(0.40, "#c2c0c0");  // Warna terang pada akhir gradasi abu-abu
		gradientGray.addColorStop(0.50, "#827f7f");  // Warna gelap pada awal gradasi abu-abu
		gradientGray.addColorStop(0.60, "#c2c0c0");  // Warna terang pada akhir gradasi abu-abu
		gradientGray.addColorStop(0.70, "#827f7f");  // Warna gelap pada awal gradasi abu-abu
		// Mengisi persegi panjang dengan gradasi abu-abu
		ctx.fillStyle = gradientGray;
		ctx.fillRect(squareX, squareY, squareWidth, squareHeight);

		//ctx.fillStyle = "#ccc";
		//Pattern
		var img = document.createElement("canvas"),
			img_ctx = img.getContext('2d'),
			x, y,
			number,
			opacity = 1;
		img.width = 45;
		img.height = 45;
		for (x = 0; x < img.width; x++) {
			for (y = 0; y < img.height; y++) {
				number = Math.floor(Math.random() * 80);
				img_ctx.fillStyle = "rgba(" + number + "," + number + "," + number + "," + opacity + ")";
				img_ctx.fillRect(x, y, 1, 1);
			}
		}
		var png = document.createElement("img");
		png.setAttribute('src', img.toDataURL("image/png"));
		png.setAttribute('width', 45);
		png.setAttribute('height', 45);
		var pat = img_ctx.createPattern(png, "repeat");
		ctx.fillStyle = pat;
		//Pattern
		ctx.fill();
		ctx.font = "45px arial black";
		ctx.fillStyle = "#595555";
		ctx.fillText("GOSOK DISINI", 120, 63);

		// var coupons = ['<b>Selamat!</b>code anda : 45a4sd8xw8q8'];
		// var coupon = coupons[Math.floor(Math.random() * coupons.length)];
		// $('.message').html(coupons);
	}

	generate();
	$('.coupon-create').on('click', generate);

	function handleMouseDown(e) {
		mouseX = parseInt(e.clientX - offsetX);
		mouseY = parseInt(e.clientY - offsetY);
		lastX = mouseX;
		lastY = mouseY;
		isMouseDown = true;
	}
	function handleMouseUp(e) {
		mouseX = parseInt(e.clientX - offsetX);
		mouseY = parseInt(e.clientY - offsetY);
		isMouseDown = false;
	}
	function handleMouseOut(e) {
		mouseX = parseInt(e.clientX - offsetX);
		mouseY = parseInt(e.clientY - offsetY);
		isMouseDown = false;
	}
	function handleMouseMove(e) {
		mouseX = parseInt(e.clientX - offsetX);
		mouseY = parseInt(e.clientY - offsetY);
		if (isMouseDown) {
			ctx.beginPath();
			ctx.globalCompositeOperation = "destination-out";
			ctx.arc(lastX, lastY, 30, 0, Math.PI * 2, false);
			ctx.fill();
			lastX = mouseX;
			lastY = mouseY;
		}
	}
	$("#scratch").mousedown(function (e) { handleMouseDown(e); });

	$("#scratch").mousedown(function (e) { handleMouseDown(e); });
	$("#scratch").mousemove(function (e) { handleMouseMove(e); });
	$("#scratch").mouseup(function (e) { handleMouseUp(e); });
	$("#scratch").mouseout(function (e) { handleMouseOut(e); });
	$('.scratch').removeAttr('style');
});
