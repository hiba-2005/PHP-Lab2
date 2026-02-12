
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
 
spl_autoload_register(function (string $class){
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../src/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
         use App\Entity\Filiere;

$f = new Filiere(null, "FiliereInformatique");
echo $f->getLibelle();

echo "<br>";
use App\Entity\Etudiant;


$f = new Filiere(1, "FiliereMathématiques");
echo "<br>";
$e = new Etudiant(null, "hiba", "hiba@test.com", $f);
echo "<br>";
echo $e->getNom() . " - " . $e->getFiliere()->getLibelle();
try {
    $bad = new Etudiant(null, "", "notmail", $f);
} catch (\InvalidArgumentException $ex) {
    echo "Une erreur est survenue : " . $ex->getMessage();
}
;
echo "<br>";
use App\Repository\FakeEtudiantRepository;

$repo = new FakeEtudiantRepository();
$f1 = new Filiere(1, "FiliereInformatique");

$e1 = new Etudiant(null, "manal", "manal@test.com", $f1);
$e2 = new Etudiant(null, "younesse", "younesse@test.com", $f1);

$repo->save($e1);
$repo->save($e2);

echo "Add:\n";
echo "<br>";
foreach ($repo->findAll() as $e) {
    echo $e->getId() . " - " . $e->getNom() . " (" . $e->getFiliere()->getLibelle() . ")\n";
}
echo "<br>";

$e1->setNom("hiba ouirouane");
$repo->save($e1);
echo "<br>";
echo "Update:\n";
echo "<br>";
echo $repo->findById($e1->getId())->getNom() . "\n";

$repo->delete($e2->getId());
echo "<br>";
echo "delete:\n";
echo "<br>";
foreach ($repo->findAll() as $e) {
    echo $e->getNom() . "\n";
}
Exécuter :
?>
    </body>
</html>
