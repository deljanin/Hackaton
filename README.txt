Setup Guide:
1. Download and install xampp, it creates a server that uses same langagues and plugins as the one on faculty. https://www.apachefriends.org/download.html
2. Run Xampp Control Panel and start Apache and MySQL. Remeber the port of apache (most likely 80)
3. Open a browser and type the following into your URL bar: localhost:80 
(If you had a different port in step 2, replace port 80 with it)
4. On the page thet opens, click "phpMyAdmin" in the upper right corner
5. Now create a new database by clicking on the "New" button on the left most panel.
6. NAME IT: sis3_php
7. Click import, then browse and select the sis3_php.sql file. Click Go at the bottom right side of the page.
8. Go to the location of your xampp installation (If you left it as default, it's the root folder of your main drive)
9. Then open folder htdocs, and create the folder where you want to store your webpages. (Example: "C:\xampp\htdocs\SIS3_PHP")
10. In the URL bar of your browser type: localhost:80/NameOfYourFolder/index.php (Example: "http://localhost:80/SIS3_PHP/index.php")
11. You are good to go, any changes in the code will be updated live on the pages displayed on the browser.

If you have any questions contact me.