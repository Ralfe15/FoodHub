function togglePassword(fieldName){
    const states = {'text':'password' , 'password':'text' }
    var p = document.getElementById(fieldName);
    p.setAttribute('type', states[p.getAttribute('type')])
}

function readURL(input) {
    console.log("a")
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        const preview = document.getElementById("avatar-preview")
        preview.src = e.target.result
        preview.style.width = '200px'
        preview.style.height = '200px'

        // document.getEL('#blah')
        //   .attr('src', e.target.result)
        //   .width(150)
        //   .height(200);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }