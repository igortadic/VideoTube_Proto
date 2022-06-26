<?php
require_once("includes/classes/VideoInfoControls.php");

class VideoInfoSection {
  private $con, $video, $userLoggedInObj;

  public function __construct($con, $video, $userLoggedInObj) {
    $this->con = $con;
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
  }

  public function create() {
    return $this->createPrimaryInfo() . $this->createSecondaryInfo();
  }

  private function createPrimaryInfo() {
    $title = $this->video->getTitle();
    $video = $this->video->getViews();

    $VideoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
    $controls = $VideoInfoControls->create();

    return "<div class = 'videoInfo'>
      <h1>$title</h1>
      <div class='bottomSection'>
        <span class='videwCount'>$views</span>
        $controls
      </div>
    </div>";
  }

  private function createSecondaryInfo() {

  }

}
?>
