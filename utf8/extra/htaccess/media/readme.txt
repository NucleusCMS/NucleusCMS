PLEASE NOTE: The media.htaccess file in this directory is intended to enhance security of your server by disallowing the running of scripts from the media folder. This will protect against rogue members, or external exploits, that rely on uploading script files to this folder for execution at a later time. Depending on the configuration of your web server, this code may not run as intended. 

To apply it, follow these instructions:

1. Be sure that another .htaccess file does not exist in the /media folder
2. Copy the media.htaccess file into the media folder of your Nucleus CMS installation
3. Rename the file to .htaccess
4. If you have an existing .htaccess file in your media folder, copy the contents from the media.htaccess file into the existing .htacces file.

You can disable after installing it by renaming the file to something else, or by removing the file from that folder.