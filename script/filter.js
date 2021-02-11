var reči = ["jeb", 
"kura",
"sranj",
"govn",
"ped",
"dupe", 
"sise",
"pičk",
"pick",
"kokain",
"heroin",
"marihuana",
"prostitut",
"alko"
]
function proveri(){
    var naslov, pesma;
    naslov=document.getElementById("naslov").value;
    pesma = document.getElementById("unospesme").value;
    tekst_za_proveru= naslov+pesma;
        proveri_string(tekst_za_proveru);
        function proveri_string(string){
        for(i=0; i<reči.length; i++){
        if(string.search(reči[i])!=-1) {
            document.getElementById("pogodna").value="nije";
            break;
        }
        else{   
            document.getElementById("pogodna").value="jeste";
        }
    }}}
function proveriUnos(){
    proveri()
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