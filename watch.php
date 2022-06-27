<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoInfoSection.php");

if(!isset($_GET["id"])) {
  echo "Page not found";
  exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();
?>
<script src="assets/js/videoPlayerActions"></script>


<div class="watchLeftColumn">
<?php
  $videoPlayer = new VideoPlayer($video);
  echo $videoPlayer->create(true);

  $videoPlayer = new VideoInfoSection($con, $video, $userLoggedInObj);
  echo $videoPlayer->create(true);
?>
</div>

<div class="suggestions">

</div>

<?php require_once("includes/footer.php"); ?>
