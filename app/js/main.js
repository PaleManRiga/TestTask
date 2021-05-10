'strict'

let messages = [];
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const errorElement = document.getElementById('errorSpan');

    form.addEventListener('submit', formSend);
    

    async function formSend(e) {
        e.preventDefault();
        
        
        let error = formValidate(form);
        let formData = new FormData(form);

        if (error === 0) {
            let response = await fetch('#', {
                method: 'POST',
                body: formData}
            );
            if (response.ok){
                let result = await response.json();
                alert(result.message);
                formPreview.innerHTML = '';
                form.reset();
            } else {

            }
        } else {
            if (messages.length > 0 ) {
                errorElement.innerText = messages.join(', ');
            }
            //error message

        }
    }

    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');
        

        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input);

            if (input.classList.contains('_email')) {
                if (emailTest(input)) {
                    formAddError(input);
                    messages.push('Please provide a valid e-mail address');
                    error++;
                }
            } else if (input.getAttribute('type') === 'checkbox' && input.checked === false) {
                formAddError(input);
                messages.push('You must accept the terms and conditions');
                error++;
            } else {
                if (input.value === '') {
                    formAddError(input);
                    messages.push('Email address is required');
                    error++;
                }
            }
        }

        return error;
    }

    function formAddError(input) {
        // input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }
    function formRemoveError (input) {
        // input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }


    function emailTest(input) {
        return !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(input.value);
    }

    function succesScreen() {
        let element = document.getElementById('header__content');
        element.innerHTML = `<div class="header__content">
        <h1 class="header__content-heading">Subscribe to fuck</h1>
        <p class="header__content-text">Subscribe to our newsletter and get 10% discount on pineapple glasses.
        </p>
        <div class="wrapper">
            <div class="form">
                <form action="#" id="form" class="form__input">
                    <input type="text" id="formEmail" name="email" placeholder="Type your email address here…" class="form__input _req _email">
                    <button class="input_btn" type="submit">
                        <img src="images/ic_arrow.svg" alt="">
                    </button>
                    <span id="errorSpan"></span>

                    <div class="wrapper">
                    <div class="checkbox">
                        <input id="formAgreement" type="checkbox" name="agreement" class="checkbox__input _req">
                        <label for="formAgreement" class="checkbox__lable" ><span> I agree pissssssss <a href="#">terms of service</a></span></label>
                    </div>
                </div>

                </form>
            </div>
        </div>
        <!-- <label class="label__container">I agree to <a href="#">terms of service</a>
            <input type="checkbox" id="checkbox" class="_req">
            <span class="header__content-checkmark"></span>
            <span class="error" style="display: block;"></span>
        </label> -->

        <div class="header__baseline"></div>

        <div class="header__social">

            <a class="header__social-facebook" href="#"></a>


            <a class="header__social-instagram" href="#"></a>



            <a class="header__social-twitter" href="#"></a>


            <a class="header__social-youtube" href="#"></a>

        </div>
    </div>`
    }

});



