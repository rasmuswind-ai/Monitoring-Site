<?php
$fileDirectory = 'D:/Apache/Apache24/htdocs/assets/files/';
// Get list of files in dir
$files = scandir($fileDirectory, SCANDIR_SORT_DESCENDING);

// Find newest file (excluding dirs)
$newestFile = null;
foreach($files as $file) {
    $filePath = $fileDirectory . $file;
    if(is_file($filePath)) {
        $newestFile = $filePath;
        break;
    }
}

if($newestFile) {
    // Output the newest file path as JSON
    echo json_encode(['newestFile' => $newestFile]);
} else {
    echo json_encode(['error' => 'No files found in directory']);
}
?>
