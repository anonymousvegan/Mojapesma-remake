function proveriUnos(){
    var naslov=document.getElementById("naslov");
    var pesma=document.getElementById("unospesme");
    var kategorija=document.getElementById("kategorija");
    if  (naslov.value.length<2){
        prikazialert("Naslov  mora imati najmanje 3 slova")
        return false;
    }
    else if(pesma.value.length<30){
        prikazialert("Pesma mora imati najmanje 30 slova")
        return false;
    }
    else if(kategorija.value=="neodredjeno"){
        prikazialert("Molimo vas da odaberete kategoriju")
        return false;
    }
}