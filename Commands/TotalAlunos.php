<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Doctrine\Entity\Aluno;
use App\Doctrine\Helper\EntityManagerFactory;

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$className = Aluno::class;
$dql = "SELECT COUNT(aluno) FROM $className aluno";

$contagem_cursos = $entityManager->createQuery($dql)->getSingleScalarResult();

echo $contagem_cursos . PHP_EOL;