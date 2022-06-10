<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 500000000;
    private $allowedTypes = array("flv", "mp4", "webm", "vob", "ogv", "avi", "wmv", "mov", "mpeg", "mpg", "mkv");

    public function __construct($con) {
        $this->con = $con;
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;

        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //uploads/videos/5aa3e9343c9ffdogs_playing.flv

        $tempFilePath = str_replace(" ", "_", $tempFilePath);

        $isValidData = $this->processData($videoData, $tempFilePath);

        if(!$isValidData) {
          return false;
        }

        if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)) {
          echo "File moved successfully";
        }
    }

    private function processData($videoData, $filePath) {
        $videoType = pathInfo($filePath, PATHINFO_EXTENSION);

        if(!$this->isValidSize($videoData)) {
          echo "File too large. Can't be more than ". $this->sizeLimite . "bytes";
          return false;
        }
        else if(!$this->isValidType($videoType)) {
          echo "Invalid file type";
          return false;
        }
        else if($this->hasError($videoData)) {
          echo "Error code: " . $videoData["error"];
          return false;
        }

        return true;
    }

    private function isValidSize($data) {
      return $data["size"] <= $this->sizeLimit;
    }

    private function isValidType($type) {
      $lowercased = strtolower($type);
      return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data) {
      return $data["error"] != 0;
    }
}
?>
