let slideIndex = 0;
showSlides();

function changeSlide(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("carousel-slide");
  
  if (n === undefined) { // Para el cambio automático
    slideIndex++;
  } else { // Para el cambio manual
    slideIndex = n;
  }

  if (slideIndex > slides.length) {slideIndex = 1}    
  if (slideIndex < 1) {slideIndex = slides.length}
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
    slides[i].className = slides[i].className.replace(" active", "");
  }
  
  slides[slideIndex-1].style.display = "block";  
  slides[slideIndex-1].className += " active";

  // hace q cambie cada 5 seg 
  if (n === undefined) {
    setTimeout(showSlides, 5000); 
  }
}

/*--------------------------------------------------------------*/

async function cargarCategoriasDiDi() {
    try {
        const respuesta = await fetch('https://www.themealdb.com/api/json/v1/1/categories.php');
        const datos = await respuesta.json();
        const contenedor = document.getElementById('menu-comida');
        contenedor.innerHTML = ''; 

        datos.categories.forEach(categoria => {
            // Creamos el elemento div en lugar de usar innerHTML directo para asignar el evento clic
            const card = document.createElement('div');
            card.className = 'card-didi';
            card.innerHTML = `
                <div class="imagen-contenedor">
                    <img src="${categoria.strCategoryThumb}" alt="${categoria.strCategory}">
                </div>
                <div class="info-comida">
                    <h4>${categoria.strCategory}</h4>
                    <p>Variedad de platillos seleccionados</p>
                    <span class="precio">$${Math.floor(Math.random() * (120 - 70) + 70)} MXN</span>
                </div>
            `;
            
            // Evento para abrir el modal con los detalles
            card.onclick = () => abrirDetalles(categoria);
            contenedor.appendChild(card);
        });
    } catch (error) {
        console.error("Error al cargar el menú:", error);
    }
}

function abrirDetalles(cat) {
    const modal = document.getElementById('modal-detalles');
    const contenido = document.getElementById('detalle-comida');

    contenido.innerHTML = `
        <img src="${cat.strCategoryThumb}" style="width:100%; border-radius:15px; margin-bottom:15px;">
        <h2 style="color:#ff6600;">${cat.strCategory}</h2>
        <p style="line-height:1.6; color:#666;">${cat.strCategoryDescription}</p>
        <button class="btn-ordenar-modal">Ver Platillos Disponibles</button>
    `;

    modal.classList.add('mostrar');
    document.body.style.overflow = 'hidden'; // Bloquea scroll de fondo
}

// Cerrar Modal
document.querySelector('.cerrar-modal').onclick = () => {
    document.getElementById('modal-detalles').classList.remove('mostrar');
    document.body.style.overflow = 'auto';
};

// Cerrar si hace clic fuera del cuadro blanco
window.onclick = (event) => {
    const modal = document.getElementById('modal-detalles');
    if (event.target == modal) {
        modal.classList.remove('mostrar');
        document.body.style.overflow = 'auto';
    }
};

cargarCategoriasDiDi();