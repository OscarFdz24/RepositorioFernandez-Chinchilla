let likesOn = document.querySelectorAll('.iconoLikeOn');
likesOn.forEach(likeOn => {
    likeOn.addEventListener('click', quitarLike);
});

let likesOff = document.querySelectorAll('.iconoLikeOff');
likesOff.forEach(likeOff => {
    likeOff.addEventListener('click', ponerLike);
});

function ponerLike() {
    let idPerfil = this.getAttribute('data-idPerfil');
    fetch('index.php?accion=insertar_like&id=' + idPerfil)
        .then(response => response.text())
        .then(text => {
            try {
                let respuesta = JSON.parse(text);
                console.log(respuesta);
                this.classList.remove("iconoLikeOff");
                this.classList.remove("fa-regular");
                this.classList.add("iconoLikeOn");
                this.classList.add("fa-solid");
                this.parentNode.querySelector('.numLikes').innerHTML = respuesta.numLikes;
                this.removeEventListener('click', ponerLike);
                this.addEventListener('click', quitarLike);
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response was:', text);
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
}

function quitarLike() {
    let idPerfil = this.getAttribute('data-idPerfil');
    fetch('index.php?accion=borrar_like&id=' + idPerfil)
        .then(response => response.text())
        .then(text => {
            try {
                let respuesta = JSON.parse(text);
                console.log(respuesta);
                this.classList.remove("iconoLikeOn");
                this.classList.remove("fa-solid");
                this.classList.add("iconoLikeOff");
                this.classList.add("fa-regular");
                this.parentNode.querySelector('.numLikes').innerHTML = respuesta.numLikes;
                this.removeEventListener('click', quitarLike);
                this.addEventListener('click', ponerLike);
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response was:', text);
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
}

function comprobarLikes(idPerfil) {
    fetch('index.php?accion=comprobar_likes&id=' + idPerfil)
        .then(response => response.text())
        .then(text => {
            try {
                let respuesta = JSON.parse(text);
                console.log(respuesta);
                let numLikesElement = document.querySelector('.numLikes-' + idPerfil);
                if (numLikesElement) {
                    numLikesElement.innerHTML = respuesta.numLikes;
                }
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.error('Response was:', text);
            }
        });
}