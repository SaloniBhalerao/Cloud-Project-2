<?php
    require_once "../root/defaults.php";
  if(!isset($_SESSION)) session_start();

function sanitizeParameter($input) {
	return htmlspecialchars($input, ENT_QUOTES);
}


function printException($ex){
    print '<div class="alert alert-danger">'.$ex->getMessage().'</div>';
}

function getS3PreSignedURL($bucket, $key){
    include_once "../root/AwsFactory.php";

    $aws = new AwsFactory();
    $s3Client = $aws->getS3Client();
    $cmd = $s3Client->getCommand('GetObject', [
        'Bucket' => $bucket,
        'Key' => $key
    ]);
    $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
    $presignedUrl = (string)$request->getUri();
    return $presignedUrl;
}

function checkSession() {
	$relogin = false;
	if(isset($_SESSION["DatalakeUser"]) && $_SESSION["DatalakeUser"] != "" && $_SESSION["DatalakeUser"] != null) {
		if(isset($_SESSION["lastActivity"]) && (time()-$_SESSION["lastActivity"] < 1800)) {
			$_SESSION["lastActivity"] = time();
		} else {
		    $relogin = true;
			destroySession($relogin);
		}
	} else {
		destroySession($relogin);
	}
}

function destroySession($relogin=false) {
	session_unset();
	session_destroy();
	if($relogin) {
        header("location: ../home/?relogin");
    } else {
	    header("location: ../home");
    }
}

/*
function getCatalogedBuckets(){
    $buckets = array();
    require_once("../root/ConnectionManager.php");
    $connectionManager = new ConnectionManager();
    $mysqlConnector = $connectionManager->getMysqlConnector();

    $query = "SELECT * FROM "._RDS_DATABASE.".buckets";
    $result = $mysqlConnector->query($query);
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $buckets[] = $row["bucketname"];
    }

    return $buckets;
}*/

function getMenubar() {
    print '
		<!-- start of navbar -->
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="../home/">AWS Assignment</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
    if(isset($_SESSION["DatalakeUser"])) {
        checkSession();
        print '
			  <ul class="nav navbar-nav navbar-right">
			    <li>
			      <a class="t1" title="Explore S3" href="../s3/index.php?action=listObjects&bucket='._BUCKET.'">
					<span class="glyphicon glyphicon-cloud"></span> S3 Management
				  </a>
			    </li>
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle"
				        data-toggle="dropdown" role="button" aria-haspopup="true"
				        aria-expanded="false">
				        <i class="fa fa-user-o"></i>    ' .$_SESSION['DatalakeUser'].' <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
					<li>
					  <a href="../authenticate/user.php" class="" title="Profile">
					        <span class="glyphicon glyphicon-cog"></span> Profile
					  </a>
					</li>
					<li role="separator" class="divider"></li>
					<li>
					    <a href="../authenticate/logout.php" title="Logout">
					        <span class="glyphicon glyphicon-log-out"></span> Logout
					    </a>
					</li>
				  </ul>
				</li>
			  </ul>';
    } else {
        print '
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Login <span class="caret"></span>
                  </a>
				  <ul class="dropdown-menu">
					<li>
					    <a href="#" data-toggle="modal" data-target="#myLoginModal" title="Data Lake Access Login">
					        <span class="glyphicon glyphicon-user"></span> Login
					    </a>
					</li>
					<li>
					    <a href="#" class="customMessage" data-url="../authenticate/register.php" title="Register">
					        <span class="glyphicon glyphicon-edit"></span> Register
					    </a>
					</li>
				  </ul>
				</li>
			  </ul>';
    }
    print '
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<!-- end of navbar -->
	';
}

function fileTypeIcon($filename){
    $icons = array(
        "file-image-o" => ['png','gif','tif','jpg','jpeg','iff','ico','tiff','pct','pict','svg'],
        "file-archive-o" => ['a','ar','cpio','shar','iso','lbr','mar','sbx','jar','war','tar','bz2','f','gz','tgz','bz2','tbz2','tlz','lz','lzma','lzo','rz','sfark','sz','?q?','?z?','?xf','xz','z','Z','??_','.7z','.s7z','ace','afa','alz','apk','arc','cab','car','ice','lzh','lzx','pak','rar','zip','sfx','xar','zipx','rev','gzip'],
        "file-word-o" => ['doc','docm','docx','dot','dotx','acl','gdoc','mobi','odt'],
        "file-text-o" => ['text','txt','tsv','tex','pages','stw','sxw','xml','0','1st','600','602','ans','asc','epub','log','nb','css','xsl','xslt','tpl','bib','enl','ris'],
        "file-pdf-o" => ['pdf','dvi','pld','egt','pcl','ps','snp','xps'],
        "file-powerpoint-o" => ['ppt','pptx','afp','gslides','key','keynote','odt','otp','pez','prz','sti','sxi','watch'],
        "file-excel-o" => ['xls','xlsx','123','cell','csv','gsheet','numbers','gnumeric','ods','ots','xlk','xlsb','xlsm','xlr','xlt','xltm','xlw'],
        "file-audio-o" => ['wma','bwf','cdda','wav','flac','dts','mp1','mp2','mp3','aac','vox','ogg','asx','m3u'],
        "file-video-o" => ['aaf','3gp','avi','dat','flv','mpeg','mpg','m4v','mpe','wmv','mp4','swf'],
        "file-code-o" => ['c','cpp','java','py','sh','html','xhtml','phtml','mhtml','shtml','class','bat','cmd','ipynb','js','jsfl','pl','php','ps1','vbs','r','rb','cs','go','lisp','scala','asp','jsp','aspx','sql','sqlite'],
        "key" => ['pem','ppk','key','pub','ssh','gxk','cer','cert','der','bpw','kdb','kdbx']
    );
    $type = end(explode(".",$filename));
    foreach ($icons as $key=>$value){
        if(in_array(strtolower($type),$value)){
            return $key;
        }
    }
    return "file";
}

?>
