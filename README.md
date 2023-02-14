# ip-grabber-php
This PHP Code will grab many things like IP of the User, Country, Browser, OS, Timezone, ISP, UserAgent, Host and more!

## Installation for Linux Server
1. Create a Webhook in your Discord Server
2. Go in *index.php* and change $webhookurl to your webhook url
3. Change in the file the name for the Discord Bot/Webhook and add a website where the user should get delivered after grabbing their information
4. Go in your Linux Server
5. Install Apache (apt install apache2)
6. Put the index.php in "/var/www/html"
7. Install PHP (apt install php7.4)
8. Install curl (apt install php7.4-curl)
9. Test it! (Open on your browser the IP Adress of your Server)

## Functions
Grabs:
- IP
- Browser
- Useragent
- Date
- Time
- Host
- Country
- approximate City, Region and Zip
- Approximate Lat & Lon
- Timezone
- ISP
- OS

**If the user is a Discord Bot there will be a warning in the Message!**

## Example
![image](https://user-images.githubusercontent.com/92023913/218865198-82374dc4-8b9a-4e8f-be1e-74bc1c645468.png)
