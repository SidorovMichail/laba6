let menuOpen = document.querySelector('.menu-open');
menuOpen.addEventListener('click',function (){
    const menu = document.querySelector('.menu');
    menu.classList.toggle('show-menu');

})

let modalEnter = document.getElementById('windowEntrance');
let modalReg = document.getElementById('windowReg');
let overlay = document.getElementById('blackout');
let msg = '';
function openModal_Reg (){
    overlay.style.display = '';
    modalReg.style.display = '';
    document.documentElement.scrollTop;
    document.querySelector('body').classList.add('hidden-class');
}
function openModal_Enter (){
    overlay.style.display = '';
    modalEnter.style.display = '';
    document.documentElement.scrollTop;
    document.querySelector('body').classList.add('hidden-class');
}

function closeModal_Enter (){
    overlay.style.display = 'none';
    modalEnter.style.display = 'none';
    document.querySelector('body').classList.remove('hidden-class');
}

function closeModal_Reg (){
    overlay.style.display = 'none';
    modalReg.style.display = 'none';
    document.querySelector('body').classList.remove('hidden-class');
}

let regButton = document.querySelector('#Button_Reg');
let closeButtonReg = document.querySelector('.cross1');

let enterButton = document.querySelector('#Button_Enter');
let closeButtonEnter = document.querySelector('.cross');

regButton.addEventListener('click', function(){
    openModal_Reg();
})

closeButtonReg.addEventListener('click', function(){
    closeModal_Reg();
})

enterButton.addEventListener('click', function(){
    openModal_Enter();
})

closeButtonEnter.addEventListener('click', function(){
    closeModal_Enter();
    name.value=null;
    password.value=null;
})

const button_logIN = document.querySelector('#logIN');
const button_Register = document.querySelector('#Register');

let name = document.querySelector('.name');
let password = document.querySelector('.pword');
function CheckNameEnter(){
    if(name.value.length < 2)
        msg = 'Не заполнено поле Имя';
}
function CheckPasswordEnter(){
    if(password.value.length < 2)
        msg = 'Не заполнено поле Пароль';
}

button_logIN.addEventListener('click', function () {
    CheckNameEnter();
    CheckPasswordEnter();
    if(msg.length != 0){
        alert(msg);
    }
    else{
        console.log(name.value);
        console.log(password.value);
        closeModal_Enter();
    }
    msg = '';
});

let new_name = document.querySelector('.new_name');
let new_surname = document.querySelector('.new_surname');
let new_patr = document.querySelector('.new_patr');
let new_email = document.querySelector('.new_email');
let new_phone = document.querySelector('.new_phone');
let new_password = document.querySelector('.new_password');
let new_password_again = document.querySelector('.new_password_again');
let check_box = document.querySelector('.check_box');
let value_chek_box = check_box.checked;

function ValidMail() {
    var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    var myMail = new_email.value;
    var valid = re.test(myMail);
    if (valid){}
    else msg = 'Адрес электронной почты введен неправильно!';
}
 
function ValidPhone() {
    var re = /^(\+7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
    var myPhone = new_phone.value;
    var valid = re.test(myPhone);
    if (valid) 
        output = true;
    else
        msg = 'Некорректный номер телефона';
}  

function CheckName(){
    if(new_name.value.length < 2)
        msg = 'Не заполнено поле Имя';
    if(new_surname.value.length < 2)
        msg = 'Не заполнено поле Фамилия';
    if(new_patr.value.length < 2)
        msg = 'Не заполнено поле Отчество';
}
function CheckPassword(){
    if(new_password.value.length < 2)
        msg = 'Не заполнено поле Пароль';
    if(new_password.value != new_password_again.value)
        msg = 'Неправильно повторили пароль';
}

button_Register.setAttribute('disabled', true);
button_Register.style.background = "grey";
 
check_box.oninput = function(){
  if (!check_box.checked){
    button_Register.setAttribute('disabled', true);
  }else{
    button_Register.removeAttribute('disabled');
    button_Register.style.background = "#FFA945";
  }
}

let Form1 = document.getElementById('form1');
Form1.addEventListener('submit', function (event) {
    event.preventDefault();
    CheckName();
    ValidMail();
    ValidPhone();
    CheckPassword();
    if (msg.length != 0) {
        alert(msg);
    } else {
        // console.log(new_name.value);
        // console.log(new_email.value);
        // console.log(new_phone.value);
        // console.log(new_password.value);
        // console.log(new_password_again.value);
        // console.log(check_box.checked);
        // console.log(Form1);
        let registerForm = new FormData(Form1);
        console.log(registerForm);
        fetch('/addUs', {
                method: 'POST',
                body: registerForm
            }
        )
            .then(response => response.json())
            .then((result) => {
                console.log("123");
                if (result.errors) {
                    alert('Такой email уже существует !');
                    //вывод ошибок валидации на форму
                } else {
                    alert('Вы зарегистрировались!');
                    closeModal_Reg();
                    //успешная регистрация, обновляем страницу
                }
            })
            .catch(error => console.log(error));


    }
    msg = '';
});

let addAdvertisement = document.querySelector('#addAdvertisement');
addAdvertisement.addEventListener('click', function(){
    alert('Сначала авторизуйтесь!');
})
let addAdvertisement0 = document.querySelector('#addAdvertisement0');
addAdvertisement0.addEventListener('click', function(){
    alert('Сначала авторизуйтесь!');
})
