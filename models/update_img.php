<?php

// This is a simplified example, which doesn't cover security of uploaded images.
// This example just demonstrate the logic behind the process.

// files storage folder
$dir = '../assets/images/update-campaign/';
$files = [];
$types = ['image/png', 'image/jpg', 'image/jpeg', 'image/JPG'];

if (isset($_FILES['file']))
{
    foreach ($_FILES['file']['name'] as $key => $name)
    {
        $type = strtolower($_FILES['file']['type'][$key]);
        if (in_array($type, $types))
        {
            // setting file's mysterious name
            $filename = md5(date('YmdHis'));
            $path = $dir.$filename.'.jpg';

            // copying
            move_uploaded_file($_FILES['file']['tmp_name'][$key], $path);

            $files['file-'.$key] = array(
                'url' => 'http://localhost/admin_dompet/assets/images/update-campaign/'.$filename.'.jpg'
            );
        }
    }
}

echo stripslashes(json_encode($files));