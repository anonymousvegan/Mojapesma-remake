var zadnjielement, otvoren;
otvoren=false;
function prikaziOpcije(a){
    if(otvoren && zadnjielement!=a){
        zadnjielement.classList.remove("prikaziopcije");
    }
    if (a.classList.contains("prikaziopcije")){
        a.classList.remove("prikaziopcije");
        otvoren=false;
    }
    else{
        a.classList.add("prikaziopcije");
        otvoren=true;
        zadnjielement=a;
    }
}
function obrisi(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            prikazialert("Pesma je uspešno obrisana")
            prikazi_jos();
        }
    };
    xhttp.open("POST", "backend/obrisi.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("idpesme="+id);
}