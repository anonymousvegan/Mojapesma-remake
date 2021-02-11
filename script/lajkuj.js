function lajkuj(id, profil){
    document.getElementById(id).querySelector(".srce img").classList.remove("animirajsrce");
    document.getElementById("lajkuj-preko-celog-ekrana").querySelector("img").classList.remove("animirajsrce");
    var trenuta=document.getElementById(id).querySelector(".srce img").getAttribute("src");
    setTimeout(
        function(){
            if(trenuta=="fajlovi/srce-prazno.svg"){
                var ceoekran=document.getElementById("lajkuj-preko-celog-ekrana").querySelector("img");
                var ceoekran=document.getElementById("lajkuj-preko-celog-ekrana").querySelector("img");
                document.getElementById(id).querySelector(".srce img").src="fajlovi/srce-puno.png";
                ceoekran.src="fajlovi/srce-puno.png";
                document.getElementById(id).querySelector(".srce img").classList.remove("animirajsrcedva");
                ceoekran.classList.remove("animirajsrcedva");
                document.getElementById(id).querySelector(".srce img").classList.add("animirajsrce");
                ceoekran.classList.add("animirajsrce");
                var ispislajkova=document.querySelector("#lajkuj-preko-celog-ekrana span");
                var trenutanBroj=parseInt(ispislajkova.textContent);
                var novi=trenutanBroj+1;
                ispislajkova.textContent=novi;
            }
            if(trenuta=="fajlovi/srce-puno.png"){
                var ceoekran=document.getElementById("lajkuj-preko-celog-ekrana").querySelector(".srce img");
                document.getElementById(id).querySelector(".srce img").src="fajlovi/srce-prazno.svg";
                ceoekran.src="fajlovi/srce-prazno.svg";
                document.getElementById(id).querySelector(".srce img").classList.remove("animirajsrce");
                ceoekran.classList.remove("animirajsrce");
                document.getElementById(id).querySelector(".srce img").classList.add("animirajsrcedva");
                ceoekran.classList.add("animirajsrcedva");
                var ispislajkova=document.querySelector("#lajkuj-preko-celog-ekrana span");
                var trenutanBroj=parseInt(ispislajkova.textContent);
                var novi=trenutanBroj-1;
                ispislajkova.textContent=novi;
            }
        }, 100
    )
    trenutnibrojelement=document.getElementById(id+"brojlajkova"); 
    var trenutnibroj = parseInt(trenutnibrojelement.textContent);
    var novibroj = trenutnibroj++;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            trenutnibrojelement.innerHTML = this.responseText;
        }
    };
xhttp.open("POST", "backend/lajkuj.php", false);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("id="+id+"&profil="+profil);
}
function lajkujnelogovan(){
    prikazialert("morate se ulogovati da bi mogli da lajkujete!")
}
