<h2>Installation</h2>

<ul>
    <li>Git clone this repository or download this as ZIP</li>
        <ul>
            <li>https://github.com/plcardano/be-training.git</li>
        </ul>
    <li>After cloning or downloading zip (unzip it afterwards), then open terminal and cd into it.</li>
    <li>Update composer:</li>
        <ul>
            <li>composer update</li>
        </ul>
    <li>Install npm:</li>
        <ul>
            <li>npm install</li>
        </ul>
    <li>Create new database</li>
    <li>Create new .env file, copy the content of .env.example</li>
        
        Update the following:
        DB_DATABASE=laravel <--the database you created
        DB_USERNAME=root    <--your db username
        DB_PASSWORD=        <--your db password
</ul>

<ul>
    <li>Generate APP Key:</li>
        <ul>
            <li>php artisan key:generate</li>
        </ul>
    <li>Migrate database:</li>
        <ul>
            <li>php artisan migrate --seed</li>
        </ul>
    <li>Run server:</li>
        <ul>
            <li>php artisan serve</li>
        </ul>
    <li>Open your browser:</li>
        <ul>
            <li>http://localhost:8000</li>
        </ul>
    <li>Default login:</li>
    
        Username: admin or admin@admin.com
        Password: password
</ul>


    
