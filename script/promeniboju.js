function promeni_boju(boja, rednibroj){
    var boje=document.getElementsByClassName("bojaizbor")
    for(i=boje.length-1; i>=0; i--){
    boje[i].classList.remove("aktivna")
    }
    boje[rednibroj].classList.add("aktivna");
    kartica=document.querySelector("#unos .kartica");
    kartica.classList.remove("crvena","bela","narandzasta","zuta","zelena","plavozelena","svetloplava","tamnoplava","ljubicasta","roze","braon","dark")
    kartica.classList.add(boja);
    textarea=document.querySelector("#unos textarea");
    textarea.classList.remove("crvena","bela","narandzasta","zuta","zelena","plavozelena","svetloplava","tamnoplava","ljubicasta","roze","braon","dark")
    textarea.classList.add(boja);
    input=document.querySelector("#unos input[type='text']");
    input.classList.remove("crvena","bela","narandzasta","zuta","zelena","plavozelena","svetloplava","tamnoplava","ljubicasta","roze","braon","dark")
    input.classList.add(boja);
    bojainput=document.getElementById("bojainput");
    bojainput.value=boja;
}
function promeni_tekst_pogodnosti(){
    var pogodnost_tekst= document.getElementById("pogodnost-tekst");
    if(screen.width<=400){
        pogodnost_tekst.textContent="Za sve uzraste?";
    }else{
        pogodnost_tekst.textContent="Ova pesma je pogodna za sve?";
    }
}
promeni_tekst_pogodnosti();
window.addEventListener("resize", promeni_tekst_pogodnosti);
//promena publike
function promeni_publiku(publika, rednibroj){
    var publike=document.getElementsByClassName("publika-izbor")
    for(i=publike.length-1; i>=0; i--){
    publike[i].classList.remove("aktivna-publika")
    }
    publike[rednibroj].classList.add("aktivna-publika");
    publikainput=document.getElementById("publikainput");
    publikainput.value=publika;
}