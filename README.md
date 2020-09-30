# api.pbbg.com
The API for Persistent Browser-Based Games.

## Prerequisites for host machine
* PHP, version >= 7.3
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads), version >= 6.1.14
* [Vagrant](https://www.vagrantup.com/downloads.html), version >= 2.2.4
* [Composer package manager](https://getcomposer.org/download/)
> Other VM providers than VirtualBox (Parallels, Hyper-V, etc..) may work fine, but these instructions
> are only tested on VirtualBox

### Create development environment with Vagrant
1. [Fork](https://docs.github.com/en/free-pro-team@latest/github/getting-started-with-github/fork-a-repo) this repository
2. Clone and `cd` into your new fork.
3. `composer install`
4. Adjust `Homestead.yaml`. Specifically:

    * Adjust ssh key locations.
      ```
      authorize: ~/.ssh/id_rsa.pub
         keys:
             - ~/.ssh/id_rsa
      ```
      This should be the relative paths to where you have ssh keys already made on your machine. If they don't exist
      here then create them somewhere and use that path. Also note this is a mac-style path, whereas windows would
      require an absolute path.

    * Adjust project path to where you cloned your api.pbbg.com fork.
      ```
      folders:
          -
              map: ~/Projects/api.pbbg.com
              to: /home/vagrant/code
      ```
      This should be the relative path to your cloned project on your host machine. Change the `map` path as necessary.

    * **Add changes to `/etc/hosts` file**. You'll notice the `sites` block is mapped to `local.api.pbbg.com`.
      You need to add this to your `/etc/hosts` file on your host machine. On a mac machine, you would do something
      like `sudo nano /etc/hosts` and then add this:
      ```
      192.168.10.10   local.api.pbbg.com
      ```
      Once you start Vagrant, this will allow you to hit **http://local.api.pbbg.com** in your browser.

More info on Homestead configuration in the [official documentation](https://laravel.com/docs/8.x/homestead#first-steps).

### Commands
* `vagrant up` build the development environment in a vagrant box (laravel/homestead)
* `vagrant halt` stop the vagrant box
* `vagrant ssh` ssh into the running vagrant box (will use your ssh keys specified in Homestead.yaml)
* `vagrant reload --provision` update the vagrant box (specifically Nginx) after making a change in Homestead.yaml

More info on Vagrant in the [official documentation](https://www.vagrantup.com/docs/installation).

### Contributing and Pull Requests
1. We *highly* encourage [short, concise git commit messages](https://chris.beams.io/posts/git-commit/).
2. Your Pull Request must be approved by at least one contributor.
3. After it has been approved you may request one of the contributors to merge it for you.

> Longer Contributing document on how to offer feedback, our standards, responsibilities, code of conduct, and
>enforcement can be found in [contributing guidelines](/CONTRIBUTING.md)

### Test Environment
 After developing locally and going through the normal Pull Request process to get your changes added, the updated code
 is pushed to the test environment at [https://dev.api.pbbg.com/](https://dev.api.pbbg.com/).

## Licenses
Content is released under [GNU GPL v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html).

### Common Errors in first time setup
You must have Composer installed on the host machine. As Homestead is a Composer dependency, you need to have Homestead
installed before you can use it. If you tried to run `vagrant up` and get a similar error message:
```
There was an error loading a Vagrantfile. The file being loaded
and the error message are shown below. This is usually caused by
a syntax error.

Path: /path/to/project/root/Vagrantfile
Line number: 12
Message: LoadError: cannot load such file -- /path/to/project/root/vendor/laravel/homestead/scripts/homestead.rb
```
then ensure Composer is installed on your host machine then install your dependencies:
```
composer install
```
With the Homestead package installed, you can now run `vagrant up`.
