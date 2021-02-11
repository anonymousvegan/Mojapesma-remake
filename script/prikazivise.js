function dodaj(){
    document.getElementById("unos").classList.add("prikazi-unos");
}
function dodajneulogovan(){
    prikazialert("Ulogujete se da bi ste dodali pesmu");
}
function zatvori(){
    document.getElementById("unos").classList.remove("prikazi-unos");
}
var trenutnoaktivna=0;
function prikazivise(id){
    trenutnoaktivna=id;
    if(screen.width>=600){
        const kartica = document.getElementById(id);
        let naslov= kartica.querySelector(".naslov").textContent;
        let pisac = kartica.querySelector(".link-prema-piscu").textContent;
        let pesma=kartica.querySelector("p").textContent;
        let vreme= kartica.querySelector(".vreme-tekst").textContent;
        let lajk= kartica.querySelector(".srce");
        let slikalajka= kartica.querySelector(".srce img");
        let brojlajkova= kartica.querySelector("span").textContent;
        let profilna= kartica.querySelector(".profilna-pisca img");
        let dostupneopcije=kartica.querySelector(".opcije").innerHTML;
        const kontejner = document.querySelector(".pesma-preko-celog-ekrana");
        const okvirzapesmu= kontejner.querySelector(".okvir-za-pesmu");
        const okvirzakomentare=kontejner.querySelector(".okvir-za-komentare")
        let pisac_ceo_ekran= kontejner.querySelector("#pisac-preko-celog-ekrana");
        let profilna_ceo_ekran=kontejner.querySelector(".profilna-pisca-ceo-ekran img");
        let link_na_profilnoj=kontejner.querySelector(".profilna-pisca-ceo-ekran a")
        let naslov_ceo_ekran= kontejner.querySelector("#naslov-preko-celog-ekrana");
        let pesma_ceo_ekran = kontejner.querySelector("#tekst-pesme-preko-celog-ekrana");
        let vreme_ceo_ekran = kontejner.querySelector("#vreme-preko-celog-ekrana");
        let lajk_ceo_ekran=kontejner.querySelector("#lajkuj-preko-celog-ekrana");
        let brojlajkovaceoekran = kontejner.querySelector("#brojlajkovaceoekran");
        let slikalajkaceoekran = kontejner.querySelector("#lajkuj-preko-celog-ekrana img");
        let opcijeceoekran= kontejner.querySelector(".opcije");
        slikalajkaceoekran.setAttribute("src", slikalajka.getAttribute("src"))
        kontejner.classList.remove("mobilni");
        profilna_ceo_ekran.src=profilna.src;
        pisac_ceo_ekran.href="profil.php?profil="+pisac;
        link_na_profilnoj.href="profil.php?profil="+pisac;
        pisac_ceo_ekran.textContent=pisac;
        opcijeceoekran.innerHTML=dostupneopcije;
        pesma_ceo_ekran.textContent=pesma;
        naslov_ceo_ekran.textContent=naslov;
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
        komentari.scrollTop=komentari.scrollHeight;
    }
    else{
        const kartica = document.getElementById(id);
        kartica.style.height="auto";
        const p = kartica.querySelector("p");
        p.style.height="auto";
        location.href = "#"+id;
        kartica.querySelector("button").style.display="none"
    }
}
function zatvori_pesmu_preko_celog_ekrana(){
    grid();
    document.querySelector(".pesma-preko-celog-ekrana").classList.remove("prikazi-pesmu-na-ceo-ekran");
}
function prijavi(id){
    document.getElementById("prijavi").classList.add("prikazi");
    document.getElementById("id-pesme-za-prijavu").value=id;
}
function zatvoriprijavu(){
    document.getElementById("prijavi").classList.remove("prikazi")
}
//zatvori na esc 
document.addEventListener('keydown', function(event){
	if(event.key === "Escape"){
        zatvori();
        zatvori_pesmu_preko_celog_ekrana();
        zatvoriprijavu();
	}
});
