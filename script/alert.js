function prikazialert(tekst){
    eAlert= document.getElementById("alert");
    eAlert.textContent=tekst;
    eAlert.classList.remove("prikazialert");
    eAlert.classList.add("prikazialert");
    setTimeout(() => {
        eAlert.classList.remove("prikazialert");
    }, 5000);
}