const form = document.querySelector('form')
const documentInpt = document.querySelector('input[name="document"]')
const phoneInpt = document.querySelector('input[name="phone"]')
const birthDateInpt = document.querySelector('input[name="date"]')
const passwordInpt = document.querySelector('input[name="password"]')
const confirmPasswordInpt = document.querySelector('input[name="confirmPassword"]')

VMasker(documentInpt).maskPattern('999.999.999-99')
VMasker(phoneInpt).maskPattern('+99 99 99999-9999')
VMasker(birthDateInpt).maskPattern('9999/99/99')

form.addEventListener('submit', e => {
    if (confirmPasswordInpt.value !== passwordInpt.value) {
        e.preventDefault()
        alert('Passwords must be equal!')
        return
    }
})