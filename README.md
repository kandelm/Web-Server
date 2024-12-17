
# Web Server Setup (LAMP Stack)

## Overview
This project involves setting up a **LAMP stack** (Linux, Apache, MySQL, PHP) on a **Google Cloud Platform (GCP)** virtual machine (VM). The task includes configuring the Apache server, creating a simple PHP-based website, integrating a MySQL database, and making the website accessible externally via a public URL. Additionally, version control is managed using **Git**, and the project is pushed to **GitHub**.

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

### Create a GCP VM Instance
1. **Log in to GCP Console**: Go to [Google Cloud Console](https://console.cloud.google.com/).
2. **Create a Project**: In the GCP Console, create a new project (e.g., `Web-Server-Project`).
3. **Create a Virtual Machine**:
   - Navigate to **Compute Engine** → **VM Instances** → **Create Instance**.
   - Select an **Ubuntu image** (Ubuntu 22.04 LTS).
   - Set the **machine type** (`e2-micro`).
   - Check **Allow HTTP traffic** and **Allow HTTPS traffic** in the firewall section.
   - Click **Create**.
4. Once the VM is created, note down the **External IP** for later use.

### Install Required Packages
To install **Apache**, **MySQL**, and **PHP** on your GCP VM:
1. SSH into your VM instance:
   ```bash
   ssh mahmoudkandel323@35.226.226.112
   ```
2. Run the following commands to install the packages:
   ```bash
   sudo apt-get update
   sudo apt-get install apache2 mysql-server php libapache2-mod-php php-mysql -y
   ```

### Configure Apache
1. Test that Apache is running:
   - In your browser, go to `http://35.226.226.112`. You should see the Apache default page.
2. Create a simple HTML test page:
   ```bash
   echo "Hello Apache!" > /var/www/html/index.html
   ```

### Create a Simple Website
1. Replace the HTML file with a PHP script:
   ```bash
   echo "<?php echo 'Hello World!'; ?>" > /var/www/html/index.php
   ```
2. Visit `http://<your-vm-ip>/` in your browser to confirm that it displays **"Hello World!"**.

### Configure MySQL
1. Secure MySQL:
   ```bash
   sudo mysql_secure_installation
   ```
   Follow the prompts to set the root password.
2. Create a database and user:
   ```sql
   sudo mysql
   CREATE DATABASE web_db;
   CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'StrongPassword123';
   GRANT ALL PRIVILEGES ON web_db.* TO 'web_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

### Modify the Website to Use the Database
1. Edit `index.php` to display the visitor’s IP address and current time from the MySQL database:
   ```bash
   echo "<?php
   \$conn = new mysqli('localhost', 'web_user', 'StrongPassword123', 'web_db');
   if (\$conn->connect_error) {
       die('Connection failed: ' . \$conn->connect_error);
   }
   \$time = date('Y-m-d H:i:s');
   \$ip = \$_SERVER['REMOTE_ADDR'];
   echo 'Visitor IP: ' . \$ip . '<br> Current Time: ' . \$time;
   \$conn->close();
   ?>" > /var/www/html/index.php
   ```
2. Visit `http://35.226.226.112/` again to verify that it now shows the visitor’s IP and the current time.

### Testing Locally
Ensure that everything is working correctly by accessing your website at `http://35.226.226.112/`.

### Make the Website Publicly Accessible
1. **Set Up Firewall**: Ensure the firewall allows HTTP (port 80) and HTTPS (port 443) traffic. This can be done in the **GCP firewall rules** or **VM settings**.

---

## Git & GitHub

### Initialize Git Locally
1. Navigate to your project folder:
   ```bash
   cd /var/www/html
   ```
2. Initialize the Git repository:
   ```bash
   git init
   ```

### Create a `.gitignore` File
Create a `.gitignore` file to exclude sensitive files (e.g., database credentials):
```bash
echo "config.php" > .gitignore
```

### Commit Your Documentation & Source Code
1. Add and commit your changes:
   ```bash
   git add .
   git commit -m "Initial LAMP setup and documentation"
   ```

### Create and Push to a GitHub Repository
1. Create a repository on GitHub.
2. Add the GitHub repository as a remote:
   ```bash
   git remote add origin https://github.com/kandelm/Web-Server.git
   ```
3. Push the changes to GitHub:
   ```bash
   git push -u origin main
   ```

---

## Networking Basics

### 1. IP Address
An **IP address** (Internet Protocol address) is a unique identifier for a device on a network. It is used to route data between devices across networks. It is essential for identifying devices and ensuring proper data routing.

### 2. MAC Address
A **MAC address** (Media Access Control address) is a unique hardware identifier assigned to a network device. It is used to identify devices at the data link layer of a network, and it is important for local network communication.

**Difference from IP address**:
- **IP Address**: Identifies a device on a network (used for routing).
- **MAC Address**: Identifies a device on the local network (used within the same network).

### 3. Switches, Routers, and Routing Protocols
- **Switch**: A device that connects devices within the same network and forwards data based on MAC addresses.
- **Router**: A device that connects different networks (such as local networks and the internet), using IP addresses to route data.
- **Routing Protocols**: These protocols (e.g., OSPF, BGP) help routers determine the best paths for data transmission between networks.

### 4. Remote Connection to Cloud Instance
To connect to your cloud-based Linux instance remotely, use **SSH**. Here are the steps:

1. **Obtain the IP address** of your cloud instance.
2. **Ensure SSH is enabled** on your VM:
   ```bash
   sudo apt-get install openssh-server
   ```
3. **Generate an SSH key** on your local machine (if you don’t have one already):
   ```bash
   ssh-keygen -t ed25519 -C "mahmoudkandel323@gmail.com"
   ```
4. **Copy the SSH key** to your cloud instance:
   ```bash
   ssh-copy-id mahmoudkandel323@35.226.226.112
   ```
5. **SSH into the instance**:
   ```bash
   ssh mahmoudkandel323@35.226.226.112
   ```

---

## Deliverables
1. **Documentation (Markdown File)**: This file contains the step-by-step guide on setting up the LAMP stack, using Git, and explaining networking concepts.
2. **GitHub Repository**: A repository containing your code, configuration files, and documentation.
3. **Public URL**: A link to your website, confirming it is publicly accessible.

---

### **The End of README**
