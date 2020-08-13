# Install the Web Portal locally

- The installation is given for different Operating Systems
- Also, already added sample user details are given below,
these can be used to explore the website

### MacOS

- You should have MAMP, if not then you can install it from here 
https://documentation.mamp.info/en/MAMP-Mac/Installation/
- Clone this repository in this location
```
    /Applications/MAMP/htdocs/CareerDevelopmentCellPortal
```
- Now, add the following into your `.bash_profile` or `.bashrc` file
```
    alias mysql_mamp='/Applications/MAMP/Library/bin/mysql'
    alias mysqldump_mamp='/Applications/MAMP/Library/bin/mysqldump'
```
- Create a database using `mysql` as follows (write in mysql interpretor)
```
    CREATE DATABASE cdc
```
- Now, import all `sql` files into the database by running `importSql.sh` bash
script
```
    chmod +x importSql.sh
    ./importSql.sh
```
- Now start your `MAMP` application and open CareerDevelopmentCellPortal folder,
select `php` and then select `home.php`, you will then begin at the home page

### Linux (Debian)

The following steps are for Debian. Little changes maybe required for other Linux distributions.
Apache Server, PHP (>= 7.0) and MariaDB are needed. Install these and follow the below  steps:
- Clone this repository in some location. For example, the location would look something like:
```
    root/git/CareerDevelopmentCellPortal
```
- Start the MySQL server. 
```
    service mysql start
```
- Run the MySQL interpreter and create a database named `cdc`.
```
    CREATE DATABASE cdc
```
- Now, import all `sql` files into the database by running `importSqlLinux.sh` bash
script. You may need to modify a line in the bash (adding login details in the import statement).
```
    chmod +x importSqlLinux.sh
    ./importSqlLinux.sh
```
- Modify the Apache configuration file in `/etc/apache2`. DocumentRoot is needed to be changed.
For Debian distribution, Modify these two files:  `/etc/apache2/sites-enabled/000-default.conf` and `/etc/apache2/sites-available/000-default.conf`.
Change `DocumentRoot /var/www/html` to `DocumentRoot /root/git/CareerDevelopmentCellPortal`.
- Finally, Start the Apache Server. Go to localhost and select `php` and then select `home.php`, you will then land up at the home page.
```
    service apache2 start
```

## Sample User Details

1. Student user, details are
```
    username: student1
    password: Ab123&
```
2. Student user, details are
```
    username: student2
    password: Ab123&
```
3. Company user, details are
```
    username: company1
    password: Ab123&
```
4. Company user, details are
```
    username: company2
    password: Ab123&
```
5. Student Volunteer user, details are
```
    username: vol1
    password: Ab123&
```
6. Student Volunteer user, details are
```
    username: vol2
    password: Ab123&
```
7. CDC Offical user, details are
```
    username: official1
    password: Ab123&
```
7. CDC Offical user, details are
```
    username: official2
    password: Ab123&
```
