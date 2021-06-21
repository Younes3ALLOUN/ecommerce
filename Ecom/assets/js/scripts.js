function sign() {
    document.getElementById('home').classList.remove('uk-active')
    document.getElementById('log').classList.remove('uk-active')
    document.getElementById('sign').classList.add('uk-active')
}
function login() {
    let params = new URLSearchParams(location.search);
    document.getElementById('home').classList.remove('uk-active')
    document.getElementById('sign').classList.remove('uk-active')
    document.getElementById('log').classList.add('uk-active')
    if (params.has('email'))
        document.getElementById('email_login').value = params.get('email')
}
function home() {
    let params = new URLSearchParams(location.search);
    document.getElementById('sign').classList.remove('uk-active')
    document.getElementById('log').classList.remove('uk-active')
    document.getElementById('home').classList.add('uk-active')
    if (params.has('by')) {
        document.getElementById('homelastp').href += ("&order=price&by=" + params.get('by'))
        document.getElementById('homenextp').href += ("&order=price&by=" + params.get('by'))
    }
    if (params.has('page')) {
        document.getElementById('pagenum' + params.get('page')).classList.add("uk-active");
    }
}

function logedhome() {
    let params = new URLSearchParams(location.search);
    document.getElementById('home').classList.add('uk-active')
    if (params.has('by')) {
        document.getElementById('homelastp').href += ("&order=price&by=" + params.get('by'))
        document.getElementById('homenextp').href += ("&order=price&by=" + params.get('by'))
    }
    if (params.has('page')) {
        document.getElementById('pagenum' + params.get('page')).classList.add("uk-active");
    }
}

function orderplaced() {
    alert("Your order has been placed...");
}