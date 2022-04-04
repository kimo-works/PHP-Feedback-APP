# Feedback
1) Make a feedback form.
The page should show all the messages left, under them the form: Name, E-mail, text, "Preview" and "Edit" buttons.
Reviews can be sorted by author's name, e-mail and date of addition (by default - by date, last at the top). There must also be validation.

2) The preview should work without reloading the page.

3) Make an administrator login (login "admin", password "123"). AdminShould be able to always have feedback. Changed reviews in the general list you use the mark "changed by administrator".

4) You can attach a picture to the review.
The image should be no larger than 320x240 percent, while it is recommended to fill in a larger image, the image should be proportionally enlarged to the specified size. Accepted formats: JPG, GIF, PNG.

5) The administrator must be able to moderate.

Those. the admin page shows reviews with image thumbnails and their status (accepted/rejected).

The review becomes visible to everyone only after it is accepted by the admin. Disapproved reviews appeared in the database, but do not have characteristic users. Changing the administrator of the picture is not required.

Requirements:
1. Use PHP 7;
2. Do not use any frameworks.
3. Use PDO traffic to connect to the database.
 

Expected Result:
1. Upload the source code to your git repository;
2. System requirements and installation instructions for our platform.
3. Dump the database in the archive to upload to git.
