Installation
============

Install the application dependencies

    docker-compose run --rm backend composer install

Initialize the application by running the `init` command within a container

    docker-compose run --rm backend /app/init

Add a database service like and adjust the components['db'] configuration in `common/config/main-local.php` accordingly.

        'dsn' => 'mysql:host=mysql;dbname=yii2advanced',
        'username' => 'yii2advanced',
        'password' => 'secret',

> Docker networking creates a DNS entry for the host `mysql` available from your `backend` and `frontend` containers.

Start the application

    docker-compose up -d

Run the migrations

    docker-compose run --rm backend yii migrate

Access it in your browser by opening

- frontend: http://127.0.0.1:20080
- backend: http://127.0.0.1:21080

Use `admin/admin` for testing
