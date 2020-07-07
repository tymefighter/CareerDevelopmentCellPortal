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

### Linux

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
    username: volunteer1
    password: Ab123&
```
6. Student Volunteer user, details are
```
    username: volunteer2
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