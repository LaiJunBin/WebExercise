# Template

api需修改 api/core/db.php中約第227行來存取資料庫
```php
    $db_host = "your host";
    $db_name = "your db name";
    $username = "your username";
    $password = "your password";
```

## Command description

> gc [dir] 

description: 建立Component

Example: 

* `gc app/home` -> 生成app/home資料夾並建立home component
* `gc app/a/b/c` -> 生成app/a/b/c資料夾並建立c component

斜線使用 `/` or `\`皆可。

> gapi [dir] 

description: 建立API

Example: 

* `gapi TestController` -> 在 api/src/controller 中建立 TestController的類別檔案，包含[基本架構](api/src/controller/TestController.php)

[Template DEMO](http://18.179.174.169/50_skill/locale/template)