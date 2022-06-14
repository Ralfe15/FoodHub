function toggleSearch(){
    const val = document.querySelector('input[name="select"]:checked').value;
    const searchtype = document.querySelector(".search-type")
    searchtype.value = val;
}