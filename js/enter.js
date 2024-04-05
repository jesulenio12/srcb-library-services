let button = document.querySelector('button');
button.addEventListener('keyup', (e) => {
    if(e.keyCode === 13) {
        console.log(e.target.value);
    }
})