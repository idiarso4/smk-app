document.addEventListener('DOMContentLoaded', function() {
    const loginPage = document.querySelector('.fi-simple-layout');
    if (loginPage) {
        loginPage.classList.add('custom-login');
        
        const loginCard = document.querySelector('.fi-simple-card');
        if (loginCard) {
            loginCard.classList.add('custom-login-card');
        }
        
        const inputs = loginCard.querySelectorAll('input');
        inputs.forEach(input => {
            input.classList.add('custom-input');
        });
        
        const button = loginCard.querySelector('button[type="submit"]');
        if (button) {
            button.classList.add('custom-button');
        }
    }
}); 