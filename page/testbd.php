<?PHP
// ------------------------------------------------------------------------- //
// Test de connection à MySQL                                                //
// ------------------------------------------------------------------------- //
/*

Auteur : Joe l'indien
Mail : joe.francois@creacy.com
Site Web : http://www.creacy.com

.------------------------------------------------------------------------------------.
|Ce script vous permet de vérifier si une connection est possible avec MySQL         |
|------------------------------------------------------------------------------------.
| Tous d'abord déclarons les variables  :                                            |
| $sql_host = le nom de l'hôte du serveur MySQL, le plus souvent "localhost"         |
| $sql_user = L'utilisateur   (par défaut "root")                                    |
| $sql_pwd = Le password de l'utilisateur       (par défaut "pas de password")       |
| $sql_port = Le port utilisé par MySQL (par défaut "3306")                          |
| $sql_db = La base de données auquel vous voulez accéder                            |
|                                                                                    |
.------------------------------------------------------------------------------------.

*/


//Éditez les varibales ci dessous
$sql_host = '153.92.220.151';
$sql_user = 'u161682765_ultimatebd';
$sql_pwd = '7>vEV#s9t';
$sql_port = '3306';//pas du tout obligatoire si vous avez laissé le port par défaut
$sql_db = 'u161682765_ultimate';

if($id = mysqli_connect($sql_host,$sql_user,$sql_pwd))//Si j'arrive à me connecter avec ses paramêtres
{ if($id_db = mysql_select_db($sql_db))//Puis à cette base de données
 { echo "Succès !";//Ça roule !
 }else{
 die("Echec");//Ou impossible de se connecter à la base :( (vous êtes connectez au serveur mais impossible //de sélectionner la base $sql_db)
 }
 
mysql_close($id);
}else{
die("Echec complet");//Ou encore pire ! L'échec complet, c'est que vous n'êtes même pas arriver à vous connecter !
}
?>