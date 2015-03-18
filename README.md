# IIZP2010G2

## Guide
This guide assumes that you have 64bit windows.

Install [git bash](http://msysgit.github.io/), [vagrant](https://www.vagrantup.com/) and [virtualbox](https://www.virtualbox.org/).

### First run
Open git bash and give the following commands


* git clone https://github.com/N4SJAMK/IIZP2010G2.git
* (Give your username and password if asked to)
* cd IIZP2010G2
* sh initialize.sh
* vagrant up
* vagrant ssh	
* cd teamboard-api
* npm install --no-bin-links
* npm start &
* (Wait for "Worker [..." and then press enter)
* cd ../teamboard-io
* npm install --no-bin-links
* npm start &
* (Wait for "socket.io ..." and then press enter)
* cd ../teamboard-client-react
* npm install --no-bin-links && gulp
* (Ready after "Finished 'default' after ...")


After these commands you should have contriboard up and running on localhost:8000 and adminpanel on localhost:8001


### Coming back
Open git bash and give the following commands


* cd IIZP2010G2
* git pull
* vagrant up
* vagrant ssh
* cd teamboard-api
* npm start &
* (Wait for "Worker [..." and then press enter)
* cd ../teamboard-io
* npm start &
* (Wait for "socket.io ..." and then press enter)
* cd ../teamboard-client-react
* gulp
* (Ready after "Finished 'default' after ...")


After these commands you should have contriboard up and running on localhost:8000 and adminpanel on localhost:8001


### Shutting down


Give the following commands


* ctrl+c
* exit
* vagrant halt
* exit


## About git


If you're new to git then you probably need these.


* [git - the simple guide](http://rogerdudler.github.io/git-guide/)
* git config --global user.email "your@email.fi"
* git config --global user.name "Your Name"
