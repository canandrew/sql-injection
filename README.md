
# SQL Injection Demo & Writeup

⚠️ **THIS CODE IS PURPOSELY EXTREMELY UNSECURE TO DEMONSTRATE BASIC WEB VULNERABILITIES. CODE SHOULD NOT BE REPLICATED.**

Demonstration of a vulnerable login panel from lack of input sanitization and case sensitivity filters. Also included is a writeup which outlines the specific vulnerabilities, as well as proposed changes to better secure a similar program.


## Authors

- [@canandrew](https://www.github.com/canandrew)


## Documentation

[Writeup](https://canandrew.ca/sql-inject-writeup)


## Run Locally

### 1. Clone the project

```bash
  git clone https://github.com/canandrew/sql-injection
```


### 2. Install XAMPP
Install the necessary local server environment. The link below will take you to the official download page:
> [**Install XAMPP**](https://www.apachefriends.org/)

### 3. Setup Files and Database
* Copy the `program` folder into your XAMPP `/htdocs/` directory
* Create a table `sql-injection` and upload the SQL file `/program/data/admin-logins.sql` to your MySQL localhost.

### 4. Run the Program
Navigate to the localhost platform running the `sql-injection` program in any browser (FireFox is recommended):
```bash
  http://localhost/program
```

