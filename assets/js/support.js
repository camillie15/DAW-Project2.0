document.addEventListener("DOMContentLoaded", function () {
    // Modales y botones
    const deleteIcons = document.querySelectorAll(".bi-trash");
    const confirmDeleteModal = document.getElementById("confirmDeleteModal");
    const confirmDeleteButton = document.getElementById("confirmDeleteButton");
    const cancelButton = confirmDeleteModal.querySelector("button");
      
    // Abrir modal de confirmación de eliminación
    deleteIcons.forEach((icon) => {
      icon.addEventListener("click", function (event) {
        event.preventDefault();
        closeAllModals(); // Cierra otros modales
        const requestId = this.parentElement.getAttribute("data-request-id");
  
        if (requestId) {
          confirmDeleteButton.href = `index.php?c=support&f=delete_request&requestId=${requestId}`;

          confirmDeleteModal.style.display = "block";
        } else {
          console.error("No se pudo obtener el requestId.");
        }
      });
    });
  
    // Cancelar eliminación
    cancelButton.addEventListener("click", function () {
      confirmDeleteModal.style.display = "none";
    });
  
    // Cerrar modal de confirmación al hacer clic fuera de él
    window.addEventListener("click", function (event) {
      if (event.target == confirmDeleteModal) {
        confirmDeleteModal.style.display = "none";
      }
    });
  

    const viewIcons = document.querySelectorAll(".bi-eye");
    const responseModal = document.getElementById("responseModal");
    const responseContent = document.getElementById("responseContent");
    const closeModalButton = document.getElementById("closeModalButton");
    
    // Abrir modal de respuesta
    viewIcons.forEach((icon) => {
      icon.addEventListener("click", async function (event) {
        event.preventDefault();
        closeAllModals(); // Cierra otros modales
        const requestId = this.parentElement.getAttribute("data-request-id");
  
        if (requestId) {
          try {
            const response = await fetch(
              `index.php?c=support&f=showResponseByRequestId&requestId=${requestId}`
            );
            const content = await response.text();
  
            responseContent.innerHTML = content;
            responseModal.style.display = "block";
          } catch (error) {
            console.error("Error al cargar la respuesta:", error);
            responseContent.innerHTML =
              "<p>Error al cargar los detalles de la respuesta.</p>";
            responseModal.style.display = "block";
          }
        } else {
          console.error("No se pudo obtener el requestId.");
        }
      });
    });
  
    // Cerrar modal de respuesta
    closeModalButton.addEventListener("click", function () {
      responseModal.style.display = "none";
    });
  
    // Cerrar modal de respuesta al hacer clic fuera de él
    window.addEventListener("click", function (event) {
      if (event.target == responseModal) {
        responseModal.style.display = "none";
      }
    });
    // Cerrar todos los modales
    function closeAllModals() {
        confirmDeleteModal.style.display = "none";
        responseModal.style.display = "none";
      }
  });
  