<?php
require_once("includes/classes/ButtonProvider.php");
class VideoInfoControls {

  private $video, $userLoggedInObj;

  public function __construct($video, $userLoggedInObj) {
    $this->video = $video;
    $this->userLoggedInObj = $userLoggedInObj;
  }

  public function create() {

    $likeButton= $this->createLikeButton();
    $dislikeBUtton= $this->createDislikeButton();

    return "<div class='controls>
      $likeButton
      $dislikeBUtton
    </div>'"
  }

  private function createLikeButton() {
    $text = $this->video->getLikes();
    $videoId = $this->video->getId();
    $action = "likeVideo(this, $videoId)";
    $class = "likeButton";

    $imageSrc = "assets/images/icons/thumb-up.png";

    return ButtonProvided::createButton($text, $imageSrc, $action, $class);
  }

  private function createDislikeButton() {
    "<button>Dislike</button>";
  }
}
?>