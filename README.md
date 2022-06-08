# Rhea facility data extension

This repository handles the facility data which can be used to simulate ....

## Prerequisites

* Installed version of Rhea: https://github.com/phytec/ptf-rhea-dev
* Access to the defined database in Rhea

## Installing

* Add into the require section of your composer.json file the following
  string: ```"flux711/facility-code-dev": "dev-master" ```  
  and update composer: ```composer update --ignore-platform-reqs```

* Go to your application config file inside the module section (e.g.
  ptf-rhea-dev/rhea-web/code/rhea-yii2/api/config/main-local.php)  
  and add the following to your config:

```
$config['bootstrap'][] = 'facility';
$config['modules']['facility'] = [
  'class' => 'flux711\yii2\facility_code_dev\Module',
  // uncomment the following to add your IP if you are not connecting from localhost.
  //'allowedIPs' => ['127.0.0.1', '::1'],
];
```

* Add the new database tables to your existing databse by executing either the script file with:

```
sh ./rhea-web/code/rhea-yii2/vendor/flux711/facility-code-dev/import-tables.sh 
```

**or** directly via the command line with:

```
sudo docker exec -i rhea_mysql_1 mysql -uroot -prhea1 rhea-dev < ./facility-mysql/database/.
```

## Usage

Your Rhea instance should now contain a facility section which can be operated by a privileged user.
