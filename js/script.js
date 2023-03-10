function disableInput() {
    const aux = document.getElementById("register");
    if (aux) {
        const submit_btn = document.getElementById("create-btn");
        const regist_input = document.querySelector('#register label input[name="registration"]');
        // console.log(regist_input);
        submit_btn.disabled = true;
        if (regist_input!=null) regist_input.disabled = true;

        const usertype = document.getElementById("usertype");
        if (usertype!=null) {
            usertype.addEventListener('click', function() {
                const error_msg = document.getElementById("error_msg");
                error_msg.textContent = "";
    
                // console.log(usertype.value);
                if (usertype.value=='null') {
                    regist_input.disabled = true;
                    submit_btn.disabled = true;
                    submit_btn.textContent = 'Criar conta';
                }
                else {
                    submit_btn.disabled = false;
                }
    
                if (usertype.value=='owner') {
                    regist_input.disabled = true;
                    submit_btn.textContent = 'Criar restaurante';
                }
                if (usertype.value=='customer') {
                    regist_input.disabled = true;
                    submit_btn.textContent = 'Criar conta';
                }
                if (usertype.value=='driver') {
                    regist_input.disabled = false;
                    submit_btn.textContent = 'Criar conta';
                }
            });
        }

        const resttype = document.getElementById("resttype");
        if (resttype!=null) {
            resttype.addEventListener('click', function() {
                const error_msg = document.getElementById("error_msg");
                error_msg.textContent = "";
    
                // console.log(usertype.value);
                if (resttype.value=='null') {
                    submit_btn.disabled = true;
                }
                else {
                    submit_btn.disabled = false;
                }
            });
        }
    }
}
disableInput();



function change_fav(elem, $user, $product, $type) {
    data = {
        'id_user': $user,
        'id_product': $product,
        'type': $type,              // 1->restaurant, 2->dish
        'function': 0               // 1->add, 2->delete
    }

    if ($type==1) {
        if (document.getElementById("fav_icon").classList.contains('fa-heart-o')) {
            data.function = 1;
            // console.log(data.function);
            postData(data, '/database/favourites.php');
            document.getElementById("fav_icon").classList.remove('fa-heart-o');
            document.getElementById("fav_icon").classList.add('fa-heart');
        }
        else {
            data.function = 2;
            // console.log(data.function);
            postData(data, '/database/favourites.php');
            document.getElementById("fav_icon").classList.remove('fa-heart');
            document.getElementById("fav_icon").classList.add('fa-heart-o');
        }
    }

    else if ($type==2) {
        if (elem.classList.contains('fa-heart-o')) {
            data.function = 1;
            // console.log(data.function);
            postData(data, '/database/favourites.php');
            elem.classList.remove('fa-heart-o');
            elem.classList.add('fa-heart');
        }
        else {
            data.function = 2;
            // console.log(data.function);
            postData(data, '/database/favourites.php');
            elem.classList.remove('fa-heart');
            elem.classList.add('fa-heart-o');
        }
    }
}

function del_cart(id, id_rest) {
    data = {
        'id': id,
        'id_rest': id_rest
    }
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    postData(data, '/database/delete_cart.php');
    window.location.reload();
}

function del_dish(id) {
    data = {
        'id_dish': id
    }
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    postData(data, '/database/delete_dish.php');
    window.location.reload();
}

async function postData(data, url) {
    return fetch(url, {
        method: 'post',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: encodeForAjax(data)
    })
}
function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}


function open_modal(id, id_rest, name, t) {
    var modal = document.getElementById("myModal");
    var p = document.getElementById("modal-p");
    var btn = document.getElementById("modal-btn");
    modal.style.display = "block";

    if (t==0) {
        p.textContent = 'Tem a certeza que quer eliminar este prato ' + name + '?';
        btn.textContent = 'Eliminar';
        btn.addEventListener('click', function() {del_dish(id)});
    }
    else if (t==1) {
        p.textContent = 'Tem a certeza que quer remover o prato ' + name + ' do carrinho?';
        btn.textContent = 'Remover';
        btn.addEventListener('click', function() {del_cart(id, id_rest)});
    }
}
function close_modal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}