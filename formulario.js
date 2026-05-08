emailjs.init("a36r64ybnNLzTilkN");

// Referencias correctas a los IDs del HTML
const btn = document.getElementById("btn-submit");
const form = document.getElementById('support-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  btn.innerText = 'Enviando...'; 

  const serviceID = 'service_fgsn6so';
  const templateID = 'template_kg4at7o';

  // "this" se refiere al formulario que disparó el evento
  emailjs.sendForm(serviceID, templateID, this)
    .then(() => {
      btn.innerText = 'Enviar Reporte';
      alert('¡Reporte enviado! Nos contactaremos contigo lo antes posible.');
      form.reset(); 
    }, (err) => {
      btn.innerText = 'Enviar Reporte';
      alert("Error al enviar: " + JSON.stringify(err));
    });
});