<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>workers</title>
    <script>
        (function(){
            var key = '<?=$_GET['key']?>';
            var databaseConnect = false;
            var work = null;
            ajax('search.php','POST',{
                    key:key
                },function(res){
                    if(res){
                        databaseConnect = true;
                    }else{
                        ajax('create.php','POST',{
                            key:key
                        },function(){
                            databaseConnect = true;
                        },false);
                    }
                },false);
                if(databaseConnect){
                    work = new SharedWorker('main.js', key);
                    ajax('getValue.php','POST',{
                        key:key
                    },function(res){
                        work.port.postMessage({
                            value:res                            
                        });
                    },false)
                }
                window.onload = function () {
                    var num = document.getElementById('num');
                    var content = document.getElementById('content');
                    

                    work.port.onmessage = function (e) {
                        let value = e.data;
                        content.value = value;
                        ajax('update.php','POST',{
                            key:key,
                            content:value
                        });
                    }

                    content.oninput = function () {
                        let value = this.value;
                        work.port.postMessage({
                            value:value 
                        });
                    }
                
                }
                function ajax(url,method,jsonData,callback=null,async=true){
                    let xhr = new XMLHttpRequest();
                    xhr.open(method,url,async);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    
                    xhr.onload = function(){
                        if(callback !=null)
                            callback(this.responseText)
                    }
                    let data = jsonToAjaxData(jsonData);
                    xhr.send(data);
                }
                function jsonToAjaxData(data){
                    let keys = Object.keys(data);
                    let values = [];
                    keys.forEach(key=>{
                        values.push(`${key}=${data[key]}`);
                    });
                    return values.join('&');
                }
        })();
   
    </script>
    <style>
        #content {
            width: 500px;
            height: 500px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>

<body>
    <textarea id="content"></textarea>
</body>

</html>