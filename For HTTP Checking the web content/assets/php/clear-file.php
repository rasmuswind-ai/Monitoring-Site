<?php
// Load HTML file
$html = file_get_contents('D:\Apache\Apache24\htdocs\index.html');

// Create DOMDocument object
$dom = new DOMDocument();
@$dom->loadHTML($html); // Suppress warnings during HTML parsing

// Create DOMXPath object
$xpath = new DOMXPath($dom);

// Find span element you want to replace
$spanNode = $xpath->query('//span[@id="file-content"]')->item(0);

if ($spanNode) {
    // Create new span element
    $newSpan = $dom->createElement('span');
    $newSpan->setAttribute('id', 'file-content');
    $newSpan->setAttribute('class', 'file-content');

    // Set new content for the span
    $newSpan->nodeValue = 'No Container Alerts';

    // Replace old span with the new one
    if ($spanNode->parentNode) {
        $spanNode->parentNode->replaceChild($newSpan, $spanNode);
    }

    // Find parent figure element
    if ($spanNode->parentNode) {
        $figureNode = $spanNode->parentNode;
        while ($figureNode && $figureNode->nodeName !== 'figure' && $figureNode->parentNode) {
            $figureNode = $figureNode->parentNode;
        }

        // Close figure tag if it exists
        if ($figureNode && $figureNode->nodeName == 'figure') {
            $closingFigureTag = $dom->createTextNode('</figure>');
            $figureNode->appendChild($closingFigureTag);
        }
    }

    // Save modified HTML
    $modifiedHtml = $dom->saveHTML();

    // Write modified HTML back to the file
    file_put_contents('D:\Apache\Apache24\htdocs\index.html', $modifiedHtml);

    echo 'Span replaced successfully.';
} else {
    echo 'Span not found.';
}
?>
