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
        // After clearing file content, reload the page
        location.reload();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
});
