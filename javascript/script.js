function togglePassword(){
    const states = {'text':'password' , 'password':'text' }
    var p = document.getElementById('password');
    p.setAttribute('type', states[p.getAttribute('type')])
}