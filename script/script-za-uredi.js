var submit, otkazi, odaberi, slika, trenutnaslika;
function podesi(){
document.querySelector("nav li:nth-of-type(3)").style.display="none";
submit= document.getElementById("submitdugme");
otkazi= document.getElementById("otkazi");
odaberi = document.getElementById("lfajl");
submit.style.display="none";
otkazi.style.display="none";
slika=document.getElementById("slika")
trenutnaslika= slika.src;
}
podesi();
function ubaci(event) {
    slika.src = URL.createObjectURL(event.target.files[0]);
    slika.onload = function() {
    URL.revo// oslobađa memoriju
    submit.style.display="block";
    otkazi.style.display="block";
    odaberi.textContent="Odaberi drugu sliku";
    }
};
function otkazivanje(){
    submit.style.display="none";
    otkazi.style.display="none";
    odaberi.textContent="Promenite sliku";
    vrati_staru(trenutnaslika);
}
function vrati_staru(staraslika){
    document.getElementById("slika").remove();
    var nova= document.createElement("IMG");
    document.getElementById("profilna").appendChild(nova);
    nova.setAttribute("src", trenutnaslika);
    nova.setAttribute("id", "slika")
    podesi();
}