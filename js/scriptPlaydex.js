window.onload = function () {
    const index = document.getElementById("index");
    const info = document.getElementById("info");
    const explorar = document.getElementById("explorar");

    const activePage = localStorage.getItem("activePage");
  
    if (activePage === "index"){ 
        index.classList.add("active");
        info.classList.remove("active");
        explorar.classList.remove("active");
    } else if (activePage === "info") {
        info.classList.add("active");
        index.classList.remove("active");
        explorar.classList.remove("active");
    } else if (activePage === "explorar") {
        explorar.classList.add("active");
        index.classList.remove("active");
        info.classList.remove("active");
    } else {
        index.classList.add("active");
        info.classList.remove("active");
        explorar.classList.remove("active");
    }
  
    index.addEventListener("click", () => localStorage.setItem("activePage", "index"));
    info.addEventListener("click", () => localStorage.setItem("activePage", "info"));
    explorar.addEventListener("click", () => localStorage.setItem("activePage", "explorar"));
  };
  