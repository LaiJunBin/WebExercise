# Restful API
>資料與回傳格式都是XML

## 路由設定


|方法|網址|動作|Header|
|---|---|---|---|
|GET|account/{account}|取得使用者|Authorization: Token {token}|
|POST|account/|新增使用者|Content-Type: application/xml|
|PATCH|account/{account}|修改使用者資訊|Content-Type: application/xml + Authorization: Token {token}|
|DELETE|account/{account}|刪除使用者|Authorization: Token {token}|

