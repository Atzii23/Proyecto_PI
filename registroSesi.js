// 1. Definimos la función que hace el trabajo de buscar los datos
function cargarLogs() {
    const lista = document.getElementById('lista-entradas');
    
    fetch('registroSesi.php')
        .then(res => {
            if (!res.ok) throw new Error('Error en la red');
            return res.json();
        })
        .then(data => {
            console.log("Actualizando historial...", data);
            
            if (data.length === 0) {
                lista.innerHTML = "<p style='text-align:center;'>No hay registros de acceso.</p>";
                return;
            }

            // Usamos .map para crear todas las tarjetas y .join('') para convertirlas en texto
            lista.innerHTML = data.map(log => `
                <div class="log-card" style="background:#fff; padding:15px; border-radius:10px; margin-bottom:10px; border-left:5px solid #FF6600; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align:left;">
                    <p style="margin:0; font-weight:bold; color:#333;">${log.nombre}</p>
                    <p style="margin:0; font-size:13px; color:#666;">${log.correo}</p>
                    <p style="margin:5px 0 0; font-size:11px; color:#999;"><i class="fas fa-clock"></i> ${log.fecha_entrada}</p>
                </div>
            `).join('');
        })
        .catch(err => {
            console.error("Error al cargar:", err);
            // Solo mostramos error si la lista está vacía (para no borrar lo que ya había si falla el internet)
            if (lista.innerHTML === "" || lista.innerHTML.includes("Cargando")) {
                lista.innerHTML = "<p style='color:red; text-align:center;'>Error al conectar con los datos.</p>";
            }
        });
}

// 2. Cuando la página carga por primera vez, ejecutamos la función
document.addEventListener("DOMContentLoaded", cargarLogs);

// 3. Se ejecuta sola cada 5 segundos para ver si hay usuarios nuevos
setInterval(cargarLogs, 5000);