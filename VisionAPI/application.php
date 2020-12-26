<?php
require 'vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;
class Application
{

    private $NewImagePath = "";
    private $BaseUrl = "http://demo.enginyenice.com/";
    private $ImagePath = "";


    public function ObjectDetection($ImagePath = "",$type = "")
    {

        $this->ImagePath = $ImagePath;
        $vision = new VisionClient(['keyFile' => json_decode(file_get_contents("key.json"),true)]);
        $dog = fopen($this->ImagePath,'r');
        $img = $vision->image($dog,['OBJECT_LOCALIZATION']);
        $objects = $vision->annotate($img);
        $info = $objects->info();
        $objectsDetail = $info['localizedObjectAnnotations'];
        $AllCords = $this->AllCords($objectsDetail);
        $drawObjectsCords = array();
        $objectName = array();

        foreach ($AllCords as $objectCords){
            array_push($drawObjectsCords,$this->MaxMinCords($objectCords));
        }
        $colorAndTitle = $this->ImageTitlePush($this->ImageDraw($this->ImagePath,$drawObjectsCords,$type,$this->ObjectNameDetected($objectsDetail)),$this->ObjectNameDetected($objectsDetail));

        $result = Array();
        array_push($result,Array(
            "path"  => $this->BaseUrl.$this->NewImagePath,
            "detail" => $colorAndTitle
        ));
        $json = json_encode($result);
        return $json;



    }
    private function ImageTitlePush($ImageResult,$ObjectDetectedNames){
        $AllData = Array();
        for($i = 0; $i< count($ObjectDetectedNames);$i++){
            array_push($AllData,array(
                "title" => $ObjectDetectedNames[$i],
                "red"   => $ImageResult["colorPalete"][$i]["red"],
                "green"   => $ImageResult["colorPalete"][$i]["green"],
                "blue"   => $ImageResult["colorPalete"][$i]["blue"],
            ));
        }
        return $AllData;
    }
    private function ObjectNameDetected(Array $objectsDetails)
    {
        $objectsName = Array();
        foreach ($objectsDetails as $detail){
            array_push($objectsName,$detail['name']);
        }

        return $objectsName;
    }
    private function MaxMinCords(Array $cords){
        $drawCords = array(
            "minX" => $this->MinSearch($cords['X']),
            "minY" => $this->MinSearch($cords['Y']),
            "maxX" => $this->MaxSearch($cords['X']),
            "maxY" => $this->MaxSearch($cords['Y']),

        );
        return $drawCords;
    }
    private function AllCords($objectsDetails){

        $allCords = Array();
        foreach ($objectsDetails as $detail){
            array_push($allCords,array(
                "X"  => array(
                    "0" => $detail['boundingPoly']["normalizedVertices"][0]["x"],
                    "1" => $detail['boundingPoly']["normalizedVertices"][1]["x"],
                    "2" => $detail['boundingPoly']["normalizedVertices"][2]["x"],
                    "3" => $detail['boundingPoly']["normalizedVertices"][3]["x"],
                ),
                "Y"  => array(
                    "0" => $detail['boundingPoly']["normalizedVertices"][0]["y"],
                    "1" => $detail['boundingPoly']["normalizedVertices"][1]["y"],
                    "2" => $detail['boundingPoly']["normalizedVertices"][2]["y"],
                    "3" => $detail['boundingPoly']["normalizedVertices"][3]["y"],
                ),

            ));
        }
        return $allCords;
    }
    private function PrintObject(Array $objectsDetails)
    {
        foreach ($objectsDetails as $detail){
            echo $detail['boundingPoly']["normalizedVertices"][0]["x"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][0]["y"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][1]["x"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][1]["y"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][2]["x"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][2]["y"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][3]["x"]."</br>";
            echo $detail['boundingPoly']["normalizedVertices"][3]["y"]."</br>";
            echo "#################################</br>";
        }
    }
    private function ImageDraw($path = "",Array $cords,$type = "", Array $objectsName)
    {


        $image_info = getimagesize($this->ImagePath);
        $W  = $image_info[0];
        $H  = $image_info[1];
        switch ($type){
            case "jpg":
                $clouds = imagecreatefromjpeg($this->ImagePath);
                break;
            case "jpeg":
                $clouds = imagecreatefromjpeg($this->ImagePath);
                break;
            case "png":
                $clouds = imagecreatefrompng ($this->ImagePath);
                break;
            default:
                throw new \Exception('Unexpected value');

        }
        imagesetthickness($clouds, 10); //Kalem kalınlığı

        $colorPalete = array();
        foreach ($cords as $key=> $cord){
            $cord["minX"] =$cord["minX"] * $W;
            $cord["minY"] =$cord["minY"] * $H;
            $cord["maxX"] =$cord["maxX"] * $W;
            $cord["maxY"] =$cord["maxY"] * $H;
            $Red    = rand(0,255);
            $Green  = rand(0,255);
            $Blue   = rand(0,255);
            $randColor   = imagecolorallocate($clouds, $Red , $Green, $Blue);
            imagerectangle($clouds,  $cord["minX"],  $cord["minY"], $cord["maxX"], $cord["maxY"], $randColor);


            /*
            imagestring($clouds, 14, ($cord["minX"] + $cord["maxX"]) / 2, $cord["minY"], $objectsName[0] , $randColor);
            ------------------

            imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )

            */
            $font_color =  0x000000;
            $font = './arial.ttf';


            $width = $cord["maxX"]-$cord["minX"];
            $height = $cord["maxY"]-$cord["minY"];
            $size = ($width * $height) /5000;

            imagettftext ($clouds,$size,0,$cord["minX"]+$size,$cord["minY"]+$size,$font_color,$font,$objectsName[$key]);

            array_push($colorPalete,Array(
                "red"   => $Red,
                "green" => $Green,
                "blue"  => $Blue
            ));
        }
        $uniqName = uniqid();
        $imagePath = "detectedImages/".$uniqName.".".$type;
        imagepng($clouds,$imagePath);
        imagedestroy($clouds);

        $result = array(
            "colorPalete"   => $colorPalete
        );

        $this->NewImagePath = $imagePath;
        return $result;


    }
    private  function MinSearch(Array $cords){
        $min = 99999999999999;
        for($i = 0; $i < count($cords);$i++){
            if($cords[$i] < $min)
                $min = $cords[$i];
        }
        return $min;
    }
    private  function MaxSearch(Array $cords){

        $max = -1;
        for($i = 0; $i < count($cords);$i++){
            if($cords[$i] > $max)
                $max = $cords[$i];
        }
        return $max;
    }
    public function GetBaseUrl(){
        return $this->BaseUrl;
    }

}



