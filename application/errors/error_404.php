<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: rgba(255, 89, 73, 1);
	background-color: transparent;
	border-bottom: 1px solid #eee;
	line-height:24px;
	font-size: 27px;
	margin: 0 0 14px 0;
	padding: 30px 15px 30px 15px;
	text-shadow:1px 1px #e6e6e6, 2px 2px #e6e6e6, 3px 3px #e6e6e6, 4px 4px #e6e6e6, 5px 5px #e6e6e6, 6px 6px #e6e6e6, 7px 7px #e6e6e6, 8px 8px #e6e6e6, 9px 9px #e6e6e6, 10px 10px #e6e6e6, 11px 11px #e6e6e6, 12px 12px #e6e6e6, 13px 13px #e6e6e6, 14px 14px #e6e6e6, 15px 15px #e6e6e6, 16px 16px #e6e6e6, 17px 17px #e6e6e6, 18px 18px #e6e6e6, 19px 19px #e6e6e6, 20px 20px #e6e6e6, 21px 21px #e6e6e6, 22px 22px #e6e6e6, 23px 23px #e6e6e6, 24px 24px #e6e6e6, 25px 25px #e6e6e6, 26px 26px #e6e6e6, 27px 27px #e6e6e6, 28px 28px #e6e6e6, 29px 29px #e6e6e6, 30px 30px #e6e6e6, 31px 31px #e6e6e6, 32px 32px #e7e7e7, 33px 33px #e7e7e7, 34px 34px #e8e8e8, 35px 35px #e8e8e8, 36px 36px #e9e9e9, 37px 37px #e9e9e9, 38px 38px #eaeaea, 39px 39px #eaeaea, 40px 40px #ebebeb, 41px 41px #ebebeb, 42px 42px #ececec, 43px 43px #ededed, 44px 44px #ededed, 45px 45px #eeeeee, 46px 46px #eeeeee, 47px 47px #efefef, 48px 48px #efefef, 49px 49px #f0f0f0, 50px 50px #f0f0f0, 51px 51px #f1f1f1, 52px 52px #f1f1f1, 53px 53px #f2f2f2, 54px 54px #f3f3f3, 55px 55px #f3f3f3, 56px 56px #f4f4f4, 57px 57px #f4f4f4, 58px 58px #f5f5f5, 59px 59px #f5f5f5, 60px 60px #f6f6f6, 61px 61px #f6f6f6, 62px 62px #f7f7f7, 63px 63px #f7f7f7, 64px 64px #f8f8f8, 65px 65px #f9f9f9, 66px 66px #f9f9f9, 67px 67px #fafafa, 68px 68px #fafafa, 69px 69px #fbfbfb, 70px 70px #fbfbfb, 71px 71px #fcfcfc, 72px 72px #fcfcfc, 73px 73px #fdfdfd, 74px 74px #fdfdfd, 75px 75px #fefefe, 76px 76px #ffffff;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	text-align:center;
	box-shadow: 0 0 8px #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
.meeru{
	padding:30px 15px;
	overflow:hidden;
	height:55px;
}
</style>
</head>
<body>
	<div id="container">
		<div class="meeru"><h1><?php echo $heading; ?></h1></div>
		<?php echo $message; ?>
	</div>
</body>
</html>