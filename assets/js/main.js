
function fetchNewestFile() {
    fetch('http://<ip>/assets/php/fetchNewestFile.php')
        .then(response => {
            if(!response.ok) {
                throw new Error('Network response was not OK');
            }
            return response.json(); // Parse JSON response
        })
        .then(data => {
            // Check if response contains newest path
            if(data && data.newestFile) {
                // Extract filename from path
                const fileName = data.newestFile.split('/').pop();
                // Construct new url with IP
                const ipAddress = '<ip>'
                const newFilePath = `http://${ipAddress}/assets/files/${fileName}`;
                // Fetch newest file content
                fetch(newFilePath)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network was not OK')
                        }
                        return response.text()
                    })
                    .then(fileContent => {
                        // Replace line breaks with <br>
                        fileContent = fileContent.replace(/\n/g, '<br>');
                        // Update file content on webpage
                        document.querySelector('.file-content').innerHTML = fileContent;
                    })
                    .catch(error => {
                        console.error('There was a problem with fetching file content:', error);
                    });
            } else {
                console.error('No newest file path found');
            }
        })
        .catch(error => {
            console.error('There was a problem with fetching the newest file path:', error)
        })
}

// Call function to fetch newest file path
fetchNewestFile()

// Event listener for button click to clear file content
document.getElementById('button').addEventListener('click', () => {
    fetch('http://<ip>/assets/php/clear-file.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not OK');
        }
        // After clearing file content, fetch updated content
        fetchNewestFile();
        return response.text();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});
