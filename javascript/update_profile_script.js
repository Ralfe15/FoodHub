function togglePassword(fieldName){
    const states = {'text':'password' , 'password':'text' }
    var p = document.getElementById(fieldName);
    p.setAttribute('type', states[p.getAttribute('type')])
}