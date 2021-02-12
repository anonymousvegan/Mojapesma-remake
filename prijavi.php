<div id="prijavi">
    <div id="prijavicentar">
    <p>Unesite razlog prijave... Ukoliko  lažno prijavljujete postoji mogućnost da budete privremeno ili trajno udaljeni sa sajta. </p>
    <form action="backend/prijavapesme.php" method="post">
    <textarea name="tekst-prijave" placeholder="Unesite razlog prijave"></textarea>
    <input type="hidden" id="id-pesme-za-prijavu" name="id"/>
    <button type="submit" class="btn btn-danger">Prijavite</button>
</div>
<span class="x" onclick="zatvoriprijavu()">&times;</span>
</div>