
# Web Server Setup (LAMP Stack)

## Overview
This project involves setting up a basic **LAMP stack** (Linux, Apache, MySQL, PHP) on a Linux machine. The task includes configuring the Apache server, creating a simple PHP-based website, integrating a MySQL database, and making the website accessible externally via a public URL. Additionally, version control is managed using **Git**, and the project is pushed to **GitHub**.

## Table of Contents
1. [LAMP Stack Setup](#lamp-stack-setup)
   - [Install Required Packages](#install-required-packages)
   - [Configure Apache](#configure-apache)
   - [Create a Simple Website](#create-a-simple-website)
   - [Configure MySQL](#configure-mysql)
   - [Modify the Website to Use the Database](#modify-the-website-to-use-the-database)
   - [Testing Locally](#testing-locally)
   - [Make the Website Publicly Accessible](#make-the-website-publicly-accessible)
2. [Git & GitHub](#git--github)
   - [Initialize Git Locally](#initialize-git-locally)
   - [Create a `.gitignore` File](#create-a-gitignore-file)
   - [Commit Your Documentation & Source Code](#commit-your-documentation--source-code)
   - [Create and Push to a GitHub Repository](#create-and-push-to-a-github-repository)
3. [Networking Basics](#networking-basics)
4. [Deliverables](#deliverables)

## LAMP Stack Setup

### Install Required Packages
To install Apache, MySQL, and PHP on your Linux machine, run the following commands:
```bash
sudo apt-get update
sudo apt-get install apache2 mysql-server php libapache2-mod-php php-mysql -y
```

### Configure Apache
1. Create a test HTML file in the `/var/www/html/` directory:
   ```bash
   echo "Hello Apache!" > /var/www/html/index.html
   ```
2. Visit `http://<server-ip>/` in your browser to confirm that Apache is working correctly.

### Create a Simple Website
1. Replace the `index.html` file with a simple PHP file:
   ```bash
   echo "<?php echo 'Hello World!'; ?>" > /var/www/html/index.php
   ```
2. Visit `http://<server-ip>/` again to check that it shows "Hello World!".

### Configure MySQL
1. Secure the MySQL installation:
   ```bash
   sudo mysql_secure_installation
   ```
   Follow the prompts to set the root password.
2. Create a new database and user:
   ```sql
   CREATE DATABASE web_db;
   CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'StrongPassword123';
   GRANT ALL PRIVILEGES ON web_db.* TO 'web_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

### Modify the Website to Use the Database
1. Update the `index.php` file to connect to MySQL and display the visitor's IP address and the current time:
   ```php
   <?php
   $conn = new mysqli('localhost', 'web_user', 'StrongPassword123', 'web_db');
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   $time = date('Y-m-d H:i:s');
   $ip = $_SERVER['REMOTE_ADDR'];
   echo "Visitor IP: $ip <br> Current Time: $time";
   $conn->close();
   ?>
   ```
2. Visit `http://<server-ip>/` to check that the visitor's IP and current time are displayed.

### Testing Locally
Ensure that everything works by accessing the website at `http://<server-ip>/`.

### Make the Website Publicly Accessible
1. Configure firewall rules to allow HTTP (port 80) and HTTPS (port 443) traffic.
2. Obtain a public IP address or a domain name pointing to your server.
3. Update your DNS settings to point the domain to your server's public IP.
4. Test the external accessibility of your website.

---

## Git & GitHub

### Initialize Git Locally
Initialize a Git repository in the project directory:
```bash
cd /var/www/html
git init
```

### Create a `.gitignore` File
Create a `.gitignore` file to exclude sensitive files (e.g., database credentials):
```bash
echo "config.php" > .gitignore
```

### Commit Your Documentation & Source Code
1. Create a `README.md` file with instructions.
2. Add and commit your changes:
   ```bash
   git add .
   git commit -m "Initial LAMP setup and documentation"
   ```

### Create and Push to a GitHub Repository
1. Create a repository on GitHub.
2. Add the GitHub repository as a remote and push:
   ```bash
   git remote add origin https://github.com/kandelm/Web-Server.git
   git push -u origin main
   ```

---

## Networking Basics

### 1. IP Address
An **IP address** (Internet Protocol address) is a unique identifier for a device on a network. It is used to route data to and from the correct device. There are two types:
- **IPv4**: A 32-bit address, typically written as four decimal numbers separated by dots (e.g., `192.168.1.1`).
- **IPv6**: A 128-bit address, written in hexadecimal form (e.g., `2001:0db8:85a3:0000:0000:8a2e:0370:7334`).

**Purpose**: To identify devices and facilitate communication across networks, such as the internet.

### 2. MAC Address
A **MAC address** (Media Access Control address) is a unique identifier assigned to the network interface of a device, used to ensure that data is delivered to the correct hardware within a local network. It is a hardware address assigned by the manufacturer and typically written in hexadecimal form (e.g., `00:1A:2B:3C:4D:5E`).

**Purpose**: The MAC address ensures the correct delivery of data packets on the local network and is used for network communication within the same subnet. 

**Difference from IP Address**:
- **IP address**: Used to identify devices on a network and route traffic across the internet.
- **MAC address**: Used to identify devices at the hardware level, within a local network.

### 3. Switches, Routers, and Routing Protocols
- **Switch**: A device that connects devices within the same network. It uses MAC addresses to forward data to the correct destination device.
- **Router**: A device that connects different networks (such as your local network to the internet). It uses IP addresses to route data between networks.
- **Routing Protocols**: Protocols such as **OSPF** and **BGP** are used by routers to determine the best path for data to travel between networks.

### 4. Remote Connection to Cloud Instance
To connect to your cloud-based Linux instance remotely, you can use **SSH (Secure Shell)**. Here are the steps:

1. **Obtain the IP address** of your cloud-based server.
2. **Ensure SSH is installed** on your server:
   ```bash
   sudo apt-get install openssh-server
   ```
3. **Generate an SSH key pair** on your local machine if you don't already have one:
   ```bash
   ssh-keygen -t ed25519 -C "your_email@example.com"
   ```
4. **Copy your public SSH key to your cloud instance**:
   ```bash
   ssh-copy-id username@<server-ip>
   ```
   Replace `username` with the user on your cloud instance (e.g., `ubuntu`), and `<server-ip>` with the IP address of your server.

5. **Connect using SSH**:
   ```bash
   ssh username@<server-ip>
   ```

---

## Deliverables
1. **Documentation (Markdown File)**: A step-by-step guide on setting up the LAMP stack, using Git, and explaining networking concepts.
2. **GitHub Repository**: A repository containing your code, configuration files, and documentation.
3. **Public URL**: A link to your website, confirming it is publicly accessible.

---

### **End of README**
