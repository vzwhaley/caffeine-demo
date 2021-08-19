## Caffeine Demo Application

### BACKGROUND

I love caffeine... I need an application that will tell me if I am consuming safe levels of caffeine. Assuming that 500mg 
of caffeine is safe, I need to be able to select one of my favorite drinks and log an entry when I have consumed a 
specific beverage on any given date. In addition, I need to be able to see how many of each drink I can have on a daily 
basis based on how many of a specific drink I have consumed. Also, it would be nice to have a historic log of how many
caffeinated beverages I have consumed in the past.

I wrote this application using the following technologies:

- **`PHP version 7.3.27`**
- **`MySQL version 5.7.29`**
- **`Laravel version 8.55.0`**
- **`Vue.js version 2.6.14`**
- **`Bootstrap version 4.6.0`**

### CODE SETUP

This application uses Lando to set up a local development environment. While I do have experience writing custom
Docker compose files, as well, I have found Lando extremely helpful and reliable for getting a local dev environment up
and running rather quickly and smoothly.

- Install Lando: https://docs.lando.dev/basics/installation.html
- Install Composer: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos
- Install Node Package Manager: https://docs.npmjs.com/downloading-and-installing-node-js-and-npm

Clone the repository OR unpack contents of caffeine_demo.zip, if available, and navigate to the root directory.

In a terminal, run the following:

`lando start`

NOTE: You can easily see Lando's web and database settings by running the following:

`lando info`

### DEPENDENCIES

Install PHP dependencies by running the following in a terminal:

`lando composer install`

Install Frontend Dependencies by running the following in a terminal:

`npm install`

`npm run dev` OR `npm run watch`

If you are curious as to what dependency packages I chose to use for this application, feel free to take a look at
`composer.json` and `package.json`.

### DATABASE SETUP

Next, run Laravel Migrations to set up the database:

`lando artisan migrate`

If you would rather run commands in your SQL IDE of choice, I have provided a standalone SQL file in the 
`/database` directory.

### LOAD LOCAL WEBSITE IN BROWSER

After following the above instructions, access the website in a browser by navigating to http://caffeine-demo.lndo.site/.

If the website loads correctly, use the following to log into the application:

- E-mail Address: admin@caffeinedemo.com
- Password: admin

If the website did not load correctly in a browser, please check the settings in the `.env` file and also in the
`/config/database.php` file to ensure all settings are correct based on the settings you see when running `lando info`.

### APPLICATION FEATURES

**Home Page**: This page contains a login form to ensure the user is authenticated before accessing the Caffeine Demo 
application.

**My Drink List**: This page contains two tables with user drink data. The User Drink List for the Current Day displays how
many favorite drinks a user has consumed on the current day. The All-Time Consumed Drink List table shows a historical
log of how many drinks the user consumed on past dates with the table sorted by most recent date.

**Add My Drink**: This page contains a form for the user to choose a drink and consumption date to add to the database. Each
time the user consumes a drink, they will simply submit this form and the totals are calculated on the My Drink List page.

**Master Drink List**: This page contains all the user's favorite drinks stored in the database. From this page, a user 
can Create Drink, Edit Drink and Delete Drink. These CRUD functions are all performed via Laravel and VueJS API routing.

**Create Drink**: This page contains a form for the user to add a drink to the Master Drink List.

### EXAMINING CODE

The main files for examining logic in this application include:

- `database/migrations/*`
- `app/Http/Controllers/*`
- `app/Models/*`
- `resources/js/components/*`
- `resources/js/app.js`
- `resources/js/routes.js`
- `routes/api.php`
- `routes/web.php`
