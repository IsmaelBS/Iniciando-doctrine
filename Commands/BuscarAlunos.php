<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Doctrine\Entity\Aluno;
use App\Doctrine\Entity\Telefone;
use App\Doctrine\Helper\EntityManagerFactory;
use Doctrine\Common\Collections\Collection;

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(Aluno::class);

/**
 * @var Aluno[] $alunoList
 */
$alunoList = $alunoRepository->findAll();

foreach ($alunoList as $aluno) {
  if ($aluno->getTelefones() instanceof Collection) {
    $telefones = $aluno->getTelefones()
    ->map(function (Telefone $tel) { return $tel->getNumero(); })
    ->toArray();
  }
  
  echo "ID: {$aluno->getId()} \nName: {$aluno->getName()}" . PHP_EOL;
  echo "Telefones: ".implode(", ", $telefones). "\n\n" . PHP_EOL;
}