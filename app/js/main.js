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

            form.submit();
            window.location.href = 'success.html';
            
            
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
        document.getElementById('content').innerHTML = `
        
        <div class="wrapper" id='content'>            
            <img src="images/ic_success.svg" alt="succesimg">
            <h1 class="header__content-heading--success">Thanks for subscribing!</h1>
            <p class="header__content-text--succes">You have successfully subscribed to our email listing. Check your email for the discount code.</p>
        </div>
        `;
    }
});



