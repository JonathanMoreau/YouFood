
1) Télécharger Symfony2
---------------

### Clone the git Repository

Run the following commands:

    git clone git@github.com:JonathanMoreau/YouFood.git

2) Installation
---------------

Once you've downloaded the standard edition, installation is easy, and basically
involves making sure your system is ready for Symfony.

### a) Check your System Configuration

Before you begin, make sure that your local system is properly configured
for Symfony. To do this, execute the following:

    php app/check.php

If you get any warnings or recommendations, fix these now before moving on.

### b) Install the Vendor Libraries

If you downloaded the archive "without vendors" or installed via git, then
you need to download all of the necessary vendor libraries. If you're not
sure if you need to do this, check to see if you have a ``vendor/`` directory.
If you don't, or if that directory is empty, run the following:

    php bin/vendors install

Note that you **must** have git installed and be able to execute the `git`
command to execute this script. If you don't have git available, either install
it or download Symfony with the vendor libraries already included.

### c) Access the Application via the Browser

Congratulations! You're now ready to use Symfony. If you've unzipped Symfony
in the web root of your computer, then you should be able to access the
web version of the Symfony requirements check via:

    http://localhost/YouFood/web/config.php

If everything looks good, click the "Bypass configuration and go to the Welcome page"
link to load up your first Symfony page.

3) Configuration Virtual Hosts
-----------------------

Ajouter aux Virtual Hosts Apache le code suivant :

    NameVirtualHost *:80

    <VirtualHost *:80>
        ServerName youfood.org
        ServerAlias *.youfood.org
        ServerAdmin tonmail@gmail.com
        DocumentRoot "path/YouFood/web"
        <Directory "path/YouFood/web">
            Options Indexes FollowSymLinks MultiViews
            AllowOverride all
            Order allow,deny
            allow from all
        </Directory>
    </VirtualHost>

4) Ajouter les entrées dans le fichier hosts
------------------------

    127.0.0.1  dev.youfood.org
    127.0.0.1 prod.youfood.org

5) GO
-----------------------

Tester si dev.youfood.org fonctionne sur votre navigateur, sinon envoyer moi un mail.


@Enjoy!
