<?php
require __DIR__ . "/../vendor/autoload.php";
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature\Type;

function detect_label($path, $outFile = null)
{
    $check_label  = [
        "Face",
        "Eye",
        "Hair",
        "Lip",
        "Skin",
        "Eyebrow",
        "Nose",
        "Beauty",
        "Chin",
        "Cheek",
        "Head",
        "Forehead",
        "Long hair",
        "Short hair",
        "Hairstyle"
    ];
    $client = new ImageAnnotatorClient();

    # annotate the image
    // $path = 'path/to/your/image.jpg'
    $image = fopen($path, 'r');
    var_dump($path);
    $annotation = $client->annotateImage($image, [Type::FACE_DETECTION, Type::LABEL_DETECTION]);
    $faces = ($annotation->getFaceAnnotations());
    $labels = ($annotation->getLabelAnnotations());
   
    $num_label = 0;
    if ($labels) {
        foreach ($labels as $label) {
            // var_dump($label->getDescription());
            if(in_array($label->getDescription(), $check_label)){
                $num_label++;
            }
        }
        // var_dump($num_label);
        if($num_label > 1){
            return true;
        }
    }
    if(count($faces) > 0){
        var_dump(count($faces));
        return true;
    }
    return false;
}
