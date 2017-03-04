<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(!isset($_SESSION['token_info']))
        $_SESSION['token_info'] = null;
}

if (isset($_GET['token'])) {
    echo "<pre>";
    print_r($_SESSION['token']);
    echo "</pre>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph Explorer (powered by Office365 REST client)</title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
    <link href="content/site.css" rel="stylesheet"/>
    <link rel="stylesheet" href="bower_components/jquery-jsonview/dist/jquery.jsonview.css" />
    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/jquery-jsonview/dist/jquery.jsonview.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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


        function initJSONViewer(jsonResult) {
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
            showRaw(jsonResult)
        }


        function populareRequestList(authorityUrl) {
            $('#requestList option').val(function (i, text) {
                return authorityUrl + $(this).val();
            });
        }

        var token_info = <?php echo json_encode($_SESSION['token_info']); ?>;


        $(function() {

            var isAuthenticated = <?php echo json_encode(isset($_SESSION['auth_ctx']));  ?>;

            if(isAuthenticated) {
                $("li#nodeSignIn").hide();
                $("li#nodeSignOut").show();
                $("li#nodeTenantInfo").show();
                $("li#nodeTenantInfo").text(token_info.unique_name);
                var tenantName = token_info.unique_name.split("@")[1];
                var authorityUrl = $("#boxQuery").val() + "/" + tenantName + "/";
                $("#boxQuery").val(authorityUrl);
                populareRequestList(authorityUrl);
            }
            else {
                $("#resultPanel").hide();
                $("li#nodeSignIn").show();
                $("li#nodeSignOut").hide();
                $("li#nodeTenantInfo").hide();
            }

            $("#resultPanel").hide();
            $("#btnSubmitRequest").click(function(){
                var queryTextEnc = encodeURIComponent($("#boxQuery").val());
               $.getJSON("ProcessQuery.php?text=" + queryTextEnc)
                   .done(function (result){
                        //console.log(result);
                       $("#resultPanel").show();
                       initJSONViewer(result);
                   });
            });
        });





    </script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Graph Explorer</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="https://msdn.microsoft.com/en-us/Library/Azure/Ad/Graph/api/api-catalog">Documentation</a>
                </li>
                <li id="nodeSignIn">
                    <a href="SignIn.php" id="loginLink">Sign in</a>
                </li>
                <li class="navbar-text" id="nodeTenantInfo">
                </li>
                <li id="nodeSignOut">
                    <a href="SignOut.php" >Sign out</a>
                </li>
            </ul>

        </div>
    </div>
</div>
<div class="container body-content">
    <br />

    <datalist id="requestList">
        <option value="applications"></option>
        <option value="users"></option>
        <option value="servicePrincipals"></option>
        <option value="devices"></option>
        <option value="groups"></option>
        <option value="contacts"></option>
        <option value="tenantDetails"></option>
        <option value="directoryRoles"></option>
        <option value="directoryRoleTemplates"></option>
        <option value="oauth2PermissionGrants"></option>
        <option value="subscribedSkus"></option>
        <option value="reports"></option>
    </datalist>

    <!-- This is the form part of the page.-->
        <div class="input-group">
            <div class="input-group-btn">
                <button id="btnSubmitRequest" type="button" class="btn btn-default" >Submit</button>
            </div>
            <input type="text" id="boxQuery" value="https://graph.windows.net" class="form-control" placeholder="Query" list="requestList">
        </div>
    <div id="resultPanel">
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
        <pre class="panel-body" style="max-height: 65vh; overflow-y: scroll;" id="json"></pre>
        <pre class="panel-body" style="max-height: 65vh; overflow-y: scroll;" id="jsonRaw"></pre>
    </div>
    <br />
    <hr />
    <footer>
        Powered by <a href="https://github.com/vgrem/phpSPO">phpSPO</a>
    </footer>
</div>
</body>
</html>