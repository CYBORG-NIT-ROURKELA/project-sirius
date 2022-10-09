# Local Environment Setup

- [Git download and setup][git]
- [installation link for xampp][install-xampp]
- [how to run web app in localhost][run_in_localhost]
- [how to use phpMyAdmin to import db and visualise changes][phpAdmin]
  
---

## Git download and setup

- Git is a version control system to keep track of changes to the files you are doing.
- Go to [https://git-scm.com/downloads](https://git-scm.com/downloads) and download the command line git version.
- It is necessary to clone and commit changes to the project.
- Setup up your credential locally in terminal for git to work with github / gitlab account

    ```bash
    git config --global user.name "<user-name>"
    ```

    ```zsh
    git config --global user.email user-name@example.com
    ```

    replace the `name` and `email` with your `real name` and `email address` respectively.

- First `fork` the repo by clicking on the `fork` button of the repository to get a copy in you github account ad you cannot work on the any other repository unless you are a contributor or owner of a repository
- After that clone the repo using `git clone https://github.com/<user-name>/project-sirius.git`

---

## Installation link for xampp

- Go to [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html) website and download the latest version of XAMPP software as per the operating system like windows, linux, OS X.
- After installation run the file and follow the instruction present in it and setup the XAMPP Server locally.

---

## how to run web app in localhost

- Firstly open XAMPP GUI locally by clicking start and search XAMPP to start the server.
- start the `apache`, `MySQL`  in `XAMPP` GUI to start the server.
- Now You have to place the project inside `htdocs` folder of XAMPP software which will be basically located in `c:\Program Files(x86)\xampp\htdocs`
- Now load the webpage on the server by typing [localhost](http://localhost/) in a browser like safari, chrome, Mozilla Firefox, Microsoft Edge.
- After typing this you will get a display of project folder / files present in htdocs.
- Select the folder that you want to work and make your changes, test and develop the website.

---

## how to use phpMyAdmin to import db and visualise changes

- Open phpMyAdmin page in browser by typing [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) in the search bar after starting the XAMPP server.
- In this you will see the MySQL database where you save the database of the project and work locally for developing the project.
- You will get a test data in database which will be provided while installing XAMPP server.
- First create database `project_sirius` in the `phpmyadmin` site by typing `create database / new button` in sidebar.
- you can import the database into the server by clicking on the `import button` and choose the `project_sirius.sql file` that is present in `./api/project_sirius.sql` of project parent directory and click on import button present at the bottom of the page leaving default variable.

---

[git]: #git-download-and-setup
[install-xampp]: #installation-link-for-xampp
[run_in_localhost]: #how-to-run-web-app-in-localhost
[phpAdmin]: #how-to-use-phpmyadmin-to-import-db-and-visualise-changes