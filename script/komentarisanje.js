
var ekomentar = document.getElementById("unoskomentara");
ekomentar.addEventListener('keyup', function (e) {
    if(e.key=="Enter"){
        komentar=ekomentar.value;
        ekomentar.value="";
        autor=document.getElementById("autorkomentara").value;
        pesma=document.getElementById("id-pesme-za-komentarisanje").value;
        if(autor==""){
            prikazialert("Morate se ulogovati da bi ste komentarisali.")
        }else if(komentar!=""){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("komentari").innerHTML = this.responseText;
                    komentari=document.getElementById("komentari");
                    komentari.scrollTop=komentari.scrollHeight;
                }
            };
            xhttp.open("POST", "backend/dodajkomentar.php", false);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("komentar="+komentar+"&autor="+autor+"&pesma="+pesma);
        }
    }
  });
  function komentarisimobilni(){
    komentar=ekomentar.value;
    ekomentar.value="";
    autor=document.getElementById("autorkomentara").value;
    pesma=document.getElementById("id-pesme-za-komentarisanje").value;
    if(autor==""){
        prikazialert("Morate se ulogovati da bi ste komentarisali.")
    }else if(komentar!=""){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("komentari").innerHTML = this.responseText;
                komentari=document.getElementById("komentari");
                komentari.scrollTop=komentari.scrollHeight;
            }
        };
        xhttp.open("POST", "backend/dodajkomentar.php", false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("komentar="+komentar+"&autor="+autor+"&pesma="+pesma);
    }
}
function prikazikomentare(id){
    if(screen.width<=600){
        console.log("manje od 600")
        trenutnoaktivna=id;
        const kartica = document.getElementById(id);
        let vreme= kartica.querySelector(".vreme-tekst").textContent;
        let lajk= kartica.querySelector(".srce");
        let slikalajka= kartica.querySelector(".srce img");
        let brojlajkova= kartica.querySelector("span").textContent;
        const kontejner = document.querySelector(".pesma-preko-celog-ekrana");
        kontejner.classList.add("mobilni");
        const okvirzakomentare=kontejner.querySelector(".okvir-za-komentare")
        const okvirzapesmu= kontejner.querySelector(".okvir-za-pesmu")
        let vreme_ceo_ekran = kontejner.querySelector("#vreme-preko-celog-ekrana");
        let lajk_ceo_ekran=kontejner.querySelector("#lajkuj-preko-celog-ekrana");
        let brojlajkovaceoekran = kontejner.querySelector("#brojlajkovaceoekran");
        let slikalajkaceoekran = kontejner.querySelector("#lajkuj-preko-celog-ekrana img");
        slikalajkaceoekran.setAttribute("src", slikalajka.getAttribute("src"))
        vreme_ceo_ekran.textContent=vreme;
        brojlajkovaceoekran.textContent=brojlajkova;
        lajk_ceo_ekran.setAttribute("onclick", (lajk.getAttribute("onclick")));
        var pesmazakomentarisanje=document.getElementById("id-pesme-za-komentarisanje");
        pesmazakomentarisanje.setAttribute("value",id)
        var boje=["bela","crvena", "narandzasta", "zuta", "zelena", "plavozelena","svetloplava","tamnoplava","ljubicasta","roze","braon","dark"];
        for (i=0; i<boje.length; i++){
            okvirzapesmu.classList.remove(boje[i]);
            okvirzakomentare.classList.remove(boje[i])
        }
        klasenakartici=kartica.classList;
        nizklasanakartici=[...klasenakartici];
        for (i=0; i<boje.length; i++){
            if(nizklasanakartici.indexOf(boje[i])!=-1){
                okvirzapesmu.classList.add(boje[i]);
                okvirzakomentare.classList.add(boje[i])
            }
        }
        kontejner.classList.add("prikazi-pesmu-na-ceo-ekran")
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("komentari").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "ispiskomentara.php", false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+id);
        komentari=document.getElementById("komentari");
        komentari.scrollTop=komentari.scrollHeight;}
    else{
        prikazivise(id);
        document.querySelector(".pesma-preko-celog-ekrana").classList.remove("mobilni");
    }
}
function  prikazi_vise_ceo_ekran(){
    var kartica=document.querySelector("#pesme .kartica");
    id=kartica.getAttribute("id")
    prikazivise(id);
}