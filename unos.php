<div id="unos">
    <form onsubmit="return proveriUnos()" class="form-container" autocomplete="off" method="post" action="backend/unospesme.php">
        <div class="card text-center kartica">
            <div class="card-header pisac">
                <div class="pogodnost">
                    <div id="pogodnost-tekst" class="pogodnost-tekst">Ova pesma je pogodna za sve?</div>
                    <div class="pogodnost-odabir">
                        <select class="btn btn-primary" name="pogodna" id="pogodna">
                            <option value="jeste">Da</option>
                            <option value="nije">Ne</option>
                        </select>
                    </div>
                </div>
                <span class="x" onclick="zatvori()">&times;</span>
            </div>
            <div class="card-body telo-kartice">
                <input type="hidden" id="bojainput" name="boja" value="bela">
                <input type="hidden" id="publikainput" name="publika" value="javno">
                <input type="hidden" name="pisac" value="<?php echo $_SESSION['ime'];?>">
                <div class="form-group">
                    <input minlength="2" maxlength="20" onkeyup="proveri()" type="text"  placeholder=" " name="naslov" id="naslov" aria-describedby="emailHelp" autocomplete="off" required >
                    <label for="naslov" id="lnaslov">
                        <span class="label-tekst" id="username-label-tekst">Naslov</span>
                    </label>
                </div>
                <div class="okvir-za-unos-pesme">
                    <textarea require minlength="30" onkeyup="proveri()" id="unospesme" name="pesma" placeholder="Tekst pesme"></textarea>
                </div>
                <select class="btn btn-primary" name="kategorija" id="kategorija">
                    <option value="neodredjeno">Odaberite Kategodiju</option>
                    <option value="ljubavne">Ljubavne</option>
                    <option value="decije">Dečije</option>
                    <option value="porodicne">Porodične</option>
                    <option value="zivotinje-i-priroda">Životinje i priroda</option>
                    <option value="rodoljubive-i-religijske">Rodoljubive/Religijske</option>
                    <option value="ostale">Ostale</option>
                </select>
            </div>
            <div class="card-footer text-muted vreme">
            <div class="boja"><div class="boje">
                    <div onclick="promeni_boju('bela', 0)" id="bela" class="aktivna bojaizbor"></div>
                    <div onclick="promeni_boju('crvena', 1)" id="crvena" class="bojaizbor"></div>
                    <div onclick="promeni_boju('narandzasta', 2)" id="narandzasta" class="bojaizbor"></div>
                    <div onclick="promeni_boju('zuta', 3)" id="zuta" class="bojaizbor"></div>
                    <div onclick="promeni_boju('zelena', 4)" id="zelena" class="bojaizbor"></div>
                    <div onclick="promeni_boju('plavozelena', 5)" id="plavozelena" class="bojaizbor"></div>
                    <div onclick="promeni_boju('svetloplava', 6)" id="svetloplava" class="bojaizbor"></div>
                    <div onclick="promeni_boju('tamnoplava', 7)" id="tamnoplava" class="bojaizbor"></div>
                    <div onclick="promeni_boju('ljubicasta', 8)" id="ljubicasta" class="bojaizbor"></div>
                    <div onclick="promeni_boju('roze', 9)" id="roze" class="bojaizbor"></div>
                    <div onclick="promeni_boju('braon', 10)" id="braon" class="bojaizbor"></div>
                    <div onclick="promeni_boju('dark', 11)" id="dark" class="bojaizbor"></div>
                </div>
                    <img src="fajlovi/boja.svg">
                </div>
                <div class="vreme-tekst">
                    <button type="submit" name="unosdugme" class="btn btn-primary">Objavite</button>
                </div>
                <div class="publika">
                <div class="publika-izbor-kontejner">
                        <div onclick="promeni_publiku('javno', 0)" id="publika-javno"  class="publika-izbor aktivna-publika">
                            <img src="fajlovi/public.png" alt="Javno"><p>Javno</p>
                        </div>
                        <div onclick="promeni_publiku('korisnici', 1)" id="publika-korisnici-sajta" class="publika-izbor">
                            <img src="fajlovi/korisnici.png" alt="Korisnici sajta"><p>Prijavljeni korisnici</p>
                        </div>
                        <div onclick="promeni_publiku('link', 2)" id="publika-link" class="publika-izbor">
                            <img src="fajlovi/link.png" alt=""><p>Samo osobe sa linkom</p>
                        </div>
                        <div onclick="promeni_publiku('privatno', 3)" id="publika-privatno" class="publika-izbor">
                            <img src="fajlovi/private.webp" alt="Privatno"><p>Samo ja</p>
                        </div>
                    </div>
                    <img id="publika-slika" src="fajlovi/public.png" />
                </div>
            </div>
        </div>
    </form>
</div>