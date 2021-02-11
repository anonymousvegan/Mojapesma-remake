function prethodna(){
    var kartice=document.querySelectorAll("#pesme .kartica");
    var idevi=[];
    for (i=0; i<kartice.length; i++){
        idevi.push(parseInt(kartice[i].getAttribute("id")));
    }
    var index=idevi.indexOf(trenutnoaktivna);
    if(index>=1){
    var indexprehodne=index-1;
    var idprethodne=idevi[indexprehodne];
    prikazivise(idprethodne);
    }
}
function sledeca(){
    var kartice=document.querySelectorAll("#pesme .kartica");
    var idevi=[];
    for (i=0; i<kartice.length; i++){
        idevi.push(parseInt(kartice[i].getAttribute("id")));
    }
    var index=idevi.indexOf(trenutnoaktivna);
    if(index%5==0){
        prikazi_jos();
    }
    var indexsledece=index+1;
    var idsledece=idevi[indexsledece];
    prikazivise(idsledece);
}
