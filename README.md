MotoGP Chronos Management - Guimove
============

## INSTALLATION

To get the full project, do this on GitBash:

    git clone git@github.com:Ninir/YouFoodAdministration.git
    cd YouFoodAdministration

Now, do the following commands:

    php bin/vendors install

### Global config
You will need to create a global config file. Simply copy/paste `app/config/parameters.ini.dist` to `app/config.parameters.ini` and modify it. You can do:

    mv app/config/parameters.ini.dist app/config/parameters.ini

And then modify the dbname, your credentials to use PHPMyAdmin etc


### Getting Assets
You will get all the third-party libraries. Then, generate symbolic links entering this command:

    php app/console assets:install --symlink web

This will create symbolic links to bundles registered in `app/AppKernel.php`, in order to access their assets.

### Getting Fixtures (Database Data)
In order to get existing data in the DB, do the following:

    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force

