<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Doctrine\Entity\Aluno;
use App\Doctrine\Entity\Telefone;
use App\Doctrine\Helper\EntityManagerFactory;

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(Aluno::class);


/**
 * @var Aluno[] $alunoList
 */
$alunoList = $alunoRepository->findAll();

foreach ($alunoList as $aluno) {
  $telefones = $aluno->getTelefones()->map(function (Telefone $tel) { return $tel->getNumero(); })->toArray();
  echo "ID: {$aluno->getId()} \nName: {$aluno->getName()}" . PHP_EOL;
  echo "Telefones: ".implode(", ", $telefones);
}