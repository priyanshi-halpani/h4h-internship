# h4h-internship
# Short Setup Notes

## Setup

* First, I installed **Vagrant** because I was not familiar with it. I researched what Vagrant is and how it works.
* I already had **VirtualBox** installed.
* I chose **Ubuntu 22.04** for the project.
* I created the Ubuntu VM using:

```bash
vagrant init ubuntu/jammy64
```

* I checked the Vagrant file using:

```bash
vagrant validate
```

* I started the VM using:

```bash
vagrant up
```

* I checked if the VM was running:

```bash
vagrant status
```

* I connected to the Ubuntu VM using:

```bash
vagrant ssh
```

## Setup Script

* I created a `setup.sh` script to set up the required software.
* I added the script to the `Vagrantfile`:

```ruby
config.vm.provision "shell", path: "scripts/setup.sh"
```

* I checked the Vagrant configuration again:

```bash
vagrant validate
```

* I ran the setup script using:

```bash
vagrant provision
```

* I also updated the script so that it could be run more than once.

## Testing

* I checked whether Apache was running:

```bash
systemctl status apache2 --no-pager
```

* I opened the website in my Windows browser:

```text
http://localhost:8080
```

* I created the PHP and MySQL files:

  * `db.php`
  * `index.php`
  * `edit.php`

* I checked the website and confirmed that the **CRUD functions were working**.

## Final Check

* I destroyed the Vagrant VM:

```bash
vagrant destroy
```

* I created it again using:

```bash
vagrant up
```

* I checked the website again and confirmed that everything was working correctly.

## Assumptions

* I assumed that **Ubuntu, MySQL, and PHP** would be suitable for this project.
* I assumed **VirtualBox** would be used with Vagrant because it was already installed.

## Errors / Problems

* I faced some problems while using **Vagrant** because it was new to me. I researched the issues and eventually managed to debug and solve them.
* Working with **PHP** was also a little challenging. I had used PHP before, so it felt like revisiting old topics. It was a good way to refresh and brush up on my PHP knowledge.
* I tested the setup again by destroying and recreating the VM, and everything worked correctly.

