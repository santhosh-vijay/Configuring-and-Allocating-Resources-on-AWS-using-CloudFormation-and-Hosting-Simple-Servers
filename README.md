# Configuring-and-Allocating-Resources-on-AWS-using-CloudFormation-and-Hosting-Simple-Servers

Objective:

1. VPC: 10.0.0.0/16 (North Virginia Region us-east-1)
- Create a Virtual Private Cloud (VPC) resource called IPA-VPC
- Create subnets in your VPC. You must create 2 public subnets and 2 private subnets, each in different availability zone in the same region under the same VPC
- Create Internet Gateway resource called IPA-IGW
- Create NAT Gateway resource called IPA-NATG
- Attach the Internet Gateway to IPA-VPC
- Create 2 Route
  - IPA-PublicRouteTables
  - IPA-PrivateRouteTable
- Attach private and public subnets to their respective Route Tables
- Create a Default Route pointing to IPA-IGW in PublicRouteTable
- Create a Default Route pointing to IPA-NATG in PrivateRouteTable

2. Deploy 2 EC2 Instances

One in Public subnet and other in Private subnet.

EC2 instance in Public Subnet:
- Ubuntu 18.04 64Bit
- T2 micro, 1 GB RAM, 8GB General Purpose SSD.
- Should be assigned a Public IP
- During deployment, install a webserver
- Post deployment the Public EC2 should connect to MYSQL server on Private EC2
- Create a Table to show your connection

EC2 instance in Private Subnet:
- Ubuntu 18.04 64Bit
- T2 micro, 1 GB RAM, 8GB General Purpose SSD.
- Should be assigned a Public IP
- It should have a MYSQL server


The requirements for objective 1 were configured on a json template file and implemented using AWS CloudFormation. The create.sh file is used as a single click command file which creates all of the above resources when executed and the delete.sh file is also used as a single command delete file which deleted all of the allocated resources when executed.
Alternatively, the create_resources_using_cli.sh file can be used to allocate resources without CloudFormation.

The requirements for objective 2 is implemented as follows:

The public and private subnets that were previously created are used to launch new EC2 instances according to the requirements.

- OS: Ubuntu 18.04 LTS
- Type: T2 micro
- RAM: 1GB
- STORAGE: 8GB General Purpose SSD

We select the required Ubuntu Image and complete the setup. In order to login to these instance SSH is done using the Putty tool by the utilizing the Public and Private key pair. However, our private EC2 instance does not have a public IP thus, we use the Pageant tool to upload the private key of our private EC2 instance. Before uploading, we convert our private key from pem format to ppk format using the PuttyGen tool. After uploading, we open the Putty tool and enter the public IP of the public EC2 instance. Under SSH authorization we enable agent forwarding and upload the private key of our public EC2 instance. Under SSH→Auth, we enable Agent Forwarding and upload the private key of our public EC2 instance. We enter the username as “ubuntu” and login to our public instance. In order to deploy a web server, we use the following command: 

$sudo apt-get install apache2 libapache2-mod-php php

After installation, we can check to see if the status is active. We now SSH into the private instance by using the following command:

$ssh ubuntu@<ipv4-address>

To install the MySQL server, the following command is executed:

$sudo apt-get install mysql-server

After logging in to the MySQL server we create a database and table using the following commands: mysql> CREATE DATABASE books; mysql> CREATE TABLE authors;
We insert required data into the table.

We create a user and grant permissions using the following commands: 

mysql> CREATE USER “testing”@”<ip>” IDENTIFIED BY “******”; 

mysql> GRANT ALL PRIVILEGES ON *.* TO “testing”@”<ip>”; 

mysql> FLUSH PRIVILEGES;

We open the file /etc/mysql/mysql.conf.d/mysqld.cnf and comment the bind-address. Restart the MySQL server using the following command:

$sudo service mysql restart

We then get into our public instance and write a PHP code to fetch and display data from the MySQL table in the path /var/www/html/index.php. We also have to update Security Groups to our EC2 instances to allow the necessary connections by aloowing inbound MySQL connections from the Web Server's public IP on port 3306.
After making all the necessary changes we copy the public IP or public DNS of our public EC2 instance provided by AWS and paste it in a web browser to view the web page.



