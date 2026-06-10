import './bootstrap';
import Alpine from 'alpinejs';

import.meta.glob([

    '../images/**',

    '../fonts/**',

    '../images/games/**'

]);

window.Alpine = Alpine;

Alpine.start();

const button = document.querySelectorAll('.category-button')
const spinner = document.getElementById('spinner')
const container_productos = document.getElementById('products-container')
const error_text = document.getElementById('error-text')
const alertContainer = document.getElementById('mensaje_error')

if (button) {
    button.forEach(bttn => {
        bttn.addEventListener('click', () => {

            button.forEach(btn => {
                btn.classList.remove('active');
            });

            bttn.classList.add('active');

            spinner.classList.remove('d-none')
            container_productos.classList.add('d-none')

            const categoriaID = bttn.dataset.id ?? '';

            fetch(`/productos/filtrar?categoria_id=${categoriaID}`)
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`Error HTTP: ${res.status}`);
                    }
                    return res.text();
                })
                .then(html => {
                    container_productos.innerHTML = html;
                })
                .catch(() => {
                    alertContainer.classList.remove('d-none')
                    alertContainer.classList.add('show')
                    error_text.textContent = 'Ha habido un problema'
                })
                .finally(() => {
                    spinner.classList.add('d-none')
                    container_productos.classList.remove('d-none')

                }
                );
        });
    });
}


const buttonClose = document.getElementById('alert-button')

if (buttonClose) {
    buttonClose.addEventListener('click', () => {
        alertContainer.classList.remove('show')
    })
}


const buttonMostrar = document.querySelectorAll('.button-mostrar')

if (buttonMostrar) {
    buttonMostrar.forEach(button => {
        button.addEventListener('click', () => {
            const pedidoID = button.dataset.pedido;
            var tabla = document.querySelectorAll(`.tabla-pedidos[data-pedido="${pedidoID}"]`)

            tabla[0].classList.toggle('mostrarTabla');
            button.classList.toggle('active-mostrar')
        })
    });
}


