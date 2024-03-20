### Simple Monitoring webpage for backend display

This simple webpage was created for testing, utilizing cache busting and backend scripts such as php.

The following php scripts: 
  - clear-file.php
  - fetchNewestFile.php
has been created to bypass the caching issue of showing live data to a webpage.

By utilizing the fetchNewestFile.php after the clear-file.php script has run and renamed the file, the fetchNewestFile.php will retrieve all files in the specified directory and list the newest file.
This is then parsed as simple JSON, so that it can be imported by the main.js script to send it to the webpage, thus bypassing the cache.

### How is it bypassing the cache?
By renaming the file each time it gets cleared, we can use this and change the path of the data file in javascript to trick the browser to thinking it's an entirely new file, thus the browser will have to download that "new" file to cache.
This gives you an immediate update on the webpage that reflects the newest data from the specific file
