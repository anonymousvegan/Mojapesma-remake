<div id="izbor">
    <div class="pretraga">
        <form class="form-container" autocomplete="off" method="get" action="pretraga.php">
            <div class="form-group">
                <input type="text"  placeholder=" " class="form-control" name="pretraga" id="pretraga" aria-describedby="emailHelp" autocomplete="off" required >
                <label for="pretraga" id="lpretraga">
                <span class="label-tekst" id="pretraga-label-tekst">Pretraži...</span></label>
                <img src="fajlovi/pretraga.webp" alt="pretraga">
            </div> 
            <button type="submit" id="pretraga-dugme">
        </form>
    </div>
    <div class="odabir odabrano " id="grid" onclick="grid()">
        <img src="fajlovi/grid.png" alt="grid">
    </div>
<!-- ovo je bilo nekad za listu, sada želim prikaz   <div class="odabir"  id="lista" onclick="lista()" > -->
    <div class="odabir"  id="lista" onclick="prikazi_vise_ceo_ekran(); lista();" >
        <img src="fajlovi/lista.svg" alt="lista">
    </div>
</div>
<script>
    function lista(){
        document.getElementById('grid').classList.remove("odabrano");
        document.getElementById('lista').classList.add("odabrano");
    }    
    function grid(){
        document.getElementById('grid').classList.add("odabrano");
        document.getElementById('lista').classList.remove("odabrano");
    }
</script>