<?php

use App\Doctrine\Entity\Aluno;
use App\Doctrine\Entity\Telefone;
use App\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$aluno = new Aluno();
$aluno->setName($argv[1]);

for ($i = 2;$i < $argc; $i++) {
  $numeroTelefone = $argv[$i];
  $telefone = new Telefone();
  $telefone->setNumero($numeroTelefone);
  
  $aluno->addTelefone($telefone);
  $entityManager->persist(($telefone));
}
$entityManager->persist($aluno);

$entityManager->flush();
