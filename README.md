# Rhea facility data extension

This repository handles the facility data which can be used to simulate ....

## Prerequisites

* Installed version of Rhea: https://github.com/phytec/ptf-rhea-dev
* Access to the defined database in Rhea

## Installing

### Development System

If you are using the development system all installing steps are already executed and you just have to execute the **.sql** scripts on your database. For further instuction just head to the Database section.

### Production System

Add into the **require** section of your composer.json file the following string: ```"flux711/facility-code-dev": "dev-master" ```and update composer: ```composer update --ignore-platform-reqs```

Go to your application config file inside the module section (e.g. rhea-yii2/api/config/main-local.php) and add the following to your config to connect the project to your module:

```
$config['bootstrap'][] = 'facility';
$config['modules']['facility'] = [
  'class' => 'flux711\yii2\facility_code_dev\Module',
  // uncomment the following to add your IP if you are not connecting from localhost.
  //'allowedIPs' => ['127.0.0.1', '::1'],
];
```
Also in the same file add the following to connect to the new database for the facility data (change details accordingly):

```
$config = [
'components' => [
  'db_facility' => [
    'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=mysql;dbname=facility-dev',
      'username' => 'root',
      'password' => 'password',
      'charset' => 'utf8',
    ],
  ],
];
```

### Database

Add the new database tables to your existing databse by executing the **.sql**-files directly to your database.  You can find them under ```facility-mysql/database/*.sql``` in this project or via this link https://github.com/flux711/ptf-facility-yii2-code-dev/tree/master/facility-mysql/database

## Usage

Your Rhea instance should now contain a facility section which can be operated by a privileged user.
