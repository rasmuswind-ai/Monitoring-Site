<?php
$fileDirectory = 'D:/Apache/Apache24/htdocs/assets/files/';
$fileName = 'status_' . exec('powershell [int](Get-Date -UFormat %s -Millisecond 0)') . '.txt'; // Appending current timestamp to file name for cache busting

$filePath = $fileDirectory . $fileName;

// Clear file content and rename
if(file_put_contents($filePath, 'No container alerts') !== false) {
    echo "File content cleared successfully and renamed to $fileName";
} else {
    echo "Error clearing file";
}
?>
