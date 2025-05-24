<x-layouts.custome.header>
    <div id="photo-grid" class="flex mt-12 flex-col gap-2 max-w-6xl mx-auto"></div>

    <!-- Modal -->
<div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 transition-opacity duration-300">
  <div id="modalContent" class="bg-white opacity-0 scale-95 transition-all duration-300 transform mr-auto ml-auto mt-12 rounded-lg max-w-3xl w-full mx-4 overflow-hidden shadow-lg relative">
    <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl">&times;</button>
    <img id="modalImage" class="w-full max-h-[70vh] object-contain" src="" alt="Expanded Image">
    <div class="p-4 border-t">
      <p id="modalDescription" class="text-lg text-gray-700"></p>
    </div>
  </div>
</div>

<script>
  const images = [
    { src: "https://picsum.photos/id/1015/600/400", description: "A peaceful landscape with a river." },
    { src: "https://picsum.photos/id/1016/300/500", description: "Portrait of a city building at dusk." },
    { src: "https://picsum.photos/id/1018/450/300", description: "Rolling hills with warm evening light." },
    { src: "https://picsum.photos/id/1021/350/500", description: "Old street corner captured in vintage tones." },
    { src: "https://picsum.photos/id/1024/600/400", description: "Beautiful sunrise over the ocean." },
    { src: "https://picsum.photos/id/1025/300/300", description: "Close-up of colorful flowers." },
    { src: "https://picsum.photos/id/1035/400/600", description: "Foggy forest trees in the morning." },
    { src: "https://picsum.photos/id/1041/500/333", description: "Modern architecture and symmetry." },
  ];

  const container = document.getElementById("photo-grid");
  const modal = document.getElementById("modal");
  const modalContent = document.getElementById("modalContent");
  const modalImage = document.getElementById("modalImage");
  const modalDescription = document.getElementById("modalDescription");
  const closeModal = document.getElementById("closeModal");

  function getContainerWidth() {
    return container.clientWidth;
  }

  function showModal(src, description) {
    modal.classList.remove("hidden");
    // Wait for reflow before adding transition classes
    requestAnimationFrame(() => {
      modalContent.classList.remove("opacity-0", "scale-95");
      modalContent.classList.add("opacity-100", "scale-100");
    });
    modalImage.src = src;
    modalDescription.textContent = description;
  }

  function hideModal() {
    modalContent.classList.remove("opacity-100", "scale-100");
    modalContent.classList.add("opacity-0", "scale-95");
    setTimeout(() => {
      modal.classList.add("hidden");
    }, 300); // Tailwind transition duration match
  }

  closeModal.addEventListener("click", hideModal);
  modal.addEventListener("click", (e) => {
    if (e.target === modal) hideModal();
  });

  function createRow(imageRow, rowHeight) {
    const rowDiv = document.createElement("div");
    rowDiv.className = "flex gap-2";

    imageRow.forEach(({ src, width, height, description }) => {
      const img = document.createElement("img");
      const ratio = width / height;
      img.src = src;
      img.className = "rounded-lg shadow-sm object-cover cursor-pointer hover:opacity-90 transition";
      img.style.height = `${rowHeight}px`;
      img.style.width = `${Math.round(rowHeight * ratio)}px`;

      img.addEventListener("click", () => {
        showModal(src, description);
      });

      rowDiv.appendChild(img);
    });

    container.appendChild(rowDiv);
  }

  function buildGrid() {
    container.innerHTML = "";
    const targetHeight = 200;
    const gap = 8;
    let imageRow = [];
    let rowAspectRatio = 0;

    const imagePromises = images.map(({ src, description }) => {
      const img = new Image();
      img.src = src;
      return new Promise(resolve => {
        img.onload = () => {
          resolve({
            src: img.src,
            width: img.naturalWidth,
            height: img.naturalHeight,
            description
          });
        };
      });
    });

    Promise.all(imagePromises).then(loadedImages => {
      loadedImages.forEach(image => {
        const aspectRatio = image.width / image.height;
        imageRow.push(image);
        rowAspectRatio += aspectRatio;

        const totalWidth = rowAspectRatio * targetHeight + (imageRow.length - 1) * gap;
        if (totalWidth >= getContainerWidth()) {
          const adjustedHeight = (getContainerWidth() - (imageRow.length - 1) * gap) / rowAspectRatio;
          createRow(imageRow, adjustedHeight);
          imageRow = [];
          rowAspectRatio = 0;
        }
      });

      if (imageRow.length > 0) {
        createRow(imageRow, targetHeight);
      }
    });
  }

  window.addEventListener("resize", () => {
    clearTimeout(window._resizeTimer);
    window._resizeTimer = setTimeout(buildGrid, 200);
  });

  buildGrid();
</script>


</x-layouts.custome.header>
