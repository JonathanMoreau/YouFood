
1) Télécharger Symfony2
---------------

### Clone the git Repository

Run the following commands:

    git clone git@github.com:JonathanMoreau/Miam.git

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

    http://localhost/Miam/web/config.php

If everything looks good, click the "Bypass configuration and go to the Welcome page"
link to load up your first Symfony page.

To see a real-live Symfony page in action, access the following page:

    web/app_dev.php/demo/hello/Fabien

3) Configuration Virtual Hosts
-----------------------

Ajouter aux Virtual Hosts Apache le code suivant :

    NameVirtualHost *:80

    <VirtualHost *:80>
        ServerName dev.youfood.com
        ServerAdmin tonmail@gmail.com
        DocumentRoot "path/Miam/web"
        <Directory "path/Miam/web>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride None
            Order allow,deny
            allow from all
            <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.*)$ /app_dev.php [QSA,L]
            </IfModule>
        </Directory>
    </VirtualHost>

    <VirtualHost *:80>
        ServerName prod.youfood.com
        ServerAdmin tonmail@gmail.com
        DocumentRoot "path/Miam/YouFood/web"
        <Directory "path/Miam/web>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride None
            Order allow,deny
            allow from all
            <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.*)$ /app.php [QSA,L]
            </IfModule>
        </Directory>
    </VirtualHost>

4) Ajouter les entrées dans le fichier hosts
------------------------

    127.0.0.1  dev.youfood.com
    127.0.0.1 prod.youfood.com

5) GO
-----------------------

Tester si dev.youfood.com fonctionne sur votre navigateur, sinon envoyer un mail à jonathanmoreaufr@gmail.com


@Enjoy!
