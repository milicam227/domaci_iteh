<?php

require "dbBroker.php";
require "model/prijava.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$rezultat=Prijava::getAll($conn);

if(!$rezultat){
    echo("Neuspesna konekcija");
    die();
}
else{



?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Zakazivanje projekata</title>

</head>

<body>


<div class="div1" ><h1>Zakazivanje projekata studentskih organizacija</h1></div> <br><br><br>

<div class="row"  >
    <div class="div3">
        <button id="vidi"  class="btn_vidi" 
        s> Zakazani projekti</button>
    </div><br>
    
    <div class="div4">
            <button id="prijavise" type="button" class="btn_prijavise" data-toggle="modal" data-target="#prikaziModal">Zakaži</button>

        </div>
    
    
    <br>
    <div class="div5"> 
 
            
            <input type="text" id="ulaz" onkeyup="nadji()" placeholder="Pretraži projekte po organizatoru" >
        
    </div><br>
</div>



<div  class="divp" >

    <div class="div6" >
        <table id="tabela" class="tabela_koncerata" border="3" style=" background-color:rgb(43, 145, 185)">
            <thead class ="zaglavlje">
            <tr >
                <th scope="kolona" style="background-color:rgb(43, 145, 185) " >Naziv</th>
                <th scope="kolona" style="background-color:rgb(43, 145, 185) " >Datum</th>    
                <th scope="kolona" style="background-color:rgb(43, 145, 185) " >Mesto</th>
                <th scope="kolona" style="background-color:rgb(43, 145, 185) " >Organizator</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    while ($red = $rezultat->fetch_array()) :
                    ?>
                <tr >
                    <td><?php echo $red["naziv"] ?></td>
                    <td><?php echo $red["datum"] ?></td>
                    <td><?php echo $red["mesto"] ?></td>
                    <td><?php echo $red["organizator"] ?></td>
                    <td >
                        <label class="oznaci">
                        <input type="radio" name="cekiranje" value=<?php echo $red["id"] ?>>
                                    <span class="checkmark"></span>
                        </label>
                    </td>

                </tr>
                <?php
                    endwhile;
                    }
                ?>
            </tbody>
        </table>
        <div class="row" >
            <div class="div8" >
                <button id="azuriraj" class="btn_azuriraj" data-toggle="modal" data-target="#azurirajModal">AŽURIRAJ</button>
                
            </div>

            
            <div class="col-md-12" >
                    <button id="btn-obrisi" type="button" formmethod="post" class="btn btn-danger">UKLONI</button>
                </div>
            <div class="div10"  >
                    <button id="uredi" class="btn_uredi" onclick="sortirajTabelu()">SORTIRAJ</button>
                </div>

        </div>
    </div>
</div>



<div class="modal" id="prikaziModal"  role="dialog"  style=" background-color:#b9ebff">
    <div class="div12" style=" background-color:#b9ebff">

        
        <div class="modal-content" style=" background-color:#b9ebff">
            <div class="div14">
                <button type="button" class="zatvori" data-dismiss="modal">&times;</button>
            </div>
            <div class="div15">
                <div class="fprijava">
                    <form action="#" method="post" id="dodajForm">
                        <h3>Zakazi</h3>
                        <div class="row">
                            <div class="div16 ">
                                <div class="form-group">
                                    <label for="">Naziv: </label>
                                    <input type="text"  name="naziv" class="form-control"/> 
                                </div><br>
                                <div class="div18">
                                <div class="form-group">
                                    <label for="">Datum: </label>
                                    <input type="date"   name="datum" class="form-control"/>
                                </div>
                                </div><br>
                                
                                <div class="form-group">
                                    <label for="mesto">Mesto: </label>
                                    <input type="text"  name="mesto" class="form-control"/>
                                </div><br>
                                <div class="form-group">
                                <label for="">Organizator: </label>
                                    <input type="text"  name="organizator" class="form-control"/>
                                </div><br>
                                
                                <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" >Zakazi</button>
                                    </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



 </div>



 <div class="modal" id="azurirajModal" role="dialog"  style=" background-color: #FFDAB9">
    <div class="div24" style=" background-color: #FFDAB9">

     
        <div class="modal-content" style=" background-color:#FFDAB9">
            <div class="div26" style=" background-color:#FFDAB9">
                <button type="button" class="zatvori" data-dismiss="modal">&times;</button>
            </div>
            <div class="div27" >
                <div class="div28">
                    <form action="#" method="post" id="azuriranje">
                        <h3 >Ažuriraj projekat</h3>
                        <div class="row">
                            <div class="div30">
                                <div class="div31">
                                    <input id="idPrijava" type="text" name="idPrijava" class="frm"
                                           placeholder="idPrijava *" value="" readonly />
                                </div><br>
                                <div class="div32">
                                    <input id="izvodjac" type="text" name="izvodjac" class="frm"
                                           placeholder="izvodjac *" value=""/>
                                </div><br>
                                <div class="div35">
                                    <input id="datum" type="date" name="datum" class="frm"
                                           placeholder="datum *" value=""/>
                                </div><br>
                                <div class="div33">
                                    <input id="mesto" type="text" name="mesto" class="frm"
                                           placeholder="mesto *" value=""/>
                                </div><br>
                                <div class="div34">
                                    <input id="idVolonter" type="text" name="idVolonter" class="frm"
                                           placeholder="idVolonter *" value=""/>
                                </div><br>
                                
                                <div class="div36">
                                    <button id="btnIzmeni" type="submit" class="izmeni"
                                           > Izmeni
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="div37">
                <button type="button" class="kraj " data-dismiss="modal">Kraj</button>
            </div>
        </div>



</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
    
  




<script>

        function sortirajTabelu() {
            console.log("Pozvana");
            var table, rows, s, i, a, b, shouldS;
            table = document.getElementById("tabela");
            s = true;

            while (s) {
                s = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldS = false;
                    a = rows[i].getElementsByTagName("td")[1];
                    b = rows[i + 1].getElementsByTagName("td")[1];
                    if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
                        shouldS = true;
                        break;
                    }
                }
                if (shouldS) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    s = true;
                }
            }
        }




        function nadji() {
            var unos, filter, table, tr, td, i, txtValue;
            unos = document.getElementById("ulaz");
            filter = unos.value.toUpperCase();
            table = document.getElementById("tabela");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
       

</script>



</body>
</html>

