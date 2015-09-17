<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bayer</title>
    <!--<script src="js/shared/jquery-2.1.3.min.js"></script>
    <script src="js/shared/angular.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.angularjs.org/1.2.28/angular.min.js"></script>
    <script src="https://code.angularjs.org/1.2.28/angular-route.min.js"></script>
    <script src="https://code.angularjs.org/1.2.28/angular-sanitize.min.js"></script>
    <script src="/esto-esta-pasando/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="/esto-esta-pasando/js/shared/ui-bootstrap-0.13.0.min.js"></script>-->
    <script src="/esto-esta-pasando/js/jquery.bxslider.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/esto-esta-pasando/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/esto-esta-pasando/css/style.css">
    <link rel="stylesheet" type="text/css" href="/esto-esta-pasando/css/jquery.bxslider.css">
    <base href="/esto-esta-pasando/">
</head>
<body ng-app="BayerHappeningApp">
    <div class="container-fluid">
        <?php include 'views/header.html'; ?>
        <div ng-view></div>
        <?php include 'views/footer.html'; ?>
    </div>
    <input type="hidden" id="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>"
    <!-- Modules -->
    <script src="js/app.js"></script>
    <!-- Controllers -->
    <script src="js/controllers/HomeController.js"></script>
    <script src="js/controllers/NewsController.js"></script>
    <script src="js/controllers/NewsDetailController.js"></script>
    <script src="js/controllers/AlbumsController.js"></script>
    <script src="js/controllers/AlbumsDetailController.js"></script>
    <script src="js/controllers/VideosController.js"></script>
    <script src="js/controllers/VideosDetailController.js"></script>
    <!-- Services -->
    <script src="js/services/HomeServices.js"></script>
    <script src="js/services/NewsServices.js"></script>
    <script src="js/services/AlbumsServices.js"></script>
    <script src="js/services/VideosServices.js"></script>
    <script src="js/services/RatingService.js"></script>
</body>
</html>