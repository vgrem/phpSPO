<?php


use Office365\PHP\Client\GraphClient\ActiveDirectoryClient;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

require_once '../bootstrap.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$response = null;
$authorityUrl = "https://graph.windows.net";
$requestUrl = $authorityUrl;
$tenantInfo = array(
    "UserName" => null,
    "Name" => null
);


if(isset($_SESSION['auth_ctx'])) {

    $accessToken = $_SESSION['auth_ctx']->getAccessToken();
    $tenantInfo["LoginName"] = $accessToken->id_token_info["unique_name"];
    list($username, $tenantInfo["Name"]) = explode('@', $tenantInfo["LoginName"]);
    $requestUrl = $authorityUrl . "/" . $tenantInfo["Name"] . "/";
    $client = new ActiveDirectoryClient($_SESSION['auth_ctx']);


    if (isset($_GET['text'])) {
        $requestUrl = $_GET['text'];
        $request = new RequestOptions($_GET['text']);
        $request->Url .= "?api-version=1.0";
        $response = $client->executeQueryDirect($request);
        $requestUrl = $_GET['text'];
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph Explorer (powered by Office365 REST client)</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet"/>
    <link href="Content/site.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <link rel="stylesheet" href="https://rawgithub.com/yesmeck/jquery-jsonview/master/dist/jquery.jsonview.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="https://rawgithub.com/yesmeck/jquery-jsonview/master/dist/jquery.jsonview.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Graph Explorer</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="https://msdn.microsoft.com/en-us/Library/Azure/Ad/Graph/api/api-catalog">Documentation</a>
                </li>
                <?php if(!isset($_SESSION['auth_ctx'])){ ?>
                <li>
                    <a href="SignIn.php" id="loginLink">Sign in</a>
                </li>
                <?php } else { ?>
                <li class="navbar-text">
                    <?php echo $tenantInfo["LoginName"]; ?>
                </li>
                <li>
                    <a href="SignOut.php" >Sign out</a>
                </li>
                <?php } ?>
            </ul>

        </div>
    </div>
</div>
<div class="container body-content">


    <br />
    <datalist id="languages">
    </datalist>

    <!-- This is the form part of the page.-->
    <form method="GET" action="">
        <div class="input-group">
            <span class="input-group-addon"><input type="submit" value="GET" name=UrlRequest /></span>
            <input type="text" name="text" value="<?php echo $requestUrl;?>" class="form-control" placeholder="Username" list="languages">
        </div>
    </form>
    <?php if(isset($response)) { ?>
        <script>

            function showJson(jsonResult) {
                document.getElementById('json').style.display = 'block';
                document.getElementById('jsonRaw').style.display = 'none';
                $('#json').JSONView(jsonResult);
                $('#expand-btn').prop('disabled', false);
                $('#collapse-btn').prop('disabled', false);
                $('#raw-btn').prop('disabled', false);
                $('#json-btn').prop('disabled', true);
                //$('#raw-btn').addClass("btn-primary");
                //$('#json-btn').removeClass('btn-success');
            }

            function showRaw(jsonResult) {
                document.getElementById('json').style.display = 'none';
                document.getElementById('jsonRaw').style.display = 'block';
                document.getElementById('jsonRaw').innerHTML = JSON.stringify(jsonResult, null, 2);
                $('#raw-btn').prop('disabled', true);
                $('#json-btn').prop('disabled', false);
                $('#expand-btn').prop('disabled', true);
                $('#collapse-btn').prop('disabled', true);
                //$('#raw-btn').addClass("btn-success");
                //$('#json-btn').removeClass('btn-primary');
            }

            $(function() {

                var jsonResult = <?php echo $response ?>;

                $('#json-btn').on('click', function () {
                    showJson(jsonResult);
                });

                $('#collapse-btn').on('click', function () {
                    $('#json').JSONView('collapse');
                });

                $('#expand-btn').on('click', function () {
                    $('#json').JSONView('expand');
                });

                $('#raw-btn').on('click', function () {
                    showRaw(jsonResult);
                });

                showRaw(jsonResult);

            });



        </script>
        <br />
        <div class="row">
            <div class="col-md-6">

                <!--div id="DurationText">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default">Request duration:</button>
                        <button type="button" class="btn btn-default btn-success" id="time-btn"> milliseconds</button>
                    </div>
                </div-->
            </div>
            <div class="col-md-6" align="right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" id="collapse-btn" disabled="">Collapse</button>
                    <button type="button" class="btn btn-default" id="expand-btn" disabled="">Expand</button>
                    <button type="button" class="btn btn-default btn-success" id="raw-btn" disabled="">Raw</button>
                    <button type="button" class="btn btn-default" id="json-btn">JSON</button>
                </div>
            </div>
        </div>
        <br />
    <div id="resultPanel">
        <pre class="panel-body" style="max-height: 65vh; overflow-y: scroll;" id="json"></pre>
        <pre class="panel-body" style="max-height: 65vh; overflow-y: scroll;" id="jsonRaw"></pre>
    </div>
    <?php } ?>
    <br />
    <hr />
    <footer>
        Powered by <a href="https://github.com/vgrem/phpSPO">phpSPO</a>
    </footer>
</div>
</body>
</html>