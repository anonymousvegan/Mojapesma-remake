<div class="pesma-preko-celog-ekrana">
    <div onclick="prethodna()" id="leva-strelica" class="strelica">&#x2039;</div>
    <div onclick="sledeca()" id="desna-strelica" class="strelica">&#x203A;</div>
    <div class="okvir-za-pesmu">
        <div class="header-pesme-preko-celog-ekrana">
            <div class="profilna-pisca-ceo-ekran">
                    <a href="profil.php?profil=kemal">
                        <img src="fajlovi/profile-icon.svg">
                    </a>
            </div>
            <div class="pisac">
                <a href="profil.php?profil=anonymousvegan" id="pisac-preko-celog-ekrana">anonymousvegan</a>
            </div>
            <div class="tacke" onclick="prikaziOpcije(this)">
                <img src="fajlovi/tacke.png">
                <div class="opcije">
                </div>
            </div>
        </div>
        <div id="skrol">
        <h5 id="naslov-preko-celog-ekrana">Krvava bajka</h5>
        <p id="tekst-pesme-preko-celog-ekrana"></p>
        </div>
    </div>
    <div id="okvirzakomentare" class="okvir-za-komentare">
        <div id="okvir-za-vreme-preko-celog-ekrana">
            <div id="lajkuj-preko-celog-ekrana"  class="srce"><img src="fajlovi/srce-puno.png"><span id="brojlajkovaceoekran"></span></div>
            <div id="vreme-preko-celog-ekrana"></div>
            <div class="x" onclick="zatvori_pesmu_preko_celog_ekrana()">&times;</div>
        </div>
        <input id="autorkomentara" type="hidden" name="autor" value="<?php echo $_SESSION['ime']?>">
        <input id="id-pesme-za-komentarisanje" type="hidden" name="idpesme">
        <div id="komentari">
        <?php  require "ispiskomentara.php";?>
        </div>
        <div class="form-group">
        <input type="text" name="komentar" id="unoskomentara" placeholder=" " autocomplete="off" require/>
        <label for="unoskomentara" id="lkomentar">
            <span class="label-tekst" id="komentar-label-tekst">Unesi komentar...</span>
        </label>
        <img onclick="komentarisimobilni()" src="fajlovi/posalji.svg" id="posaljikomentarikonica">
        </div>
    </div>
</div>