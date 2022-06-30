# Rhea facility data extension

This repository handles the facility data which can be used to simulate ....

## Prerequisites

* Installed version of Rhea: https://github.com/phytec/ptf-rhea-dev
* Access to the defined database in Rhea

## Installing

### Development System

If you are using the development system all installing steps are already executed and you just have to execute the **
.sql** scripts on your database: ``` sh rhea-web/code/rhea-yii2/vendor/flux711/facility-code-dev/facility-dev.sh ```

### Production System

Add into the **require** section of your composer.json file the following
string: ```"flux711/facility-code-dev": "dev-master" ```    
and update composer: ```sudo docker exec -it --user www-data rhea_web_1 composer update -d rhea-yii2```

Go to your application config file inside the module section (e.g. rhea-yii2/api/config/main-local.php) and add the
following to your config to connect the project to your module:

```
$config['bootstrap'][] = 'facility';
$config['modules']['facility'] = [
  'class' => 'rhea\facility\Module',
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

## Usage

Your Rhea instance should now contain a facility section which can be operated by a privileged user.
