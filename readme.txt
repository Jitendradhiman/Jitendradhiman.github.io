basic steps for managing github. Every command starts with $ and the action is described below the command. I assume the working directory on the local host is mygithub. You should also notice that you will have two copies of github files one on your local machine and another on github server to work with. 
--- making clone to the local machine ---- 
cd to mygithub and run the following command to get the github material in mygithub directory.
$ git clone address 
where address is the clone address obtained by clicking on download clone option on github main page.
This makes a copy of github files in mygithub.
Now you can make changes, add some new files (if u wish) in mygithub and then next step is to push it to the github server. Run the following commands to do that
$ github add .
<<<<<<< HEAD
$ git commit -m "a meaning message which says what changes you made"
$ git push origin master 
=======
$ git commit -m "a meaning message which says what changes you made"
$ git push origin master 
At this point, you will be prompted with github user name and password. Supply that.
Your files will be successfully uploaded on your github account
----- opening a .html file as web page using github server -----
You can create a .html file and upload it on gethub server.
The web page can be opened using the web address as follows:
Assume the github user name is Jitendradhiman and there is a file index.html on github server.
https://Jitendradhiman.github.io
<<<<<<< HEAD
By default, this opens index.html file as a web page.
=======
By default, this opens index.html file as a web page.
https://Jitendradhiman.github.io 

---------------------------------------------------------------------------------------------------
Making a local folder as a git repository, there are several git repositories linked with a single account and we are creating one more  fresh  repository with the name "listeningTest"
go to the local folder (that need to be added as git repositories)
-- Initialize as git repository
$ git init
-- add
$ git add .
-- commit
 $ git commit -m "a new git repository"
-- add the repository to remote
$ git remote add origin URL of remote repository, for example : URL of remote repository = https://github.com/Jitendradhiman/listeningTests.git
$ git push -u origin master 