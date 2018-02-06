var searchMemberButton = document.getElementById('searchMemberButton');
searchMemberButton.addEventListener('click', function (evt) {
    var username = searchForm.username.value;
    if (username != "") {
        evt.preventDefault();
        var dataset = new FormData();
        dataset.append('username', username);
        var req = new XMLHttpRequest();
        req.open('POST', './assets/php/search.php');
        req.onload = function () {
            var node = document.getElementById('searchResult');
            node.innerText = this.responseText;
        };
        req.send(dataset);
    }
}, false);