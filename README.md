# civicrm-buildkit-vagrant (cividev)

This software is derived from [Varying Vagrant Vagrants](https://github.com/Varying-Vagrant-Vagrants/VVV). It is an open source [Vagrant](https://www.vagrantup.com) configuration focused on [CiviCRM](https://civicrm.org) development. Cividev inherits VVV's [MIT License](https://github.com/civicrm/civicrm-buildkit-vagrant/blob/master/LICENSE).

## Overview

### The Purpose of cividev

The primary goal of civicrm-buildkit-vagrant (cividev) is to provide a complete and easily installable development environment for CiviCRM with a standard server setup and CiviCRM configuration templates.

Cividev is ideal for testing new releases, developing extensions and contributing to CiviCRM core.

### How to Use cividev

#### Software Requirements

Cividev requires recent versions of both Vagrant (1.7+) and VirtualBox (4.3+) to be installed. If you use it for development, it will work with your favorite locally installed development environment.

[Vagrant](https://www.vagrantup.com) is a "tool for building and distributing development environments". It works with [virtualization](https://en.wikipedia.org/wiki/X86_virtualization) software such as [VirtualBox](https://www.virtualbox.org/) to provide a virtual machine sandboxed from your local environment.

#### Cividev as a MAMP/XAMPP Replacement

Once Vagrant and VirtualBox are installed, download or clone cividev and type `vagrant up` to automatically build a virtualized Ubuntu server on your computer containing everything needed to test or develop with any combination of CMS and CiviCRM versions. See our section on [The First Vagrant Up](#the-first-vagrant-up) for detailed instructions.

Multiple projects can be developed at once in the same environment. Cividev is pre-configured with the following CiviCRM configurations:

* __d7-master__ with Drupal 7 and the current development version of CiviCRM
* __d7-46__ with Drupal 7 and CiviCRM 4.6 (LTS)
* __wp-master__ and __wp-46__ with WordPress
* __d8-master__ with Drupal 8
* __b-master__ with Backdrop

Cividesk's `config`, `database`, `log` and `www` directories are shared with the virtualized server.

These shared directories allow you to work, for example, in `cividev/www/d7-master` in your local file system and have those changes immediately reflected in the virtualized server's file system and http://d7-master.test/. Likewise, if you `vagrant ssh` and make modifications to the files in `/srv/www/`, you'll immediately see those changes in your local file system.

### The First Vagrant Up

1. Start with any local operating system such as Mac OS X, Linux, or Windows.
1. Install [Git](http://git-scm.org).
 * Windows users: Be sure to add the Git executables to your path (See, e.g. [this guide](http://blog.osteel.me/posts/2015/01/25/how-to-use-vagrant-on-windows.html), under "Prerequisites")
1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads) 4.3 or above
1. Install [Vagrant](https://www.vagrantup.com/downloads.html) 1.7 or above
    * `vagrant` will now be available as a command in your terminal, try it out.
    * ***Note:*** If Vagrant is already installed, use `vagrant -v` to check the version. You may want to consider upgrading if an older version is in use.
    * if you are on Windows, please install *git* with *ssh* as described [here](http://blog.osteel.me/posts/2015/01/25/how-to-use-vagrant-on-windows.html)
1. Windows Users - if using the bash shell (usually the Git Bash Shell) make sure the process runs as administrator.
1.  Windows users should be certain that their BIOS' virtualization settings are enabled. (Intel owners should enable VT-x while AMD owners should enable AMD-v. See [here](http://www.sysprobs.com/disable-enable-virtualization-technology-bios) for a better explanation.)
1. Install the [vagrant-hostsupdater](https://github.com/cogitatio/vagrant-hostsupdater) plugin with `vagrant plugin install vagrant-hostsupdater`
    * Note: This step is not a requirement, though it does make the process of starting up a virtual machine nicer by automating the entries needed in your local machine's `hosts` file to access the provisioned VVV (Varying Vagrant Vagrants) domains in your browser.
    * If you choose not to install this plugin, the following entries should be added to your local `hosts` file:
        ```
        192.168.123.10  cividev civi.test d7-master.test wp-master.test d7-46.test wp-46.test
        192.168.123.10  d8-46.test b-46.test d8-master.test b-master.test
        ```
1. Install the [vagrant-triggers](https://github.com/emyl/vagrant-triggers) plugin with `vagrant plugin install vagrant-triggers`
    * Note: This step is not a requirement. When installed, it allows for various scripts to fire when issuing commands such as `vagrant halt` and `vagrant destroy`.
    * By default, if vagrant-triggers is installed, a `db_backup` script will run on halt, suspend, and destroy that backs up each database to a `dbname.sql` file in the `{vvv}/database/backups/` directory. These will then be imported automatically if starting from scratch. Custom scripts can be added to override this default behavior.
    * If vagrant-triggers is not installed, VVV will not provide automated database backups.
1. Clone or extract the civicrm-buildkit-vagrant project into a local directory
    * `git clone git://github.com/civicrm/civicrm-buildkit-vagrant.git cividev`
    * OR download and extract the repository master [zip file](https://github.com/civicrm/civicrm-buildkit-vagrant/archive/master.zip) to a `cividev` directory on your computer.
    * OR download and extract a [stable release](https://github.com/civicrm/civicrm-buildkit-vagrant/releases) zip file if you'd like some extra comfort.
1. In a command prompt, change into the directory where you placed the files.  Use `cd` from the command prompt to do this.  
1. Start the Vagrant environment with `vagrant up`
    * Be VERY patient as the magic happens (time for a coffee or lunch break?). This will take a while on the first run as your local machine downloads the required files and builds all.
    * Watch as the script ends, as an administrator or `su` ***password may be required*** to properly modify the hosts file on your local machine.
1. Visit any of the following default sites in your browser:
    * [http://d7-master.test/](http://d7-master.test/) for CiviCRM trunk on Drupal 7
    * [http://civi.test/](http://civi.test/) for a (minimal) dashboard containing several useful tools
1. Build additional instances:
    * ssh into your machine with 'vagrant ssh' from the cividev directory
    * type 'civibuild create <configuration>' with <configuration> one of the [predefined configurations](https://github.com/civicrm/civicrm-buildkit-vagrant/blob/master/www/cividev-hosts) (ie. wp-46 for example)
    * go to 'http://<configuration>.test' in your local browser to acces the new instance (ie. http://wp-46.test)

Fancy, yeah?

### What Did That Do?

The first time you run `vagrant up`, a packaged box containing a basic virtual machine is downloaded to your local machine and cached for future use. The file used by Varying Vagrant Vagrants contains an installation of Ubuntu 14.04 and is about 332MB.

After this box is downloaded, it begins to boot as a sandboxed virtual machine using VirtualBox. Once booted, it runs the provisioning script included with VVV. This initiates the download and installation of around 100MB of packages on the new virtual machine. Then [buildkit](https://github.com/civicrm/civicrm-buildkit) is downloaded, configured and the d7-master configuration is built (therefore pre-seeding all caches).

The time for all of this to happen depends a lot on the speed of your Internet connection. If you are on a fast cable connection, it will likely take around 30 minutes.

On future runs of `vagrant up`, the packaged box will be cached on your local machine and Vagrant will only need to apply the requested provisioning.

* ***Preferred:*** If the virtual machine has been powered off with `vagrant halt`, `vagrant up` will quickly power on the machine without provisioning.
* ***Rare:*** If you would like to reapply the provisioning scripts with `vagrant up --provision` or `vagrant provision`, some time will be taken to check for updates and packages that have not been installed.
* ***Very Rare:*** If the virtual machine has been destroyed with `vagrant destroy`, it will need to download the full 100MB of package data on the next `vagrant up`.

### Now What?

Now that you're up and running, start poking around and modifying things.

1. Access the server via the command line with `vagrant ssh` from your `vagrant-local` directory. You can do almost anything you would do with a standard Ubuntu installation on a full server.
    * **MS Windows users:** An SSH client is generally not distributed with Windows PCs by default. However, a terminal emulator such as [PuTTY](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html) will provide access immediately. For detailed instructions on connecting with PuTTY, consult the [VVV Wiki](https://github.com/Varying-Vagrant-Vagrants/VVV/wiki/Connect-to-Your-Vagrant-Virtual-Machine-with-PuTTY).
    * From within a remote ssh to vagrant, you'll find the civicrm files in /srv/www/_cms_branch_/sites/all/modules/civicrm.  For example, /srv/www/d7-master/sites/all/modules/civicrm.  Careful, you may also find some civicrm files in /vagrant/www/... these are old artifacts, and aren't the right ones.
1. Power off the box with `vagrant halt` and turn it back on with `vagrant up`.
1. Suspend the box's state in memory with `vagrant suspend` and bring it right back with `vagrant resume`.
1. Reapply provisioning to a running box with `vagrant provision`.
1. Destroy the box with `vagrant destroy`. Files added in the `www` directory will persist on the next `vagrant up`.
1. Start modifying and adding local files to fit your needs. Take a look at [Auto Site Setup](https://github.com/varying-vagrant-vagrants/vvv/wiki/Auto-site-Setup) for tips on adding new projects.

#### Caveats

The network configuration picks an IP of 192.168.123.10. It could cause conflicts on your existing network if you *are* on a 192.168.123.x subnet already. You can configure any IP address in the `Vagrantfile` and it will be used on the next `vagrant up`

Cividev relies on the stability of both Vagrant and Virtualbox. These caveats are common to Vagrant environments and are worth noting:
* If the directory cividev is inside of is moved once provisioned, it will break.
    * If `vagrant destroy` is used before moving, this should be fine.
* If Virtualbox is uninstalled, cividev will break.
* If Vagrant is uninstalled, cividev will break.

The default memory allotment for the cividev virtual machine is 1024MB. If you would like to raise or lower this value to better match your system requirements, a [guide to changing memory size](https://github.com/Varying-Vagrant-Vagrants/VVV/wiki/Customising-your-Vagrant's-attributes-and-parameters) is in the wiki.

Cividev is using a 64bit version of Ubuntu. Some older CPUs (such as the popular *Intel Core 2 Duo* series) do not support this. Changing the line `config.vm.box = "ubuntu/trusty64"` to `"ubuntu/trusty32"` in the `Vagrantfile` before `vagrant up` will provision a 32bit version of Ubuntu that will work on older hardware.

### Credentials and Such

All CMS usernames and passwords for these installations are `demo / demo` and `admin / admin` by default.

The MySQL/phpMyAdmin username and password is `root / root` by default.

Please note that cividev is a development and testing environment, it is NOT secure and NOT intended to be used in production or on any Internet-accessible server.

### Running Unit Tests
CD to /srv/www/d7-master/sites/all/modules/civicrm/tools/scripts
Run phpunit /srv/www/d7-master/sites/all/modules/civicrm/tests/phpunit/HelloTest.php

### What do you get?

A bunch of stuff!

1. [Ubuntu](http://www.ubuntu.com/) 14.04 LTS (Trusty Tahr)
1. [apache](http://apache.org/) 2.4.x
1. [mysql](https://www.mysql.com/) 5.5.x
1. [php5](http://php.net/) 5.5.x and all extensions needed for CiviCRM
1. [memcached](http://memcached.org/)
1. PHP [memcache extension](https://pecl.php.net/package/memcache)
1. PHP [xdebug extension](https://pecl.php.net/package/xdebug/)
1. [PHPUnit](https://phpunit.de/)
1. [git](http://git-scm.com/)
1. [ngrep](http://ngrep.sourceforge.net/usage.html)
1. [dos2unix](http://dos2unix.sourceforge.net/)
1. [Composer](https://github.com/composer/composer)
1. [phpMemcachedAdmin](https://code.google.com/p/phpmemcacheadmin/)
1. [phpMyAdmin](http://www.phpmyadmin.net/) (multi-language)
1. [Opcache Status](https://github.com/rlerdorf/opcache-status)
1. [Webgrind](https://github.com/jokkedk/webgrind)
1. [NodeJs](https://nodejs.org/)
1. [grunt-cli](https://github.com/gruntjs/grunt-cli)
1. [Mailcatcher](http://mailcatcher.me/)
1. [buildkit] and all related tools
1. Drupal 7 and 8, Wordpress latest version, Backdrop

### Need Help?

* Let us have it! Don't hesitate to open a new issue on GitHub if you run into trouble or have any tips that we need to know.

## Copyright / License

Cividev is derivative work based on VVV. VVV is copyright (c) 2014-2015, the contributors of the VVV project under the [MIT License](LICENSE).
