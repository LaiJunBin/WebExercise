var joinForm = document.getElementById('joinForm');
if (joinForm !== null) {
    joinForm.addEventListener('submit', function (evt) {
        var username = joinForm.username.value;
        var password = joinForm.password.value;
        var passwordAgain = joinForm.passwordAgain.value;
        //帳號必須為6~8字
        if (username.length >= 6 && username.length <= 8) {
            //密碼與確認密碼是否相同
            if (password === passwordAgain) {
                //密碼必須包含大小寫字母及數字，且長度在8~20，更不能包含不合法字元(*/-.)
                if (password.length >= 8 && password.length <= 20) {
                    var stringPattern = 'abcdefghijklmnopqrstuvwxyz';
                    var lowerArray = stringPattern.split('');
                    var upperArray = stringPattern.toUpperCase().split('');
                    var numberArray = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
                    var lowerCount = matchString(password, lowerArray);
                    var upperCount = matchString(password, upperArray);
                    var numberCount = matchString(password, numberArray);
                    if (lowerCount > 0 && upperCount > 0 && numberCount > 0) {
                        if (lowerCount + upperCount + numberCount == password.length) {
                            dataset = new FormData();
                            dataset.append('username', username);
                            dataset.append('password', password);
                            req = new XMLHttpRequest();
                            req.open("POST", './assets/php/joinMember.php');
                            req.onload = function () {
                                alert(this.responseText)
                                if (this.responseText == '註冊成功')
                                    location.hash = '';
                            };
                            req.send(dataset);
                        } else
                            alert('密碼中包含不合法字元!')
                    } else
                        alert('密碼必須包含大小寫英文及數字!')
                } else
                    alert('密碼的長度必須在8~20字之間!');
            } else
                alert('兩次輸入的密碼不一樣!');
        } else
            alert('帳號的長度必須在6~8個字之間!');
        evt.preventDefault();

    }, false);
}
function matchString(data, arr) {
    var count = 0;
    for (key of data) {
        for (value of arr) {
            if (key == value)
                count++;
        }
    }
    return count;
}